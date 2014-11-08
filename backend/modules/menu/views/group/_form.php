<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/**
 * @var yii\web\View $this
 * @var common\modules\menu\models\MenuGroup $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="menu-group-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 512]) ?>

    <?= $form->field($model, 'position')->textInput() ?>

    <?= $form->field($model, 'section_position')->dropDownList($model->section_position_arr, ['prompt' => '---']); ?>

    <?= $form->field($model, 'active_status')->checkbox() ?>

    <div class="form-actions">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
