<form action="<?=site_url('forgot-password');?>" method="POST">
	<div class="input-container">
		<input class="begin-input input-email" autocomplete="off" type="text" name="email" value="" placeholder="<?=$this->localization->getLocalPlaceholder('forgot','email')?>">
	</div>
	<div class="div-form-operation">
		<button autocomplete="off" class="red-button begin-button btn-forgot-submit btn-locked"><?=$this->localization->getLocalButton('signin','forgot_submit')?></button><br>
	</div>
</form>