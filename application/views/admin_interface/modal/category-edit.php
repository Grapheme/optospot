<?=form_open($this->uri->uri_string(),array('class'=>'form-horizontal form-category-update')); ?>
<div id="editCategory" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="Insert Category" aria-hidden="true">
	<input type="hidden" id="category_id" value="" name="category_id">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="InsertCategoryLabel">Edit category pages</h3>
	</div>
	<div class="modal-body">
		<fieldset>
			<div class="control-group">
				<label for="title" class="control-label">Name of the category:</label>
				<div class="controls">
					<input type="text" id="CategoryName" class="span8 valid-required" name="title" autocomplete="off" value="">
					<span class="label label-info">For example: Library, Partners</span>
				</div>
			</div>
		</fieldset>
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
		<button class="btn btn-success btn-category-update" type="submit" name="updcategory" value="send">Save category</button>
	</div>
</div>
<?= form_close(); ?>