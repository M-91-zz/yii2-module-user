<?php
namespace id5\rbac\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use id5\rbac\components\UserIdentity;
use id5\rbac\Module;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property int $id
 * @property string $username
 * @property string $password_hash
 * @property string $email
 * @property string $auth_key
 * @property string $password_reset_token
 * @property int $status
 * @property int $superadmin
 * @property string $created_at
 * @property string $updated_at
 */
class User extends UserIdentity
{
    
    const STATUS_UNCONFIRMED = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 99;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_UNCONFIRMED],
            ['superadmin', 'default', 'value' => 0],
            ['status', 'in', 'range' => [
                self::STATUS_ACTIVE,
                self::STATUS_DELETED,
                self::STATUS_UNCONFIRMED
            ]],
            [['username', 'password_hash', 'email'], 'required'],
            [['username', 'password_hash', 'email', 'auth_key', 'password_reset_token'], 'string'],
            [['status', 'superadmin'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('app', 'ID'),
            'username' => Module::t('app', 'Username'),
            'password_hash' => Module::t('app', 'Password Hash'),
            'email' => Module::t('app', 'Email'),
            'auth_key' => Module::t('app', 'Auth Key'),
            'password_reset_token' => Module::t('app', 'Password Reset Token'),
            'status' => Module::t('app', 'Status'),
            'superadmin' => Module::t('app', 'Superadmin'),
            'created_at' => Module::t('app', 'Created At'),
            'updated_at' => Module::t('app', 'Updated At'),
        ];
    }

    /**
     * @return boolean
     */
    public function isSuperadmin(): bool
    {
        return $this->superadmin;
    }
}
