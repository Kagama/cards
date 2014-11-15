<?php
/**
 * Created by PhpStorm.
 * User: pashaevs
 * Date: 04.11.14
 * Time: 17:09
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->registerAssetBundle('backend\assets\PostModuleAsset', \yii\web\View::POS_HEAD);

$this->registerJs('
    var editor = ace.edit("editor");
    editor.setTheme("ace/theme/monokai");
    editor.session.setMode("ace/mode/php!pure")
    editor.session.setMode({path: "ace/mode/php", pure:true, /*other options here*/})
    var textarea = $("#file-content").hide();
    editor.getSession().setValue(textarea.val());
    editor.getSession().on("change", function(){
      textarea.val(editor.getSession().getValue());
    });
    ', \yii\web\View::POS_READY);

$this->title = 'Редактирование';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="content-block-index padding020 widget" >
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin([
        'method' => 'POST'
    ]); ?>
    <div style="height: 600px; position: relative; ">
        <textarea name="file-content" id="file-content" cols="30" rows="10"><?=$file_content?></textarea>
        <div id="editor">
        </div>
    </div>
</div>
<div class="content-block-index padding020 widget" style="font-size: 14px; ">
    <div class="form-group">
        <?= Html::submitButton('Обновить', ['class' => 'btn btn-success']) ?> &nbsp;&nbsp; или &nbsp;&nbsp; <?= Html::a('отмена', ['index']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>