<?=form_open($this->uri->uri_string(),array('class'=>'form-horizontal form-edit-settings')); ?>
<fieldset>
	<legend><?=$form_legend;?></legend>
	<div class="control-group">
		<label for="registration" class="control-label">Registration: </label>
		<div class="controls">
			<input type="text" class="span14 valid-required" name="registration" value="<?=@$settings['registration'];?>">
		</div>
	</div>
	<div class="control-group">
		<label for="charts" class="control-label">Charts: </label>
		<div class="controls">
			<input type="text" class="span14 valid-required" name="charts" value="<?=@$settings['charts'];?>">
		</div>
	</div>
	<div class="control-group">
		<label for="deposit" class="control-label">Deposit: </label>
		<div class="controls">
			<input type="text" class="span14 valid-required" name="deposit" value="<?=@$settings['deposit'];?>">
		</div>
	</div>
	<div class="form-actions">
        <button class="btn btn-success btn-edit-settings" type="submit" name="submit" value="submit">Submit Form</button>
    </div>
</fieldset>
<?= form_close(); ?>
<div class="clear"></div>
<?php
    $mails_path = 'application/views/mails';
    $this->load->helper('file');
    $files = get_dir_file_info($mails_path, $top_level_only = TRUE);
if (isset($files['forgot.php'])):
    $files['forgot.php']['title'] = "Forgot password";
endif;
if (isset($files['reject-document.php'])):
    $files['reject-document.php']['title'] = "Reject document";
endif;
if (isset($files['signup.php'])):
    $files['signup.php']['title'] = "SignUp";
endif;
if (isset($files['withdraw.php'])):
    $files['withdraw.php']['title'] = "Withdraw";
endif;
?>
<?php if($this->input->get('mail') && $edit_file = get_file_info($mails_path.'/'.$this->input->get('mail'))):?>
<?= form_open($this->uri->uri_string(),array('class'=>'form-horizontal form-edit-mails')); ?>
    <input type="hidden" name="file_name" value="<?=$this->input->get('mail');?>">
    <fieldset>
        <legend><?=$form_legend_mail;?> <?=(isset($files[$this->input->get('mail')]['title']))?$files[$this->input->get('mail')]['title']:'';?></legend>
        <div class="control-group">
            <div class="controls">
                <textarea id="code" style="height: 400px" class="span17" name="mail_file"><?=read_file($mails_path.'/'.$this->input->get('mail'))?></textarea>
            </div>
        </div>
        <div class="form-actions">
            <button class="btn btn-success btn-edit-mails" type="submit" name="submit-mail" value="submit">Submit Form</button>
            <a class="btn btn-default" href="<?=base_url(uri_string());?>" value="submit">Cancel</a>
        </div>
    </fieldset>
<?= form_close(); ?>
<?php else: ?>
    <div class="navbar">
        <div class="navbar-inner">
            <a href="" class="brand none">Emails</a>
        </div>
    </div>
    <table class="table table-striped table-bordered">
        <tbody>
        <?php foreach ($files as $file_name => $file): ?>
            <tr class="align-center">
                <td class="span6">
                    <a href="<?=base_url(uri_string().'?mail='.$file_name); ?>"><?=@$file['title'];?> [size: <?=@$file['size'];?> byte]</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>