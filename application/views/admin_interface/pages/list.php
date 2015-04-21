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
			<?php if($redactor):?>
				<?php if($page['manage'] && isset($page['id'])):?>
				<div style="float:right;margin:5px 0;">
					<a class="btn btn-inverse deletePage" data-toggle="modal" href="#deletePage" data-page="<?=$page['id'];?>"><i class="icon-trash icon-white"></i> Delete page</a>
				</div>
				<div class="clear"></div>
				<?php endif;?>
				<?php $this->load->view("admin_interface/forms/text-editor");?>
			<?php endif;?>
			</div>
		<?php $this->load->view("admin_interface/includes/rightbar");?>
		<?php $this->load->view("admin_interface/modal/lang-insert");?>
		<?php $this->load->view("admin_interface/modal/page-delete");?>
		</div>
	</div>
	<?php $this->load->view("admin_interface/includes/scripts");?>
	<?php if($redactor):?>
<script type="text/javascript" src="<?=site_url('js/vendor/redactor.min.js');?>"></script>
<script type="text/javascript" src="<?=site_url('js/cabinet/redactor-config.js');?>"></script>
	<?php endif;?>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#CategoryPage").val(<?=$page['category'];?>);
		<?php if($page['manage'] && isset($page['id'])):?>
			var Page = 0;
			$(".deletePage").click(function(){Page = $(this).attr('data-page');});
			$("#DelPage").click(function(){location.href='<?=$this->baseURL;?>admin-panel/actions/pages/delete-page/'+Page;});
		<?php endif;?>
		});
	</script>
</body>
</html>