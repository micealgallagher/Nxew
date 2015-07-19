<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\common\Constant;

/**
 * ContactForm is the model behind the contact form.
 */
class AddTrackSoundCloudForm extends Model
{
    public $url;
    public $accountId;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['url'], 'required'],
            // email has to be a valid email address
            ['url', 'url']
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'url' => 'SoundCloud URL'
        ];
    }
}
