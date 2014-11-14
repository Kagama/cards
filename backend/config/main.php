<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'language' => 'ru',
//    'controllerNamespace' => 'backend\controllers',
    'defaultRoute' => 'admin/default',
    'bootstrap' => ['log'],
    'modules' => [
        'admin' => [
            'class' => 'backend\modules\admin\AdminModule',
        ],
        'pages' => [
            'class' => 'backend\modules\pages\PagesModule',
        ],
        'address' => [
            'class' => 'backend\modules\address\AddressModule',
        ],
        'menu' => [
            'class' => 'backend\modules\menu\MenuModule',
        ],
        'appmodule' => [
            'class' => 'backend\modules\appmodule\AppModule',
        ],
        'faq' => [
            'class' => 'backend\modules\faq\FaqModule'
        ],
        'files' => [
            'class' => 'backend\modules\files\FileModule',
        ],
        'organization' => [
            'class' => 'backend\modules\organization\OrganizationModule',
        ],

        'user' => [
            'class' => 'backend\modules\user\UserModule',
        ],

        'card' => [
            'class' => 'backend\modules\card\CardModule',
        ],
        'contentBlock' => [
            'class' => 'backend\modules\contentBlock\ContentBlockModule'
        ],
        'layoutEditor' => [
            'class' => 'backend\modules\layoutEditor\LayoutEditorModule'
        ]
    ],
    'components' => [
        'mail' => [
            'class' => 'yii\swiftmailer\Mailer',
        ],
        'session' => [
            'class' => 'yii\web\DbSession',
            'sessionTable' => 'backend_session'
        ],
        'request' => [
            'cookieValidationKey' => 'sdNsa23Ms',
            'enableCsrfValidation'=>false,
            'baseUrl' => '/cp' // данный адрес соответсвует с тем адресом который мы задали в .htaccess из общего рута нашего приложения.
        ],

        'user' => [
            'identityClass' => 'backend\modules\admin\models\AdminUsers',
            'enableAutoLogin' => true,
            'loginUrl' => 'admin/default/login.html'
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@app/views' => '@app/themes/lightblue',
                    '@app/modules' => '@app/themes/lightblue/modules', // <-- !!!
                ],
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'admin/default/error',
        ],
        'assetManager' => [
            'basePath' => '@webroot/assets',
            'baseUrl' => '@web/assets',
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'sourcePath' => null,
                    'js' => [''] // тут путь до Вашего экземпляра jquery
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'suffix' => '.html',
            'rules'=>[
                '<module:\w+>/<controller:\w+>/<action:\w+>'=>'<module>/<controller>/<action>',
                '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
            ]
        ],
    ],
    'params' => $params,
];
