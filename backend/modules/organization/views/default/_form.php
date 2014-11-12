<?php
/**
 * Created by PhpStorm.
 * User: Phantom
 * Date: 26.10.2014
 * Time: 0:32
 */
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
//use kartik\widgets\Typeahead;
use common\modules\organization\models\Category;
use common\modules\organization\models\City;

Yii::$app->view->registerJsFile('http://api-maps.yandex.ru/2.1/?load=package.full&mode=debug&lang=ru-RU');
Yii::$app->view->registerJs("
            var myMap;
            ymaps.ready(function () {
                var latitudeInput = $('#organization-latitude');
                var longitudeInput = $('#organization-longitude');
                var startGeoPoint;
                if (latitudeInput.val().length == 0 || longitudeInput.val().length == 0) {
                    startGeoPoint = [42.985532, 47.504067];
                } else {
                    startGeoPoint = [latitudeInput.val(), longitudeInput.val()];
                }

                myMap = new ymaps.Map('yandexMap', {
                        center: startGeoPoint,
                        zoom: 13,
                    }
                );

                var myPlacemark = new ymaps.Placemark(
                    startGeoPoint,
                    {hintContent: 'Передвиньте метку в нужное место на карте.'},
                    {
                        draggable: true,
                    }
                );

                myMap.geoObjects.add(myPlacemark);
                myMap.behaviors.disable('scrollZoom');

                myMap.events.add('click', function(e) {
                    var coords = e.get('coords');
                    myPlacemark.geometry.setCoordinates(coords);
                    setCoordinates(coords[0], coords[1]);

                    event.stopImmediatePropagation();
                });

                myPlacemark.events.add('dragend', function(e) {
                    var thisPlacemark = e.get('target');
                    var coords = thisPlacemark.geometry.getCoordinates();
                    setCoordinates(coords[0], coords[1]);
                });

//                $('#yandexMap').hover(function(){
//                    myMap.behaviors.enable('scrollZoom')
//                },function(){
//                    myMap.behaviors.disable('scrollZoom');
//                });

//                ymaps.geolocation.get().then(function (result) {
//                    var myLocation = result.geoObjects.get(0).properties.get('text');
//    //                    myMap.geoObjects.add(result.geoObjects);
//                    ymaps.route([myLocation, startGeoPoint]).then(
//                        function (route) {
//                            myMap.geoObjects.add(route);
//                        },
//                        function (error) {
//                            alert('Возникла ошибка: ' + error.message);
//                        }
//                    );
//                });


            });

            function setCoordinates(latitude, longitude) {
                $('#organization-latitude').val(latitude);
                $('#organization-longitude').val(longitude);

                var myGeocoder = ymaps.geocode([latitude, longitude]);

                myGeocoder.then(function (res) {
                    res.geoObjects.each(function (currentObject) {
                        $('#organization-address').val(currentObject.properties.get('text'));
                        return false;
                    });
                });
            }
        ", View::POS_READY, 'add-organization-action');

?>


<section class="widget">
    <div class="organization-form">

        <?php $form = ActiveForm::begin([
            'options' => [
                'novalidate' => "novalidate",
                'method' => "post",
                'data-validate' => "parsley"
            ]
        ]); ?>
        <?= $form->errorSummary($model) ?>
        <?= $form->field($model, 'name')->textInput(); ?>

        <?= $form->field($model, 'category')->dropDownList(ArrayHelper::map(Category::find()->all(), 'id', 'name'), ['prompt' => '---']) ?>

        <?= $form->field($model, 'working_time')->textInput(); ?>

        <?= $form->field($model, 'phone')->textInput(); ?>
        <?php $data = [1, 2, 3, 4] ?>


        <?=
        $form->field($city, 'name')->widget(\kartik\widgets\Select2::className(), [
            'model' => $city,
            'attribute' => 'name',
            'options' => ['multiple' => false, 'class' => 'form-control'],
            'pluginOptions' => [
                'tags' => City::getAllLikeJsList(),
                'maximumInputLength' => 30,
                'maximumSelectionSize' => 1
            ],
        ]); ?>

        <?= $form->field($model, 'address')->textInput(['maxlength' => 512]); ?>

        <span class="test"></span>


        <div class="row">
            <a href="#" onclick="$('#yandexMap').toggle(); return false;" class="btn"><span
                    class="glyphicon glyphicon-map-marker"></span> Укажите расположение организации на карте</a>
            <?=
            $form->field($model, 'latitude', [
                'template' => '
                            {input}
                        '
            ])->hiddenInput()->label('') ?>
            <?=
            $form->field($model, 'longitude', [
                'template' => '
                            {input}
                        '
            ])->hiddenInput()->label('') ?>

            <!--        <p class="note">Для удобства добавления адреса вы можете вользоваться Yandex картой.</p>-->
            <span id="latitude"></span> <span id="longitude"></span>

            <div id="yandexMap" class="col-lg-12" style="height: 300px;">

            </div>
        </div>

        <?= $form->field($model, 'description')->textarea(['rows' => 6]); ?>

        <fieldset>
            <legend>SEO Атрибуты</legend>
            <?= $form->field($model, 'seo_title')->textInput(['maxlength' => 512]) ?>

            <?= $form->field($model, 'seo_keywords')->textInput(['maxlength' => 512]) ?>

            <?= $form->field($model, 'seo_description')->textarea(['rows' => 6]) ?>
        </fieldset>

        <div class="form-actions">
            <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</section>




