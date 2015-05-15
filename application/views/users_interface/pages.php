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
        <?php if(isset($menu[$active_category]['pages'])): ?>
            <div class="grid_3 typical-menu">
                <nav>
                    <ul>
                    <?php foreach($menu[$active_category]['pages'] as $page):?>
                        <?php $is_active = ($page['url'] == noFirstSegment(uri_string())) ? " active" : ""; ?>
                        <li data-url="<?=$page['url'];?>">
                            <?=anchor($page['url'],$page['link'],'class="typical-link'.$is_active.'"');?>
                        </li>
                    <?php endforeach;?>
                    </ul>
                </nav>
            </div>
        <?php endif;?>
			<div class="grid_9 page-margin">
				<?php if(noFirstSegment(uri_string()) == 'binarnie-opcioni-otkrit-schet'): ?>
					<?php $ticker = $this->load->view("html/ticker",NULL,TRUE); ?>
				<?php else: ?>
                    <?php $ticker = NULL;?>
                <?php endif; ?>
				<div class="normal-text">
					<?=str_replace('$$ticker$$', $ticker, $content);?>
				</div>
			</div>
		</div>
    <?php
        if (noFirstSegment(uri_string()) == 'binarnie-opcioni-demo-schet'):
            $type = "demo";
        elseif (noFirstSegment(uri_string()) == 'binarnie-opcioni-otkrit-schet'):
            $type = "pro";
        else:
            $type = "none";
        endif;
    ?>
		<?php if($type!="none"): ?>
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