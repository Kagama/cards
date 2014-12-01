<?php

use yii\db\Schema;
use yii\db\Migration;

class m141201_122120_delete_organizations extends Migration
{
    public function up()
    {
        $this->delete('{{%organization}}', ['between', 'id', 1, 15]);
    }

    public function down()
    {
        echo "m141201_121326_delete_organizations cannot be reverted.\n";

        return false;
    }
}
