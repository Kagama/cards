<?php
/**
 * Created by PhpStorm.
 * User: Phantom
 * Date: 26.10.2014
 * Time: 0:32
 */
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
?>


<section class="widget">
    <div class="user-form">

        <?php $form = ActiveForm::begin([
            'options' => [
                'novalidate' => "novalidate",
                'method' => "post",
                'data-validate' => "parsley"
            ]
        ]); ?>
        <?= $form->errorSummary($model) ?>
        <?= $form->field($model, 'username')->textInput(); ?>
        <?= $form->field($model, 'surname')->textInput(); ?>
        <?= $form->field($model, 'name')->textInput(); ?>
        <?= $form->field($model, 'phone')->textInput(); ?>
        <?= $form->field($model, 'car_number')->textInput(); ?>

        <?=
        $form->field($model, 'discount_card')->widget(\kartik\widgets\Select2::className(), [
            'model' => $model,
            'attribute' => 'discount_card',
            'data' => ArrayHelper::map(\common\modules\card\models\Card::find()->all(), 'id', 'discount_card'),
            'options' => ['placeholder' => 'Выберите карту ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
        ?>


        <div class="form-actions">
            <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</section>




