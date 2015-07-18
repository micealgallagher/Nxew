<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 */
class UserDetail extends Model
{
    public $userId;
    public $forename;
    public $surname;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['forename', 'surname'], 'required'],
        ];
    }
}
