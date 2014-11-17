<?php
/**
 * Created by PhpStorm.
 * User: pashaevs
 * Date: 17.11.14
 * Time: 16:26
 */
?>
<!-- Org Info -->

<section class="org-info">
    <div class="container">

        <div class="info six columns">
            <h1><?=$model->name?></h1>
            <?=\yii\helpers\Html::img("/".$model->doCache('300x190', 'width'), ['alt' => "Лого - ".$model->name])?>
            <span><?=$model->address?></span>
            <span><?=$model->cityObj->name?></span>
<!--            <span>Руспублика Дагестан</span>-->
            <span class="phone"><?=$model->phone?></span>
        </div>

        <div class="description ten columns">
            <a href="<?=\yii\helpers\Url::to(['/'.$menu->url."/".$model->cat->alt_name])?>"><?=$model->cat->name?></a>
            <?=$model->description?>
        </div>

        <div class="map sixteen columns" id="map-org"></div>
    </div>
</section>