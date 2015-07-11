<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\common\Constant;

/**
 * ContactForm is the model behind the contact form.
 */
class AddUserForm extends Model
{
    public $forename;
    public $surname;
    public $email;
    public $type;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['forename', 'surname', 'email', 'type'], 'required'],
            // email has to be a valid email address
            ['email', 'email']
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'forename' => 'Forename',
            'surname' => 'Surname',
            'email' => 'Email',
        ];
    }

    public function getTypeOptions() {
        return [
            Constant::USER_TYPE_USER,
            Constant::USER_TYPE_ADMIN,
        ];
    }
}
