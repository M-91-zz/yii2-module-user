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
            if ($role === 'admin') {
                if (!$user->isGuest && $user->identity->isSuperadmin()) {
                    return true;
                }
            }
            elseif ($role === '?') {
                if ($user->isGuest) {
                    return true;
                }
            }
            elseif ($role === '@') {
                if (!$user->isGuest) {
                    return true;
                }
            } 
            elseif ($user->can($role)) {
                return true;
            }
        }

        return false;
    }
}
