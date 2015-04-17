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
                    <a class="brand none" href=""><?=$this->localization->getLocalButton('client_cabinet','partner-program')?></a>
                </div>
            </div>
            <p>
                <?=$this->localization->getLocalMessage('partner-program','annotation')?>
            </p>
            <p>
                <a href="<?=site_url('').'?pp='.$this->profile['id'];?>"><?=site_url('').'?pp='.$this->profile['id'];?></a>
            </p>
            <p>
                <?=$this->localization->getLocalMessage('partner-program','invite_annotation')?>
            </p>
            <?php if(count(@$partners)):?>
            <table id="div_deposit_value" class="opt-table">
                <thead>
                    <tr>
                        <th width="100px"><?=$this->localization->getLocalMessage('partner-program','invite_account_name')?></th>
                        <th width="150px"><?=$this->localization->getLocalMessage('partner-program','invite_account_summa')?></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($partners as $partner):?>
                    <tr>
                        <td><?=$partner['first_name'].' '.$partner['last_name'];?></td>
                        <td></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <?php else:?>
            <p>
                <?=$this->localization->getLocalMessage('partner-program','partners_list_empty')?>
            </p>
            <?php endif;?>
        </div>
        <?php $this->load->view("clients_interface/includes/rightbar");?>
    </div>
</div>
<?php $this->load->view("clients_interface/includes/scripts");?>
</body>
</html>