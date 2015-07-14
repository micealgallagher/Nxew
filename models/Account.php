<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "account".
 *
 * @property string $id
 * @property integer $user_id
 * @property string $bio
 *
 * @property User $user
 */
class Account extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'account';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'bio'], 'required'],
            [['user_id'], 'integer'],
            [['bio'], 'string'],
            [['website', 'facebook', 'twitter'], 'url'],
            [['user_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'bio' => 'Bio',
            'website' => 'Website',
            'facebook' => 'Facebook',
            'twitter' => 'Twitter',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function beforeSave($insert)
    {

        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                Yii::info('MGDEV - We got to the Account.beforeSave funciton. Giving it to: ' . Yii::$app->getUser()->id);
                $this->user_id = Yii::$app->getUser()->id;
            } else {
                Yii::info('MGDEV - Account.beforeSave funciton. Giving it to: ' . $this->user_id . ' with the bio: ' . $this->bio);
            }
            return true;
        } else {
            return false;
        }
    }

    public function hasBioChanged($bio) {
        return strcmp($bio, $this->bio) != 0;;
    }
}
