<form action="<?=site_url('cabinet/withdraw/request');?>" class="signup-form form-signup" method="post" target="signup_iframe">
	<input type="hidden" name="account" value="<?=$this->account['id'];?>" />
	<input type="hidden" name="email" value="<?=$this->profile['email'];?>" />
	<select name="payment" class="valid-required tooltip-place" data-tooltip-place="right">
		<option value=""><?=$this->localization->getLocalButton('withdraw','payment')?></option>
		<option value="9">MasterCard</option>
		<option value="19">WebMoney WMR</option>
		<option value="22">WebMoney WME</option>
		<option value="23">WebMoney WMZ</option>
		<option value="28">QIWI-кошелек</option>
		<option value="1011350">Visa</option>
		<option value="1013538">Яндекс.Деньги</option>
	</select>
	<input type="text" class="valid-required valid-numeric tooltip-place" data-tooltip-place="right" name="summa" value="" placeholder="<?=$this->localization->getLocalPlaceholder('withdraw','summa')?>" />
	<textarea name="details" rows="6" class="span10 valid-required tooltip-place" data-tooltip-place="right" placeholder="<?=$this->localization->getLocalPlaceholder('withdraw','details')?>"></textarea>
	<button type="submit" class="btn btn-action btn-withdrawal" name="Submit"><?=$this->localization->getLocalButton('withdraw','submit_withdraw')?></button>
</form>