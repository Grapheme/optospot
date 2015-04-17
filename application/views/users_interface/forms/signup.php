<form action="<?=site_url('signup-account');?>" method="POST" id="<?=$idForm;?>">
	<input type="hidden" value="xml" name="answerType">
	<input type="hidden" value="send" name="act">
	<input type="hidden" value="main" name="office">
	<div class="reg-normal">
		<div class="input-container">
			<input class="begin-input input-fname" type="text" name="fname" value="" placeholder="<?=$this->localization->getLocalPlaceholder('signup','fname')?>">
		</div>
		<div class="input-container">
			<input class="begin-input input-lname" type="text" name="lname" value="" placeholder="<?=$this->localization->getLocalPlaceholder('signup','lname')?>">
		</div>
		<div class="input-container">
			<input class="begin-input input-email" type="text" name="email" value="" placeholder="<?=$this->localization->getLocalPlaceholder('signup','email')?>">
		</div>
		<div class="input-container select-out country-div">
			<?php $this->load->view('html/select-countries');?>
		</div>
		<div class="policy-checkbox">
			<input type="checkbox" name="policy" id="policy">
            <label for="policy"><?=$this->localization->getLocalButton('signup','checkbox')?></label>
		</div>

		<!-- <select class="begin-input input-account" name="account_type" id="account">
			<option value="0"><?=$this->localization->getLocalButton('signup','type_account');?></option>
			<option value="1"><?=$this->localization->getLocalButton('signup','demo_account');?></option>
			<option value="2"><?=$this->localization->getLocalButton('signup','real_account');?></option>
		</select> -->
		<input type="hidden" value="0" name="account_type" id="account">

		<div class="div-form-operation">
			<button onclick="$('#account').val('1'); yaCounter21615634.reachGoal('frmregister'); return true;" class="red-button begin-button signup-submit btn-locked"><?=$this->localization->getLocalButton('signup','try_for_free')?></button>
			<br><?=$this->localization->getLocalButton('signup','or')?> <a onclick="$('#account').val('2'); yaCounter21615634.reachGoal('frmregister'); return true;" class="form-link signup-submit btn-locked"><?=$this->localization->getLocalButton('signup','try_for_real')?></a>
		</div>
	</div>
	<div class="reg-error none-display">
		<p class="normal-text"></p>
		<button class="red-button try-again"><?=$this->localization->getLocalButton('signin','try_again');?></button>
	</div>
	<div class="reg-success none-display">
		<p class="normal-text">
			<?=$this->localization->getLocalMessage('index','success-reg');?>
			<br/><a href="<?=site_url('cabinet/balance');?>"><?=$this->localization->getLocalButton('user_block','fill-acc');?></a>
		</p>
	</div>
</form>