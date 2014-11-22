<?php
/**
 * Created by PhpStorm.
 * User: Phantom
 * Date: 21.10.2014
 * Time: 16:15
 */

use yii\web\View;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\modules\organization\models\City;

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- Register -->

<section class="register">
    <div class="container">
        <h1>Регистрация карты</h1>

        <?php $form = \yii\widgets\ActiveForm::begin([
            'method' => 'post',
            'id' => 'payment_form',
            'action' => \yii\helpers\Url::to(['/user/default/registration']), //http://test.robokassa.ru/Index.aspx
//            'enableClientValidation' => false,
//            'enableAjaxValidation' => false,
        ])?>
        <div>
            <?= $form->field($regForm, 'card_number', [
                'template' => '
                    <div class="item one-third column">
                    {label}
                    {input}
                    {error}
                    </div>'

            ])->widget(\yii\widgets\MaskedInput::className(), [
                'mask' => '999999'
            ])->textInput(['placeholder' => '999999']); ?>

            <?= $form->field($regForm, 'car_number', [
                'template' => '
                    <div class="item one-third column">
                    {label}
                    {input}
                    {error}
                    </div>'

            ])->textInput(['placeholder' => 'a999aa99[9]']); ?>

            <?= $form->field($regForm, 'phone', [
                'template' => '
                    <div class="item one-third column">
                    {label}
                    {input}
                    {error}
                    </div>',

            ])->widget(\yii\widgets\MaskedInput::className(), [
                'mask' => '+7 (999) 999-99-99',

            ])->textInput(['placeholder' => '+7 (999) 999-99-99']); ?>
            <div style="clear: both"></div>
        </div>

        <?= $form->field($regForm, 'month', [
            'template' => '
                    <div class="item eight columns">
                    {label}
                    {input}
                    {error}
                    </div>'

        ])->dropDownList([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12], ['onchange' => 'setCoast(this);']); ?>

        <div class="item eight columns">
            <label for="" class="not-required">К оплате</label>
            <input type="text" value="100" id="payment" name="OutSum" style="padding: 9px 15px; width: 100%;" readonly="true" />
        </div>


        <div class="item sixteen columns" style="font-size: 18px;">
            <div class="button" onclick="$('#payment_form').submit();">Регистрация</div>
<!--            <input type="submit" value="Регистрация" name="submit" class="button" style="width: 100%;"/>-->
        </div>

        <?php \yii\widgets\ActiveForm::end(); ?>
    </div>
</section>