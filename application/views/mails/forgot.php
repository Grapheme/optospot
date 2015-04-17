<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<?php if(@$reg_data['accountID']['language'] == 3):?>
    <p>Уважаемый <em><?=@$first_name.' '.@$last_name;?></em>,</p>
    <p>К нам поступил запрос на смену вашего пароля для доступа к своему личному кабинету на сайте <?=anchor('','Optospot.net');?></p>
    <p>Логин: <?=@$trade_login;?><br/>Пароль: <?=$this->encrypt->decode(@$trade_password);?></p>
    <br>
    <br>
    <p>С уважением,<br>Команда Optospot</p>
    <br>
    <p><a href="mailto:support@optospot.net">support@optospot.net</a><br>http://optospot.net/</p>
<?php else:?>
    <p>Dear <em><?=@$first_name.' '.@$last_name;?></em>,</p>
    <p>You have requested a new password to access the site <?=anchor('','Optospot trading platform');?></p>
    <p>Login: <?=@$trade_login;?><br/>Password: <?=$this->encrypt->decode(@$trade_password);?></p>
    <br>
    <br>
    <p>Best Regards,<br>Optospot Team</p>
    <p><a href="mailto:support@optospot.net">support@optospot.net</a><br>http://optospot.net/</p>
<?php endif; ?>
</body>
</html>