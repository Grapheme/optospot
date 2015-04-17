<form class="signup-form real" action="<?=$action_registration;?>" method="post" target="signup_iframe">
	<input type="hidden" class="FieldSend" name="answerType" value="xml" />
	<input type="hidden" class="FieldSend" name="act" value="send" />
	<input type="hidden" class="FieldSend" name="office" value="main" />
	<input type="hidden" class="FieldSend" name="account_type" value="2" />
	<input type="text" class="valid-required FieldSend" name="fname" id="fname" data-placement="right" role="tooltip" data-original-title="Field cannot be empty" placeholder="First name" value="<?=($this->loginstatus && $this->user['demo'] == 1)?$user['first_name']:'';?>" />
	<input type="text" class="valid-required FieldSend" name="lname" id="lname" data-placement="right" role="tooltip" data-original-title="Field cannot be empty" placeholder="Last name" value="<?=($this->loginstatus && $this->user['demo'] == 1)?$user['last_name']:'';?>" />
	<input type="text" class="valid-required FieldSend" id="signup-email-real" name="email" data-placement="right" role="tooltip" data-original-title="Field cannot be empty" placeholder="Email" value="<?=($this->loginstatus && $this->user['demo'] == 1)?$user['email']:'';?>" />
	<?php $this->load->view('html/select-countries');?>
	<input type="text" class="valid-required FieldSend" data-placement="right" role="tooltip" data-original-title="Field cannot be empty" name="phone" placeholder="Phone" />
<?php if(!$this->loginstatus || $this->user['demo'] == 1):?>
	<input type="checkbox" id="coach-real" value="1" checked="checked" name="coach" style="float: left; margin-right: 0.5em;"/> <label for="coach">I'd like to speak with a trading coach</label>
	<button data-account="real" type="submit" class="btn btn-action signup-btn" name="Submit">Open Account</button>
<?php else:?>
	<button class="btn btn-action none" disabled="disabled">Not active</button>
<?php endif;?>
</form>