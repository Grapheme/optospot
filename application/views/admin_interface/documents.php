<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view("admin_interface/includes/head");?>
</head>
<body>
<?php $this->load->view("admin_interface/includes/header");?>
<div class="container">
    <div class="row">
        <div class="span19">
            <div class="navbar">
                <div class="navbar-inner">
                    <a class="brand none" href="">Documents</a>
                </div>
            </div>
            <?php $this->load->view("alert_messages/alert-error");?>
            <?php $this->load->view("alert_messages/alert-success");?>
            <div>
                <table class="opt-table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>User name</th>
                        <th>Document</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                <?php if(count($documents)):?>
                    <?php $this->load->helper('date');?>
                     <?php $style = '';?>
                    <?php foreach($documents as $account_id => $account_documents): ?>
                        <?php $showDocuments = FALSE;?>
                        <?php foreach($account_documents as $document): ?>
                            <?php if($document['approved'] != 1):?>
                                <?php $showDocuments = TRUE;?>
                            <?php endif;?>
                        <?php endforeach; ?>
                    <?php if($showDocuments):?>
                        <?php foreach($account_documents as $document): ?>
                        <tr<?=$style;?>>
                            <td><?=$document['trade_login'];?></td>
                            <td><a href="<?=$this->baseURL.'admin-panel/actions/users/edit/id/'.$account_id;?>" target="_blank"><?=$document['name']?></a></td>
                            <td>
                            <?php if($document['type'] == 1):?>
                                <a href="<?=$this->baseURL.$document['path'];?>" target="_blank">Proof of identity</a>
                            <?php else:?>
                                <a href="<?=$this->baseURL.$document['path'];?>" target="_blank">Proof of address</a>
                            <?php endif;?>
                            </td>
                            <td><?=swap_dot_date_with_time($document['date']);?></td>
                            <td>
                            <?php if($document['approved'] == 0):?>
                                <a class="js-confirm" href="<?=$this->baseURL.'admin-panel/documents/approve/'.$document['document_id']?>">Approve</a> /
                                <a href="#rejectModal" data-action="<?=$this->baseURL.'admin-panel/documents/reject/'.$document['document_id'];?>" role="button" class="js-confirm-modal" data-toggle="modal">Reject</a>
                            <?php elseif($document['approved'] == 1):?>
                                <p class="text-success">Approved</p>
                            <?php elseif($document['approved'] == 2):?>
                                <a class="js-popover" data-content="<?=htmlspecialchars($document['comment']);?>" data-original-title="Reason for rejection" data-placement="bottom" data-toggle="popover" href="javascript:void(0);" data-trigger="hover">Reject</a>
                            <?php endif;?>
                            </td>
                            <?php $style = '';?>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif;?>
                        <?php $style = ' style="border-top:1pt solid black;"';?>
                    <?php endforeach; ?>
                <?php else:?>
                        <tr>
                            <td colspan="5"><?=$this->localization->getLocalButton('user_documents','empty_list')?></td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div id="rejectModal" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <form style="margin: 0;" id="form-delete-document" action="#" method="post">
                <div class="modal-header">
                    <h3 id="myModalLabel">Reject document</h3>
                </div>
                <div class="modal-body">
                    <p>Specify reason for rejection.</p>
                    <textarea style="width: 500px; height: 100px;" name="content"></textarea>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                    <button type="submit" class="btn btn-primary">Reject</button>
                </div>
            </form>
        </div>
        <?php $this->load->view("admin_interface/includes/rightbar");?>
    </div>
</div>
<?php $this->load->view("admin_interface/includes/scripts");?>
<script>
    $(function(){
        $(".js-popover").popover();
    });
</script>
</body>
</html>