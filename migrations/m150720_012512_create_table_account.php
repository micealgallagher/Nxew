<?php

use yii\db\Schema;
use yii\db\Migration;

class m150720_012512_create_table_account extends Migration
{
    public function up()
    {
        $this->createTable('account', [
            'id' => Schema::TYPE_PK,
            'user_id' => Schema::integer(),
            'bio' => Schema::text() . ' NOT NULL',
            'website' => Schema::string(500),
            'facebook' => Schema::string(500),
            'twitter' => Schema::string(500),
            'soundcloud' => Schema::string(500),
        ]);
    }

    public function down()
    {
        echo "m150720_012512_create_table_account cannot be reverted.\n";

        return false;
    }
}
