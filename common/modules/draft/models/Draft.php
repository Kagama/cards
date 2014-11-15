<?php

namespace common\modules\draft\models;

use common\modules\user\models\User;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "t_kg_draft".
 *
 * @property integer $id
 * @property string $model_name
 * @property integer $model_id
 * @property string $model_obj
 */
class Draft extends \yii\db\ActiveRecord
{

    static $draft_rows = null;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_kg_draft';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['model_name', 'model_id', 'model_obj'], 'required'],
            [['model_id'], 'integer'],
            [['model_obj'], 'string'],
            [['model_name'], 'string', 'max' => 512]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'model_name' => 'Название модели',
            'model_id' => 'Номер модели',
            'model_obj' => 'Сериализованная модель',
        ];
    }


    public static function getRow($_model_id, $_model_name)
    {
        if (static::$draft_rows == null) {
            $allRows = static::find()->all();
            foreach ($allRows as $index => $row)
                static::$draft_rows[$row->model_name][$row->model_id] = $row;

        }
        return (isset(static::$draft_rows[$_model_name][$_model_id]) ? static::$draft_rows[$_model_name][$_model_id] : null);

    }

    public static function getDraftRecord(ActiveRecord $model)
    {
//        $user = User::findIdentity(Yii::$app->user->getId());
        if (!Yii::$app->user->isGuest) {
            $draft = static::getRow($model->getPrimaryKey(), $model->className());
            if ($draft != null) {
                $obj = unserialize($draft->model_obj);
                $model->setAttributes($obj->getAttributes());
                unset($obj);
                unset($draft);
            }
        }
    }

    public static function addObj(ActiveRecord $model)
    {

        $draft = static::getRow($model->id, $model->className());
        $draft = ($draft == null ? new static() : $draft);

        $draft->model_id = $model->getPrimaryKey();
        $draft->model_name = $model->className();
        $draft->model_obj = serialize($model);

        return $draft->save();
    }

    public static function removeObj(ActiveRecord $model)
    {
//        $draft = static::getRow($model->id, $model->className());

//        if ($draft == null)
//            return $model;

//        $obj = unserialize($draft->model_obj);
//        $model->setAttributes($obj->getAttributes());

        static::deleteObj($model);

//        return $model;
    }

    public static function deleteObj(ActiveRecord $model)
    {
        $obj = static::findOne(['model_id' => $model->id, 'model_name' => $model->className()]);
        if ($obj != null)
            $obj->delete();
    }

}
