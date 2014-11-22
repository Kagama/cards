<?php

namespace frontend\modules\user\controllers;

use frontend\modules\user\models\ChangePasswordForm;
use frontend\modules\user\models\ClientRegForm;
use Yii;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\modules\user\models\User;
use common\modules\user\models\RegisterForm;

class DefaultController extends Controller
{
//    public function behaviors()
//    {
//        return [
////            'verbs' => [
////                'class' => VerbFilter::className(),
////                'actions' => [
////                    //'delete' => ['post'],
////                ],
////            ],
//            'access' => [
//                'class' => AccessControl::className(),
//                'only' => ['index', 'self-info', 'change-password', 'registration'],
//                'rules' => [
//                    [
//                        'allow' => true,
//                        'actions' => ['index', 'self-info', 'change-password', 'registration'],
//                        'matchCallback' => function ($rule, $action) {
//                            $model = User::findIdentity(Yii::$app->user->getId());
//                            if (!empty($model)) {
//                                return ($model->role->id == 2); //
//                            }
//                            return false;
//                        }
//                    ],
//                    [
//                        'allow' => true,
//                        'actions' => ['index', 'self-info', 'change-password', 'registration'],
////                        'roles' => ['@']
//                        'matchCallback' => function ($rule, $action) {
//                            $model = User::findIdentity(Yii::$app->user->getId());
//                            if (!empty($model)) {
//                                return ($model->role->id == 1); // Администратор
//                            }
//                            return false;
//                        }
//                    ],
//
//                ]
//            ]
//        ];
//    }

    public function actionIndex()
    {
        return $this->render('index');
    }

//    public function actionSelfInfo()
//    {
//
//        $model = User::findIdentity(Yii::$app->user->getId());
//
//        $success = false;
//        if ($model->load(Yii::$app->request->post())) {
//            $model->updated_at = time();
//            if ($model->save()) {
//                $success = true;
//
//            }
//        }
//
//        return $this->render('selfInfo', ['success' => $success, 'model' => $model]);
//    }

//    public function actionChangePassword()
//    {
//        $model = User::findIdentity(Yii::$app->user->getId());
//        $form = new ChangePasswordForm();
//
//        $success = false;
//        if ($form->load(Yii::$app->request->post()) && $form->updateUser($model)) {
//            $success = true;
//        }
//
//        return $this->render('change-password', ['success' => $success, 'model' => $form]);
//    }

    public function actionRegistration()
    {
        $model = new ClientRegForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->registration($model)) {

                $sum = ($model->month + 1) * Yii::$app->params['month_price'];

                $SignatureValue = md5(Yii::$app->params['MrchLogin'] . ":" . $sum . ":0:" . Yii::$app->params['Pass_1'] . ":Shp_1=" . $model->car_number . ":Shp_2=" . $model->card_number);

                return $this->redirect(Yii::$app->params['ROBOKASSA_URL'] . "?MrchLogin=" . Yii::$app->params['MrchLogin'] .
                    '&InvId=0' .
                    '&OutSum=' . $sum .
                    '&Desc=Активация дисконтной карты на выбранный период' .
                    '&Shp_1=' . $model->car_number .
                    '&Shp_2=' . $model->card_number .
                    '&SignatureValue=' . $SignatureValue
                );
            }
        }
        return $this->render('registration', [
            'regForm' => $model
        ]);
    }

    public function actionCheckCar()
    {
        if (Yii::$app->request->isAjax) {

            $car_number = Yii::$app->request->get('car_number');
            $user = User::find()->where(['car_number' => $car_number])->one();

            if (empty($user)) {
                return Json::encode(['car_fail' => true]);
            } else if (empty($user->card) || ($user->card->active == 0)) {
                return Json::encode(['fail' => true]);
            } else {
                return Json::encode(['success' => true]);
            }
        }
        $this->goHome();

    }

//    public function actionActivate($username)
//    {
//        $model = User::findOne(['username' => $username]);
//        if ($model->load(Yii::$app->request->post()) && $model->validate())
//            if ($model->save()) {
//                Yii::$app->getSession()->setFlash('activation-done', '<p> Карта активирована. </p>');
//            }
//        return $this->render('activate', [
//            'model' => $model,
//        ]);
//    }


}
