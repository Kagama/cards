<?php

namespace common\modules\address\models;

use Yii;

/**
 * This is the model class for table "t_kg_address_locality".
 *
 * @property integer $id
 * @property integer $type
 * @property string $name
 */
class AddressLocality extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_kg_address_locality';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'name'], 'required'],
            [['type'], 'integer'],
            [['name'], 'string', 'max' => 512]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Тип НП',
            'name' => 'Название НП',
        ];
    }
}
