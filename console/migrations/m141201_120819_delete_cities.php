<?php

use yii\db\Schema;
use yii\db\Migration;

class m141201_120819_delete_cities extends Migration
{
    public function up()
    {
        $this->delete('{{%city}}', 'name = :name', [':name' => 'Махачкала']);
        $this->delete('{{%city}}', 'name = :name', [':name' => 'Санкт-Петербург']);
    }

    public function down()
    {
        echo "m141201_120819_delete_cities cannot be reverted.\n";

        return false;
    }
}
