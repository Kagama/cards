<?php

namespace common\modules\contentBlock\models;

use common\modules\draft\models\Draft;
use Yii;

/**
 * This is the model class for table "{{%content_block}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $content
 * @property integer $visible
 */
class ContentBlock extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%content_block}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'content'], 'required'],
            [['content'], 'string'],
            [['visible'], 'integer'],
            [['name'], 'string', 'max' => 254]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название блока',
            'content' => 'Содержимое',
            'visible' => 'Отобразить',
        ];
    }

    public function afterFind()
    {
        Draft::getDraftRecord($this);
    }
}
