<?php

namespace M91\UserModule\models;

use Yii;
use yii\rbac\Item;

class Permission extends AuthItem
{
    public $type = Item::TYPE_PERMISSION;
}
