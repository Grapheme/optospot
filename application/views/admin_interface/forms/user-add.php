<?=form_open(uri_string(),array('class'=>'form-horizontal form-user-add','method'=>'post')); ?>
    <input type="hidden" name="addmoderator" value="1" />
	<fieldset>
		<hr/>
		<div class="clearfix">
			<label for="text">Name</label>
			<input type="text" class="span5" name="first_name" value="<?=$this->input->get('name')?>"><br/>
			<label for="text">Email</label>
			<input type="text" class="span5 valid-email" name="email" value="<?=$this->input->get('email')?>"><br/>
            <label for="text">Group</label>
            <select autocomplete="off" name="group_id">
                <option value="1">Moderator</option>
                <option value="2">Administrator</option>
                <option value="3">Small administrator</option>
            </select>
		</div>
		<div class="div-form-operation clearfix">
			<button class="btn btn-submit btn-loading btn-success">Add</button>
		</div>
		<hr/>
	</fieldset>
<?=form_close();?>