<?php
/**
 * Created by PhpStorm.
 * User: pashaevs
 * Date: 04.11.14
 * Time: 17:08
 */

namespace backend\modules\layoutEditor\controllers;
use Yii;
use yii\helpers\FileHelper;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use backend\modules\admin\models\AdminUsers;

class DefaultController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],

            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'edit'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'edit'],
                        'matchCallback' => function ($rule, $action) {
                            $model = AdminUsers::findIdentity(Yii::$app->user->getId());
                            if (!empty($model)) {
                                return $model->getRoleId() == 1; // Администратор
                            }
                            return false;
                        }
                    ]
                ]
            ]
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionEdit($file = null)
    {
        $file = Html::decode($file);
        if ($file === null)
            throw new NotFoundHttpException('Страница не найдена.');

        $content = file_get_contents($file);

        if (isset($_POST['file-content'])) {
            if (file_put_contents($file, $_POST['file-content'])) {
                $this->redirect(['index']);
            }

        }
        $file_content  = $content;

        return $this->render('edit', ['file_content' => $file_content]);
    }
}