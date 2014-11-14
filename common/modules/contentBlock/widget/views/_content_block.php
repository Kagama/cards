<?php
/**
 * Created by PhpStorm.
 * User: pashaevs
 * Date: 28.10.14
 * Time: 19:33
 */
?>
<?php
\common\widget\html\ActiveEdit::begin(['model' => $model, 'url' => "/contentBlock/simple-edit/edit"]);
?>
<div>
    <?= $model->content; ?>
</div>
<?php
\common\widget\html\ActiveEdit::end();
?>
