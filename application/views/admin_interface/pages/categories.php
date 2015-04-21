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
					<a class="btn btn-success addCategory" style="float:right; margin-left: 3px;" data-toggle="modal" href="#addCategory"><i class="icon-plus icon-white"></i> New category</a>
					<?=anchor('admin-panel/actions/pages/lang/'.$this->uri->segment(5).'/new-page','<i class="icon-plus-sign icon-white"></i> New page',array('class'=>'btn btn-info','style'=>'margin-left:3px;'));?>
					<?=anchor('admin-panel/actions/pages/lang/'.$this->uri->segment(5).'/properties','<i class="icon-cog icon-white"></i> Properties',array('class'=>'btn btn-info'));?>
				</div>
			<?php if($category):?>
				<!--<p><?=$form_legend;?></p>-->
				<table class="table table-bordered table-hover">
					<thead/>
					<tbody>
					<?php for($i=0;$i<count($category);$i++):?>
						<tr class="align-center">
							<td class=""><?=$category[$i]['title'];?></td>
							<td class="span1"><a class="btn editCategory" data-toggle="modal" href="#editCategory" data-category="<?=$category[$i]['id'];?>" data-category-title="<?=$category[$i]['title'];?>"><i class="icon-pencil"></i></a></td>
							<td class="span1"><a class="btn deleteCategory" data-toggle="modal" href="#deleteCategory" data-category="<?=$category[$i]['id'];?>"><i class="icon-trash"></i></a></td>
						</tr>
					<?php endfor; ?>
					</tbody>
				</table>
			<?php endif;?>
			</div>
		<?php $this->load->view("admin_interface/includes/rightbar");?>
		<?php $this->load->view("admin_interface/modal/lang-insert");?>
		<?php $this->load->view("admin_interface/modal/category-insert");?>
		<?php $this->load->view("admin_interface/modal/category-edit");?>
		<?php $this->load->view("admin_interface/modal/category-delete");?>
		</div>
	</div>
	<?php $this->load->view("admin_interface/includes/scripts");?>
	<script type="text/javascript">
		$(document).ready(function(){
			var CategoryID = 0;
			$(".editCategory").click(function(){$("#category_id").val($(this).attr('data-category'));$("#CategoryName").val($(this).attr('data-category-title'));});
			$(".deleteCategory").click(function(){CategoryID = $(this).attr('data-category');});
			$("#DelCategory").click(function(){location.href='<?=$this->baseURL;?>admin-panel/actions/pages/delete-category/'+CategoryID;});
		});
	</script>
</body>
</html>