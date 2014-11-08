<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var \common\models\LoginForm $model
 */
$this->title = 'Вход';
$this->params['breadcrumbs'][] = $this->title;


//use \common\modules\user\models\User;
//
//$user = new User();
//$user->username = 'rashid';
//$user->password = 'rashid';
//$user->status = 1;
////$user->roleId = 1;
//$user->setPassword($user->password);
//$user->generateAuthKey();
//if ($user->save()) {
//    return $user;
//} else {
//    print_r($user->getErrors());
//}

?>
<div class="orange-white-delimiter">
    <div class="margin03percent">
        <img src="/img/news-icon.png" class="icon-bg" alt="Информационные сообщения" /> <span>Вход - Регистрация</span>
    </div>
</div>
<div class="row white-bg" style="background-color: #f4f4f4;">
    <div class="margin03percent  login-form">


        <div class="row">
            <div class="col-lg-11" >
                <h1 style="text-align: right;">Вход</h1>

                <p style="text-align: right;">Пожалуйста, заполните следующие поля, чтобы войти на сайт:</p>

                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <?= $form->errorSummary($model) ?>
                <div style="text-align: right;">
                    <?= $form->field($model, 'username')?>
                </div>
                <div style="text-align: right;">
                    <?= $form->field($model, 'password')->passwordInput(); ?>
                </div>
                <?= $form->field($model, 'rememberMe')->checkbox() ?>
                <div style="color:#000;margin:1em 0; text-align: center;">
                    Если вы забыли пароль, вы можете <?= Html::a('востановить его', ['/main/default/request-password-reset']) ?>.
                </div>
                <div class="form-group">
                    <?= Html::submitButton('Вход', ['class' => 'btn red-button', 'name' => 'login-button']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
            <div class="col-lg-2">
                <span style="text-align: center; font-size: 1.8em; display: block; line-height: 3.2em;">- ИЛИ -</span>
            </div>
            <div class="col-lg-11">
                <h1>Регистрация</h1>

                <p>Пожалуйста, заполните следующие поля, чтобы зарегистрироваться:</p>

                <div class="row">
                    <div class="col-lg-24" >
                        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                        <?= $form->errorSummary($reg) ?>
                        <?= $form->field($reg, 'username') ?>
                        <?= $form->field($reg, 'email') ?>
                        <?= $form->field($reg, 'role')->radioList(\yii\helpers\ArrayHelper::map(\common\modules\user\models\UserRole::find()->all(), 'id', 'name')); ?>
                        <?= $form->field($reg, 'password')->passwordInput() ?>
                        <?= $form->field($reg, 're_password')->passwordInput() ?>
                        <div class="form-group">
                            <?= Html::submitButton('Регистрация', ['class' => 'btn red-button', 'name' => 'signup-button']) ?>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
