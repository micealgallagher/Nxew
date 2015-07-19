<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    public $_user;
    public $type;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            Yii::info('MGDEV - Password is: ' . $this->password . ' password_hash is: ' . $user->password_hash);

            if (!$user || !$user->validatePassword($this->password, $user->password_hash)) {
                $this->addError($attribute, 'Current password is incorrect.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
            Yii::info('MGDEV : about to get the user');
            $user = $this->getUser();

        Yii::info('MGDEV : we are about to validate!');
        if ($this->validate()) {


            Yii::info('MGDEV : we are about to validate the password!');
            //if (Yii::$app->security->validatePassword($this->password, $user->password_hash)) {
            //if (Yii::$app->security->validatePassword('miceal', '$2y$13$CqmT.GsjGmlpatsz3TAuCOjen1dOrjLr0bOz8RHHXPA4Z03vdzYKG')) {
            Yii::info('MGDEV : Password validated!!! Will I remember: ' . $this->rememberMe);
            $this->type = $user->type;
            Yii::$app->user->enableSession = true;
            return Yii::$app->user->login($user, 5 * 60);
            //}
        }/*}else {
            Yii::info('MGDEV : validation failed!');
        }*/
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {

        Yii::info('MGDEV - getting the user with the username ' . $this->username );

        return User::findByUsername($this->username);
    }
}
