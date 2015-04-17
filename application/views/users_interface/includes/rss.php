<?php if($inline == TRUE):?>
	<div class="rbk-line">
		<img src="<?=baseURL('img/rbk.png" class="rbk-img');?>">
		<marquee onmouseover="this.stop();" onmouseout="this.start();" class="rbk-move normal-text">
		<?php
			$className = 'move-news-item normal-text';
			$this->load->helper('rss');
			switch ($this->language):
				case '1': getRSS("http://feeds.feedburner.com/yahoo-news-updates",2,$className);break;
				case '3': getRSS("http://static.feed.rbc.ru/rbc/internal/rss.rbc.ru/rbc.ru/economics.rss",5,$className);break;
				default: getRSS("http://feeds.feedburner.com/yahoo-news-updates",2,$className);break;
			endswitch;
		?>
		</marquee>
	</div>
<?php else:?>
	<div class="grid_3 typical-news">
		<div class="typical-news-in">
			<div class="typical-news-title">
				<img src="<?=baseURL('img/rbk.png" class="rbk-img');?>">
				<p class="typical-link">Новости рбк</p>
			</div>
			<?php
				$className = 'typical-news-item normal-text';
				$this->load->helper('rss');
				switch ($this->language):
					case '1': getRSS("http://feeds.feedburner.com/yahoo-news-updates",2,$className);break;
					case '3': getRSS("http://static.feed.rbc.ru/rbc/internal/rss.rbc.ru/rbc.ru/economics.rss",5,$className);break;
					default: getRSS("http://feeds.feedburner.com/yahoo-news-updates",2,$className);break;
				endswitch;
			?>
		</div>
	</div>
<?php endif;?>