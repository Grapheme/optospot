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
						<a class="brand none" href=""><?=$this->localization->getLocalButton('client_cabinet','my-accounts')?></a>
					</div>
				</div>
				<table id="div_deposit_value" class="opt-table">
					<thead>
						<tr>
							<th><?=$this->localization->getLocalButton('signup','type_account')?></th>
							<th><?=$this->localization->getLocalButton('client_cabinet','account')?></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td width="100px"><?=$this->localization->getLocalButton('signup','real_account')?></td>
							<td width="150px"><?=(isset($accounts[0]))?$accounts[0]['trade_login']:anchor('cabinet/open-account?reg=real',$this->localization->getLocalButton('client_sidebar','real_register'));?></td>
						</tr>
						<tr>
							<td width="100px"><?=$this->localization->getLocalButton('signup','demo_account')?></td>
							<td width="150px"><?=(isset($accounts[1]))?$accounts[1]['trade_login']:anchor('cabinet/open-account?reg=demo',$this->localization->getLocalButton('client_sidebar','demo_register'));?></td>
						</tr>
					</tbody>
				</table>
			</div>
		<?php $this->load->view("clients_interface/includes/rightbar");?>
		</div>
	</div>
	<?php $this->load->view("clients_interface/includes/scripts");?>
</body>
</html>