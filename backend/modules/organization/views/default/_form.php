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
                    startGeoPoint = [55.753676, 37.619899];
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
                'data-validate' => "parsley",
                'enctype' => 'multipart/form-data'
            ]
        ]); ?>
        <?= $form->errorSummary($model) ?>

        <?php
        if ($model->img != "") {
            echo Html::img("/".$model->doCache('300x190', 'width', '300x190'));
        }
        ?>
        <?= $form->field($model, 'img')->fileInput()?>

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

        <?= $form->field($model, 'description', [
            'template' => '
                {label}
                <div class="textarea-content">{input}</div>
                {error}
            '
        ])->widget(sim2github\imperavi\widgets\Redactor::className(), [
//            'options' => [
//                'debug' => 'true',
//            ],
            'clientOptions' => [ // [More about settings](http://imperavi.com/redactor/docs/settings/)
                'convertImageLinks' => 'true', //By default
                'convertVideoLinks' => 'true', //By default
                'buttonSource' => true,
                //'wym' => 'true',
                //'air' => 'true',
                'linkEmail' => 'true', //By default
                'lang' => 'ru',
//            'imageGetJson' =>  \Yii::getAlias('@web').'/redactor/upload/imagejson', //By default
                'plugins' => [ // [More about plugins](http://imperavi.com/redactor/plugins/)
                    'ace',
                    'clips',
                    'fullscreen'
                ]
            ],

        ]);
        ?>

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




