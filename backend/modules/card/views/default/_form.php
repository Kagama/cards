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
use common\modules\user\models\User;
?>


<section class="widget">
    <div class="card-form">

        <?php $form = ActiveForm::begin([
            'options' => [
                'novalidate' => "novalidate",
                'method' => "post",
                'data-validate' => "parsley"
            ]
        ]); ?>

        <?= $form->errorSummary($model) ?>
        <?= $form->field($model, 'discount_card')->textInput(); ?>

<!--        --><?//= $form->field($model, 'user_id')->textInput(); ?>

        <?=
        $form->field($model, 'user_id')->widget(\kartik\widgets\Select2::className(), [
            'model' => $model,
            'attribute' => 'user_id',
            'data' => ArrayHelper::map(User::find()->all(), 'id', 'username'),
            'options' => ['placeholder' => 'Выберите пользователя ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],        ]); ?>

        <div class="form-actions">
            <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</section>




