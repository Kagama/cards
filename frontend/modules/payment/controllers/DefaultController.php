<?php
/**
 * Created by PhpStorm.
 * User: pashaevs
 * Date: 21.11.14
 * Time: 19:20
 */

namespace frontend\modules\payment\controllers;

use common\modules\card\models\Card;
use common\modules\payment\models\PaymentLog;
use yii\web\Controller;

class DefaultController extends Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionSuccess()
    {
        $car_number = \Yii::$app->request->post('Shp_1');
        $car_number = mb_convert_encoding($car_number, 'UTF-8', 'CP-1251');

        $card_number = \Yii::$app->request->post('Shp_2');
        $card_number = mb_convert_encoding($card_number, 'UTF-8', 'CP-1251');

        $card = Card::find()->where(['discount_card' => $card_number])->one();
        if(!empty($card)) {
            $months = (\Yii::$app->request->post('OutSum') / \Yii::$app->params['month_price']);
            $card->active = 1;
            $card->last_payment = time();
            // Если дата окончания активности карты равно null или меньше текущей даты то ...
            if ($card->end_date == null || $card->end_date < time()) {
                $card->end_date = time() + (60 * 60 * 24 * $months);

            // Если дата окончания активности катры больше текущей даты то увеличиваем уже
            // оплоченый срок на указанные месяцы
            } else if ($card->end_date > time()) {
                $card->end_date = $card->end_date * (60 * 60 * 24 * $months);
            }

            if ($card->save()) {

                $log = new PaymentLog();
                $log->car_number = $car_number;
                $log->card_number = $card_number;
                $log->sum = \Yii::$app->request->post('OutSum');
                $log->date = time();
                $log->status = 'success';
                $log->save();
                unset($_POST);
                \Yii::$app->view->registerMetaTag(['http-equiv' => 'refresh', 'content' => "3;URL=".\Yii::$app->getHomeUrl()]);
            }
        }
        return $this->render('success');
    }


    public function actionFailed()
    {
        $car_number = \Yii::$app->request->get('Shp_1');
        $car_number = mb_convert_encoding($car_number, 'UTF-8', 'CP-1251');

        $card_number = \Yii::$app->request->get('Shp_2');
        $card_number = mb_convert_encoding($card_number, 'UTF-8', 'CP-1251');

        $log = new PaymentLog();
        $log->car_number = $car_number;
        $log->card_number = $card_number;
        $log->sum = \Yii::$app->request->get('OutSum');
        $log->date = time();
        $log->status = 'fail';
        $log->save();

        \Yii::$app->view->registerMetaTag(['http-equiv' => 'refresh', 'content' => "10;URL=".\Yii::$app->getHomeUrl()]);

        return $this->render('failed');
    }

    public function actionDoPay()
    {
        print_r(\Yii::$app->request->get());
    }
}