<?php

use yii\db\Migration;
// https://github.com/yiisoft/yii2-app-advanced/blob/master/console/migrations/m130524_201442_init.php
class m180912_193723_create_user_table extends Migration
{
    public function up()
    {
        $tableName = Yii::$app->db->tablePrefix .'user';

        if (Yii::$app->db->getTableSchema($tableName, true) === null) {
            $tableOptions = null;
            if ($this->db->driverName === 'mysql') {
                // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
                $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
            }
            $this->createTable('{{%user}}', [
                'id' => $this->primaryKey(),
                'username' => $this->string()->notNull()->unique(),
                'auth_key' => $this->string(32)->notNull(),
                'password_hash' => $this->string()->notNull(),
                'password_reset_token' => $this->string()->unique(),
                'email' => $this->string()->notNull()->unique(),
                'status' => $this->smallInteger()->notNull()->defaultValue(0),
                'superadmin' => $this->smallInteger()->notNull()->defaultValue(0),
                'created_at' => $this->integer()->notNull(),
                'updated_at' => $this->integer()->notNull(),
            ], $tableOptions);
        }

    }
    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
