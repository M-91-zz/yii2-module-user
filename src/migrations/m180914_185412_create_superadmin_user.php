<?php

use yii\db\Migration;
use M91\UserModule\models\User;

/**
 * Class m180914_185412_create_superadmin_user
 */
class m180914_185412_create_superadmin_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $user = new User();
        $user->username = 'superadmin';
        $user->setPassword('superadmin');
        $user->email = 'superadmin@superadmin.com';
        $user->status = User::STATUS_ACTIVE;
        $user->generateAuthKey();
        $user->superadmin = 1;
        $user->save(false);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $user = User::findByUsername('superadmin');
        if ($user)
            $user->delete();
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180914_185412_create_superadmin_user cannot be reverted.\n";

        return false;
    }
    */
}
