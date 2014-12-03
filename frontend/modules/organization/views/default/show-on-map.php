<?php
/**
 * Created by PhpStorm.
 * User: Phantom
 * Date: 21.11.2014
 * Time: 17:34
 */
use yii\web\View;

$this->title = "Организации на карте - ".Yii::$app->params['seo_title'];
Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => $model->seo_keywords]);
Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $model->seo_description]);

$js = "";
if ($model)
    foreach ($model as $index => $orgModel) {
        switch ($orgModel->cat->id) {
            case 1:
                $js .= '

                orgPlacemark' . $index . ' = new ymaps.Placemark([organization_coord[' . $index . '][1], organization_coord[' . $index . '][0]], {
                    balloonContentHeader: "<strong>'.\yii\helpers\Html::encode($orgModel->name).'</strong>",
                    balloonContentBody: "'.\yii\helpers\Html::encode($orgModel->description).'",
                    balloonContentFooter: "'.\yii\helpers\Html::encode($orgModel->address).'</br> Тел.: '.$orgModel->phone.'</br> Построить путь"
				}, washMark );
                orgMap.geoObjects.add(orgPlacemark' . $index . ');
            ';
                break;
            case 2:
                $js .= '

                orgPlacemark' . $index . ' = new ymaps.Placemark([organization_coord[' . $index . '][1], organization_coord[' . $index . '][0]], {
                    balloonContentHeader: "<strong>'.\yii\helpers\Html::encode($orgModel->name).'</strong>",
                    balloonContentBody: "'.\yii\helpers\Html::encode($orgModel->description).'",
                    balloonContentFooter: "'.\yii\helpers\Html::encode($orgModel->address).'</br> Тел.: '.$orgModel->phone.'"
                }, tireMark );
                orgMap.geoObjects.add(orgPlacemark' . $index . ');
            ';
                break;
            case 3:
                $js .= '

                orgPlacemark' . $index . ' = new ymaps.Placemark([organization_coord[' . $index . '][1], organization_coord[' . $index . '][0]], {
                    balloonContentHeader: "<strong>'.\yii\helpers\Html::encode($orgModel->name).'</strong>",
                    balloonContentBody: "'.\yii\helpers\Html::encode($orgModel->description).'",
                    balloonContentFooter: "'.\yii\helpers\Html::encode($orgModel->address).'</br> Тел.: '.$orgModel->phone.'"
				}, rusMark );
                orgMap.geoObjects.add(orgPlacemark' . $index . ');
            ';
                break;
            case 4:
                $js .= '

                orgPlacemark' . $index . ' = new ymaps.Placemark([organization_coord[' . $index . '][1], organization_coord[' . $index . '][0]], {
                    balloonContentHeader: "<strong>'.\yii\helpers\Html::encode($orgModel->name).'</strong>",
                    balloonContentBody: "'.\yii\helpers\Html::encode($orgModel->description).'",
                    balloonContentFooter: "'.\yii\helpers\Html::encode($orgModel->address).'</br> Тел.: '.$orgModel->phone.'"
				}, repairMark);
                orgMap.geoObjects.add(orgPlacemark' . $index . ');
            ';
                break;
            default:
                $js .= '
                orgPlacemark' . $index . ' = new ymaps.Placemark([organization_coord[' . $index . '][1], organization_coord[' . $index . '][0]], {
                    balloonContentHeader: "<strong>'.\yii\helpers\Html::encode($orgModel->name).'</strong>",
                    balloonContentBody: "'.\yii\helpers\Html::encode($orgModel->description).'",
                    balloonContentFooter: "'.\yii\helpers\Html::encode($orgModel->address).'</br> Тел.: '.$orgModel->phone.'"
				}, unknowMark );
                orgMap.geoObjects.add(orgPlacemark' . $index . ');
            ';
                break;
        }
    }
    $js .= "";
Yii::$app->view->registerJs("
    var organization_coord = [];
    if (".count($latitude).")
    {
        var latitude = ".json_encode($latitude).";
        var longitude = ".json_encode($longitude).";

        $.each(longitude, function (id, value) {
            organization_coord[id] = [];
            organization_coord[id][0] = value;
        })

        $.each(latitude, function (id, value) {
            organization_coord[id][1] = value;
        })
    }
    else {
         organization_coord[0] = getCoord('Москва');
    }

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

        ymaps.ready(function(){
                orgMap = new ymaps.Map('map-address-all', {
                    center: [organization_coord[0][1], organization_coord[0][0]],
                    zoom: 12
                });
            orgMap.controls.add('zoomControl');

    ".$js."

    var myLocation = new ymaps.Placemark(
        [ymaps.geolocation.latitude, ymaps.geolocation.longitude],
        {hintContent: 'Передвиньте метку в нужное место на карте.'},
        {
            draggable: true,
        }
    )

    orgMap.geoObjects.add(myLocation);
    var coords = myLocation.geometry.getCoordinates();

    orgMap.events.add('click', function(e) {
        var coords = e.get('coords');
        myLocation.geometry.setCoordinates(coords);
        event.stopImmediatePropagation();
    });

//    myPlacemark.events.add('dragend', function(e) {
//        var thisPlacemark = e.get('target');
//        var coords = thisPlacemark.geometry.getCoordinates();
//        setCoordinates(coords[0], coords[1]);
//    });
//var fPlacemark = new ymaps.Placemark(
//[47.5169416033, 42.9729279383])
//orgMap.geoObjects.add(fPlacemark);
    orgMap.geoObjects.add(myLocation);

//    alert (organization_coord[0]);

});
", View::POS_READY);
?>

<section class="organizations">
    <div class="container">
        <h1>Показать организации на карте</h1>
        <?php $form = \yii\widgets\ActiveForm::begin([
            'id' => "searchOrg",
            'method' => 'get',
            'action' => \yii\helpers\Url::to(['/'.$menu->url.'/show-on-map'])
        ])?>
        <div class="item one-third column">
            <label for="">Город</label>
            <?php
            $city_var = Yii::$app->request->get('city');
            ?>
            <?= \yii\helpers\Html::dropDownList('city', $city_var, \yii\helpers\ArrayHelper::map(\common\modules\organization\models\City::find()->all(), "id", 'name'), ['prompt' => '---']) ?>
        </div>
        <div class="item one-third column">
            <label for="">Тип организации</label>
            <?php
            $category_var = Yii::$app->request->get('category');
            ?>
            <?= \yii\helpers\Html::dropDownList('category', $category_var, \yii\helpers\ArrayHelper::map(\common\modules\organization\models\Category::find()->all(), 'alt_name', 'name'), ['prompt' => '---']) ?>
        </div>
        <div class="item one-third column">
            <div class="button" onclick="$('#searchOrg').submit();">Показать на карте</div>
        </div>
        <?php \yii\widgets\ActiveForm::end(); ?>

    </div>
</section>

<div class="map-all" id="map-address-all"></div>

<br />
<br />
<br />