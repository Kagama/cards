<h1>Новое сообщение от <?=$contactForm->flp?> от <?=date('d/m/Y')?></h1>
<br />
<p><strong>ФИО:</strong> <?=$contactForm->flp?></p>
<p><strong>Email:</strong> <?=$contactForm->email?></p>
<p><strong>Номер тел.:</strong> <?=$contactForm->phone?></p>
<br />
<fieldset>
    <legend><strong>Описание проблемы</strong></legend>
    <p><?=$contactForm->text?></p>
</fieldset>
