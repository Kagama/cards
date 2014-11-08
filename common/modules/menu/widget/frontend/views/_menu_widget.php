<?php
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;


//NavBar::begin([
////                'brandLabel' => 'My Company',
////                'brandUrl' => Yii::$app->homeUrl,
//    'options' => [
//        'class' => 'navbar-inverse ',
//    ],
//]);
//$menuItems = [
//    ['label' => 'Главная', 'url' => Yii::$app->homeUrl],
//    ['label' => 'Список всех лагерей', 'url' => null,
//        'items' => [
//            ['label' => 'Лагеря со спортивным уклоном', 'url' => '#'],
//            ['label' => 'Лагеря с бассейном', 'url' => '#'],
//            ['label' => 'Лагеря с творческим уклоном', 'url' => '#'],
//            ['label' => 'Лагеря с изучением ин. языков', 'url' => '#'],
//            ['label' => 'Зимние лагеря', 'url' => '#'],
//            ['label' => 'Лагеря в горных местностях', 'url' => '#'],
//            ['label' => 'Лагеря с санаторно-курортным лечением', 'url' => '#'],
//            ['label' => 'Лагеря с возможностью кататься на лошадях', 'url' => '#'],
//        ]
//    ],
//    ['label' => 'информация о нас', 'url' => ['#']],
//    ['label' => 'контакты', 'url' => ['#']],
////                    ['label' => 'фотографии', 'url' => ['#']],
////                    ['label' => 'видео', 'url' => ['#']],
//    ['label' => 'отзывы', 'url' => ['#']],
//    ['label' => 'вопрос-ответ', 'url' => ['#']],
//    ['label' => 'карта', 'url' => ['#']],
//
//];
if (Yii::$app->user->isGuest) {
//    $menuItems2[] = ['label' => 'Вход', 'url' => ['/main/default/login']];
} else {
    $menuItems2[] = [
        'label' => "<span class='glyphicon glyphicon-user'></span>   ".Yii::$app->user->identity->username,
        'url' => null,
        'items' => [
            ['label' => '<span class="glyphicon glyphicon-cog"></span> Личный кабинет', 'url' => ['/user/default/index']],
            ['label' => '<span class="glyphicon glyphicon-log-out"></span> Выход', 'url' => ['/main/default/logout'], 'linkOptions' => ['data-method' => 'get', 'class' => 'logout-link']]
        ]
    ];
}

if (!Yii::$app->user->isGuest) {
    if (\common\modules\user\models\User::findOne(Yii::$app->user->getId())->role == 2 ) {
    }
}

echo \common\helpers\MyNav::widget([
    //'options' => ['class' => 'navbar-nav navbar-left '],
    'items' => $menuItems,
]);
if (!empty($menuItems2)) {
    echo \common\helpers\MyNav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems2,
        'encodeLabels' => false
    ]);
}

//NavBar::end();
?>