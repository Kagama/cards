<?php
/**
 * Created by PhpStorm.
 * User: Phantom
 * Date: 25.10.2014
 * Time: 0:12
 */
namespace common\modules\organization\models;

use yii\db\ActiveRecord;
use common\helpers\CString;
/*
 * @protected integer $id
 * @protected string $org_id
 * @protected string $longitude
 * @protected string $latitude
 * @protected string $address
 */
class Address extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_kg_org_address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['org_id', 'longitude', 'latitude', 'address', 'phone'], 'required'],
            [['longitude', 'latitude'], 'double'],
            ['org_id', 'integer'],
            [['address', 'phone'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'org_id' => 'ID организации',
            'address' => 'Адрес',
            'longitude' => 'Долгота',
            'latitude' => 'Широта',
            'phone' => 'Номер телефона'
        ];
    }

}