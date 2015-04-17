<form action="<?=site_url('signup-real-account');?>" class="signup-form form-signup" method="post" target="signup_iframe">
	<div class="form-container">
		<input type="hidden" name="answerType" value="xml" />
		<input type="hidden" name="act" value="send" />
		<input type="hidden" name="office" value="main" />
		<input type="hidden" class="FieldSend" name="account_type" value="2" />
		<input class="opt-input opt-reg valid-required" type="text" name="fname" value="<?=$this->profile['first_name'];?>" placeholder="<?=$this->localization->getLocalPlaceholder('signup','fname')?>" />
		<input class="opt-input opt-reg valid-required" type="text" name="lname" value="<?=$this->profile['last_name'];?>" placeholder="<?=$this->localization->getLocalPlaceholder('signup','lname')?>" />
		<input class="opt-input opt-reg valid-required valid-email" type="text" value="<?=$this->profile['email'];?>" name="email" placeholder="<?=$this->localization->getLocalPlaceholder('signup','email')?>" />
		<?php $this->load->view('html/select-countries');?>
		<input class="opt-input opt-reg valid-required valid-phone-number" type="text" value="<?=$this->profile['day_phone'];?>" name="phone" placeholder="<?=$this->localization->getLocalPlaceholder('signup','phone')?>" />
	</div>	
	<button type="submit" class="opt-btn btn-account-create" name="Submit"><?=$this->localization->getLocalButton('signup','active_submit_real')?></button>
</form>