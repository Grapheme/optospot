<div class="navbar">
	<div class="navbar-inner">
    <?php if (MY_Controller::is_administrator()): ?>
		<a data-placement="bottom" href="#InsertLang" role="button tooltip" class="brand ttObject" data-toggle="modal" data-original-title="Click the button to add a language">Add language</a>
    <?php endif; ?>
        <ul class="nav" role="navigation">
		<?php for($i=0;$i<count($langs);$i++):?>
			<li class="dropdown">
				<a id="drop<?=$i?>" class="dropdown-toggle" data-toggle="dropdown" role="button" href="#"><?=mb_strtoupper($langs[$i]['name']);?> <b class="caret"></b></a>
				<ul class="dropdown-menu" aria-labelledby="drop<?=$i?>" role="menu">
					<div class="hightPageslist">
					<li><?=anchor('admin-panel/actions/pages/lang/'.$langs[$i]['id'].'/page/home','<i class="icon-home"></i> Home');?></li>
					<li><?=anchor('admin-panel/actions/pages/lang/'.$langs[$i]['id'].'/page/trade','<i class="icon-certificate"></i> Trade');?></li>
					<li><?=anchor('admin-panel/actions/pages/lang/'.$langs[$i]['id'].'/page/faq','<i class="icon-info-sign"></i> FAQ');?></li>
					<li><?=anchor('admin-panel/actions/pages/lang/'.$langs[$i]['id'].'/page/deposit','<i class="icon-asterisk"></i> Deposit');?></li>
					<li><?=anchor('admin-panel/actions/pages/lang/'.$langs[$i]['id'].'/page/contact-us','<i class="icon-globe"></i> Contact Us');?></li>
				<?php for($j=0;$j<count($langs_pages);$j++):?>
					<?php if($langs[$i]['id'] == $langs_pages[$j]['language']):?>
						<hr/><?php break;?>
					<?php endif;?>
				<?php endfor;?>
				<?php for($j=0;$j<count($langs_pages);$j++):?>
					<?php if($langs[$i]['id'] == $langs_pages[$j]['language']):?>
						<li><?=anchor('admin-panel/actions/pages/lang/'.$langs[$i]['id'].'/page/'.$langs_pages[$j]['id'],'<i class="icon-circle-arrow-right"></i> '.$langs_pages[$j]['link'],array('tabindex'=>'-1'));?></li>
					<?php endif;?>
				<?php endfor;?>
					</div>
					<hr/>
					<li><?=anchor('admin-panel/actions/pages/lang/'.$langs[$i]['id'].'/new-page','<i class="icon-plus-sign"></i> New page');?></li>
					<li><?=anchor('admin-panel/actions/pages/lang/'.$langs[$i]['id'].'/categories','<i class="icon-th-list"></i> Categories',array('tabindex'=>'-1'));?></li>
                    <?php if (MY_Controller::is_administrator()): ?>
                    <li><?=anchor('admin-panel/actions/pages/lang/'.$langs[$i]['id'].'/properties','<i class="icon-cog"></i> Properties',array('tabindex'=>'-1'));?></li>
                    <?php endif; ?>
				</ul>
			</li>
		<?php endfor;?>
		</ul>
	</div>
</div>