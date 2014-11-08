<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 22.07.14
 * Time: 22:45
 */

use yii\captcha\Captcha;

?>
<div class="orange-white-delimiter">
    <div class="margin03percent">
        <img src="/img/news-icon.png" class="icon-bg" alt="Информационные сообщения"/> <span><?= $menu->name ?> </span>
    </div>
</div>
<div class="row white-bg" style="background-color: #f4f4f4;">

    <div class="margin03percent">
        <div class="col-lg-17">
            <h1><?=$category->name?></h1>

            <div class="row faqs">
                <?=
                \yii\widgets\ListView::widget([
                    'dataProvider' => $dataProvider,
                    'layout' => '{items}{pager}',
                    'itemView' => '_faq_item',
                    'emptyText' => '- Нет вопросов -',
                    'viewParams' => ['menu' => $menu],
                    'showOnEmpty' => '-',
                    'itemOptions' => [
                        'tag' => 'div'
                    ],
                    'pager' => [
                        'prevPageLabel' => '&nbsp;',
                        'nextPageLabel' => '&nbsp;'
                    ]
                ])
                ?>
            </div>

            <h2>Задать вопрос</h2>
            <?php
            $form = \yii\widgets\ActiveForm::begin([
                'options' => [
                    'class' => 'faq-form'
                ]
            ]);
            ?>
            <?php
            if (Yii::$app->session->hasFlash('faq_thanks_for_question') &&
                Yii::$app->session->getFlash('faq_thanks_for_question') == true
            ) {
                Yii::$app->view->registerJs("
                    $('.faq-form .success').slideDown( 400 ).delay( 2600 ).slideUp( 400 );
                    $('.faq-form')[0].reset();
                ", \yii\web\View::POS_END);
                ?>
                <p class="success">Спасибо за Ваш вопрос. В ближайшее время мы Вам ответим.</p>
            <?php
            }
            ?>
            <div class="row">
                <?=
                $form->field($faqForm, 'username', [
                    'template' => '
                    <div class="input col-lg-6">
                    {input}
                    <div class="frame-blue"></div>
                    {error}
                    </div>


                '
                ])->textInput(['maxlength' => 256, 'placeholder' => 'Имя']) ?>
                <?=
                $form->field($faqForm, 'email', [
                    'template' => '
                    <div class="input col-lg-6 " style="margin-left: 10px;">
                    {input}
                    <div class="frame-red"></div>
                    {error}
                    </div>

                '
                ])->textInput(['maxlength' => 256, 'placeholder' => 'EMail']) ?>
                <div class="col-lg-6" style="margin-left: 10px;">
                    <div class="row captcha">
                    <?=
                    $form->field($faqForm, 'verifyCode')->widget(Captcha::className(), [
                        'options' => [
//                            'placeholder' => 'Код',
                            'maxlength' => 8
                        ],
                        'captchaAction' => '/faq/captcha',
                        'template' => '
                                    <div class="col-lg-11 captcha-img">{image}</div>
                                    <div class="col-lg-11 captcha-input">{input}</div>
                                ',
                    ])->label("") ?>
                    </div>
                </div>

                <?=
                $form->field($faqForm, 'question', [
                    'template' => '
                    <div class="input col-lg-24">
                    <div class="textarea">{input}</div> <div class="button">'.\yii\helpers\Html::submitButton('Задать вопрос', ['class' => 'submit']).'</div>
                    <div class="frame-orange"></div>
                    <div class="frame-grey"></div>
                    <div class="clearfix"></div>
                    {error}
                    </div>

                '
                ])->textarea(['maxlength' => 2048, 'placeholder' => 'Вопрос', 'class' => 'text']) ?>


<!--                <div class="col-lg-24">-->
<!--                    --><?//=  ?>
<!--                </div>-->
            </div>
            <?php \yii\widgets\ActiveForm::end(); ?>
        </div>
        <div class="col-lg-6 col-lg-offset-1">
            <?=
            \frontend\modules\faq\widget\CategoryWidget::widget([
                'model' => new \common\modules\faq\models\FaqCategory(),
                'module_name' => $menu->url,
                'selected' => $category->id,
                'title' => '<span style="font-size: 16px;">Категории вопросов</span>'
            ]) ?>
        </div>
    </div>
</div>