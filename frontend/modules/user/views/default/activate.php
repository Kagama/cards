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

$this->title = 'Активация карты';
$this->params['breadcrumbs'][] = $this->title;
Yii::$app->view->registerJs('
$(document).ready(function () {
    var month = $("#card-month_price").text();
    $(document).on("change", "#user-month", function() {
    var month_num = Number($("#user-month").val());
    var num = month * month_num;
        $("#card-month_price").text(num);
    });
});
    ', View::POS_READY, 'full-price');
    ?>

<?php
if (Yii::$app->getSession()->hasFlash('activation-done')) {
    echo Yii::$app->getSession()->getFlash('activation-done');
    Yii::$app->getSession()->setFlash('activation-done', null);
}   else {
    ?>

    <h1><?php echo Html::encode($this->title); ?></h1>
    <p>Заполните следующие поля: </p>

    <?php $form = ActiveForm::begin([
        'validateOnType' => true,
        'options' => [
            'class' => 'form-horizontal', 'id' => 'activation-form'
        ]
    ]); ?>
    <?= $form->field($model, 'month')->widget(kartik\widgets\TouchSpin::classname(), [
        'options' => [
            'value' => 1,
        ],
        'pluginOptions' => [
            'max' => 12,
            'min' => 1,
        ]
    ]); ?>
    <p>Сумма к оплате : </p> <span id="card-month_price"><?= Yii::$app->params['month_price'] ?></span>

    <div class="form-actions">
        <?php echo Html::submitButton('Активировать', ['class' => 'btn btn-primary']); ?>

    </div>

    <?php  ActiveForm::end();
}
?>