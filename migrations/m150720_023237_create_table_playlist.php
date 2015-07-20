<?php

use yii\db\Schema;
use yii\db\Migration;

class m150720_023237_create_table_playlist extends Migration
{
    public function up()
    {
        $this->createTable('playlist_track', [
            'id' => Schema::TYPE_PK,
            'account_id' => Schema::integer(),
            'title' => Schema::string(500),
            'genre' => Schema::string(500),
            'artwork_url' => Schema::text(500),
            'permalink_uri' => Schema::string(500),
            'waveform_url' => Schema::string(500),
            'stream_url' => Schema::string(500),
            'uri' => Schema::string(500),
            'user_uri' => Schema::string(500),
            'user_username' => Schema::string(500),
            'user_permalink_url' => Schema::string(500),
            'user_avatar_url' => Schema::string(500),
        ]);

        $this->execute('ALTER TABLE `playlist_track` ADD CONSTRAINT `FK_PLAYLIST_TRACK_USER` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;');
    }

    public function down()
    {
        echo "m150720_023237_create_table_playlist cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
