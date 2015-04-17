<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
<?php $this->load->view("users_interface/includes/head");?>
</head>
<body>
	<?php $this->load->view("users_interface/includes/ie7");?>
	<?php $this->load->view("users_interface/includes/header");?>
	<div class="main-container">
		<div class="container_12">
			<div class="grid_12" style="text-align: center;">
				<a href="http://optospot.net/ru/registering" class="top-circle">
					<div>
						<p class="circle-number">1</p>
						<p class="circle-line"></p>
						<h2 class="circle-title"><?=$this->localization->getLocalMessage('index','circle_step1_1')?></h2>
						<p class="circle-description normal-text"><?=$this->localization->getLocalMessage('index','circle_step1_2')?></p>
					</div>
				</a>
				<div class="top-circle-arrow">&nbsp;</div>
				<a href="#tickers" class="top-circle">
					<div>
						<p class="circle-number">2</p>
						<p class="circle-line"></p>
						<h2 class="circle-title"><?=$this->localization->getLocalMessage('index','circle_step2_1')?></h2>
						<p class="circle-description normal-text"><?=$this->localization->getLocalMessage('index','circle_step2_2')?></p>
					</div>
				</a>
				<div class="top-circle-arrow">&nbsp;</div>
				<a href="http://optospot.net/ru/binarnaya-platforma/online-treiding?acc=pro" class="top-circle">
					<div>
						<p class="circle-number">3</p>
						<p class="circle-line"></p>
						<h2 class="circle-title"><?=$this->localization->getLocalMessage('index','circle_step3_1')?></h2>
						<p class="circle-description normal-text"><?=$this->localization->getLocalMessage('index','circle_step3_2')?></p>
					</div>
				</a>
			</div>
		</div>
	</div>
	<div class="begin-container">
		<div class="container_12">
			<div class="grid_8" id="screen-1">
				<div class="begin-list">
					<img src="<?=baseURL('img/red-1.png');?>"><p><?=mb_strtoupper($this->localization->getLocalMessage('index','screen1_1'));?></p>
				</div>
				<div class="begin-list">
					<img src="<?=baseURL('img/red-2.png');?>"><p><?=mb_strtoupper($this->localization->getLocalMessage('index','screen1_2'));?></p>
				</div>
				<div class="begin-list">
					<img src="<?=baseURL('img/red-3.png');?>"><p><?=mb_strtoupper($this->localization->getLocalMessage('index','screen1_3'));?></p>
				</div>
			</div>
			<a href="<?=site_url('binarnie-opcioni-bonus-v-rossii');?>" class="grid_8" id="screen-2" style="text-decoration:none;">
				<p class="screen2-text" style="width: 670px; margin-bottom: 10px;"><?=$this->localization->getLocalMessage('index','screen_2_title')?></p>
				<p class="screen2-text" style="font-size: 15px; width: 580px; font-weight: normal; margin: 50px 0 0; line-height: 2em;"><?=$this->localization->getLocalMessage('index','screen_2_text')?></p>
			</a>
			<a href="<?=site_url('award');?>" class="grid_8" id="screen-3">
				<p class="screen2-text" style="width: 670px; margin-bottom: 10px;"><?=$this->localization->getLocalMessage('index','screen_3_title')?></p>
				<p class="screen2-text" style="font-size: 22px; width: 670px; font-weight: normal; margin: 0 0 60px 0;"><?=$this->localization->getLocalMessage('index','screen_3_text')?></p>
				<p class="screen2-text" style="font-size: 15px; font-weight: normal; line-height: 25px;"><?=$this->localization->getLocalMessage('index','screen_3_desc')?></p>
			</a>
			<?php $this->load->view("users_interface/modal/begin-trade");?>
			<div class="control">
				<a class="control-line active" id="control-1"></a>
				<a class="control-line" id="control-2"></a>
				<a class="control-line" id="control-3"></a>
			</div>
		</div>
	</div>
	<!-- <div class="container_12">
		<div class="grid_12">
			<a target="_blank" href="#" class="right-banner">
				<div class="hover-banner">
				</div>
				<div class="banner-text"><?=$this->localization->getLocalMessage('index','banner-left')?></div>
			</a>
			<a target="_blank" href="http://optospot.net/banners/trade_binery_options_<?php if($this->language_url == "ru") { ?>RUS<?php } else { ?>ENG<?php } ?>.pdf" class="left-banner">
				<div class="hover-banner">
				</div>
				<div class="banner-text"><?=$this->localization->getLocalMessage('index','banner-right')?></div>
			</a>
		</div>
	</div> -->
	<div class="fish-container">
		<div class="container_12">
			<div class="grid_12">
                <h2 style="text-align: center; text-transform: uppercase; margin-top:-20px;">
                    &ndash; <?=$this->localization->getLocalMessage('index','fish1_');?> &ndash;
                </h2>
				<div class="fish-div">
					<div class="fish-img-container"><img src="<?=baseURL('img/fish-1.png');?>"></div>
					<p><h2><?=$this->localization->getLocalMessage('index','fish1_1');?></h2></p>
					<p class="normal-text"><?=$this->localization->getLocalMessage('index','fish1_2');?></p>
				</div>
				<div class="fish-bet">&nbsp;</div>
				<div class="fish-div">
					<div class="fish-img-container"><img src="<?=baseURL('img/fish-2.png');?>"></div>
					<p><h2><?=$this->localization->getLocalMessage('index','fish2_1');?></h2></p>
					<p class="normal-text"><?=$this->localization->getLocalMessage('index','fish2_2');?></p>
				</div>
				<div class="fish-bet">&nbsp;</div>
				<div class="fish-div">
					<div class="fish-img-container"><img src="<?=baseURL('img/fish-3.png');?>"></div>
					<p><h2><?=$this->localization->getLocalMessage('index','fish3_1');?></h2></p>
					<p class="normal-text"><?=$this->localization->getLocalMessage('index','fish3_2');?></p>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
		<a name="tickers"></a>
	</div>
	<div class="clearfix"></div>
    <?=(isset($page[4]['content']))?$page[4]['content']:'';?>
	<div class="money-container">
		<div class="container_12">
			<div class="money-in-container">
				<div class="grid_12">
					<?php $this->load->view("users_interface/includes/rss",array('inline'=>TRUE));?>
				</div>
				<div class="grid_9">
					<?php $this->load->view("users_interface/includes/ticker");?>
				</div>
				<div class="grid_3 money-div-right">
					<p class="money-right-title"><?=$this->localization->getLocalMessage('index','money_right');?></p>
					<div class="money-right-list">
						<img src="<?=baseURL('img/red-1.png');?>">
						<div>
							<h2><?=$this->localization->getLocalMessage('index','circle_step1_1')?></h2>
							<p class="normal-text"><?=$this->localization->getLocalMessage('index','circle_step1_2')?></p>
						</div>
					</div>
					<div class="money-right-list">
						<img src="<?=baseURL('img/red-2.png');?>">
						<div>
							<h2><?=$this->localization->getLocalMessage('index','circle_step2_1')?></h2>
							<p class="normal-text"><?=$this->localization->getLocalMessage('index','circle_step2_2')?></p>
						</div>
					</div>
					<div class="money-right-list">
						<img src="<?=baseURL('img/red-3.png');?>">
						<div>
							<h2><?=$this->localization->getLocalMessage('index','circle_step3_1')?></h2>
							<p class="normal-text"><?=$this->localization->getLocalMessage('index','circle_step3_2')?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    <?php if(isset($page[1]['content']) && !empty($page[1]['content'])): ?>
    <div class="fish-container good-points <?php if($this->loginstatus === TRUE) echo "authed";?>">
		<div class="container_12">
			<?=(isset($page[1]['content']))?$page[1]['content']:'';?>
		</div>
	</div>
    <?php endif;?>
	<?php $this->load->view("users_interface/modal/signup");?>
    <?php if(isset($page[2]['content']) && !empty($page[2]['content'])): ?>
	<div class="fish-container">
		<div class="container_12">
			<?=(isset($page[2]['content']))?$page[2]['content']:'';?>
		</div>
	</div>
    <?php endif;?>
	<div class="clear"></div>
	<?php $this->load->view("users_interface/modal/signin");?>
	<div class="dark-screen"></div>
	<?php $this->load->view("users_interface/includes/footer");?>
	<?php $this->load->view("users_interface/includes/scripts");?>
	<!--<script src="<?=baseURL('js/ticker.js')?>"></script>-->
	<?php $this->load->view("users_interface/includes/analytics");?>
	<?php $this->load->view("users_interface/includes/metrika");?>
</body>
</html>
