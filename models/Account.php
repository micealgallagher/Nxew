<?php

namespace app\models;


use app\common\Constant;
use Yii;
use app\models\User;

/**
 * This is the model class for table "account".
 *
 * @property string $id
 * @property integer $user_id
 * @property string $bio
 * @property string $website
 * @property string $facebook
 * @property string $twitter
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

    public function beforeSave($insert) {

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

    public function hasAnySocialItems() {
        return strlen($this->website) > 0 ||
                strlen($this->facebook) > 0 ||
                strlen($this->twitter) > 0;
    }

    /*public  function beforeValidate() {
        if ( sizeof($this->website) > 0 && strpos(Constant::URL_PREFIX, $this->website) === false) {
            $this->website = Constant::URL_PREFIX . $this->website;
        }
        if ( sizeof($this->twitter) > 0 &&strpos(Constant::URL_PREFIX, $this->twitter) === false) {
            $this->twitter = Constant::URL_PREFIX . $this->twitter;
        }
        if ( sizeof($this->facebook) > 0 &&strpos(Constant::URL_PREFIX, $this->facebook) === false) {
            $this->facebook = Constant::URL_PREFIX . $this->facebook;
        }

        return true;
    }*/

    public function numOfPlaylistTracks() {
        return $this->findBySql('select count(*) from playlist_track where account_id = ' . $this->id);
    }

    public function hasBioChanged($bio) {
        return strcmp($bio, $this->bio) != 0;
    }
}
