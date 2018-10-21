<?php

namespace M91\UserModule\models;

use Yii;
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
    
    public function __construct($authItem)
    {
        $this->authManager = Yii::$app->authManager;
        $this->authItem = $authItem;

        if (!is_null($authItem) && $properties = get_object_vars($authItem)) {
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
            ['name', function ($attribute, $params, $validator) {
                if ($this->authManager->getRole($this->name) !== null || $this->authManager->getPermission($this->name) !== null) {
                    $this->addError($attribute, Module::t('app', 'Item name must be unique. [{name}] already exists', [
                        'name' => $this->name,
                    ]));
                }
            }],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app', 'Name'),
            'type' => Yii::t('app', 'Type'),
            'description' => Yii::t('app', 'Description'),
            'ruleName' => Yii::t('app', 'Rule Name'),
            'data' => Yii::t('app', 'Data'),
            'createdAt' => Yii::t('app', 'Created At'),
            'updatedAt' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return boolean
     */
    public function isNewRecord(): bool
    {
        return $this->authItem === null;
    }

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
            return $this->authManager->add($authItem);
        }
        
        return $this->authManager->update($this->authItem->name, $authItem);
    }
}
