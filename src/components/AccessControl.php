<?php

namespace marcelodeandrade\UserModule\components;

use Yii;
use yii\base\ActionFilter;

class AccessControl extends \yii\filters\AccessControl
{
    public function beforeAction($action)
    {
        $user = $this->user;

        if ($user->isGuest || $user->identity === null) {
            $this->denyAccess($user);
            return false;
        }
        
        if ($user->identity->isSuperadmin())
            return true;

        return false;
    }

    protected function denyAccess($user)
    {
        if ($user !== false && $user->getIsGuest()) {
            $user->loginRequired();
        } else {
            throw new ForbiddenHttpException(Yii::t('yii', 'You are not allowed to perform this action.'));
        }
    }
}