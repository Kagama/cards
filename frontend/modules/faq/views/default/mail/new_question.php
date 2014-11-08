<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 07.08.14
 * Time: 17:01
 */
?>

<h1>Новый вопрос от <?= $form->username ?> <?= date('d.m.Y', $form->date) ?></h1>
<p style="font-size: 14px;">
    <?= strip_tags($form->question); ?>
</p>
