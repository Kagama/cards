<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 07.08.14
 * Time: 17:01
 */
?>

<h1>Отыет на вопрос от <?= $form->username ?> <?= date('d.m.Y', $form->date) ?></h1>
<p style="font-size: 14px;">
    <h2>Вопрос</h2>
    <?= strip_tags($form->question); ?>
    <hr/>
    <h2>Ответ от <?= date('d.m.Y', $form->answer_date) ?></h2>
    <?=$form->answer?>
</p>
