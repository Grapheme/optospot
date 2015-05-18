<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
<?php $this->load->view("users_interface/includes/head");?>
</head>
<body>
	<?php $this->load->view("users_interface/includes/ie7");?>
	<?php $this->load->view("users_interface/includes/header");?>
	<div class="award-container">
		<h1 class="award-title">Forex Expo Awards 2013</h1>
	</div>
	<div class="container_12">
		<div class="grid_12">
			<h1 class="award-h1"><?=$this->localization->getLocalMessage('award','title')?></h1>
		</div>
		<div class="award-block-left">
			<div class="normal-text award-text" style="margin-top: 0;">
				<p><?=$this->localization->getLocalMessage('award','text')?></p>
			</div>
			<img src="<?=baseURL('img/award-photo-2.png');?>" style="width: 130%; margin-left: -30%;">
		</div>
		<div class="award-block-right">
			<img src="<?=baseURL('img/award-photo-1.png');?>" style="width: 130%; margin-right: -30%;">
			<div class="normal-text award-text">
				<?=$this->localization->getLocalMessage('award','text-2')?>
			</div>
		</div>
	</div>
	<div class="award-items-container">
		<div class="container_12">
            <?=$content?>
		</div>
	</div>
	<div class="clear"></div>
	<?php $this->load->view("users_interface/modal/signin");?>
	<div class="dark-screen"></div>
	<?php $this->load->view("users_interface/includes/footer");?>
	<?php $this->load->view("users_interface/includes/scripts");?>
	<?php $this->load->view("users_interface/includes/analytics");?>
	<?php $this->load->view("users_interface/includes/metrika");?>
</body>
</html>