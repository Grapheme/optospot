<?php
$this->config->load('withdraw');
$clients_paysystems = $this->config->item('withdraw_clients');
$selected_paysystem = isset($clients_paysystems[$post['payment']]) ? $clients_paysystems[$post['payment']] : FALSE;
$redirectLink = site_url('admin-panel/withdraw');
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
    <h2>Withdrawal request!</h2>
    ID account: <?=$post['account_id']?><br/>
    Trade login: <?=$post['trade_login']?><br/>
    Account Email: <?=$post['email']?><br/>
<?php if($selected_paysystem): ?>
    Payment system: <?=$selected_paysystem['title'];?>
    <?php $redirectLink .= '?paysystem='.urlencode($post['payment']);?>
    <?php foreach($selected_paysystem['inputs'] as $input_title => $input):?>
        <br><?=$input['placeholder']?>: <?=isset($post[$input_title]) ? $post[$input_title] : 'ERROR'; ?>
        <?php
        if($input_title == $selected_paysystem['account']):
            $redirectLink .= '&account='.urlencode($post[$selected_paysystem['account']]);
        else:
            $redirectLink .= '&'.$input_title.'='.urlencode($post[$input_title]);
        endif;
        ?>
    <?php endforeach;?>
<?php endif; ?>
    <br>Specify the amount of money, USD: = <?=$post['amount']?>
    <?php $redirectLink .= '&amount='.urlencode($post['amount']);?>
    <br><br>Login under the administrator's <a href="<?=$redirectLink?>">link</a> to withdrawal.
</body>
</html>