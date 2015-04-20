<?php
    $ApprovedDocuments = Clients_interface::accountVerified();
?>
<div class="span5">
	<ul class="right-menu">
		<!-- <li class="nav-header"><?=$this->localization->getLocalButton('client_sidebar','navigation')?></li> -->
		<li num="home"><?=anchor('',$this->localization->getLocalButton('client_sidebar','home'));?></li>
		<?php if($this->loginstatus && $this->profile['demo'] == 0): ?>
		<li num="trading"><a href="<?=site_url('binarnaya-platforma/online-treiding?acc=pro')?>"><?= $this->localization->getLocalButton('client_sidebar','trade') ?></a></li>
		<?php else: ?>
		<li num="trading"><a href="<?=site_url('binarnaya-platforma/online-treiding?acc=demo')?>"><?= $this->localization->getLocalButton('client_sidebar','trade') ?></a></li>
		<?php endif; ?>
		<?php if($this->profile['demo'] == 0):?>
			<li num="balance"><?=anchor('cabinet/balance',$this->localization->getLocalButton('client_sidebar','deposit'));?></li>
            <?php if(!$ApprovedDocuments):?>
            <li num="withdraw"><?=anchor('cabinet/withdraw',$this->localization->getLocalButton('client_sidebar','verification_off'));?></li>
            <?php else:?>
            <li num="withdraw"><?=anchor('cabinet/withdraw',$this->localization->getLocalButton('client_sidebar','withdrawal'));?></li>
            <?php endif;?>
        <?php else:?>
			<li num="balance"><?=anchor('cabinet/balance',$this->localization->getLocalButton('client_sidebar','real_register'));?></li>
			<li num="withdraw"><?=anchor('cabinet/balance',$this->localization->getLocalButton('client_sidebar','withdrawal'));?></li>
		<?php endif;?>
		<li num="my-accounts"><?=anchor('cabinet/my-accounts',$this->localization->getLocalButton('client_sidebar','my-accounts'));?></li>
        <?php if($this->loginstatus && $this->profile['demo'] == 0 && $ApprovedDocuments): ?>
        <li num="partner-program"><?=anchor('cabinet/partner-program',$this->localization->getLocalButton('client_sidebar','partner-program'));?></li>
		<?php endif; ?>
        <li num="profile"><?=anchor('cabinet/profile',$this->localization->getLocalButton('client_sidebar','profile'));?></li>
<?php if($this->profile['demo'] == 0):?>
	</ul>
    <?php if($ApprovedDocuments):?>
        <p class="text-success" style="margin: 10px 0 0 15px;"><?=$this->localization->getLocalButton('client_sidebar','verification_on')?></p>
    <?php endif;?>
<?php endif;?>
	<div class="logout-div"><?=anchor('logoff',$this->localization->getLocalButton('client_sidebar','logout'));?></div>
</div>