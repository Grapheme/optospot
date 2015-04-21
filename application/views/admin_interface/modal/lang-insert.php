<?=form_open('admin-panel/actions/pages',array('class'=>'form-horizontal form-language-insert')); ?>
<div id="InsertLang" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="Insert Language" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="InsertLangLabel">Adding language website</h3>
	</div>
	<div class="modal-body">
		<fieldset>
			<div class="control-group">
				<label for="name" class="control-label">Name:</label>
				<div class="controls">
					<input type="text" class="span8 valid-required" name="name" value="" placeholder="For example: English, Russian">
				</div>
			</div>
            <div class="control-group">
				<label for="name" class="control-label">Nickname (URL):</label>
				<div class="controls">
					<input type="text" class="span8 valid-required" name="nickname" value="" placeholder="For example: en, ru">
				</div>
			</div>
		</fieldset>
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
		<button class="btn btn-success btn-language-insert" type="submit" name="insleng" value="send">Add language</button>
	</div>
</div>
<?= form_close(); ?>