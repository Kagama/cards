<?php
/**
 * Created by PhpStorm.
 * User: pashaevs
 * Date: 17.11.14
 * Time: 16:26
 */

use yii\web\View;



$js = "ymaps.ready(function(){";

switch($model->cat->id) {
    case 1:
        $js .= '
            orgMap = new ymaps.Map("map-wash", {
                center: [organization_coord[1], organization_coord[0]],
                zoom: 16
            });

            orgPlacemark = new ymaps.Placemark([organization_coord[1], organization_coord[0]], {balloonContent: ""}, washMark );
            orgMap.geoObjects.add(orgPlacemark);
        ';
        break;
    case 2:
        $js .= '
            orgMap = new ymaps.Map("org-tire", {
                center: [organization_coord[1], organization_coord[0]],
                zoom: 16
            });

            orgPlacemark = new ymaps.Placemark([organization_coord[1], organization_coord[0]], {balloonContent: ""}, tireMark );
            orgMap.geoObjects.add(orgPlacemark);
        ';
        break;
    case 3:
        $js .= '
            orgMap = new ymaps.Map("map-russ", {
                center: [organization_coord[1], organization_coord[0]],
                zoom: 16
            });

            orgPlacemark = new ymaps.Placemark([organization_coord[1], organization_coord[0]], {balloonContent: ""}, rusMark );
            orgMap.geoObjects.add(orgPlacemark);
        ';
        break;
    case 4:
        $js .= '
            orgMap = new ymaps.Map("map-repair", {
                center: [organization_coord[1], organization_coord[0]],
                zoom: 16
            });

            orgPlacemark = new ymaps.Placemark([organization_coord[1], organization_coord[0]], {balloonContent: ""}, repairMark );
            orgMap.geoObjects.add(orgPlacemark);
        ';
        break;
    default:
        $js .= '
            orgMap = new ymaps.Map("map-org", {
                center: [organization_coord[1], organization_coord[0]],
                zoom: 16
            });

            orgPlacemark = new ymaps.Placemark([organization_coord[1], organization_coord[0]], {balloonContent: ""}, unknowMark );
            orgMap.geoObjects.add(orgPlacemark);
        ';
        break;
}

$js .= "});";

Yii::$app->view->registerJs("
    var organization_coord = getCoord('".$model->address."');

    var footMap, orgMap, allMap,
    	mainMark    =  {
			            	iconImageHref:   '/img/map-icon-main.png', // картинка иконки
			            	iconImageSize:   [ 200,  150], 			  // размер иконки
			            	iconImageOffset: [-100, -105] 			  // позиция иконки
	                   },
	    washMark    =  {
			            	iconImageHref:   '/img/map-icon-wash.png',
			            	iconImageSize:   [ 80,  80],
			            	iconImageOffset: [-40, -70]
				       },
	    tireMark    =  {
			            	iconImageHref:   '/img/map-icon-tire.png',
			            	iconImageSize:   [ 80,  80],
			            	iconImageOffset: [-40, -70]
				       },
	    rusMark     =  {
			            	iconImageHref:   '/img/map-icon-rus.png',
			            	iconImageSize:   [ 80,  80],
			            	iconImageOffset: [-40, -70]
				       },
	    repairMark  =  {
			            	iconImageHref:   '/img/map-icon-repair.png',
			            	iconImageSize:   [ 80,  80],
			            	iconImageOffset: [-40, -70]
				       },
	    unknowMark  =  {
			            	iconImageHref:   '/img/map-icon-unknown.png',
			            	iconImageSize:   [ 80,  80],
			            	iconImageOffset: [-40, -70]
				       };

    ".$js."

", View::POS_READY);
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

        <div class="map sixteen columns" id="<?= $model->cat->id == 1 ? "map-wash" : ($model->cat->id == 2 ? "org-tire" : ($model->cat->id == 3 ? "map-russ" : ($model->cat->id == 4 ? "map-repair" : "map-org") )) ;?>"></div>
    </div>
</section>