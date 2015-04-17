<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<?php if(@$reg_data['accountID']['language'] == 3):?>
    <p>Уважаемый Трейдер,</p>
    <p>Вы успешно завершили процесс регистрации и теперь можете приступить к торговле, воспользовавшись следующей информацией:</p>
    <p>
        Логин: <?=@$reg_data['login'];?><br/>
        Пароль: <?=@$reg_data['password'];?>
    </p>
    <p>Спасибо, что выбрали OptoSpot. Помните, что по любым обратиться в нашу службу поддержки.</p>
    <br>
    <br>
    <p>С уважением,<br>Команда Optospot</p>
    <br>
    <p><a href="mailto:support@optospot.net">support@optospot.net</a><br>http://optospot.net/</p>
<?php else:?>
    <p>Dear Trader,</p>
    <p>Welcome to the world of OptoSpot binary options trading. We hope that you will enjoy the experience and our collaboration will last for many years to come.</p>
    <p>You have successfully information below:</p>
    <p>
        Login: <?=@$reg_data['login'];?><br/>
        Password: <?=@$reg_data['password'];?>
    </p>
    <p>You are just one step away from the new phase in your life. It’s the phase of decent earnings, based only on your market analysis and trading strategy. Join one of our bonus promotions to multiply your benefits and build your successful future with us.</p>
    <p>Thank you for joining OptoSpot. Do not hesitate to contact our support team on any matter.</p>
    <br>
    <br>
    <p>Best Regards,<br>Optospot Team</p>
    <p><a href="mailto:support@optospot.net">support@optospot.net</a><br>http://optospot.net/en/</p>
<?php endif; ?>
</body>
</html>