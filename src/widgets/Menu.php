<?php

namespace M91\UserModule\widgets;

use yii\bootstrap\Nav;
use M91\UserModule\Module;

class Menu extends Nav
{
    /**
     * @inheritdoc
     */
    public $options = [
        'class' => 'nav-tabs'
    ];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->items = [
            [
                'label' => Module::t('rbac', 'Roles'),
                'url'   => ['/user-module/role/index'],
            ],
            [
                'label' => Module::t('rbac', 'Create'),
                'items' => [
                    [
                        'label' => Module::t('rbac', 'Create Role'),
                        'url'   => ['/user-module/role/create']
                    ],
                ]
            ],
        ];
    }
}
