<?php

namespace M91\UserModule\filters;

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
            if ($role === 'admin' && (!$user->isGuest && $user->identity->isSuperadmin())) {
                return true;
            }
            
            elseif ($role === '?' && $user->isGuest) {
                return true;
            }
            
            elseif ($role === '@' && !$user->isGuest) {
                return true;
            }

            elseif ($user->can($role)) {
                return true;
            }
        }

        return false;
    }
}
