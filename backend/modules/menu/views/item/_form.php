<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var common\modules\menu\models\Menu $model
 * @var yii\widgets\ActiveForm $form
 */
?>
<div class="row">
    <?php $form = ActiveForm::begin(); ?>
    <div class="col-lg-6">
        <section class="widget">
            <div class="body">
                <div class="menu-form">


                    <?= $form->errorSummary([$model]); ?>
                    <?= $form->field($model, 'name')->textInput(['maxlength' => 512]) ?>

                    <div class="row">
                        <div class="col-lg-4">
                            <?php
                            echo \common\helpers\html\mySelect::widget([
                                'model' => $model,
                                'attribute' => 'parent_id',
                                'data' => \common\modules\menu\models\Menu::find()->orderBy('position DESC')->all()
                            ]);
                            ?>
                        </div>
                        <div class="col-lg-4">
                            <?= $form->field($model, 'group_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\modules\menu\models\MenuGroup::find()->all(), "id", "name"), ['prompt' => '---']) ?>
                        </div>
                        <div class="col-lg-4">
                            <?= $form->field($model, 'position')->textInput() ?>
                        </div>
                    </div>

                    <?= Html::hiddenInput('Menu[group_id]', (empty($model->group_id) ? Yii::$app->request->get('group_id') : $model->group_id)) ?>
                    <?= $form->field($model, 'template')->textarea(['rows' => 8])?>
<!--                    --><?//= $form->field($model, 'template')->widget(sim2github\imperavi\widgets\Redactor::className(), [
//                        'options' => [
//                            'debug' => 'false',
//                        ],
//                        'clientOptions' => [ // [More about settings](http://imperavi.com/redactor/docs/settings/)
//                            'convertImageLinks' => 'false', //By default
//                            'convertVideoLinks' => 'false', //By default
//                            //'wym' => 'true',
//                            //'air' => 'true',
//                            'linkEmail' => 'true', //By default
//                            'lang' => 'ru',
//                            'tidyHtml' => true,
//                            'allowedTags' => ['p', 'a', 'span',  'div', 'bold', 'table', 'tr', 'td', 'thead', 'tbody', 'tfoot', 'img'],
//                            'phpTags' => true,
//                            'pastePlainText' => true,
//                            'paragraphy' =>false,
//                            'convertDivs' => false,
//                            'deniedTags' => false,
////            'imageGetJson' =>  \Yii::getAlias('@web').'/redactor/upload/imagejson', //By default
//                            'plugins' => [ // [More about plugins](http://imperavi.com/redactor/plugins/)
//                                'ace',
//                                'clips',
//                                'fullscreen'
//                            ]
//                        ],
//
//                    ])
//                    ?>

                    <fieldset>
                        <legend>SEO Атрибутика</legend>
                        <?= $form->field($model, 'seo_title')->textInput(['maxlength' => 512]) ?>

                        <?= $form->field($model, 'seo_keywords')->textInput(['maxlength' => 512]) ?>

                        <?= $form->field($model, 'seo_description')->textarea(['rows' => 6]) ?>
                    </fieldset>


                    <div class="form-actions">
                        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    </div>


                </div>
            </div>
        </section>
    </div>
    <div class="col-lg-6">
        <section class="widget">
            <header>
                <h4 style="font-size: 24px; margin-left: 20px;"><i class="fa fa-cogs"></i> &nbsp;&nbsp;Модуль</h4>
            </header>
            <div class="body">

                <?php
                $modelsObjArr = \common\modules\appmodule\models\Module::find()->all();

                ?>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Название</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($modelsObjArr as $module) {
                        //echo $model->module_id."==".$module->id." ".(($model->module_id == $module->id) ? "true" : "false")."</br>";
                        $module_is_checked = ($model->module_id == $module->id) ? true : false;
                        if ($module->subentries == 1) {

//                            echo CHtml::radioButton('rel_module_to_menu', $module_is_checked);
                            echo "<tr>";
                            echo    "<td>";
                            echo        "<span style='margin-left:35px; font-size:16px;'>" . $module->name . "</span>";
                            echo    "</td>";
                            echo "</tr>";
//                            Yii::import('application.modules.' . $module->module_name . '.models.*');
//                            $htmlHelper = new HtmlModuleHelper();
                            $obj_name = $module->object_name;
                            $_obj = new $obj_name();
                            $arr = $_obj::find()->all();
                            foreach ($arr as $field) {
                                $subentries_checked = ($model->module_model_id == $field->id);
                                echo "<tr>";
                                echo    "<td style='padding-left: 45px;'>";
                                echo        Html::radio('Menu[module_model_id]', $subentries_checked, [ 'value' => $field->id, 'class' => 'module_model_id', 'style' => 'display:none;']);
                                echo        "<label class='radio' style='line-height: 24px; margin:0; padding:0; cursor:pointer;'>". Html::radio('Menu[module_id]', $subentries_checked, ['value' => $module->id, 'class' => 'iCheck', 'style' => 'padding:0; margin:0;']) ." ". $field->title . "</label>";
                                echo    "</td>";
                                echo "</tr>";
                            }

                        } else {
                            echo "<tr>";
                            echo    "<td style='line-height: 24px;'>";
                            echo        "<label class='radio' style='line-height: 24px; margin:0; padding:0; cursor:pointer;'>" . Html::radio('Menu[module_id]', $module_is_checked, ['value' => $module->id, 'class' => 'iCheck', 'style' => 'padding:0; margin:0;']) . "  " . $module->name . "</label>";
                            echo    "</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<?php
Yii::$app->getView()->registerJs('
    $(".radio").on("click", function() {
        var module_model_id = $(this).prev(".module_model_id");
        var module_id = $(this).children("div").children(".iCheck");
        if (module_model_id.length > 0) {
            module_model_id.attr("checked", true);
        }

    });
', \yii\web\View::POS_END, 'menu-form');
?>
