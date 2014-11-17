
<!-- Slider -->

<section class="slider">



    <div class="slideinfo">
        <div id="s-l" class="slide-arrow left"></div>
        <div id="s-r" class="slide-arrow right"></div>

        <span class="big">Скидочная карта ждет вас</span>

        <div class="cards">
            <img src="/img/main_card_wash.png" alt="">
            <img src="/img/main_card_tire.png" alt="">
            <img src="/img/main_card_rus.png" alt="">
            <img src="/img/main_card_repair.png" alt="">
            <img src="/img/main_card_unknown.png" alt="">
        </div>
    </div>

    <div class="slideshow">
        <div class="slide first"></div>
        <div class="slide second"></div>
        <div class="slide third"></div>
    </div>
</section>

<!-- ПОЧЕМУ МЫ ЛУЧШИЕ -->

<section class="why-we">
    <div class="container">
        <div class="sixteen collumns">
            <?=\common\modules\contentBlock\widget\ContentBlockWidget::widget([
                'id' => 1
            ]);?>
        </div>
    </div>
</section>

<!-- Types -->

<section class="type">
    <div class="container">
        <?php
        $menuOrg = \common\modules\menu\models\Menu::find()->where(['module_id' => 7])->one();
        $categories = \common\modules\organization\models\Category::find()->all();
        foreach ($categories as $_cat) {
        ?>
            <div class="item four columns">
                <h2><?=$_cat->name?></h2>
                <img src="<?="/".$_cat->img?>" alt="<?=$_cat->name?>">
                <p>
                    <?=$_cat->text_before?>
                </p>
                <?=\yii\helpers\Html::a("Посмотреть организации", ['/'.$menuOrg->url.'/'.$_cat->alt_name], ['class' => 'button']) ?>
            </div>
        <?php
        }
        ?>
    </div>
</section>



<!-- Последние зарегистрированные организации -->

<section class="last-reg">
    <div class="container">
        <div class="title"><h1>Последние зарегистрированные организации</h1></div>
        <?php

        $organizations = \common\modules\organization\models\Organization::find()->orderBy(' created_at DESC ')->limit(3)->all();
        foreach ($organizations as $org) {
            ?>
            <div class="item one-third column">
                <div class="image">
                    <a href="<?=\yii\helpers\Url::to(['/'.$menuOrg->url."/".$org->id."/".\common\helpers\CString::translitTo($org->name)])?>">
                        <img src="img/main-reg-marussia.png" alt="">
                        <span>Подробнее</span>
                    </a>
                </div>
                <h2><?=$org->name?></h2>
                <a href="<?=\yii\helpers\Url::to(['/'.$menuOrg->url.'/'.$org->cat->alt_name]);?>"><?=$org->cat->name;?></a>
                <p>
                    <?=\common\helpers\CString::subStr($org->description, 0, 300);?>
                </p>
            </div>
        <?php
        }
        ?>

        <a href="<?=\yii\helpers\Url::to(['/'.$menuOrg->url])?>" class="button">Все организации</a>
    </div>
</section>

<!-- Register -->

<section class="register">


    <div class="container">
        <h1>Регистрация</h1>

        <form action="">
            <div class="item one-third column">
                <label for="">Название</label>
                <input type="text" val="">
            </div>

            <div class="item one-third column">
                <label for="">E-Mail</label>
                <input type="text" val="">
            </div>

            <div class="item one-third column">
                <label for="">Адрес сайта</label>
                <input type="text" val="">
            </div>

            <div class="item one-third column">
                <label for="">Телефоны</label>
                <input type="text" val="">
            </div>

            <div class="item one-third column">
                <label for="">Город</label>
                <input type="text" val="">
            </div>

            <div class="item one-third column">
                <label for="">Улица, дом, офис</label>
                <input type="text" val="">
            </div>

            <div class="item one-third column">
                <label for="">Город</label>
                <input type="text">
            </div>

            <div class="item two-thirds column">
                <label for="">Сфера деятельности</label>
                <input type="text">
            </div>

            <div class="item offset-by-two twelve columns">
                <label for="">О фирме кратко</label>
                <textarea name="" id="" cols="30" rows="8"></textarea>
            </div>
        </form>
    </div>
</section>

<!-- Card Check -->

<section class="card-check">
    <div class="container">


        <div class="title sixteen columns">
            <span>Проверить карту</span></div>
        <div class="eight columns">
            <input type="text" placeholder="номер карты" id="card_check">
        </div>

        <div class="status eight columns">
            <span>Ваша карта</span>
            <span class="card-status" id="card_status"></span>
        </div>

        <!-- 		<div class="images">
                    <img src="img/card-check-1.png" alt="">
                    <img src="img/card-check-2.png" alt="">
                </div> -->
    </div>
</section>