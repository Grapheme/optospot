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
						<?=anchor('',"Return",array('class'=>'brand no-clickable backpath'));?>
						<ul class="nav">
							<li class="active"><a href="" class="none">Edit user profile</a></li>
						</ul>
					</div>
				</div>
				<?php $this->load->view("alert_messages/alert-error");?>
				<?php $this->load->view("alert_messages/alert-success");?>
				<?php $this->load->view("admin_interface/forms/edituser");?>
			</div>
            <div id="rejectModal" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <form style="margin: 0;" id="form-delete-document" action="#" method="post">
                    <div class="modal-header">
                        <h3 id="myModalLabel">Reject document</h3>
                    </div>
                    <div class="modal-body">
                        <p>Specify reason for rejection.</p>
                        <textarea style="width: 500px; height: 100px;" name="content"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                        <button type="submit" class="btn btn-primary">Reject</button>
                    </div>
                </form>
            </div>
		<?php $this->load->view("admin_interface/includes/rightbar");?>
		</div>
	</div>
	<?php $this->load->view("admin_interface/includes/scripts");?>
    <script>
        $(function(){
            $(".js-popover").popover();
        });
    </script>
</body>
</html>