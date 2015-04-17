<?=form_open($this->uri->uri_string(),array('class'=>'form-horizontal')); ?>
	<fieldset>
		<legend>Смена пароля</legend>
		<div class="control-group">
			<label for="oldpas" class="control-label">Старый пароль:</label>
			<div class="controls">
				<input type="password" id="oldpas" class="input-medium" name="oldpas" value="<?=isset($user['oldpassword'])? $user['oldpassword']:'';?>">
				<span class="help-inline" style="display:none;"></span>
			<?php if(isset($user['oldpassword'])):?>
				<span class="help-block">Пароль: <?=$user['oldpassword'];?></span>
			<?php endif;?>
			</div>
		</div>
		<div class="control-group">
			<label for="password" class="control-label">Новый пароль:</label>
			<div class="controls">
				<input type="password" id="password" class="input-medium" name="password" value="">
				<span class="help-inline" style="display:none;">&nbsp;</span>
			</div>
		</div>
		<div class="control-group">
			<label for="confpass" class="control-label">Повторите пароль:</label>
			<div class="controls">
				<input type="password" id="confpass" class="input-medium" name="confpass" value="">
				<span class="help-inline" style="display:none;">&nbsp;</span>
			</div>
		</div>
		<div class="form-actions">
			<button class="btn btn-primary" type="submit" name="submit" id="submit" value="submit">Сохранить</button>
			<input class="btn btn-inverse" id="reset" style="height: 28px; cursor:pointer;" type="button" value="Отменить">
		</div>
	</fieldset>
<?= form_close(); ?>