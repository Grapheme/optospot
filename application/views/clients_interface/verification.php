<!DOCTYPE html>
<html lang="en">
<?php $this->load->view("clients_interface/includes/head");?>

<body>
	<?php $this->load->view("clients_interface/includes/header");?>
	<div class="container">
		<div class="row">
			<div class="span19">
                <div class="navbar">
                    <div class="navbar-inner">
                        <a class="brand no-clickable" href=""><?=$this->localization->getLocalButton('client_cabinet','verification')?></a>
                    </div>
                </div>
                <div>
                    <?=$this->localization->getLocalMessage('verification','annotation')?>
                </div>
                <div class="clear"> </div>
            </div>
            <?php $this->load->view("clients_interface/includes/rightbar");?>
		</div>
	</div>
	<?php $this->load->view("clients_interface/includes/footer");?>
	<?php $this->load->view("clients_interface/includes/scripts");?>
</body>
</html>