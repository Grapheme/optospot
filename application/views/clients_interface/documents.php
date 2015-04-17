<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view("clients_interface/includes/head");?>
</head>
<body>
	<?php $this->load->view("clients_interface/includes/header");?>
	<div class="container">
		<div class="row">
			<div class="span19">
				<div class="navbar">
					<div class="navbar-inner">
						<a class="brand no-clickable" href=""><?=$this->localization->getLocalButton('user_documents','doc_verification')?></a>
					</div>
				</div>
				<?php $this->load->view("alert_messages/alert-error");?>
				<?php $this->load->view("alert_messages/alert-success");?>
				<div>
					<?=$this->localization->getLocalMessage('documents','annotation')?>
				</div>
				<div class="clear"> </div>
				<div>
					<table class="table opt-table">
						<thead>
						<tr>
							<th><?=$this->localization->getLocalButton('user_documents','doc_link')?></th>
							<th><?=$this->localization->getLocalButton('user_documents','doc_date_upload')?></th>
							<th><?=$this->localization->getLocalButton('user_documents','doc_approved')?></th>
							<th><?=$this->localization->getLocalButton('user_documents','doc_actions')?></th>
						</tr>
						</thead>
						<tbody>
							<tr>
								<td>
                                <?php if(isset($documents[1])):?>
                                    <a href="<?=$this->baseURL.$documents[1]['path'];?>" target="_blank">
                                        <?=$this->localization->getLocalButton('user_documents','identity_card');?>
                                    </a>
                                <?php else:?>
                                    <?=$this->localization->getLocalButton('user_documents','identity_card');?>
                                <?php endif;?>
                                </td>
                                <td>
                                <?php if(isset($documents[1])):?>
                                    <?=swap_dot_date_with_time($documents[1]['created_at']);?>
                                <?php endif;?>
                                </td>
								<td>
                            <?php if(isset($documents[1])):?>
                                <?php if($documents[1]['approved'] == 0):?>
                                    <?=$this->localization->getLocalButton('user_documents','documents_checked');?>
                                <?php elseif($documents[1]['approved'] == 1):?>
                                    <?=$this->localization->getLocalButton('user_documents','documents_approved');?>
                                <?php elseif($documents[1]['approved'] == 2):?>
                                    <a class="js-popover" data-content="<?=htmlspecialchars($documents[1]['comment']);?>" data-placement="bottom" data-toggle="popover" href="javascript:void(0);" data-trigger="hover" data-original-title="<?=$this->localization->getLocalButton('user_documents','reason_rejection');?>">
                                        <?=$this->localization->getLocalButton('user_documents','documents_reject');?>
                                    </a>
                                <?php endif;?>
                            <?php endif;?>
                                </td>
								<td>
                                <?php if(!isset($documents[1]) || $documents[1]['approved'] == 2):?>
                                    <?php $this->load->view('clients_interface/forms/upload-document',array('ids'=>'identity_card','type'=>1));?>
                                <?php endif;?>
                                </td>
							</tr>
                            <tr>
								<td>
                                <?php if(isset($documents[2])):?>
                                    <a href="<?=$this->baseURL.$documents[2]['path'];?>" target="_blank">
                                        <?=$this->localization->getLocalButton('user_documents','identity_address');?>
                                    </a>
                                <?php else:?>
                                    <?=$this->localization->getLocalButton('user_documents','identity_address');?>
                                <?php endif;?>
                                </td>
								<td>
                                <?php if(isset($documents[2])):?>
                                    <?=swap_dot_date_with_time($documents[2]['created_at']);?>
                                <?php endif;?>
                                </td>
								<td>
                            <?php if(isset($documents[2])):?>
                                <?php if($documents[2]['approved'] == 0):?>
                                    <?=$this->localization->getLocalButton('user_documents','documents_checked');?>
                                <?php elseif($documents[2]['approved'] == 1):?>
                                    <?=$this->localization->getLocalButton('user_documents','documents_approved');?>
                                <?php elseif($documents[2]['approved'] == 2):?>
                                    <a class="js-popover" data-content="<?=htmlspecialchars($documents[2]['comment']);?>" data-placement="bottom" data-toggle="popover" href="javascript:void(0);" data-trigger="hover" data-original-title="<?=$this->localization->getLocalButton('user_documents','reason_rejection');?>">
                                        <?=$this->localization->getLocalButton('user_documents','documents_reject');?>
                                    </a>
                                <?php endif;?>
                            <?php endif;?>
                                </td>
								<td>
                                <?php if(!isset($documents[2]) || $documents[2]['approved'] == 2):?>
                                    <?php $this->load->view('clients_interface/forms/upload-document',array('ids'=>'identity_address','type'=>2));?>
                                <?php endif;?>
                                </td>
							</tr>
						</tbody>
					</table>
                <?php if((isset($documents[1]) && $documents[1]['approved'] == 2) || (isset($documents[2]) && $documents[2]['approved'] == 2)):?>
                    <div style="margin: 10px 0 10px 0"><?=$this->localization->getLocalButton('user_documents','documents_rejected');?></div>
                <?php endif;?>
                    <div><?=$this->localization->getLocalMessage('documents','form_format_files')?></div>
					<?=$this->localization->getLocalMessage('documents','form_annotation')?>
				</div>
			</div>
		<?php $this->load->view("clients_interface/includes/rightbar");?>
		</div>
	</div>
	<?php $this->load->view("clients_interface/includes/scripts");?>
<script>
    $(function(){
        $(".js-popover").popover();
        $("#a_identity_card").click(function(){
            $("#file_identity_card").click();
        });
        $("#a_identity_address").click(function(){
            $("#file_identity_address").click();
        });
        $("#file_identity_card").change(function(){
            $("#submit_identity_card").click();
        });
        $("#file_identity_address").change(function(){
            $("#submit_identity_address").click();
        });
    });
</script>
</body>
</html>