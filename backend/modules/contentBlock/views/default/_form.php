<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\contentBlock\models\ContentBlock */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="content-block-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 254]) ?>

    <?= $form->field($model, 'content', [
        'template' => "
                {label}
                <div class='textarea-content'>{input}</div>
                {error}
            "
    ])->widget(sim2github\imperavi\widgets\Redactor::className(), [
        'options' => [
            'debug' => 'true',
        ],
        'clientOptions' => [ // [More about settings](http://imperavi.com/redactor/docs/settings/)
            'convertImageLinks' => 'true', //By default
            'convertVideoLinks' => 'true', //By default
            'buttonSource' => true,
            //'wym' => 'true',
            //'air' => 'true',
            'linkEmail' => 'true', //By default
            'lang' => 'ru',
            'tidyHtml' => true,
            'allowedTags' => ['p', 'blockquote', 'b', 'i', 'ul', 'li', 'ol', 'a', 'div', 'span', 'bold', 'table', 'tr', 'td', 'thead', 'tbody', 'tfoot', 'img', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'],
            'phpTags' => true,
            'pastePlainText' => false,
            'replaceDivs' => false,
            'paragraphy' => false,
            'convertDivs' => false,
            'deniedTags' => false,
            //'wym' => 'true',
            //'air' => 'true',
//            'imageGetJson' =>  \Yii::getAlias('@web').'/redactor/upload/imagejson', //By default
            'plugins' => [ // [More about plugins](http://imperavi.com/redactor/plugins/)
                'ace',
                'clips',
                'fullscreen'
            ]
        ],

    ])
    ?>

    <?= $form->field($model, 'visible')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'name' => 'submit', 'value' => 'submit']) ?>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;или&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <?= Html::submitButton('Опубликовать', ['class' => 'btn btn-primary', 'name' => 'submit', 'value' => 'publish']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
