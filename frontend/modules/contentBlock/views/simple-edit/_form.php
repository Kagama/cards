<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\contentBlock\models\ContentBlock */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="content-block-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?//= $form->field($model, 'name')->textInput(['maxlength' => 254]) ?>

    <?= $form->field($model, 'content', [
        'template' => "
                {label}
                <div style='color:#000;'>
                {input}
                </div>
                {error}
            "
    ])->widget(sim2github\imperavi\widgets\Redactor::className(), [
        'options' => [
            'debug' => 'true',
        ],
        'clientOptions' => [ // [More about settings](http://imperavi.com/redactor/docs/settings/)
            'pathCss' => Yii::getAlias('@frontend/web/css/'),
            'css' => ['style.css'],
            'convertImageLinks' => 'true', //By default
            'convertVideoLinks' => 'true', //By default
            'buttonSource' => true,
            //'wym' => 'true',
            //'air' => 'true',
            'linkEmail' => 'true', //By default
            'lang' => 'ru',
//            'imageGetJson' =>  \Yii::getAlias('@web').'/redactor/upload/imagejson', //By default
            'plugins' => [ // [More about plugins](http://imperavi.com/redactor/plugins/)
                'ace',
                'clips',
                'fullscreen'
            ]
        ],

    ])
    ?>

<!--    --><?//= $form->field($model, 'visible')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'name' => 'submit', 'value' => 'submit']) ?>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;или&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <?= Html::submitButton('Опубликовать', ['class' => 'btn btn-danger', 'name' => 'submit', 'value' => 'publish']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
