<?php

namespace M91\UserModule\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\rbac\Item;
use M91\UserModule\Module;

/**
 *
 * @property string $name
 * @property int $type
 * @property string $description
 * @property string $ruleName
 * @property resource $data
 * @property int $createdAt
 * @property int $updatedAt
 *
 */
class AuthItem extends \yii\base\Model
{
    /**
     * @var string $name
     */
    public $name;

    /**
     * @var int $type
     */
    public $type;

    /**
     * @var string $description
     */
    public $description;

    /**
     * @var string $ruleName
     */
    public $ruleName;

    /**
     * @var string $data
     */
    public $data;

    /**
     * @var int $createdAt
     */
    public $createdAt;

    /**
     * @var int $updatedAt
     */
    public $updatedAt;

    /**
     * @var \yii\rbac\ManagerInterface $authManager
     */
    public $authManager;

    /**
     * @var string $authItem
     */
    public $authItem;

    /**
     * @var array $items
     */
    public $items;

    public $subRoles;
    public $permissions;

    public function __construct($authItem = null)
    {
        $this->authManager = Yii::$app->authManager;
        $this->authItem = $authItem;
        
        if (!is_null($authItem) && $properties = get_object_vars($authItem)) {
            $this->subRoles = $this->getChildren(Item::TYPE_ROLE);
            $this->permissions = $this->getChildren(Item::TYPE_PERMISSION);
            
            foreach ($properties as $key => $value) {
                $this->$key = $value;
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'type', 'description'], 'required'],
            [['name', 'description', 'ruleName', 'data'], 'string'],
            [['type', 'createdAt', 'updatedAt'], 'integer'],
            [['name', 'description'], 'trim'],
            [['items', 'subRoles', 'permissions'], 'safe'],
            ['name', function ($attribute, $params, $validator) {
                if (
                    $this->authManager->getRole($this->name) !== null
                    || $this->authManager->getPermission($this->name) !== null
                ) {
                    $this->addError($attribute, Module::t('app', 'Item name must be unique. [{name}] already exists.', [
                        'name' => $this->name,
                    ]));
                }
            },
            'when' => function ($model) {
                return $model->isNewRecord();
            }],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => Module::t('app', 'Name'),
            'type' => Module::t('app', 'Type'),
            'description' => Module::t('app', 'Description'),
            'ruleName' => Module::t('app', 'Rule Name'),
            'data' => Module::t('app', 'Data'),
            'createdAt' => Module::t('app', 'Created At'),
            'updatedAt' => Module::t('app', 'Updated At'),
            'items' => Module::t('app', 'Items'),
        ];
    }

    /**
     * @return boolean
     */
    public function isNewRecord(): bool
    {
        return $this->authItem === null;
    }

    /**
     * @param Item $authItem
     * @return void
     */
    public function fillAuthItem(Item &$authItem): void
    {
        $authItem->name = $this->name;
        $authItem->type = $this->type;
        $authItem->description = $this->description;
        $authItem->ruleName = $this->ruleName;
        $authItem->data = $this->data;
        $authItem->createdAt = $this->createdAt;
        $authItem->updatedAt = $this->updatedAt;
    }

    /**
     * @return boolean
     */
    public function save(): bool
    {
        $authItem = ($this->type === Item::TYPE_ROLE)
            ? $this->authManager->createRole($this->name)
            : $this->authManager->createPermission($this->name);

        $this->fillAuthItem($authItem);

        if ($this->isNewRecord()) {
            $return = $this->authManager->add($authItem);
        } else {
            $return = $this->authManager->update($this->authItem->name, $authItem);
        }
        
        if ($return) {
            $this->saveChildren();
        }

        return $return;
    }

    /**
     * @param integer $type
     * @return array
     */
    public function getAuthItems(int $type): array
    {
        $authItem = ($type === Item::TYPE_ROLE)
            ? $this->authManager->getRoles()
            : $this->authManager->getPermissions();

        $roles = ArrayHelper::map(
            $authItem,
            'name',
            'name'
        );
        
        if (!is_null($this->authItem)) {
            $roles = array_filter($roles, function($name) {
                return $name !== $this->authItem->name ? $name : false;
            });
        }

        return $roles;
    }

    /**
     * @param integer $type
     * @return array
     */
    public function getChildren(int $type): array
    {
        $authItem = ($type === Item::TYPE_ROLE)
        ? $this->authManager->getChildRoles($this->authItem->name)
        : $this->authManager->getPermissionsByRole($this->authItem->name);

        return ArrayHelper::map(
            $authItem,
            'name',
            'name'
        );
    }

    /**
     * @return void
     */
    public function saveChildren()
    {
        if (!is_null($this->authItem)) {
            $this->removeChildren($this->authItem);
        }
        $this->addChild($this->permissions);
        $this->addChild($this->subRoles);
    }

    /**
     * @param Item $parent
     * @return boolean
     */
    public function removeChildren(Item $parent): bool
    {
        return $this->authManager->removeChildren($parent);
    }

    /**
     * @param array|null $items
     * @return void
     */
    public function addChild($items): void
    {
        if ($items) {
            foreach ($items as $name) {
                $child = $this->authManager->getPermission($name);
                if (empty($child)) {
                    $child = $this->authManager->getRole($name);
                }
                if ($this->authManager->canAddChild($this->authItem, $child)) {
                    $this->authManager->addChild($this->authItem, $child);
                }
            }
        }
    }
}
