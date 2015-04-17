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
		<div class="container_12 reg-blocks">
			<form action="<?=site_url('signup-account');?>" method="POST">
				<div class="grid_12"><h1 class="reg-title"><?=$this->localization->getLocalButton('signup','form_title');?></h1></div>
				<div class="grid_4 reg-block" id="reg-1">
					<div class="reg-blocked" style="display:none;">&nbsp;</div>
					<div class="reg-block-in">
						<div class="reg-blocks-title">
							<img src="<?=baseURL('img/red-1.png');?>">
							<h2><?=$this->localization->getLocalButton('signup','fill')?></h2>
						</div>
						<div class="clear"></div>
						<input type="hidden" value="xml" name="answerType">
						<input type="hidden" value="send" name="act">
						<input type="hidden" value="main" name="office">
						<div class="input-container"><input class="begin-input input-fname" name="fname" value="" type="text" placeholder="<?=$this->localization->getLocalPlaceholder('signup','fname')?>" id="name"></div>
						<div class="input-container"><input class="begin-input input-lname" name="lname" value="" type="text" placeholder="<?=$this->localization->getLocalPlaceholder('signup','lname')?>" id="lastname"></div>
						<div class="input-container"><input class="begin-input input-email" name="email" value="" type="text" placeholder="<?=$this->localization->getLocalPlaceholder('signup','email')?>" id="email"></div>
						<div class="input-container" id="country-div">
							<?php $this->load->view('html/select-countries');?>
						</div>
						<button class="red-button reg-block-button" id="button-1"><?=$this->localization->getLocalButton('signup','next')?></button>
					</div>
				</div>
				<div class="reg-circle" id="circle-2">
					<p class="circle-number">
						2
					</p>
					<div class="circle-line"></div>
					<h2><?=$this->localization->getLocalButton('signup','choice_type_account')?></h2>
				</div>
				<div class="grid_4 reg-block" id="reg-2" style="display:none;">
					<div class="reg-blocked" style="display:none;">&nbsp;</div>
					<div class="reg-block-in">
						<div class="reg-blocks-title">
							<img src="<?=baseURL('img/red-2.png');?>">
							<h2><?=$this->localization->getLocalButton('signup','choice_type_account')?></h2>
						</div>
						<div class="clear"></div>
						<a href="#" class="score blue steps-signup-submit">
							<div class="score-in">
								<h2 class=""><?=$this->localization->getLocalButton('signup','demo_account');?></h2>
								<div class="circle-line"></div>
								<p class="normal-text"><?=$this->localization->getLocalButton('signup','demo_account_text');?></p>
							</div>
						</a>
						<a href="#" class="score green steps-signup-submit">
							<div class="score-in ">
								<h2><?=$this->localization->getLocalButton('signup','real_account');?></h2>
								<div class="circle-line"></div>
								<p class="normal-text"><?=$this->localization->getLocalButton('signup','real_account_text');?></p>
							</div>
						</a>
						<div class="div-form-operation"></div>
						<div class="hidden">
							<input type="radio" name="account_type" value="1" class="acc-radio">
							<input type="radio" name="account_type" value="2" class="acc-radio">
						</div>
					</div>
				</div>
				<div class="reg-circle" id="circle-3">
					<p class="circle-number">
						3
					</p>
					<div class="circle-line"></div>
					<h2><?=$this->localization->getLocalButton('signup','by_register');?></h2>
				</div>
				<div class="grid_4 reg-block" id="reg-3" style="display:none;">
					<div class="reg-block-in">
						<div class="reg-blocks-title">
							<img src="<?=baseURL('img/red-3.png');?>">
							<h2><?=$this->localization->getLocalButton('signup','by_register');?></h2>
						</div>
						<div class="clear"></div>
						<div class="reg-desc normal-text" style="display: none;">
							<?=$this->localization->getLocalButton('signup','by_register_text');?>
							<div>
								<a href="<?=site_url('binarnaya-platforma/online-treiding');?>" class="red-button reg-block-button steps-signup-submit" id="button-3"><?=$this->localization->getLocalButton('signup','begin_trading');?></a>
							</div>
						</div>
						<div class="reg-desc-2 normal-text" style="display: none;">
							<?=$this->localization->getLocalButton('signup','by_register_text_pro');?>
							<div>
								<a href="<?=site_url('cabinet/balance');?>" class="red-button reg-block-button steps-signup-submit" id="button-3"><?=$this->localization->getLocalMessage('signup','up_balance');?></a>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	<?php if($this->uri->segment(1) == 'ru'):?>
		<div class="clear"></div>
		<div class="container_12 reg-blocks">
			<h1>Торговля бинарными опционами онлайн. Регистрация бинарные опционы</h1>
			<p>Попытка зарабатывать деньги на просторах виртуального мира приводит многих людей к биржевой торговле. Одним из приоритетных финансовых инструментов в этом 
			интеллектуальном бизнесе являются бинарные опционы онлайн. Чтобы выйти на рынок и начать зарабатывать, достаточно зарегистрироваться на нашем сайте. 
			Это вы можете сделать здесь и сейчас. Регистрация на бинарных опционах довольно простая процедура, в результате которой вы станете трейдером и получите не 
			только доступ на биржу, но и солидного партнера, в лице Оptospot.net.</p>
			<h2>Заработок начинается с регистрации на бинарных опционах</h2>
			<p>Приличный доход от торговли компенсируется риском полной потери средств с торгового счета, поэтому опционы величают игрой «все или ничего». 
			Сама торговля бинарными опционами сводится к тому, что трейдер обязан на основании анализа рынка валют и металлов определить направление движения цены 
			(она будет расти или падать) в конкретный период времени.</p>
			<p>Для онлайн торговли бинарными опционами, прежде всего, необходим компьютер с подключением к интернету, что есть сейчас любом доме. 
			На большинстве сайтов интернет  торговли опционами еще необходима установка рабочего терминала, что непросто для новичка. В нашем случае этого не требуется, 
			так как  <a href="http://optospot.net/ru/binarnaya-platforma/online-treiding?acc=pro">торговая платформа для интернет-трейдинга  уже готова к работе.</a> <p>
			<h3>Оptospot.net - торговля бинарными опционами для новичков</h3>
			<p>Для успешной торговли вам необходим хотя бы минимальный запас теоретических знаний. Рекомендуем посмотреть раздел сайта 
			<a href="http://optospot.net/ru/binarnaya-platforma/binarnie-opcioni-brokeri-strategii">«Обучение торговле бинарными опционами для новичков»</a>
			 – это краткий вводный курс о том, с чего следует начинать трейдеру. 
			О работе платформы и <a href="http://optospot.net/ru/library/tehnika-traidinga-torgovlya-na-birge-dlya-nachinauchih-part-1">торговле на бирже для начинающих</a>
			много полезного узнаете, перейдя по этой ссылке.</p>
			<h3>Торговли бинарными опционами онлайн: шаг за шагом</h3>
			<p>Для начала трейдер выбирает финансовый инструмент. Чаще валютную пару, но можно и золото, потому что оно имеет высокую волатильность, то есть 
			цена на золото в постоянном движении вверх или вниз. Для начала трейдер спокойно анализирует график цен в определенный тайм фрейм (временной показатель). 
			Но и дальше спокойствие должно быть ключевым качеством всегда, особенно после открытия сделки. Хотя оставаться спокойным, когда на кону твои деньги, совсем непросто. 
			Когда расчеты закончил и у вас уже есть прогноз, вы выставляется сумма средств для участия в торгах и нажимаются главную кнопку. Если цена на выбранный актив, 
			по вашему мнению,  должна вырасти,  выбираете “above”, если упасть, то “below”.</p>
			<h3>Регистраций + бинарные опционы = прибыль</h3>
			<p>От игре к игре надо совершенствоваться, отрабатывать навыки, приемы и стратегии в процессе трейдинга, устраняя неточности и ошибки. 
			Их, увы, не избежать. Но главное,  вовремя сделать правильные выводы и внести в торговлю бинарными опционами нужные коррективы для эффективного заработка. 
			Движение цен подвергается изменениям в мировой экономике постоянно. Учитывать их и делать грамотные прогнозы – вот основной залог успеха в интернет трейдинге. 
			В этой связи важно <a href="http://optospot.net/ru/binarnie-opcioni-dlya-nachinauchih">научиться правильно трактовать влияние новостей на биржевые цены.</a> 
			Но, в любом случае, торговля бинарными опционами сопряжена с рисками. Чтобы свести их к минимуму стоит 
			<a href="http://optospot.net/ru/kak-zarabativat-na-binarnih-opcionah-kak-torgovat-na-binarnih-opcionah">научиться управлять рисками</a>, чтобы не потерять однажды голову, 
			а следом за ней и все свои деньги. Только при холодной голове и разумных действиях торговля бинарными опционами может стать стабильным источником дохода.</p>
		</div>
	<?php endif;?>
	</div>
	<div class="clear"></div>
	<?php $this->load->view("users_interface/modal/signin");?>
	<div class="dark-screen"></div>
	<?php $this->load->view("users_interface/includes/footer");?>
	<?php $this->load->view("users_interface/includes/scripts");?>
	<?php $this->load->view("users_interface/includes/analytics");?>
	<?php $this->load->view("users_interface/includes/metrika");?>
</body>
</html>