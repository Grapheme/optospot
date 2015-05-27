<?php
$this->config->load('withdraw');
$clients_paysystems = $this->config->item('withdraw_clients');

reset($clients_paysystems);
$selectedPaySystem = key($clients_paysystems);
?>
<form action="<?=$action;?>" method="POST" class="form-horizontal form-edit-settings form-withdraw">
    <input type="hidden" name="account_id" value="<?=$this->account['id'];?>" />
    <input type="hidden" name="trade_login" value="<?=$this->profile['trade_login'];?>" />
    <input type="hidden" name="email" value="<?=$this->profile['email'];?>" />
    <div class="form-container">
        <fieldset>
            <label><?=$this->localization->getLocalButton('withdraw','payment')?>:</label>
            <select id="select-pay-system" autocomplete="off" name="payment" class="withdraw-div span7">
            <?php foreach($clients_paysystems as $paysystem_id => $paysystems):?>
                <?php if($paysystems['visible']):?>
                <option value="<?=$paysystem_id;?>"><?=$paysystems['title'];?></option>
                <?php endif;?>
            <?php endforeach;?>
            </select>
            <div class="withdraw-div withdraw-input<?= ($selectedPaySystem == 110)? '' : ' hidden'; ?>" data-paysystem-id="110">
                <label><?=$this->localization->getLocalButton('withdraw','country')?>:</label>
                <select autocomplete="off" name="country" class="withdraw-div span7">
                    <option value="UK">United Kingdom</option>
                </select>
            </div>
        <?php foreach($clients_paysystems as $paysystem_id => $paysystems):?>
            <?php if($paysystems['visible']):?>
                <?php foreach($paysystems['inputs'] as $input_name => $input):?>
            <div class="withdraw-div withdraw-input<?= ($selectedPaySystem == $paysystem_id)? '' : ' hidden'; ?>" data-paysystem-id="<?=$paysystem_id;?>">
                <input placeholder="<?=$input['placeholder'];?>" class="<?=$input['class'];?>" type="text" name="<?=$input_name;?>">
            </div>
                <?php endforeach;?>
            <?php endif;?>
        <?php endforeach;?>
            <div class="withdraw-div">
                <input placeholder="<?=$this->localization->getLocalPlaceholder('withdraw','summa')?>" type="text" class="valid-required account-amount" name="amount"><br>
            </div>
        </fieldset>
        <fieldset>
            <div class="withdraw-div">
                <button class="opt-btn btn-withdrawal" type="submit" autocomplete="off" value="Send money"><?=$this->localization->getLocalButton('withdraw','submit_withdraw')?></button>
            </div>
        </fieldset>
    </div>
</form>