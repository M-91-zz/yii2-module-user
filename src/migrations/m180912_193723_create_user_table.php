<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m180912_193723_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull(),
            'password_hash' => $this->string()->notNull(),
            'email' => $this->string()->notNull(),
            'auth_key' => $this->string(),
            'password_reset_token' => $this->string(),
            'status' => $this->tinyInteger()->defaultValue(0),
            'superadmin' => $this->tinyInteger()->defaultValue(0),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
