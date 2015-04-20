<!DOCTYPE html>	
<html lang="en">
<?php $this->load->view("admin_interface/includes/head");?>
<link rel="stylesheet" href="<?=site_url('css/datapicker/jquery-ui-datapicker.css');?>" />
<body>
	<?php $this->load->view("admin_interface/includes/header");?>
	
	<div class="container">
		<div class="row">
			<div class="span19">
				<div class="navbar">
					<div class="navbar-inner">
						<a class="brand none" href="">Users list</a>
					</div>
				</div>
				<?php $this->load->view("alert_messages/alert-error");?>
				<?php $this->load->view("alert_messages/alert-success");?>
				<div style="height:3px;"> </div>
                <div class="grid_14">
                    <a href="<?=site_url(uri_string());?>">#Traiders</a>
                    <a href="<?=site_url(uri_string().'?group=2');?>">#Administrators</a>
                    <a href="<?=site_url(uri_string().'?group=1');?>">#Moderators</a>
                </div>
                <div style="height:3px;"> </div>
				<div class="grid_14">
					<a href="" class="search-form-view no-clickable">Search</a>
					<div class="div-search-form" <?=(!empty($accounts))?'style="display: none"':'';?>>
						<?php $this->load->view('admin_interface/forms/users-search');?>
					</div>
				</div>
				<div style="height:10px;"> </div>
			<?php if($accounts):?>
				<table class="table table-striped table-bordered">
					<thead/>
					<tbody>
					<?php for($i=0;$i<count($accounts);$i++):?>
						<tr class="align-center">
							<td class="span6">
								<?=$accounts[$i]['first_name'].' '.$accounts[$i]['last_name'];?><br/>
								<strong><?=$accounts[$i]['email'];?></strong>
								<br/><span class="label label-info"><?=$accounts[$i]['signdate'];?></span>
								<?php if($accounts[$i]['coach']):?>
								&nbsp;<span class="label">Speak with a coach</span>
								<?php endif;?>
								<?php if(!$accounts[$i]['active']):?>
									<br/><br/><span class="label label-inverse"><em>User is not active</em></span>
								<?php endif;?>
								<br/><br/>
								<span class="label label-info"><em><?=($accounts[$i]['verification'])?'Verified':'Not Verified'?></em></span><br>
								<span class="label label-inverse"><em><?=($accounts[$i]['demo'])?'Demo account':'Real account'?></em></span>
							</td>
							<td class="span12">
								<strong>Country:</strong> <?=$accounts[$i]['country'];?><br/>
								<strong>Address line 1:</strong> <?=$accounts[$i]['address1'];?><br/>
								<strong>Address line 2:</strong> <?=$accounts[$i]['address2'];?><br/>
								<strong>Email:</strong> <em><?=$accounts[$i]['email'];?></em><br/>
								<strong>Day phone:</strong> <?=$accounts[$i]['day_phone'];?><br/>
								<strong>Home phone:</strong> <?=$accounts[$i]['home_phone'];?><br/>
							</td>
							<td class="span1">
								<?=anchor('admin-panel/actions/users/edit/id/'.$accounts[$i]['id'],'<i class="icon-pencil"></i>',array('class'=>'btn'));?><br/>
								<div style="height:3px;"> </div>
								<a class="deleteUser btn" data-uid="<?=$accounts[$i]['id'];?>" data-toggle="modal" href="#deleteUser" title="Delete user"><i class="icon-trash"></i></a>
							</td>
						</tr>
					<?php endfor; ?>
					</tbody>
				</table>
				<?=$pagination;?>
			<?php endif;?>
			</div>
		<?php $this->load->view("admin_interface/includes/rightbar");?>
		<?php $this->load->view("admin_interface/modal/user-delete");?>
		</div>
	</div>
	<?php $this->load->view("admin_interface/includes/scripts");?>
	<script type="text/javascript" src="<?=site_url('js/datepicker/jquery.ui.datepicker.js');?>"></script>
	<script type="text/javascript" src="<?=site_url('js/datepicker/jquery.ui.datepicker-ru.js');?>"></script>
	<script type="text/javascript" src="<?=site_url('js/libs/datepicker.js');?>"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			var uID = 0;
			$(".deleteUser").click(function(){uID = $(this).attr('data-uid');});
			$("#DelUser").click(function(){location.href='<?=baseURL();?>admin-panel/actions/users/delete/id/'+uID;});
		});
	</script>
</body>
</html>