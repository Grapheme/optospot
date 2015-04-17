<?=form_open($this->uri->uri_string(),array('class'=>'form-horizontal')); ?>
<div id="newPassword" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="New Password" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="NewPasswordLabel">Request new password</h3>
	</div>
	<div class="modal-body">
		<fieldset>
			<div class="control-group">
				<label for="title" class="control-label">Enter current password:</label>
				<div class="controls">
					<input type="password" data-placement="top" role="tooltip" data-original-title="Field cannot be empty" class="span8 input-valid" name="password" autocomplete="off" value="">
					<span class="label label-info">Your Email: <?=$this->user['email'];?></span>
				</div>
			</div>
		</fieldset>
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
		<button class="btn btn-success sendForm" type="submit" name="newpassword" value="send">Request</button>
	</div>
</div>
<?= form_close(); ?>