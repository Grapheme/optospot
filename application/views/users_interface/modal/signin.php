<div class="login-popup">
	<div class="reg-form popup">
		<div class="div-signin">
			<h2 class="begin-title"><?=$this->localization->getLocalPlaceholder('signin','title_form')?></h2>
			<?=$this->load->view('users_interface/forms/signin');?>
		</div>
		<div class="div-forgot hidden">
			<h2 class="begin-title"><?=$this->localization->getLocalPlaceholder('forgot','title_form')?></h2>
			<?=$this->load->view('users_interface/forms/forgot');?>
		</div>
	</div>
</div>