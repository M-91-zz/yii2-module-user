<?php

namespace M91\UserModule\models;

use Yii;
use yii\base\Model;
use yii\rbac\Item;
use M91\UserModule\Module;

class Permission extends Model
{
    /**
     * @var [string]
     */
    public $name;

    /**
     * @var [string]
     */
    public $description;

    /**
     * @var [string]
     */
    public $type = Item::TYPE_PERMISSION;

    public $authManager;

    public function __construct()
    {
        $this->authManager = Yii::$app->authManager;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['name', 'description'], 'string'],
            [['name', 'description'], 'trim'],
            ['name', function ($attribute, $params, $validator) {
                if ($this->authManager->getPermission($this->name) !== null) {
                    $this->addError($attribute, Module::t('app', 'Permission name must be unique. [{name}] already exists', [
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
            'name' => Module::t('app', 'Name'),
            'description' => Module::t('app', 'Description'),
        ];
    }

    /**
     * @return boolean
     */
    public function save(): bool
    {
        $permission = $this->authManager->createPermission($this->name);
        $permission->description = $this->description;

        return $this->validate() && $this->authManager->add($permission);
    }

    public function permissionList()
    {

    }

}
