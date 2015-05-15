<div class="menu">
	<div class="menu-left">
		<nav>
			<ul>
        <?php foreach ($menu as $menu_item): ?>
            <?php if (count($menu_item['pages'])): ?>
                <li>
                    <a href="javascript:void(0);" class="top-link js-dropdownlist-link"><?=$menu_item['title'];?></a>
                    <div class="trading-popup">
                    <?php foreach ($menu_item['pages'] as $page): ?>
                        <?= anchor($page['url'], $page['link']); ?>
                    <?php endforeach; ?>
                    </div>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
			</ul>
		</nav>
	</div>
	<div class="menu-right">
		<?php if(!$this->loginstatus):?>
			<a onclick="yaCounter21615634.reachGoal('register');" href="<?=site_url('registering')?>"><?=$this->localization->getLocalMessage('index','user_block_reg')?></a>
			<button class="red-button" id="enter"><?=$this->localization->getLocalMessage('index','user_block_login')?></button>
		<?php else:?>
			<?php $this->load->view('html/user-block');?>
		<?php endif;?>
		<div class="lang-div">
			<select id="ChangeLang" class="lang">
			<?php for($i=0;$i<count($languages);$i++):?>
				<option value="<?=mb_strtolower($languages[$i]['uri']);?>"<?=($languages[$i]['id'] == $this->language)?' selected="selected"':''?>><?=mb_strtoupper($languages[$i]['uri']);?></option>
			<?php endfor;?>
			</select>
		</div>
	</div>
</div>