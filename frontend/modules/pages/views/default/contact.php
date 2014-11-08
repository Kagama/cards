<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 25.08.14
 * Time: 0:32
 */
use yii\web\View;
use frontend\assets\AppAsset;

Yii::$app->view->registerJs('
    ymaps.ready(init);
	    var myMap,
	        myPlacemark;

	    function init(){
	        myMap = new ymaps.Map("map", {
	            center: [55.727, 37.61],
	            zoom: 16,
		        controls: []
	        });

	        myPlacemark = new ymaps.Placemark([55.725882, 37.60437], {
	            hintContent: "Ленинский проспект, д. 8",
	            balloonContent: "Столица России"
	        });

	        myMap.geoObjects.add(myPlacemark);
	    }
', View::POS_END);


$this->title = "Контакты - ".Yii::$app->params['seo_title'];
Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => Yii::$app->params['seo_keywords']]);
Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => Yii::$app->params['seo_description']]);
?>
<!-- Карта -->
<div class="cont_map" id="map">
    <div class="tri1"></div>

    <div class="cont_inf">
        <div>
            <h1>Контакты</h1>
				<span>
					Россия, 119991, ГСП, Москва, Ленинский проспект, д. 8, НЦССХ им. А. Н. Бакулева, корп. 29 (18)
				</span>
				<span>
					Телефон: 8 (495) 456-87-86
				</span>
        </div>
    </div>
</div>
<!-- Контент -->

<div class="content">
    <div class="wrapper">



    </div>
</div>