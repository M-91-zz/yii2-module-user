<?php

namespace id5\rbac\components;

use Yii;
use yii\base\ActionFilter;

class AccessControl extends \yii\filters\AccessControl
{
    public function beforeAction($action)
    {
        if (Yii::$app->user->identity->isSuperadmin())
            return true;

        return parent::beforeAction($action);
    }
}