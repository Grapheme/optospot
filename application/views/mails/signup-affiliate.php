<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<?php if(@$reg_data['accountID']['language'] == 3):?>
    <p>Уважаемый Трейдер,</p>
    <p>Вы завершили процесс регистрации счета аффилианта:</p>
    <p>
        Логин: <?=@$reg_data['login'];?><br/>
        Пароль: <?=@$reg_data['password'];?>
    </p>
    <br>
    <p>С уважением,<br>Команда Optospot</p>
    <br>
    <p><a href="mailto:support@optospot.net">support@optospot.net</a><br>http://optospot.net/</p>
<?php else:?>
    <p>Dear Trader,</p>
    <p>You have successfully information below:</p>
    <p>
        Login: <?=@$reg_data['login'];?><br/>
        Password: <?=@$reg_data['password'];?>
    </p>
    <br>
    <p>Best Regards,<br>Optospot Team</p>
    <p><a href="mailto:support@optospot.net">support@optospot.net</a><br>http://optospot.net/en/</p>
<?php endif; ?>
</body>
</html>