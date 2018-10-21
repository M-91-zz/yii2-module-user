<?php

namespace M91\UserModule\models;

use Yii;
use yii\rbac\Item;

class Role extends AuthItem
{
    public $type = Item::TYPE_ROLE;
}
