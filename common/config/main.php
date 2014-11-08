<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'extensions' => require(__DIR__ . '/../../vendor/yiisoft/extensions.php'),
    'language' => 'ru-RU',
    'modules' => [
        'gii' => 'yii\gii\Module',
        'redactor' =>  'sim2github\imperavi\Module',
//        'news' => [
//            'class' => 'common\modules\news\NewsModule',
//        ],
//        'pages' => [
//            'class' => 'common\modules\pages\PagesModule',
//        ],
//        'user' => [
//            'class' => 'common\modules\user\UserModule',
//        ],
//        'camp' => [
//            'class' => 'common\modules\camp\CampModule',
//        ],
    ],

    'components' => [

//        'cache' => [
//            'class' => 'yii\caching\FileCache',
//        ],
        'image' => [
            'class' => 'yii\image\ImageDriver',
            'driver' => 'GD',  //GD or Imagick
        ],
//        'urlManager' => [
//            'enablePrettyUrl' => true,
//            'showScriptName' => false,
//            'suffix' => '.html',
//            'rules'=>[
//
//////
////                '<module:\w+>/<action:\w+>'=>'<module>/default/<action>',
////                '<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>'=>'<module>/<controller>/<action>',
//                '<module:\w+>/<controller:\w+>/<action:\w+>'=>'<module>/<controller>/<action>',
////
//                '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
//                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
////////
////                'gii'=>'gii/default/index',
////                'gii/<controller:\w+>/<action:\w+>'=>'gii/<controller>/<action>',
//            ]
//        ],

    ],
];
