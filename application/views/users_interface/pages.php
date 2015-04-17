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
			<?php if($active_category) { ?>
			<div class="grid_3 typical-menu">
				<nav>
					<ul>
				<?php for($i=0;$i<count($footer['pages']);$i++): ?>
					<?php if($footer['pages'][$i]['category'] == $active_category && $footer['pages'][$i]['second_page'] == 0):?>
						<li data-url="<?=$footer['pages'][$i]['url'];?>">
						<?php if($footer['pages'][$i]['url'] == noFirstSegment(uri_string())):
							$isactive = " active";
						else:
							$isactive = "";
						endif;
						?>
							<?=anchor($footer['pages'][$i]['url'],$footer['pages'][$i]['link'],'class="typical-link'.$isactive.'"');?>
						<br>
						</li>
					<?php endif; ?>
				<?php endfor; ?>
					</ul>
				</nav>
			</div>
			<?php } ?>
			<div class="grid_9 page-margin">
				<?php if(noFirstSegment(uri_string()) == 'binarnie-opcioni-otkrit-schet') {  ?>
					<?php $ticker = $this->load->view("html/ticker",NULL,TRUE); ?>
				<?php } else { $ticker = NULL; }?>
				<div class="normal-text">
					<?=str_replace('$$ticker$$', $ticker, $content);?>
				</div>
			</div>
		</div>
		
		
		
		<?php 
			if(noFirstSegment(uri_string()) == 'binarnie-opcioni-demo-schet')
			{
				$type = "demo";
			} 
			elseif(noFirstSegment(uri_string()) == 'binarnie-opcioni-otkrit-schet') 
			{
				$type = "pro";
			} 
			else 
			{
				$type = "none";
			}
		?>
		
		<?php if($type!="none") { ?>

			<?php if($this->loginstatus === FALSE):?>
			<div class="main-container kit">
				<div class="container_12 reg-container">
					<div class="reg-form">
						<h1 class="begin-title"><?=$this->localization->getLocalButton('signup','form_title');?></h1>
						<?php $posit = "down"; ?>
						<?=$this->load->view('users_interface/forms/signup-page',array('idForm'=>'reg-form','type'=>$type));?>
					</div>
				</div>
			</div>
			<?php endif;?>
		
		<?php } ?>
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