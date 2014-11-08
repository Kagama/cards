<?php

namespace common\modules\faq\models;

use common\helpers\CString;
use Yii;

/**
 * This is the model class for table "t_kg_faq_category".
 *
 * @property integer $id
 * @property string $name
 * @property string $alt_name
 */
class FaqCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_kg_faq_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'alt_name'], 'string', 'max' => 512]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Категория',
            'alt_name' => 'Alt Название'
        ];
    }

    public function beforeValidate() {
        if (parent::beforeValidate()) {

            $this->alt_name = CString::translitTo($this->name);

            return true;
        }
        return false;
    }
}
