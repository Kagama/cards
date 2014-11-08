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
use common\modules\organization\models\Category;
?>
<section class="widget">
    <div class="category-form">

        <?php $form = ActiveForm::begin([
            'options' => [
                'novalidate' => "novalidate",
                'method' => "post",
                'data-validate' => "parsley"
            ]
        ]); ?>

        <?= $form->field($model, 'name')->textInput(); ?>

        <?= $form->field($model, 'text_before')->widget(sim2github\imperavi\widgets\Redactor::className(), [
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
//            'imageGetJson' =>  \Yii::getAlias('@web').'/redactor/upload/imagejson', //By default
                'plugins' => [ // [More about plugins](http://imperavi.com/redactor/plugins/)
                    'ace',
                    'clips',
                    'fullscreen'
                ]
            ],

        ])
        ?>

        <?= $form->field($model, 'text_after')->widget(sim2github\imperavi\widgets\Redactor::className(), [
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
//            'imageGetJson' =>  \Yii::getAlias('@web').'/redactor/upload/imagejson', //By default
                'plugins' => [ // [More about plugins](http://imperavi.com/redactor/plugins/)
                    'ace',
                    'clips',
                    'fullscreen'
                ]
            ],

        ])
        ?>

        <fieldset>
            <legend>SEO Атрибуты</legend>
            <?= $form->field($model, 'seo_title')->textInput(['maxlength' => 512]) ?>

            <?= $form->field($model, 'seo_keywords')->textInput(['maxlength' => 512]) ?>

            <?= $form->field($model, 'seo_description')->textarea(['rows' => 6]) ?>
        </fieldset>

        <div class="form-actions">
            <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</section>




