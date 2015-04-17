<form action="<?=site_url('signup-affiliate-account');?>" class="signup-form form-signup" method="post" target="signup_iframe">
	<div class="form-container">
        <input type="hidden" name="user_id" value="<?=$this->profile['id']?>" />
		<input type="hidden" name="answerType" value="xml" />
		<input type="hidden" name="act" value="send" />
		<input type="hidden" name="office" value="<?=$this->profile['remote_id']?>" />
		<input type="hidden" name="departmental" value="Y" />
		<input class="opt-input opt-reg valid-required" type="text" name="first_name" value="<?=$this->profile['first_name'];?>" placeholder="<?=$this->localization->getLocalPlaceholder('signup','fname')?>" />
		<input class="opt-input opt-reg valid-required" type="text" name="last_name" value="<?=$this->profile['last_name'];?>" placeholder="<?=$this->localization->getLocalPlaceholder('signup','lname')?>" />
		<input class="opt-input opt-reg valid-required valid-email" type="text" value="<?=$this->profile['email'];?>" name="email" placeholder="<?=$this->localization->getLocalPlaceholder('signup','email')?>" />

        <input class="opt-input opt-reg valid-required" type="text" value="<?=$this->profile['address1'];?>" name="address1" placeholder="<?=$this->localization->getLocalPlaceholder('signup','address1')?>" />
        <input class="opt-input opt-reg valid-required" type="text" value="<?=$this->profile['city'];?>" name="city" placeholder="<?=$this->localization->getLocalPlaceholder('signup','city')?>" />
        <input class="opt-input opt-reg valid-required" type="text" value="<?=$this->profile['state'];?>" name="state" placeholder="<?=$this->localization->getLocalPlaceholder('signup','state')?>" />
        <input class="opt-input opt-reg valid-required" type="text" value="" name="passport_id" placeholder="<?=$this->localization->getLocalPlaceholder('signup','passport')?>" />
        <?php $this->load->view('html/select-countries');?>
		<input class="opt-input opt-reg valid-required valid-phone-number" type="text" value="<?=$this->profile['day_phone'];?>" name="phone" placeholder="<?=$this->localization->getLocalPlaceholder('signup','phone')?>" />
	</div>
	<button type="submit" class="opt-btn btn-account-create" autocomplete="off" name="Submit"><?=$this->localization->getLocalButton('signup','active_submit_affiliate')?></button>
</form>