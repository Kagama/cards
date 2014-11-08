<?php

namespace frontend\modules\user\controllers;

use frontend\modules\user\models\ChangePasswordForm;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\modules\user\models\User;
use common\modules\user\models\RegisterForm;

class DefaultController extends Controller
{
    public function behaviors()
    {
        return [
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    //'delete' => ['post'],
//                ],
//            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'self-info', 'change-password'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'self-info', 'change-password'],
                        'matchCallback' => function ($rule, $action) {
                                $model = User::findIdentity(Yii::$app->user->getId());
                                if (!empty($model)) {
                                    return ($model->role == 2); //
                                }
                                return false;
                            }
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index', 'self-info', 'change-password'],
//                        'roles' => ['@']
                        'matchCallback' => function ($rule, $action) {
                                $model = User::findIdentity(Yii::$app->user->getId());
                                if (!empty($model)) {
                                    return ($model->role == 1); // Администратор
                                }
                                return false;
                            }
                    ],

                ]
            ]
        ];
    }
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionSelfInfo () {

        $model = User::findIdentity(Yii::$app->user->getId());

        $success = false;
        if ($model->load(Yii::$app->request->post())) {
            $model->updated_at = time();
            if ($model->save()) {
                $success = true;

            }
        }

        return $this->render('selfInfo', ['success' => $success, 'model' => $model]);
    }

    public function actionChangePassword () {
        $model = User::findIdentity(Yii::$app->user->getId());
        $form = new ChangePasswordForm();

        $success = false;
        if ($form->load(Yii::$app->request->post()) && $form->updateUser($model)) {
            $success = true;
        }

        return $this->render('change-password', ['success' => $success, 'model' => $form]);
    }

    public function actionRegister()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new RegisterForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->register($model)) {
                return $this->redirect(['activate', 'username' => $model->username]);
            }
        }
        return $this->render('register', [
            'model' => $model
        ]);
    }

    public function actionActivate($username)
    {
        $model = User::findOne(['username' => $username]);
        if ($model->load(Yii::$app->request->post()) && $model->validate())
            if ($model->save()) {
                Yii::$app->getSession()->setFlash('activation-done', '<p> Карта активирована. </p>');
            }
        return $this->render('activate', [
            'model' => $model,
        ]);
    }
}
