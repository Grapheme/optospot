<?php
$unid = uniqid('opt_');
$timestamp = date("YmdHis");
$response = '';

$project = $this->config->item('withdraw_project');
$secret = $this->config->item('withdraw_secret');
$url = $this->config->item('withdraw_url');
$page = $this->config->item('withdraw_page');
$errors = $this->config->item('withdraw_errors');
$pay_systems_ids = $this->config->item('withdraw_paysystems');
$currencies = $this->config->item('withdraw_currencies');

$action = 'paysystems';
$signString = sha1('secret='.$secret.'&action='.$action.'&project='.$project.'&timestamp='.$timestamp);
$whatsystem_xml = '<?xml version="1.0" encoding="UTF-8"?>'.
"<request>
    <action>$action</action>
    <project>$project</project>
    <timestamp>$timestamp</timestamp>
    <sign>$signString</sign>
</request>";
$headers = array("POST ".$page." HTTP/1.0","Content-type: text/xml;charset=\"utf-8\"","Accept: text/xml","Content-length: ".strlen($whatsystem_xml));

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_TIMEOUT, 60);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $whatsystem_xml);
$result = curl_exec($ch);
curl_close($ch);

$PaySystems = array();
$PaySystemsResult = json_decode(json_encode((array)simplexml_load_string($result)), 1);
if($PaySystemsResult['status'] == 1 && isset($PaySystemsResult['paysystems']['paysystem'])):
    foreach($PaySystemsResult['paysystems']['paysystem'] as $paysystem):
        if (in_array($paysystem['id'],$pay_systems_ids)):
            $PaySystems[$paysystem['id']] = array('title'=>$paysystem['title'],'currency_id'=>840);
            #$PaySystems[$paysystem['id']] = array('title'=>$paysystem['title'],'currency_id'=>$paysystem['currency_id']);
        endif;
    endforeach;
endif;
if ($this->input->get('action') === FALSE):

    $action = 'balance';
    $signString = sha1('secret='.$secret.'&action='.$action.'&project='.$project.'&timestamp='.$timestamp);
    $xml = '<?xml version="1.0" encoding="UTF-8"?>'.
    "<request>
        <project>$project</project>
        <action>$action</action>
        <timestamp>$timestamp</timestamp>
        <sign>$signString</sign>
    </request>";

    $headers = array("POST ".$page." HTTP/1.0","Content-type: text/xml;charset=\"utf-8\"","Accept: text/xml","Content-length: ".strlen($xml));

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
    $result = curl_exec($ch);
    $final = simplexml_load_string($result);
    curl_close($ch);

    if($final->status == 1):
        $response = "Balance: " . $final->balance." RUB";
    else:
        $response = "Error: ".@$errors[(int)$final->status];
    endif;

elseif ($this->input->get('action') == 'pay'):

    $this->form_validation->set_rules('payment', 'Payment', 'required');
    $this->form_validation->set_rules('account', 'Account', 'required');
    $this->form_validation->set_rules('amount', 'Amount', 'required');

    if ($this->form_validation->run() === FALSE):
        $response = "Not all parameters are sent!";
    else:
        try {
            $payment = $this->input->post('payment');
            $account = $this->input->post('account');
            $name = $this->input->post('name');
            $expiry = $this->input->post('expiry');
            $amount = $this->input->post('amount');
            $phone = $this->config->item('withdraw_phone');
            $currency = $this->input->post('currency');
            $action = 'check';

            //////////////
            $string = "secret=$secret&account=$account&action=$action&amount=$amount&currency=$currency";
            $expiry_str = $name_str = '';
            if ($payment == '9'):
                $string .= "&expiry=$expiry&name=$name";
                $expiry_str = "<expiry>$expiry</expiry>";
                $name_str = "<name>$name</name>";
            endif;
            $string .= "&paysystem=$payment&phone=$phone&project=$project&timestamp=$timestamp&txn_id=$unid";
            //////////////
            $signString = sha1($string);
            $xml = '<?xml version="1.0" encoding="UTF-8"?>'.
            "<request>
                <project>$project</project>
                <action>$action</action>
                <timestamp>$timestamp</timestamp>
                <sign>$signString</sign>
                <params>
                    <account>$account</account>
                    <amount>$amount</amount>
                    <currency>$currency</currency>
                    ".$expiry_str.$name_str."
                    <paysystem>$payment</paysystem>
                    <phone>$phone</phone>
                    <txn_id>$unid</txn_id>
                </params>
            </request>";

            $headers = array("POST ".$page." HTTP/1.0","Content-type: text/xml;charset=\"utf-8\"","Accept: text/xml","Content-length: ".strlen($xml));

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_TIMEOUT, 60);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
            $result = curl_exec($ch);
            $final = simplexml_load_string($result);
            curl_close($ch);

            if ($final->status == 1):
                $action = 'pay';
                $invoice = $final->invoice;
                $signString = sha1("secret=$secret&action=$action&invoice=$invoice&project=$project&timestamp=$timestamp");
                $xml = '<?xml version="1.0" encoding="UTF-8"?>' .
                    "<request>
                    <action>$action</action>
                    <project>$project</project>
                    <timestamp>$timestamp</timestamp>
                    <params>
                        <invoice>$invoice</invoice>
                    </params>
                    <sign>$signString</sign>
                </request>";

                $headers = array("POST ".$page." HTTP/1.0", "Content-type: text/xml;charset=\"utf-8\"", "Accept: text/xml", "Content-length: " . strlen($xml));
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_TIMEOUT, 60);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
                $result = curl_exec($ch);
                $payfinal = simplexml_load_string($result);
                curl_close($ch);
                if ($payfinal->status == 1 || $payfinal->status == 2):
                    $response = "Your ".$amount." USD are sending!";
                else:
                    $error_index = (int)$payfinal->status;
                    if (isset($errors[$error_index])):
                        $response = "Error pay: ".@$errors[$error_index];
                    else:
                        $response = "Error pay: ".@$payfinal->status;
                    endif;
                endif;
            else:
                $response = "Error check: ".@$errors[(int)$final->status];
            endif;
        }catch (Exception $e){
            $response = "Exception Errors";
        }
    endif;
endif;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view("admin_interface/includes/head"); ?>
</head>
<body>
<?php $this->load->view("admin_interface/includes/header"); ?>
<div class="container">
    <div class="row">
        <div class="span19">
            <div class="navbar">
                <div class="navbar-inner">
                    <a class="brand none" href="">Withdraw</a>
                    <?php if ($this->input->get('action') === FALSE): ?>
                    <a href="javascript:void(0)" class="pull-right" id="show-astropay-form">Withdrawal through Astropay</a>
                    <a href="javascript:void(0)" class="pull-right hidden" id="show-dengionline-form">Withdrawal through Dengionline</a>
                    <?php endif;?>
                </div>
            </div>
            <p class="form-withdraw-dengionline"><?= $response."<br><br>";?></p>
            <?php if ($this->input->get('action') === FALSE): ?>
            <form action="?action=pay" method="POST" class="form-horizontal form-edit-settings form-withdraw form-withdraw-dengionline">
                <input type="hidden" name="currency" id="payment-currency" value="<?=$this->config->item('withdraw_currency')?>">
                <fieldset>
                    <label>Choose payment:</label>
                <?php if(count($PaySystems)):?>
                    <select id="select-paysystems" name="payment" autocomplete="off" class="span7">
                    <?php foreach($PaySystems as $payment_system_id => $payment_system):?>
                        <option data-currency-id="<?=$payment_system['currency_id'];?>" data-currency-title="<?=@$currencies[$payment_system['currency_id']];?>" value="<?=$payment_system_id;?>"><?=$payment_system['title'];?></option>
                    <?php endforeach;?>
                    </select>
                <?php endif;?>
                    <div class="withdraw-div">
                        <label>Specify the account number to withdraw money:</label>
                        <input type="text" class="valid-required" name="account" placeholder="1234123412341234" autocomplete="off">
                    </div>
                    <div class="name-div withdraw-div" style="display: none;">
                        <label>Name:</label>
                        <input type="text" name="name" placeholder="Ivan Ivanov" autocomplete="off">
                    </div>
                    <div class="expiry-div withdraw-div" style="display: none;">
                        <label>Expiry date:</label>
                        <input type="text" name="expiry" placeholder="0617" autocomplete="off">
                    </div>
                    <div class="withdraw-div">
                        <label>Amount for withdrawal (<u id="payment-currency-title"><?=$this->config->item('withdraw_currency_title');?></u>):</label>
                        <input type="text" class="valid-required" name="amount" placeholder="00.00" autocomplete="off"><br>
                    </div>
                </fieldset>
                <div class="form-actions">
                    <button class="btn btn-success btn-withdrawal" type="submit" value="Send money"><?= $this->localization->getLocalButton('withdraw', 'submit_withdraw') ?></button>
                </div>
            </form>
            <?php else:
                echo "<br><a href='" . site_url('admin-panel/withdraw') . "'>Get back</a>";
            endif; ?>
            <?php if ($this->input->get('action') === FALSE): ?>
                <?php $autocomplete = 'on';?>
                <form action="<?=site_url('admin-panel/withdraw-astropay-request');?>" method="POST" class="hidden form-horizontal form-edit-settings form-withdraw-astropay">
                    <input type="hidden" name="login" value="<?=$this->config->item('astropay_x_login');?>">
                    <input type="hidden" name="pass" value="<?=$this->config->item('astropay_x_trans_key');?>">
                    <input type="hidden" name="control" value="">
                    <input type="hidden" name="iban" value="">
                    <input type="hidden" name="currency" value="USD">
                    <input type="hidden" name="notification_url" value="<?=current_url().'?astropay=result';?>">
                    <input type="hidden" name="type" value="json">
                    <input type="hidden" name="external_id" value="<?=uniqid('atr_');?>">
                    <div class="span8">
                        <div class="withdraw-div">
                            <label>User’s full name:</label>
                            <input type="text" name="beneficiary" placeholder="Name Surname" autocomplete="<?=$autocomplete;?>">
                            <input type="hidden" name="beneficiary_id" value="">
                        </div>
                        <div class="withdraw-div">
                            <label>User’s personal identification number<br>(CPF-Brazil,DNI-Argentina,ID-other):</label>
                            <input type="text" required class="valid-required" name="cpf" placeholder="12345678" autocomplete="<?=$autocomplete;?>">
                        </div>
                        <div class="withdraw-div">
                            <label>The user’s country:</label>
                            <input type="text" required class="valid-required" name="country" placeholder="BR" autocomplete="<?=$autocomplete;?>">
                        </div>
                        <div class="withdraw-div">
                            <label>Bank Name of the user:</label>
                            <input type="text" required class="valid-required" name="bank" placeholder="Bank" autocomplete="<?=$autocomplete;?>">
                        </div>
                        <div class="withdraw-div">
                            <label>The branch of the bank:</label>
                            <input type="text" required class="valid-required" name="bank_branch" placeholder="User123" autocomplete="<?=$autocomplete;?>">
                        </div>
                    </div>
                    <div class="span9">
                        <div class="withdraw-div">
                            <label>The user bank account:</label>
                            <input type="text" v class="valid-required" name="bank_account" placeholder="1988520" autocomplete="<?=$autocomplete;?>">
                        </div>
                        <div class="withdraw-div">
                            <label>The type of account<br>(C:current/S:saving):</label>
                            <input type="text" required class="valid-required" value="C" name="account_type" placeholder="C" autocomplete="<?=$autocomplete;?>">
                        </div>
                        <div class="withdraw-div">
                            <label>Amount for withdrawal (<u>US Dollar</u>):</label>
                            <input type="text" required class="valid-required" name="amount" placeholder="199.95" autocomplete="<?=$autocomplete;?>">
                        </div>
                        <div class="withdraw-div">
                        <label>Comments:</label>
                        <textarea name="comments" style="height: 120px;" placeholder="This is a comment" autocomplete="<?=$autocomplete;?>"></textarea>
                    </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-actions">
                        <button class="btn btn-success btn-withdrawal" type="submit" value="Send money"><?= $this->localization->getLocalButton('withdraw', 'submit_withdraw'); ?></button>
                    </div>
                </form>
            <?php endif; ?>
        </div>
        <?php $this->load->view("admin_interface/includes/rightbar"); ?>
    </div>
</div>
<?php $this->load->view("admin_interface/includes/scripts"); ?>
<?php if($this->input->get('paysystem') && $this->input->get('paysystem') != 110):?>
<script type="text/javascript">
   $(function(){
       $("#select-paysystems").val(<?=$this->input->get('paysystem');?>).change();
<?php foreach($this->input->get() as $item => $value):?>
   <?php if($item != 'paysystem'):?>
       $(".form-withdraw input[name='<?=$item?>']").val("<?=$value?>");
   <?php endif;?>
<?php endforeach; ?>
   });
</script>
<?php elseif($this->input->get('paysystem') && $this->input->get('paysystem') == 110):?>
<script type="text/javascript">
    $("#show-dengionline-form").removeClass('hidden');
    $("#show-astropay-form").addClass('hidden');

    $(".form-withdraw-dengionline").addClass('hidden');
    $(".form-withdraw-astropay").removeClass('hidden');
</script>
<?php endif;?>
</body>
</html>