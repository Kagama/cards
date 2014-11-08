<?php

namespace common\modules\address\models;

use Yii;

/**
 * This is the model class for table "t_kg_address_zipcode".
 *
 * @property integer $id
 * @property integer $code
 */
class AddressZipcode extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_kg_address_zipcode';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code'], 'required'],
            [['code'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
        ];
    }
}
