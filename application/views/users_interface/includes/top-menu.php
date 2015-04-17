<div class="menu">
	<div class="menu-left">
		<nav>
			<ul>
			<?php for($i=1;$i<count($main_menu);$i++):?>
				<?php if($main_menu[$i]['url'] == 'binarnaya-platforma/online-treiding') { ?>
					<li><?=anchor($main_menu[$i]['url'],$main_menu[$i]['link'],'class="top-link" id="deposit-link"');?></li>
					<div class="trading-popup">
							<a href="<?=$main_menu[$i]['url'];?>?acc=pro"><?=$this->localization->getLocalButton('signup','real_account')?></a>
							<a href="<?=$main_menu[$i]['url'];?>?acc=demo"><?=$this->localization->getLocalButton('signup','demo_account')?></a>
						</div>

				<? } elseif(mb_strtolower($main_menu[$i]['url']) == 'faq') { ?>
					
				<? } else { ?>
					<li><?=anchor($main_menu[$i]['url'],$main_menu[$i]['link'],'class="top-link"');?></li>
				<?php } ?>
			<?php endfor;?>
                <?php
                $category_id = $page_id = FALSE;
                $category_title = $page_link = FALSE;
                for($i=0;$i<count($footer['pages']);$i++):
                    if($footer['pages'][$i]['category'] == 23 && $this->language_url = 'en'):
                        $category_id = 23;
                    endif;
                    if($footer['pages'][$i]['category'] == 22 && $this->language_url = 'ru'):
                        $category_id = 22;
                    endif;
                    if($footer['pages'][$i]['category'] == 21 && $this->language_url = 'ind'):
                        $category_id = 21;
                    endif;
                endfor;
                if($category_id):
                    for($i=0;$i<count($footer['category']);$i++):
                        if ($footer['category'][$i]['id'] == $category_id):
                            $category_title = $footer['category'][$i]['title'];
                        endif;
                    endfor;
                    for($i=0;$i<count($footer['pages']);$i++):
                        if ($footer['pages'][$i]['category'] == $category_id):
                            $page_link = $footer['pages'][$i]['url'];
                            break;
                        endif;
                    endfor;
                endif;
                ?>
                <?php if($category_title && $page_link):?>
                    <li><a class="top-link" href="<?=site_url($page_link);?>"><?=$category_title;?></a></li>
                <?php else:?>
					<li><a target="_blank" href="http://optospot.net/banners/trade_binery_options_<?php if($this->language_url == "ru") { ?>RUS<?php } else { ?>ENG<?php } ?>.pdf" class="top-link"><?=$this->localization->getLocalMessage('index','banner-right')?></a></li>
                <?php endif;?>
            <?php
				/*switch ($this->language):
					case '1': echo '<a target="_blank" class="top-link" href="'.baseURL('img/diploma.jpg').'">Awards</a>';break;
					case '4': echo '<a target="_blank" class="top-link" href="'.baseURL('img/diploma.jpg').'">Penghargaan</a>';break;
					case '3': echo '<a target="_blank" class="top-link" href="'.baseURL('img/diploma.jpg').'">Награды</a>'; break;
					default: echo '<a target="_blank" class="top-link" href="'.baseURL('img/diploma.jpg').'">Награды</a>'; break;
				endswitch;*/
			?>
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