<div class="auth-data">
<?php if($this->account['id'] == 0):?>
	<a href="<?=baseURL(ADMIN_START_PAGE);?>" class="action-cabinet"><?=$this->localization->getLocalButton('user_block','admin_link')?></a>
<?php else:
	if($this->profile['demo'] == 1 && $this->account['id'] > 0):
		if($this->uri->uri_string() == $this->language_url.'/binarnaya-platforma/online-treiding'):
			echo anchor(USER_START_PAGE,'Demo account',array('class'=>'action-cabinet','target'=>'_blank'));
		else:
			echo anchor(USER_START_PAGE,'Demo account',array('class'=>'action-cabinet'));
		endif;
	else:
		if($this->uri->segment(2) == 'trade'):
			echo anchor(USER_START_PAGE,$this->localization->getLocalButton('user_block','user_link'),array('class'=>'action-cabinet','target'=>'_blank'));
		else:
			echo anchor(USER_START_PAGE,$this->localization->getLocalButton('user_block','user_link'),array('class'=>'action-cabinet'));
		endif;
	endif;
endif;?>
<?php if($this->profile['demo'] == 1 && $this->account['id'] > 0):?>

<?php elseif($this->profile['demo'] == 0 && $this->account['id'] > 0):?>
	<?php 
		$CI = & get_instance();
		$account = $CI->getTradeAccountInfoDengiOnLine();
	?>
	<!--<div class="trader-div"><a href="<?=site_url('cabinet/balance');?>">trader_<?=(isset($account['accounts']['accountId']))?$account['accounts']['accountId']:'ERROR';?></a></div>-->
	<div class="trader-div">
		<?=$this->localization->getLocalButton('user_block','trader-balance')?>
		<strong><?=(isset($account['accounts']['amount']))?$account['accounts']['amount']:'ERROR';?></strong><br>
		<a href="<?=site_url('cabinet/balance');?>" class="trader-div-money"><?=$this->localization->getLocalButton('user_block','fill-acc');?></a>
	</div>
<?php endif; ?>
	<a class="action-cabinet" href="<?=site_url('logoff');?>"><?=$this->localization->getLocalButton('user_block','logoff')?></a>
</div>