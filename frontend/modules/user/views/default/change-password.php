<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 21.06.14
 * Time: 20:31
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var \common\models\LoginForm $model
 */
$this->title = 'Изменить пароль';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orange-white-delimiter">
    <div class="margin03percent">
        <img src="/img/news-icon.png" class="icon-bg" alt="Информационные сообщения" /> <span>Кабинет - Изменить пароль</span>
    </div>
</div>
<div class="row white-bg" style="background-color: #f4f4f4;">
    <div class="margin03percent">
        <h1 class="title">Личный кабинет</h1>
        <div class="col-lg-6">
            <?php

            echo $this->render('/common/_camp_owner_menu');

            ?>

        </div>
        <div class="col-lg-18">
            <?php
            if ($success) {
                ?>
                <div class="alert-success">
                    Запись обновленая.
                </div>
            <?php
            }
            ?>
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
            <?= $form->errorSummary($model) ?>
            <?= $form->field($model, 'old_password') ?>
            <?= $form->field($model, 'password') ?>
            <?= $form->field($model, 're_password') ?>
            <div class="form-group">
                <?= Html::submitButton('Обновить', ['class' => 'btn red-button', 'name' => 'signup-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>