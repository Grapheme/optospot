<?php $this->load->view("html/chat"); ?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?=baseURL('js/vendor/jquery-1.10.2.min.js');?>"><\/script>')</script>
<script type="text/javascript" src="<?=baseURL('js/vendor/bootstrap.min.js');?>"></script>
<script type="text/javascript" src="<?=baseURL('js/vendor/jquery.form.js');?>"></script>
<script type="text/javascript" src="<?=baseURL('js/vendor/jquery.inputmask.js');?>"></script>
<script type="text/javascript" src="<?=baseURL('js/libs/localize.js');?>"></script>
<script type="text/javascript" src="<?=baseURL('js/libs/base.js');?>"></script>

<script type="text/javascript" src="<?=baseURL('js/cabinet/clients.js');?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("li[num='<?=$this->uri->segment(2);?>']").addClass('active');
        $(".backpath").click(function(){
                mt.redirect("<?=$this->session->userdata('backpath');?>")}
        );
    });
</script>