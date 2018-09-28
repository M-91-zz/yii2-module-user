<?php

namespace marcelodeandrade\UserModule\filters;

use Yii;

class AccessRule extends \yii\filters\AccessRule
{
    /**
     * @inheritDoc
     */
    protected function matchRole($user)
    {
        if (!$this->roles)
            return true;
        
        foreach ($this->roles as $role) {
            switch ($role) {
                case 'admin':
                    if (!$user->isGuest && $user->identity->isSuperadmin()) 
                        return true;
                case '?':
                    if ($user->isGuest) 
                        return true;
                case '@':
                    if (!$user->isGuest) 
                        return true;
                default:
                    if ($user->can($role)) 
                        return true;
            }
        }

        return false;
    }
}
