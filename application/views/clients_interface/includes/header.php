<header>
    <div class="container">
        <div class="row">
            <div class="span20">
                <h1>
                    <?=$this->localization->getLocalButton('client_cabinet','page_name')?>
                    <?php if($this->profile['demo'] == 1):?>
                        (<?=$this->localization->getLocalButton('client_cabinet','demo_account')?>)
                    <?php endif;?>
                </h1>
            </div>
            <div class="span4">
            <?php
                $this->load->model('languages');
                $languages = $this->languages->visibleLanguages();
            ?>
                <select id="ChangeLang" class="lang" style="width:60px;float:right;margin:2.3em 0 0;">
                    <?php for($i=0;$i<count($languages);$i++):?>
                        <option value="<?=mb_strtolower($languages[$i]['uri']);?>"<?=($languages[$i]['uri'] == $this->language)?' selected="selected"':''?>><?=mb_strtoupper($languages[$i]['uri']);?></option>
                    <?php endfor;?>
                </select>
                <div class="clear"> </div>
            </div>
        </div>
    </div>
</header>