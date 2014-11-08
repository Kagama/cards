<?php

namespace frontend\modules\main\controllers;


use frontend\modules\main\models\ContactForm;
use Yii;
use yii\helpers\Json;
use yii\web\Controller;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\modules\main\models\SignupForm;
use frontend\modules\main\models\LoginForm;
use common\modules\consultation\models\Consultation;
use frontend\modules\consultation\models\ConsultationForm;
use frontend\modules\consultation\widget\ConsultationWidget;

class DefaultController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup', 'contact'],
                'rules' => [
                    [
                        'actions' => ['signup', 'contact'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['get'],
                ],
            ],
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
//        $model = new ConsultationForm();
//        $cons = new Consultation();
//        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
//            if ($model->saveConsultation($cons)){
//
//            } else {
//
//            }
//        }

        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        $reg = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        if ($reg->load(Yii::$app->request->post())) {
            $user = $model->signup();
            if ($user) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }
        return $this->render('login', [
            'model' => $model,
            'reg' => $reg
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionSignup()
    {

        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            $user = $model->signup();
            if ($user) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionContact()
    {
        $model = new ContactForm();

        if (Yii::$app->request->isAjax) {

            if ($model->load(Yii::$app->request->post()) && $model->validate()) {

                if ($model->sendMessageTo()) {
                    echo Json::encode(['error' => false, 'message' => 'Спасибо за доверие! В ближайшее время мы свяжемся с Вами.']);
                    Yii::$app->end();
                } else {
                    echo Json::encode(['error' => true, 'message' => 'Письмо не отправленно к Администратору сайта.<br />Через некоторое время попробуйте еще раз.']);
                    Yii::$app->end();
                }
            } else {
                echo Json::encode(['error' => true, 'message' => 'Некоторые поля не заполнены']);
            }
            Yii::$app->end();
        }
    }
}
