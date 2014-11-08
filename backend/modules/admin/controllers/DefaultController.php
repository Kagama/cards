<?php

namespace backend\modules\admin\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use backend\modules\admin\models;

class DefaultController extends Controller
{
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login', 'logout', 'index', 'error'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login', 'error'],
                        'roles' => ['?']
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index', 'logout'],
//                        'roles' => ['@']
                        'matchCallback' => function ($rule, $action) {
                            if ($action != 'logout') {
                                $model = models\AdminUsers::findIdentity(Yii::$app->user->getId());
                                if (!empty($model)) {
                                    return $model->getRoleId() == 1; // Администратор
                                }
                            }
                            return false;
                        }
                    ]
                ]
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
//        var_dump(Yii::$app->request->post());
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new \backend\modules\admin\models\LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $this->redirect(['/admin/default/index']);
        } else {
            return $this->renderPartial('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
