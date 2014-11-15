<?php

use yii\helpers\Html;

$this->registerAssetBundle('backend\assets\PostModuleAsset', \yii\web\View::POS_HEAD);


/* @var $this yii\web\View */
/* @var $model common\modules\contentBlock\models\ContentBlock */

$this->title = 'Создать информационный блок';
$this->params['breadcrumbs'][] = ['label' => 'Информационный блок', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-block-create padding020">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
