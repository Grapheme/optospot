<!DOCTYPE html>	
<html lang="en">
<?php $this->load->view("admin_interface/includes/head");?>
<body>
	<?php $this->load->view("admin_interface/includes/header");?>
	<div class="container">
		<div class="row">
			<div class="span19">
				<div class="navbar">
					<div class="navbar-inner">
						<a class="brand none" href="">Registered</a>
					</div>
				</div>
				<div style="height:3px;"> </div>
			<?php if($registered):?>
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<td>Дата регистрации</td>
							<td>Количество регистраций</td>
						</tr>
					</thead>
					<tbody>
					<?php for($i=0;$i<count($registered);$i++):?>
						<tr class="align-center">
							<td><?=month_date($registered[$i]['signdate']);?></td>
							<td><a href="<?=site_url('admin-panel/actions/users-list?login=&email=&period_begin='.swap_dot_date($registered[$i]['signdate']).'&period_end='.swap_dot_date($registered[$i]['signdate']));?>"><?=$registered[$i]['count'];?></a></td>
						</tr>
					<?php endfor; ?>
					</tbody>
				</table>
				<p>Всего регистраций: <?=$total_registerd;?></p>
				<?=$pagination;?>
			<?php endif;?>
			</div>
		<?php $this->load->view("admin_interface/includes/rightbar");?>
		</div>
	</div>
	<?php $this->load->view("admin_interface/includes/scripts");?>
</body>
</html>