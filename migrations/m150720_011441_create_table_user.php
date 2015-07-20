<?php

use yii\db\Schema;
use yii\db\Migration;

class m150720_011441_create_table_user extends Migration
{
    public function up()
    {
        $this->createTable('user', [
            'id' => Schema::TYPE_PK,
            'forename' => Schema::string(50) . ' NOT NULL',
            'surname' => Schema::string(50) . ' NOT NULL',
            'username' => Schema::string(100) . ' NOT NULL',
            'auth_key' => Schema::string(100),
            'password_hash' => Schema::string(100),
            'password_reset_token' => Schema::string(100),
            'email' => Schema::string(500),
            'status' => Schema::smallInteger(),
            'type' => Schema::string(50) . ' NOT NULL',
            'created_at' => Schema::integer(). ' NOT NULL',
            'updated_at' => Schema::integer(). ' NOT NULL',
        ]);
    }

    public function down()
    {
        echo "m150720_011441_create_table_user cannot be reverted.\n";

        return false;
    }
}
