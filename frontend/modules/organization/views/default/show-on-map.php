<?php
/**
 * Created by PhpStorm.
 * User: Phantom
 * Date: 21.11.2014
 * Time: 17:34
 */
use yii\web\View;

$js = "";
if ($model)
    foreach ($model as $index => $orgModel) {
        switch ($orgModel->cat->id) {
            case 1:
                $js .= '

                orgPlacemark' . $index . ' = new ymaps.Placemark([organization_coord[' . $index . '][1], organization_coord[' . $index . '][0]], {
                    balloonContentHeader: "<strong>'.$orgModel->name.'</strong>",
                    balloonContentBody: "'.$orgModel->description.'",
                    balloonContentFooter: "'.$orgModel->address.'</br> Тел.: '.$orgModel->phone.'"
				}, washMark );
                orgMap.geoObjects.add(orgPlacemark' . $index . ');
            ';
                break;
            case 2:
                $js .= '

                orgPlacemark' . $index . ' = new ymaps.Placemark([organization_coord[' . $index . '][1], organization_coord[' . $index . '][0]], {
                    balloonContentHeader: "<strong>'.$orgModel->name.'</strong>",
                    balloonContentBody: "'.$orgModel->description.'",
                    balloonContentFooter: "'.$orgModel->address.'</br> Тел.: '.$orgModel->phone.'"
                }, tireMark );
                orgMap.geoObjects.add(orgPlacemark' . $index . ');
            ';
                break;
            case 3:
                $js .= '

                orgPlacemark' . $index . ' = new ymaps.Placemark([organization_coord[' . $index . '][1], organization_coord[' . $index . '][0]], {
                    balloonContentHeader: "<strong>'.$orgModel->name.'</strong>",
                    balloonContentBody: "'.$orgModel->description.'",
                    balloonContentFooter: "'.$orgModel->address.'</br> Тел.: '.$orgModel->phone.'"
				}, rusMark );
                orgMap.geoObjects.add(orgPlacemark' . $index . ');
            ';
                break;
            case 4:
                $js .= '

                orgPlacemark' . $index . ' = new ymaps.Placemark([organization_coord[' . $index . '][1], organization_coord[' . $index . '][0]], {
                    balloonContentHeader: "<strong>'.$orgModel->name.'</strong>",
                    balloonContentBody: "'.$orgModel->description.'",
                    balloonContentFooter: "'.$orgModel->address.'</br> Тел.: '.$orgModel->phone.'"
				}, repairMark);
                orgMap.geoObjects.add(orgPlacemark' . $index . ');
            ';
                break;
            default:
                $js .= '
                orgPlacemark' . $index . ' = new ymaps.Placemark([organization_coord[' . $index . '][1], organization_coord[' . $index . '][0]], {
                    balloonContentHeader: "<strong>'.$orgModel->name.'</strong>",
                    balloonContentBody: "'.$orgModel->description.'",
                    balloonContentFooter: "'.$orgModel->address.'</br> Тел.: '.$orgModel->phone.'"
				}, unknowMark );
                orgMap.geoObjects.add(orgPlacemark' . $index . ');
            ';
                break;
        }
    }
    $js .= "});";

Yii::$app->view->registerJs("
    var organization_coord = [];
    if (".count($address).")
    {
        var address = ".json_encode($address).";

        $.each(address, function (id, value) {
            organization_coord[id] = getCoord(value);
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
                    zoom: 16
                });
            orgMap.controls.add('zoomControl');

    ".$js."

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
            <div class="button" onclick="$('#searchOrg').submit();">Показать</div>
        </div>
        <?php \yii\widgets\ActiveForm::end(); ?>

    </div>
</section>

<div class="map-all" id="map-address-all"></div>

