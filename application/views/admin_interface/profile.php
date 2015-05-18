<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view("admin_interface/includes/head");?>
</head>
<body>
	<?php $this->load->view("admin_interface/includes/header");?>
	<div class="container">
		<div class="row">
			<div class="span19">
                <div class="navbar">
                    <div class="navbar-inner">
                        <a class="brand none" href="">Profile</a>
                    </div>
                </div>
                <p><?=$this->profile['first_name'];?> (<?=$this->profile['email'];?>)<br><br></p>
                <?php $this->load->view("alert_messages/alert-error");?>
                <?php $this->load->view("alert_messages/alert-success");?>
                <div style="height:3px;"> </div>
                <?php $this->load->view("admin_interface/forms/password");?>
			</div>
		<?php $this->load->view("admin_interface/includes/rightbar");?>
		</div>
	</div>
	<?php $this->load->view('admin_interface/includes/footer');?>
	<?php $this->load->view("admin_interface/includes/scripts");?>
</body>
</html>
