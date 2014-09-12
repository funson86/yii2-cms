<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "admin".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $role
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Admin extends \yii\db\ActiveRecord
{
	const STATUS_INACTIVE = 0;
	const STATUS_ACTIVE = 10;

	/**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%admin}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            //[['username'], 'unique'],
            [['username'], 'validateUnique'],
            [['role', 'status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'email' => Yii::t('app', 'Email'),
            'role' => Yii::t('app', 'Role'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

	public static function getArrayStatus()
	{
		return [
			self::STATUS_INACTIVE => Yii::t('users', 'Deleted'),
			self::STATUS_ACTIVE => Yii::t('users', 'Active'),
		];
	}
	/**
	 * @return string Readable user status
	 */
	public function getStatusLabel()
	{
		$statuses = self::getArrayStatus();
		return $statuses[$this->status];
	}

	public function validateUnique()
	{
		/*if (!$this->hasErrors())
		{
			if ($this->isNewRecord) {
				$this->addError('name', 'This name already exists.');
			}
		}*/
		$this->addError('username', 'This name already exists.');
		return false;
	}
}
