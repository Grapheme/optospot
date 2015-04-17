<?php if($this->loginstatus === FALSE):?>
<div class="begin-form-div">
	<div class="begin-form">
		<h2 class="begin-title normal-text"><?=$this->localization->getLocalPlaceholder('signup','title_form')?></h2>
		<?php $posit = "up"; ?>
		<?=$this->load->view('users_interface/forms/signup',array('idForm'=>'top-form'));?>
	</div>
</div>
<?php endif;?>