<?=form_open($this->uri->uri_string(),array('class'=>'form-horizontal form-category-insert')); ?>
<div id="addCategory" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="Insert Category" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="InsertCategoryLabel">Adding category pages</h3>
	</div>
	<div class="modal-body">
		<fieldset>
			<div class="control-group">
				<label for="title" class="control-label">Name of the category:</label>
				<div class="controls">
					<input type="text" class="span8 valid-required" name="title" autocomplete="off" value="">
					<span class="label label-info">For example: Library, Partners</span>
				</div>
			</div>
		</fieldset>
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
		<button class="btn btn-success btn-category-insert" type="submit" name="inscategory" value="send">Add category</button>
	</div>
</div>
<?= form_close(); ?>