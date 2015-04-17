<?php if($this->loginstatus === FALSE):?>
<div class="main-container kit">
	<div class="container_12 reg-container">
		<div class="reg-form">
			<h1 class="begin-title"><?=$this->localization->getLocalButton('signup','form_title');?></h1>
			<?php $posit = "down"; ?>
			<?=$this->load->view('users_interface/forms/signup',array('idForm'=>'reg-form'));?>
		</div>
	</div>
</div>
<?php endif;?>