<?php

use yii\db\Schema;
use yii\db\Migration;

class m141130_141055_add_agreement extends Migration
{
    public function up()
    {
        $this->addColumn('{{%user}}', 'agreement', 'BOOLEAN');
    }

    public function down()
    {
        $this->dropColumn('{{%user}}', 'agreement');
    }
}
