<?php

namespace common\modules\address\models;

use Yii;

/**
 * This is the model class for table "t_kg_address_street".
 *
 * @property integer $id
 * @property string $name
 * @property integer $locality_id
 */
class AddressStreet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_kg_address_street';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['locality_id'], 'integer'],
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
            'name' => 'Name',
            'locality_id' => 'Населеный Пункт'
        ];
    }
}
