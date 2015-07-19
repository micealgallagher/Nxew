<?php

namespace app\models;

use Yii;
use DateTime;
use app\common\Constant;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $forename
 * @property string $surname
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property string $type
 * @property integer $created_at
 * @property integer $updated_at
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{


    public static function tableName()
    {
        return 'user';
    }

    /**
     * Finds an identity by the given ID.
     *
     * @param string|integer $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findByUsername($username) {
        return User::findOne(['username' => $username]);
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string current user auth key
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @param string $authKey
     * @return boolean if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['forename', 'surname', 'username', 'password_hash', 'email', 'created_at', 'updated_at', 'type'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['forename', 'surname'], 'string', 'max' => 50],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['type'], 'string', 'max' => 15],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'forename' => 'Forename',
            'surname' => 'Surname',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'type' => 'Type',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function resetPassword() {
        $password = Yii::$app->security->generateRandomString(8);
        $this->password_hash = Yii::$app->getSecurity()->generatePasswordHash(/*$password*/'miceal');

        Yii::info('Username: ' . $this->username . ' | Password: ' . $password);
        return $password;
    }

    public function updatePassword($password) {
        $this->password_hash = Yii::$app->getSecurity()->generatePasswordHash($password);

        Yii::info('MGDEV - User has manually updated password to ' . $password );
        $this->save(false);
        return $password;
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    public function beforeSave($insert)
    {
        Yii::info('MGDEV - We got to the beforeSave funciton. ');
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->auth_key = Yii::$app->security->generateRandomString();
                $now = new DateTime();
                $this->created_at = $now->getTimestamp();
                $this->updated_at = $now->getTimestamp();

                $password = Yii::$app->security->generateRandomString(8);
                Yii::info('Username: ' . $this->username . ' | Password: ' . $password);

                $this->password_hash = Yii::$app->getSecurity()->generatePasswordHash('miceal');

                $this->auth_key = Yii::$app->security->generateRandomString();
            }
            return true;
        } else {
            return false;
        }
    }

    public function getFullName() {
        return $this->forename . ' ' . $this->surname;
    }

    public function getTypeOptions() {
        return
            [
                Constant::USER_TYPE_ADMIN => Constant::USER_TYPE_ADMIN,
                Constant::USER_TYPE_USER => Constant::USER_TYPE_USER,
            ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['user_id' => 1]);
    }
}
