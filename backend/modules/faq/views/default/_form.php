<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var common\modules\faq\models\Faq $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="faq-form">

    <?php $form = ActiveForm::begin([
        'enableClientValidation' => false,
    ]); ?>

    <?= $form->field($model, 'username')->textInput() ?>
    <?= $form->field($model, 'email')->textInput() ?>
    <?= $form->field($model, 'date')->widget(\yii\jui\DatePicker::className(), [
        'language' => 'ru',
        'model' => $model,
        'attribute' => 'date',
        'clientOptions' => [
            'dateFormat' => 'dd-mm-yy',
        ],
    ] ); ?>
    <?= $form->field($model, 'question')->textarea(['rows' => 6]) ?>

<!--    --><?//= $form->field($model, 'answer_date')->widget(\yii\jui\DatePicker::className(), [
//        'language' => 'ru',
//        'model' => $model,
//        'attribute' => 'date',
//        'clientOptions' => [
//            'dateFormat' => 'dd-mm-yy',
//        ],
//    ] ); ?>

    <?= $form->field($model, 'answer')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'category_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\modules\faq\models\FaqCategory::find()->all(), 'id', 'name'), ['prompt' => '---']) ?>

    <?= $form->field($model, 'publish')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
