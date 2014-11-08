<?php
/**
 * Created by PhpStorm.
 * User: Phantom
 * Date: 24.10.2014
 * Time: 13:37
 */

namespace common\modules\organization\models;

use yii\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "t_kg_organization".
 *
 *
 * @property integer $id
 * @property string $name
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $phone
 * @property string $description
 * @property string $address
 * @property double $longitude
 * @property double $latitude
 * @property integer $category
 * @property string $seo_title
 * @property string $seo_keywords
 * @property string $seo_description
 * @property string $working_time
 * @property string $city
 *
 */

class Organization extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_kg_organization';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'phone', 'description', 'category', 'address'], 'required'],
            [['latitude'], 'required', 'message' => 'Укажите рассположение организации на карте'],
            [['latitude', 'longitude'], 'double'],
            [['phone'], 'string', 'max' => 256],
            [['city', 'category'], 'integer'],
            [['seo_description'], 'string'],
            [['seo_title', 'seo_keywords'], 'string', 'max' => 512]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'city' => 'Город',
            'name' => 'Название организации',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
            'address' => 'Адрес',
            'phone' => 'Номер телефона',
            'description' => 'Описание',
            'longitude' => 'Долгота',
            'latitude' => 'Широта',
            'category' => 'Категория организации',
            'seo_title' => 'SEO заголовок',
            'seo_keywords' => 'SEO Ключевые слова',
            'seo_description' => 'SEO Описание',
            'working_time' => 'Время работы',
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function afterSave($insert, $attributes)
    {
        parent::afterSave($insert, $attributes);
    }

    public function getCat()
    {
        return $this->hasOne(Category::className(), ['id' => 'category']);
    }

    public function getCityObj()
    {
        return $this->hasOne(City::className(), ['id' => 'city']);
    }
}