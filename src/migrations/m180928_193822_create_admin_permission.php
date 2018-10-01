<?php

use yii\db\Migration;

/**
 * Class m180928_193822_create_admin_permission
 */
class m180928_193822_create_admin_permission extends Migration
{
    public function up()
    {
        $auth = Yii::$app->authManager;
        $admin = $auth->createRole('admin');
        $admin->description = 'Admin rules all';
        $auth->add($admin);
    }
    
    public function down()
    {
        (Yii::$app->authManager)->removeAll();
    }
}
