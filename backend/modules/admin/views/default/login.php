<?php
use backend\assets\AppAsset;

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;



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
//$user->roleId = 1;
//$user->setPassword($user->password);
//$user->generateAuthKey();
//if ($user->save()) {
//    print_r($user->getErrors());
//    return $user;
//} else {
//    print_r($user->getErrors());
//}

/**
 * @var \yii\web\View $this
 * @var string $content
 */
AppAsset::register($this);

//$this->registerCssFile("themes/lightblue/css/site.css");
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<?php $this->beginBody() ?>
<body class="background-dark">
<div class="logo widget" style=" margin: 0 0 10px 0; padding: 0 0 0 0; float: left; left: 0; top: -10px;">
<!--    <section class="">-->
    <h4 style="position: relative; left: 40px;"><a href="index.html">Kagama <strong>&nbsp;&nbsp;CMS</strong></a></h4>
</div>

<div class="site-login">

<div class="container">

        <div class="col-lg-5 login-page">

            <h1><?= Html::encode($this->title) ?></h1>

            <p>Пожалуйста, заполните следующие поля, чтобы войти в систему:</p>
            <section class="widget">


            <?php $form = ActiveForm::begin(['id' => 'login-form', 'method' => 'post']); ?>
<!--            <span class="input-group-addon"><i class="fa fa-user"></i></span>-->

                <?= $form->field($model, 'username', [
                    'template' => '
                    <div class="control-group">
                            <label class="control-label" for="password-field">{label}</label>
                            <div class="controls form-group">
                                <div class="input-group col-sm-12">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    {input}
                                </div>
                                <div class="help-block">{error}</div>
                            </div>
                        </div>'
                ])->textInput(); ?>
                <?= $form->field($model, 'password', [
                    'template' => '
                        <div class="control-group">
                            <label class="control-label" for="prepended-input">{label}</label>
                            <div class="controls form-group">
                                <div class="input-group col-sm-12">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    {input}
                                </div>
                                <div class="help-block">{error}</div>
                            </div>
                        </div>'
                ])->passwordInput(['class' => 'form-control']); ?>

                <?= $form->field($model, 'rememberMe')->checkbox() ?>
<!--                <div style="color:#999;margin:1em 0">-->
<!--                    If you forgot your password you can --><?//= Html::a('reset it', ['site/request-password-reset']) ?><!--.-->
<!--                </div>-->
                <div class="form-group">
                    <?= Html::submitButton('Вход', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </section>
    </div>
</div>

<!-- jquery and friends -->
<script src="/cp/lib/lightblue/jquery/jquery-2.0.3.min.js"> </script>
<script src="/cp/lib/lightblue/jquery-pjax/jquery.pjax.js"></script>


<!-- jquery plugins -->
<script src="/cp/lib/lightblue/icheck.js/jquery.icheck.js"></script>
<script src="/cp/lib/lightblue/sparkline/jquery.sparkline.js"></script>
<script src="/cp/lib/lightblue/jquery-ui-1.10.3.custom.js"></script>
<script src="/cp/lib/lightblue/jquery.slimscroll.js"></script>

<!-- d3, nvd3-->
<script src="/cp/lib/lightblue/nvd3/lib/d3.v2.js"></script>
<script src="/cp/lib/lightblue/nvd3/nv.d3.custom.js"></script>


<!--<div class="wrap">-->
<?php
/*NavBar::begin([
    'brandLabel' => 'My Company',
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-inverse navbar-fixed-top',
    ],
]);
$menuItems = [
    ['label' => 'Home', 'url' => ['/admin/default/index']],
];
if (Yii::$app->user->isGuest) {
    $menuItems[] = ['label' => 'Login', 'url' => ['/admin/default/login']];
} else {
    $menuItems[] = [
        'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
        'url' => ['/admin/default/logout'],
        'linkOptions' => ['data-method' => 'post']
    ];
}
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => $menuItems,
]);
NavBar::end();*/
?>

<!--    <div class="container">-->
<!--        --><?//= Breadcrumbs::widget([
//            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
//        ]) ?>
<!--        --><?//= $content ?>
<!--    </div>-->
<!--</div>-->



<?php $this->endBody() ?>
</div>
</body>
</html>
<?php $this->endPage() ?>

