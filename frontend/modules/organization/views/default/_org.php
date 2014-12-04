<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 21.07.14
 * Time: 0:19
 */
use yii\helpers\Html;
use yii\helpers\Url;

$this->params['breadcrumbs'] = [
    ['label' => 'Организации', 'url' => null],
]; ?>
<div class="item one-third column">
    <div class="image">
        <a href="<?=\yii\helpers\Url::to(['/'.$menu->url."/".$model->id."/".\common\helpers\CString::translitTo($model->name)])?>">
            <img src="<?= "/".$model->doCache('300x190', 'width', '300x190')?>" alt="">
            <span>Подробнее</span>
        </a>
    </div>
    <h2><?=$model->name?></h2>
    <a href="<?=\yii\helpers\Url::to(['/'.$menu->url, 'city' => Yii::$app->request->get('city'), 'category' => $model->cat->alt_name]);?>"><?=$model->cat->name;?></a>
    <p style="min-height: 70px; height: 70px; max-height: 70px;"><?=\common\helpers\CString::subStr(strip_tags($model->description), 0, 200);?></p>
</div>