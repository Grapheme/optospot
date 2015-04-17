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
						<a class="brand none" href="">Logs List</a>
					</div>
				</div>
				<div style="height:3px;"> </div>
			<?php if($logs):?>
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<td>Date</td>
							<td>method</td>
							<td>Fields</td>
							<td>Result</td>
							<td>Error</td>
						</tr>
					</thead>
					<tbody>
					<?php for($i=0;$i<count($logs);$i++):?>
						<tr class="align-center">
							<td>
								<?=$logs[$i]['date'];?>
							</td>
							<td>
							<?php if(!empty($logs[$i]['method'])):?>
								<?=@$logs[$i]['method'];?>
							<?php endif;?>
							</td>
							<td>
						<?php if(!empty($logs[$i]['fields'])):?>
							<?php foreach($logs[$i]['fields'] as $key => $value):?>
								<?=@$key.' - ' .@print_r($value).'<br/>';?>
							<?php endforeach;?>
						<?php endif;?>
							</td>
							<td>
						<?php if(!empty($logs[$i]['Result'])):?>
							<?php foreach($logs[$i]['Result'] as $key => $value):?>
								<?=@$key.' - ' .@print_r($value).'<br/>';?>
							<?php endforeach;?>
						<?php endif;?>
							</td>
							<td>
						<?php if(!empty($logs[$i]['Error'])):?>
							<?php foreach($logs[$i]['Error'] as $key => $value):?>
								<?=@$key.' - ' .@print_r($value).'<br/>';?>
							<?php endforeach;?>
						<?php endif;?>
							</td>
							
						</tr>
					<?php endfor; ?>
					</tbody>
				</table>
				<?=$pagination;?>
			<?php endif;?>
			</div>
		<?php $this->load->view("admin_interface/includes/rightbar");?>
		</div>
	</div>
	<?php $this->load->view("admin_interface/includes/scripts");?>
</body>
</html>