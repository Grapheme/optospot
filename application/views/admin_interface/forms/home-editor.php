<?=form_open($this->uri->uri_string(),array('class'=>'form-horizontal form-home-page')); ?>
	<fieldset>
		<legend><?=$form_legend;?></legend>
		<ul id="ProductTab" class="nav nav-tabs">
			<li class="active"><a href="#part_0" data-toggle="tab">General</a></li>
			<li><a href="#part_1" data-toggle="tab">How to trade</a></li>
			<li><a href="#part_2" data-toggle="tab">Features</a></li>
			<li><a href="#part_3" data-toggle="tab">Check out</a></li>
			<li><a href="#part_4" data-toggle="tab">Info</a></li>
		</ul>
		<div id="ProductTabContent" class="tab-content">
		<?php for($p=0;$p<count($page);$p++):?>
			<?php if($page[$p]['category'] == 0):?>
			<div class="tab-pane fade in active" id="part_<?=$p?>">
				<input type="hidden" name="home_main" value="<?=$page[$p]['id'];?>">
				<div class="control-group">
					<label for="title" class="control-label">Page title: </label>
					<div class="controls">
						<input type="text" class="span14" name="title" value="<?=$page[$p]['title'];?>">
					</div>
				</div>
				<div class="control-group">
					<label for="description" class="control-label">Page description: </label>
					<div class="controls">
                        <textarea rows="8" style="height:50px;" class="span12" name="description"><?=$page[$p]['description'];?></textarea>
					</div>
				</div>
				<div class="control-group">
					<label for="link" class="control-label">Page link: </label>
					<div class="controls">
						<input type="text" class="span14 valid-required" name="link" value="<?=$page[$p]['link'];?>">
					</div>
				</div>
				<div class="control-group">
					<label for="url" class="control-label">Page URL: </label>
					<div class="controls">
						<input type="text" class="span14" name="url" <?=(!$page[$p]['manage'])?'readonly="readonly"':'';?> value="<?=$page[$p]['url'];?>">
						<?php if(!$page[$p]['manage']):?>
							<span class="label label-important">Important. For the current page field does not change!</span>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<?php else:?>
			<div class="tab-pane fade" id="part_<?=$p?>">
				<input type="hidden" name="home_<?=$p?>" value="<?=$page[$p]['id'];?>">
			<?php if($page[$p]['title'] != 'home_3'):?>
				<div class="control-group">
					<label for="link_<?=$p;?>" class="control-label">Title: </label>
					<div class="controls">
						<input type="text" class="span14" name="link_<?=$p;?>" value="<?=$page[$p]['link'];?>">
					</div>
				</div>
			<?php else:?>
				<input type="hidden" name="link_<?=$p;?>" value="">
			<?php endif;?>
			<?php if($page[$p]['title'] != 'home_2'):?>
				<div class="control-group">
					<textarea style="height:250px;" class="redactor" name="content_<?=$p;?>"><?=$page[$p]['content'];?></textarea>
				</div>
			<?php else:?>
				<div class="control-group">
					<label for="content_<?=$p;?>" class="control-label">Button trade: </label>
					<div class="controls">
						<input type="text" class="span6" name="content_<?=$p;?>" value="<?=$page[$p]['content'];?>">
					</div>
				</div>
			<?php endif;?>
			</div>
			<?endif;?>
		<?php endfor;?>
		</div>
		<div class="form-actions">
			<button class="btn btn-success btn-home-page" type="submit" name="submit" value="submit">Submit Form</button>
		</div>
	</fieldset>
<?= form_close(); ?>