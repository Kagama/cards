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
    <a href="<?=\yii\helpers\Url::to(['/'.$menu->url.'/'.$model->cat->alt_name]);?>"><?=$model->cat->name;?></a>
    <p><?=\common\helpers\CString::subStr($model->description, 0, 300);?></p>
</div>