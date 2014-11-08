<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 22.07.14
 * Time: 23:09
 */
$frame_bg = ['green', 'blue', 'red'];
?>

    <div class="faq-block">
        <div class="row">
            <div class="col-lg-2 text-center avatar">
                <img src="/img/commint-default-icon.png" alt="Avatar"/>
                <div class="frame frame-<?= $frame_bg[floor($index % 3)] ?>">&nbsp;</div>
            </div>
            <div class="col-lg-22">
                <div class="comment-text">
                    <div class="arrow">&nbsp;</div>
                    <div class="username-date">
                        <span class="date"><?= $model->date; ?> | </span>
                        <span class="username"><?= $model->username; ?></span>

                    </div>
                    <p class="text"><?= $model->question; ?></p>
                    <div class="answer">
                        <p class="title"><span class="date"><?= $model->answer_date;?>  | </span> Ответ</p>
                        <p class="text"><?=$model->answer?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
