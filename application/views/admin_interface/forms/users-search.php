<?=form_open(uri_string(),array('class'=>'form-horizontal form-users-search','method'=>'GET')); ?>
    <input type="hidden" name="search" value="1" />
	<fieldset>
		<hr/>
		<div class="clearfix">
			<label for="text">Login</label>
			<input type="text" class="span5" name="login" value="<?=$this->input->get('login')?>"><br/>
			<label for="text">Email</label>
			<input type="text" class="span5 valid-email" name="email" value="<?=$this->input->get('email')?>"><br/>
			<label for="text">Registration period</label>
			<input type="text" class="span3 select-period-begin" autocomplete="off" name="period_begin" value="<?=$this->input->get('period_begin');?>">
			<input type="text" class="span3 select-period-end" autocomplete="off" name="period_end" value="<?=$this->input->get('period_end');?>">
		</div>
		<div class="div-form-operation clearfix">
			<button class="btn btn-submit btn-loading btn-success">Find</button>
			<a href="<?=site_url(uri_string());?>">Reset search</a>
		</div>
		<hr/>
	</fieldset>
<?=form_close();?>