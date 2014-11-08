<?php

namespace common\modules\address\models;

use Yii;

/**
 * This is the model class for table "t_kg_address".
 *
 * @property integer $id
 * @property integer $zipcode_id
 * @property integer $region_id
 * @property integer $area_id
 * @property integer $locality_id
 * @property integer $street_id
 * @property integer $camp_id
 * @property string $address_name
 */
class Address extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_kg_address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['zipcode_id', 'region_id', 'locality_id', 'street_id', 'camp_id', 'address_name'], 'required'],
            [['zipcode_id', 'region_id', 'area_id', 'locality_id', 'street_id', 'camp_id'], 'integer'],
            [['address_name'], 'string', 'max' => 512]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'zipcode_id' => 'Индекс',
            'region_id' => 'Регион',
            'area_id' => 'Район',
            'locality_id' => 'Населенный пункт',
            'street_id' => 'Улица',
            'camp_id' => 'Лагерь',
            'address_name' => 'Название адреса',
        ];
    }

    public function getZipCode() {
        return $this->hasOne(AddressZipcode::className(), ['id' => 'zipcode_id']);
    }
    public function getRegion() {
        return $this->hasOne(AddressRegion::className(), ['id'=>'region_id']);
    }
    public function getArea() {
        return $this->hasOne(AddressArea::className(), [ 'id'=>'area_id']);
    }
    public function getLocality() {
        return $this->hasOne(AddressLocality::className(), ['id'=>'locality_id']);
    }
    public function getStreet() {
        return $this->hasOne(AddressStreet::className(), ['id'=>'street_id']);
    }
}
