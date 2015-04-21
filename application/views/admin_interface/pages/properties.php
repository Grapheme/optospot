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
				<?php $this->load->view("admin_interface/includes/navigation");?>
				<?php $this->load->view("alert_messages/alert-error");?>
				<?php $this->load->view("alert_messages/alert-success");?>
				<div style="float:right;margin:5px 0 25px 0;">
					<?=anchor('admin-panel/actions/pages/lang/'.$lang['id'].'/new-page','<i class="icon-plus-sign icon-white"></i> New page',array('class'=>'btn btn-info','style'=>'margin-left:3px;'));?>
					<?=anchor('admin-panel/actions/pages/lang/'.$lang['id'].'/categories','<i class="icon-th-list icon-white"></i> Categories',array('class'=>'btn btn-info','style'=>'margin-left:3px;'));?>
				<?php if(!$lang['base']):?>
					<a class="btn btn-danger deleteLang" data-toggle="modal" href="#deleteLang" data-lang="<?=$lang['id'];?>"><i class="icon-trash icon-white"></i> Delete language</a>
				<?php endif;?>
				</div>
				<div class="clear"></div>
				<?php $this->load->view("admin_interface/forms/lang-properties");?>
			</div>
		<?php $this->load->view("admin_interface/includes/rightbar");?>
		<?php $this->load->view("admin_interface/modal/lang-insert");?>
		<?php $this->load->view("admin_interface/modal/lang-delete");?>
		</div>
	</div>
	<?php $this->load->view("admin_interface/includes/scripts");?>
	<script type="text/javascript">
		$(document).ready(function(){
			var Lang = 0;
			$(".deleteLang").click(function(){Lang = $(this).attr('data-lang');});
			$("#DelLang").click(function(){location.href='<?=$this->baseURL;?>admin-panel/actions/pages/delete-lang/'+Lang;});
		});
	</script>
</body>
</html>