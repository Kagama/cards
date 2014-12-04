<?php
/**
 * Created by PhpStorm.
 * User: Phantom
 * Date: 24.10.2014
 * Time: 13:37
 */

namespace common\modules\organization\models;

use common\helpers\CDirectory;
use common\helpers\CString;
use yii\db\ActiveRecord;
use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "t_kg_organization".
 *
 *
 * @property integer $id
 * @property string $name
 * @property string $img
 * @property steing $img_src
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
            [['seo_description', 'working_time'], 'string'],
            [['seo_title', 'seo_keywords', 'img_src'], 'string', 'max' => 512],
            [['img'], 'image', 'extensions' => 'jpg, png, jpeg, gif']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'img' => 'Лого',
            'img_src' => 'Путь к картинке',
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
            'cachedImg' => [
                'class' => 'common\behaviors\CachedImageResolution',
                'attr_src' => 'img_src',
                'attr_img_name' => 'img',
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {

            $file = UploadedFile::getInstance($this, 'img');

            if (($file instanceof UploadedFile) && ($file->size > 0)) {
                $this->img = $file;

                if (($this->img instanceof UploadedFile ) && $this->img->size > 0) {

                    $path = "images/organization/".date("Y/m/d", $this->created_at)."/".$this->getPrimaryKey();

                    CDirectory::createDir($path);
                    $dir = \Yii::$app->basePath . "/../" . $path;

                    $imageName = CString::translitTo($this->name). "." . $this->img->getExtension();

                    $this->img->saveAs($dir . "/" . $imageName);

                    $model = static::findOne($this->getPrimaryKey());
//                $model->img = $imageName;
//                $model->img_src = $path;
//                $model->update();
//                $model->update(false, ['img' => $imageName, 'img_src' => $path]);
                    static::updateAll(['img' => $imageName, 'img_src' => $path], ['id' => $this->getPrimaryKey()]);
                }
            } else {
                $this->img = $this->getOldAttribute('img');
                $this->img_src = $this->getOldAttribute('img_src');
            }
            return true;
        } else {
            return false;
        }


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