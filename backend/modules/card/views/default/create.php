<?php
/**
 * Created by PhpStorm.
 * User: Phantom
 * Date: 24.10.2014
 * Time: 14:17
 */

use yii\helpers\Html;

$this->registerAssetBundle('backend\assets\PostModuleAsset', \yii\web\View::POS_HEAD);

$this->title = 'Добавить карту';
$this->params['breadcrumbs'][] = ['label' => 'Карты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card-create padding020 widget">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    if (Yii::$app->session->hasFlash('error')) {
        ?>
        <p><?php echo Yii::$app->session->getFlash('error');
            Yii::$app->session->setFlash('error', null); ?></p>
    <?php
    } ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]); ?>

</div>