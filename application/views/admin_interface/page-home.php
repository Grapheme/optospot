<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view("admin_interface/includes/head");?>

<link rel="stylesheet" href="<?=site_url('css/redactor.css');?>" />
</head>
<body>
	<?php $this->load->view("admin_interface/includes/header");?>
	
	<div class="container">
		<div class="row">
			<div class="span19">
				<?php $this->load->view("admin_interface/includes/navigation");?>
				<?php $this->load->view("alert_messages/alert-error");?>
				<?php $this->load->view("alert_messages/alert-success");?>
				<?php $this->load->view("admin_interface/forms/home-editor");?>
			</div>
		<?php $this->load->view("admin_interface/includes/rightbar");?>
		<?php $this->load->view("admin_interface/modal/leng-insert");?>
		</div>
	</div>
	<?php $this->load->view("admin_interface/includes/scripts");?>

<script type="text/javascript" src="<?=site_url('js/vendor/redactor.min.js');?>"></script>
<script type="text/javascript" src="<?=site_url('js/cabinet/redactor-config.js');?>"></script>
</body>
</html>