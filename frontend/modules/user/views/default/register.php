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
    <h1><?php echo Html::encode($this->title); ?></h1>
    <p>Заполните следующие поля: </p>
<?php $form = ActiveForm::begin([
    'options' => [
        'class' => 'form-horizontal', 'id' => 'registration-form'
    ]
]); ?>

<?= $form->field($model, 'surname')->textInput(); ?>
<?= $form->field($model, 'name')->textInput(); ?>
<?= $form->field($model, 'username')->textInput(); ?>
<?= $form->field($model,'phone')->textInput() ?>
<?= $form->field($model, 'password')->passwordInput(); ?>

<?= $form->field($model, 'city')->widget(\kartik\widgets\Select2::className(), [
    'model' => $model,
    'attribute' => 'city',
    'options' => ['multiple' => false, 'class' => 'form-control'],
    'pluginOptions' => [
        'tags' => City::getAllLikeJsList(),
        'maximumInputLength' => 30,
        'maximumSelectionSize' => 1
    ],
]); ?>

<?= $form->field($model, 'car_number')->textInput(); ?>
<?= $form->field($model, 'bank_card')->textInput(); ?>


    <div class="form-actions">
        <?php echo Html::submitButton('Зарегистрироваться', array('class' => 'btn btn-primary')); ?>

    </div>
<?php  ActiveForm::end();

//}
?>