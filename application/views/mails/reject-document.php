<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<?php if(@$lang == 3):?>
    <p>Уважаемый трейдер,</p>
    <p>Документ, загруженный Вами для подтверждения Вашей личности, был отклонён со следующим комментарием:</p>
    <p><?=@$content;?></p>
    <p>Пожалуйста, добавьте новый документ в вашем кабинете с учётом этих требований.</p>
    <p>Если возникнут дополнительные вопросы - обращайтесь в нашу службу поддержки.</p>
        <br>
        <br>
    <p>С уважением,</p>
    <p>Алексей Глушаков</p>
    <p>Оператор по работе с клиентами</p>
    <br>
    <p>Служба поддержки<br>
    support@optospot.net</p>
<?php else:?>
    <p>Dear Trader,</p>
    <p>Documents that you uploaded for the cabinet verification were rejected, with the following commentary:</p>
    <p><?=@$content;?></p>
    <p>Please upload a new document in your cabinet, taking these requirements into consideration.</p>
        <br>
        <br>
    <p>Truly yours,</p>
    <p>James Harding,</p>
    <p>Customer support representative</p>
    <br>
    <p>Optospot customer service<br>
    support@optospot.net</p>
<?php endif; ?>
</body>
</html>