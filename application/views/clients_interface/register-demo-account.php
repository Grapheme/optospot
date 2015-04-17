<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view("clients_interface/includes/head");?>
</head>
<body>
	<?php $this->load->view("clients_interface/includes/header");?>
	<div class="container">
		<div class="row">
			<div class="span19">
				<div class="navbar">
					<div class="navbar-inner">
						<a class="brand no-clickable" href=""><?=$this->localization->getLocalButton('client_cabinet','register_demo_account')?></a>
					</div>
				</div>
				<?php $this->load->view("alert_messages/alert-error");?>
				<?php $this->load->view("alert_messages/alert-success");?>
				<div class="span6">
					<div class="signup-form" id="real-signup">
						<?php $this->load->view("clients_interface/forms/register-demo-account");?>
					</div>
				</div>
			</div>
		<?php $this->load->view("clients_interface/includes/rightbar");?>
		</div>
	</div>
	<?php $this->load->view("clients_interface/includes/scripts");?>
</body>
</html>