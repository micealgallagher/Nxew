<?php

namespace app\models;

use app\common\Constant;
use Yii;

/**
 * This is the model class for table "playlist_track".
 *
 * @property integer $id
 * @property integer $account_id
 * @property string $title
 * @property string $genre
 * @property string $artwork_url
 * @property string $permalink_uri
 * @property string $waveform_url
 * @property string $stream_url
 * @property string $uri
 * @property string $user_uri
 * @property string $user_username
 * @property string $user_permalink_url
 * @property string $user_avatar_url
 *
 * @property Account $account
 */
class PlaylistTrack extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'playlist_track';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id'], 'integer'],
            [['artwork_url'], 'string'],
            [['title', 'genre', 'permalink_uri', 'waveform_url', 'stream_url', 'uri', 'user_uri', 'user_username', 'user_permalink_url', 'user_avatar_url'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'account_id' => 'Account ID',
            'title' => 'Title',
            'genre' => 'Genre',
            'artwork_url' => 'Artwork Url',
            'permalink_uri' => 'Permalink Uri',
            'waveform_url' => 'Waveform Url',
            'stream_url' => 'Stream Url',
            'uri' => 'Uri',
            'user_uri' => 'User Uri',
            'user_username' => 'User Username',
            'user_permalink_url' => 'User Permalink Url',
            'user_avatar_url' => 'User Avatar Url',
        ];
    }

    public static function createFromArray($track) {
        $newPlaylistTrack = new PlaylistTrack();

        $newPlaylistTrack->title = $track['title'];
        $newPlaylistTrack->genre = $track['genre'];
        $newPlaylistTrack->artwork_url = $track['artwork_url'];
        $newPlaylistTrack->permalink_uri = $track['permalink_url'];
        $newPlaylistTrack->waveform_url = $track['waveform_url'];
        $newPlaylistTrack->stream_url = $track['stream_url'];
        $newPlaylistTrack->uri = $track['uri'];
        $newPlaylistTrack->user_uri = $track['user']['uri'];
        $newPlaylistTrack->user_username = $track['user']['username'];
        $newPlaylistTrack->user_permalink_url = $track['user']['permalink_url'];
        $newPlaylistTrack->user_avatar_url = $track['user']['avatar_url'];

        return $newPlaylistTrack;
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {

            if ( empty($this->artwork_url) ) {
                $this->artwork_url = Yii::$app->urlManager->baseUrl . Constant::DEFAULT_COVERART_URL;
            }

            return true;
        } else {
            return false;
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id']);
    }
}
