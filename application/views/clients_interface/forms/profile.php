<?=form_open('cabinet/profile',array('class'=>'form-horizontal form-edit-user')); ?>
	<fieldset>
		<!--<legend><?=$this->localization->getLocalButton('form_profile','legend')?>: <em><?=strtolower($account['email']);?></em></legend>-->
		<p>
			<?=$this->localization->getLocalMessage('client_cabinet','annotation')?>
		</p>
		<ul id="ProductTab" class="nav nav-tabs">
			<li class="active"><a href="#general" data-toggle="tab"><?=$this->localization->getLocalButton('form_profile','general_tab')?></a></li>
			<li><a href="#address" data-toggle="tab"><?=$this->localization->getLocalButton('form_profile','address_tab')?></a></li>
			<li><a href="#additionally" data-toggle="tab"><?=$this->localization->getLocalButton('form_profile','advanced_tab')?></a></li>
		</ul>
		<div id="ProductTabContent" class="tab-content">
			<div class="tab-pane fade in active" id="general">
				<div class="form-container">
					<div class="control-group">
                        <label class="control-label"><?=$this->localization->getLocalButton('form_profile','fname_lable')?>:</label>
						<div class="controls">
							<input placeholder="<?=$this->localization->getLocalButton('form_profile','fname_lable')?>"
							type="text" class="span10 valid-required" autocomplete="off" name="first_name" value="<?=$account['first_name'];?>">
						</div>
					</div>
					<div class="control-group">
                        <label class="control-label"><?=$this->localization->getLocalButton('form_profile','lname_lable')?>:</label>
						<div class="controls">
							<input placeholder="<?=$this->localization->getLocalButton('form_profile','lname_lable')?>"
							type="text" class="span10 valid-required" autocomplete="off" name="last_name" value="<?=$account['last_name'];?>">
						</div>
					</div>
					<div class="control-group">
                        <label class="control-label"><?=$this->localization->getLocalButton('form_profile','zip_lable')?>:</label>
						<div class="controls">
							<input placeholder="<?=$this->localization->getLocalButton('form_profile','zip_lable')?>"
							type="text" class="span6" name="zip_code" autocomplete="off" value="<?=$account['zip_code'];?>">
						</div>
					</div>
					<div class="control-group">
                        <label class="control-label"><?=$this->localization->getLocalButton('form_profile','day_phone_lable')?>:</label>
						<div class="controls">
							<input placeholder="<?=$this->localization->getLocalButton('form_profile','day_phone_lable')?>"
							type="text" class="span6" name="day_phone" autocomplete="off" value="<?=$account['day_phone'];?>">
						</div>
					</div>
					<div class="control-group">
                        <label class="control-label"><?=$this->localization->getLocalButton('form_profile','home_phone_lable')?>:</label>
						<div class="controls">
							<input placeholder="<?=$this->localization->getLocalButton('form_profile','home_phone_lable')?>"
							type="text" class="span6" name="home_phone" autocomplete="off" value="<?=$account['home_phone'];?>">
						</div>
					</div>
					<div class="sign-up-date"><?=$this->localization->getLocalButton('form_profile','signup_lable')?> <span class="sign-date-text"><?=strtoupper($account['signdate'])?></span></div>
				</div>
			</div>
			<div class="tab-pane fade in" id="address">
				<div class="form-container">
					<div class="control-group">
                        <label class="control-label"><?=$this->localization->getLocalButton('form_profile','address1_lable')?>:</label>
						<div class="controls">
							<textarea placeholder="<?=$this->localization->getLocalButton('form_profile','address1_lable')?>" rows="1" class="span9" autocomplete="off" name="address1"><?=$account['address1'];?></textarea>
						</div>
					</div>
					<div class="control-group">
                        <label class="control-label"><?=$this->localization->getLocalButton('form_profile','address2_lable')?>:</label>
						<div class="controls">
							<textarea placeholder="<?=$this->localization->getLocalButton('form_profile','address2_lable')?>" rows="1" class="span9" autocomplete="off" name="address2"><?=$account['address2'];?></textarea>
						</div>
					</div>
					<div class="control-group">
                        <label class="control-label"><?=$this->localization->getLocalButton('form_profile','country_lable')?>:</label>
						<div class="controls">
							<input placeholder="<?=$this->localization->getLocalButton('form_profile','country_lable')?>" type="text" class="span8" autocomplete="off" name="country" value="<?=$account['country'];?>">
						</div>
					</div>
					<div class="control-group">
                        <label class="control-label"><?=$this->localization->getLocalButton('form_profile','state_lable')?>:</label>
						<div class="controls">
							<input placeholder="<?=$this->localization->getLocalButton('form_profile','state_lable')?>" type="text" class="span8" autocomplete="off" name="state" value="<?=$account['state'];?>">
						</div>
					</div>
					<div class="control-group">
                        <label class="control-label"><?=$this->localization->getLocalButton('form_profile','city_lable')?>:</label>
						<div class="controls">
							<input placeholder="<?=$this->localization->getLocalButton('form_profile','city_lable')?>" type="text" class="span8" autocomplete="off" name="city" value="<?=$account['city'];?>">
						</div>
					</div>
				</div>
			</div>
			<div class="tab-pane fade in" id="additionally">
				<div class="form-container">
					<div class="control-group">
                        <label class="control-label"><?=$this->localization->getLocalButton('form_profile','email_lable')?>:</label>
						<div class="controls">
							<input placeholder="<?=$this->localization->getLocalButton('form_profile','email_lable')?>" type="text" class="span8" disabled="disabled" autocomplete="off" name="email" value="<?=$account['email'];?>">
						</div>
					</div>
					<div class="control-group">
                        <label class="control-label"><?=$this->localization->getLocalButton('form_profile','trade_login_lable')?>:</label>
						<div class="controls">
							<input placeholder="<?=$this->localization->getLocalButton('form_profile','trade_login_lable')?>" type="text" class="span8" disabled="disabled" autocomplete="off" name="trade_login" value="<?=$account['trade_login'];?>">
						</div>
					</div>
					<div class="control-group">
                        <label class="control-label"><?=$this->localization->getLocalButton('form_profile','trade_pass_lable')?>:</label>
						<div class="controls">
							<input placeholder="<?=$this->localization->getLocalButton('form_profile','trade_pass_lable')?>" type="text" class="span8" disabled="disabled" autocomplete="off" name="password" value="<?=$account['password'];?>">
						</div>
					</div>
				</div>
			</div>
		</div>
	</fieldset>
	<div class="form-actions">
		<button class="opt-btn" type="submit" name="submit" value="send"><?=$this->localization->getLocalButton('form_profile','submit')?></button>
	</div>
<?= form_close(); ?>