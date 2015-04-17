<form action="<?=site_url('signup-demo-account');?>" class="signup-form form-signup" method="post" target="signup_iframe">
	<input type="hidden" name="answerType" value="xml" />
	<input type="hidden" name="act" value="send" />
	<input type="hidden" name="office" value="main" />
	<input type="hidden" class="FieldSend" name="account_type" value="1" />
	<input type="text" class="valid-required" name="fname" value="<?=$this->profile['first_name'];?>" placeholder="<?=$this->localization->getLocalPlaceholder('signup','fname')?>" />
	<input type="text" class="valid-required" name="lname" value="<?=$this->profile['last_name'];?>" placeholder="<?=$this->localization->getLocalPlaceholder('signup','lname')?>" />
	<input type="text" class="valid-required valid-email" value="<?=$this->profile['email'];?>" name="email" placeholder="<?=$this->localization->getLocalPlaceholder('signup','email')?>" />
	<?php $this->load->view('html/select-countries');?>
	<input type="text" class="valid-required valid-phone-number" value="<?=$this->profile['day_phone'];?>" name="phone" placeholder="<?=$this->localization->getLocalPlaceholder('signup','phone')?>" />
	<button type="submit" class="btn btn-action btn-account-create" name="Submit"><?=$this->localization->getLocalButton('signup','active_submit_demo')?></button>
</form>