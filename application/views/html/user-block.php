<div class="auth-data">
<?php
$CI = & get_instance();
switch($this->profile['moderator']):
    case 0 :
        if ($this->profile['demo']):
            if (uri_string() == $this->language_url . '/binarnaya-platforma/online-treiding'):
                echo anchor(USER_START_PAGE, 'Demo account', array('class' => 'action-cabinet', 'target' => '_blank'));
            else:
                echo anchor(USER_START_PAGE, 'Demo account', array('class' => 'action-cabinet'));
            endif;
        elseif(!$this->profile['demo']):
            $account = $CI->getTradeAccountInfoDengiOnLine();
            ?>
            <div class="trader-div">
                <?=$this->localization->getLocalButton('user_block','trader-balance')?>
                <strong><?=(isset($account['accounts']['amount']))?$account['accounts']['amount']:'ERROR';?></strong><br>
                <a href="<?=site_url('cabinet/balance');?>" class="trader-div-money"><?=$this->localization->getLocalButton('user_block','fill-acc');?></a>
            </div>
        <?php
        endif;
        break;
    case 1 :
        echo anchor(baseURL('admin-panel/actions/pages'),$this->localization->getLocalButton('user_block','admin_link'),array('class'=>'action-cabinet'));
        break;
    case 2 :
        echo anchor(baseURL(ADMIN_START_PAGE),$this->localization->getLocalButton('user_block','admin_link'),array('class'=>'action-cabinet'));
        break;
    case 3 :
        echo anchor(baseURL(ADMIN_START_PAGE),$this->localization->getLocalButton('user_block','admin_link'),array('class'=>'action-cabinet'));
        break;
    default :
endswitch;
?>
	<a class="action-cabinet" href="<?=site_url('logoff');?>"><?=$this->localization->getLocalButton('user_block','logoff')?></a>
</div>