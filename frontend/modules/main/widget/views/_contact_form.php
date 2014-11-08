<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 27.09.2014
 * Time: 17:31
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

<div id="main_contact_form" style=" width: 650px;">
    <div class="wrapper" style="width: 500px;">
        <h2>Заполните форму</h2>
        <div id="success"></div>
        <div class="l" style=" width: 100%; ">
            <?php $form = ActiveForm::begin([
                'id' => 'contact-form',
                'action' => \yii\helpers\Url::to(['/main/default/contact'])
            ]); ?>
            <?= $form->errorSummary($model) ?>
            <?= $form->field($model, 'flp')->textInput() ?>

            <?= $form->field($model, 'phone')->textInput() ?>

            <?= $form->field($model, 'email')->textInput() ?>

            <?= $form->field($model, 'text')->textarea(['placeholder' => 'Опишите свои жалобы, историю развития заболевания и Ваше состояние сейчас', 'cols' => 20, 'rows' => 10]) ?>

            <input type="submit" value="Отправить" id="contact-submit">
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
