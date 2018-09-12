<?php
namespace id5\rbac\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use id5\rbac\components\UserIdentity;

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
class User extends ActiveRecord implements UserIdentity
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
            'id' => Yii::t('id5.rbac', 'ID'),
            'username' => Yii::t('id5.rbac', 'Username'),
            'password_hash' => Yii::t('id5.rbac', 'Password Hash'),
            'email' => Yii::t('id5.rbac', 'Email'),
            'auth_key' => Yii::t('id5.rbac', 'Auth Key'),
            'password_reset_token' => Yii::t('id5.rbac', 'Password Reset Token'),
            'status' => Yii::t('id5.rbac', 'Status'),
            'superadmin' => Yii::t('id5.rbac', 'Superadmin'),
            'created_at' => Yii::t('id5.rbac', 'Created At'),
            'updated_at' => Yii::t('id5.rbac', 'Updated At'),
        ];
    }

}
