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
 * @protected string $name
 */
class City extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_kg_city';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string'],
            [['id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Город',
        ];
    }

    public static function getAllLikeJsList () {
        $temp_js_list = "";
        $tags = City::find()->orderBy('name ASC')->all();
        foreach ($tags as $tag) {
            $temp_js_list .= (empty($temp_js_list) ? "" : ", ")." ".$tag->name." ";
        }
        $temp_js_list = explode(",", $temp_js_list);
        return $temp_js_list;
    }

    public function findByName($name) {
        $city = City::find()->where('name = :name ', [':name' => trim($name)])->one();
       if (!$city)
        {
            $model = new City();
            $model->name = $name;
            $model->save();
            return $model->id;
        }
            else return $city->id;
    }
}