<?php

namespace marcelodeandrade\UserModule\models;

use Yii;
use yii\base\Model;
use yii\rbac\Item;
use marcelodeandrade\UserModule\Module;

class Role extends Model
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
    public $type = Item::TYPE_ROLE;

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
                if ($this->authManager->getRole($this->name) !== null) {
                    $this->addError($attribute, Module::t('app', 'Role name must be unique. [{name}] already exists', [
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
        $role = $this->authManager->createRole($this->name);
        $role->description = $this->description;

        return $this->validate() && $this->authManager->add($role);
    }

}
