<a id="a_<?=$ids;?>" href="javascript:void(0)"><?=$this->localization->getLocalButton('user_documents','doc_action_upload')?></a>
<div class="hidden">
    <form action="<?=site_url('cabinet/documents/upload');?>" id="form_<?=$ids;?>" enctype="multipart/form-data" method="post">
        <input type="hidden" name="type" value="<?=$type;?>" />
        <input id="file_<?=$ids;?>" type="file" name="file" />
        <button type="submit" class="btn btn-action btn-upload" id="submit_<?=$ids;?>" name="submit"><?=$this->localization->getLocalButton('user_documents','upload_submit')?></button>
    </form>
</div>