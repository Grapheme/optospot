<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view("admin_interface/includes/head"); ?>
</head>
<body>
<?php $this->load->view("admin_interface/includes/header"); ?>
<div class="container">
    <div class="row">
        <div class="span19">
            <div class="navbar">
                <div class="navbar-inner">
                    <a class="brand none" href="">Withdraw for AstroPay</a>
                </div>
            <?php if(!empty($post_data['control'])):?>
                <form action="<?=$this->config->item('astropay_base_url').'request_cashout';?>" method="POST" class="form-horizontal">
                    <input type="hidden" name="login" value="<?=$post_data['login'];?>">
                    <input type="hidden" name="pass" value="<?=$post_data['pass'];?>">
                    <input type="hidden" name="external_id" value="<?=$post_data['external_id'];?>">
                    <input type="hidden" name="iban" value="<?=$post_data['iban'];?>">
                    <input type="hidden" name="currency" value="<?=$post_data['currency'];?>">
                    <input type="hidden" name="notification_url" value="<?=$post_data['notification_url'];?>">
                    <input type="hidden" name="type" value="<?=$post_data['type'];?>">

                    <input type="hidden" name="beneficiary" value="<?=$post_data['beneficiary'];?>">
                    <input type="hidden" name="beneficiary_id" value="<?=$post_data['beneficiary_id'];?>">
                    <input type="hidden" name="cpf" value="<?=$post_data['cpf'];?>">
                    <input type="hidden" name="country" value="<?=$post_data['country'];?>">
                    <input type="hidden" name="bank" value="<?=$post_data['bank'];?>">
                    <input type="hidden" name="bank_branch" value="<?=$post_data['bank_branch'];?>">
                    <input type="hidden" name="bank_account" value="<?=$post_data['bank_account'];?>">
                    <input type="hidden" name="account_type" value="<?=$post_data['account_type'];?>">
                    <input type="hidden" name="amount" value="<?=$post_data['amount'];?>">
                    <input type="hidden" name="comments" value="<?=$post_data['comments'];?>">

                    <input type="hidden" name="control" value="<?=$post_data['control'];?>">

                    <div class="withdraw-div">
                    <?php if(!empty($post_data['beneficiary'])):?>
                        <label>User’s full name: <strong><?=$post_data['beneficiary']?></strong></label>
                    <?php endif;?>
                        <label>User’s personal identification number: <strong><?=$post_data['cpf']?></strong></label>
                        <label>The user’s country: <strong><?=$post_data['country']?></strong></label>
                        <label>Bank Name of the user: <strong><?=$post_data['bank']?></strong></label>
                        <label>The branch of the bank: <strong><?=$post_data['bank_branch']?></strong></label>
                        <label>The user bank account: <strong><?=$post_data['bank_account']?></strong></label>
                        <label>The type of account: <strong><?=$post_data['account_type']?></strong></label>
                        <label>Amount for withdrawal: <strong><?=$post_data['amount']?></strong></label>
                    <?php if(!empty($post_data['comments'])):?>
                        <label>Comments: <br><?=$post_data['comments']?></label>
                    <?php endif;?>
                    </div>
                    <div class="form-actions">
                        <button class="btn btn-success btn-withdrawal" type="submit" value="Continue">Send a request</button>
                        <a class="btn btn-link" href="<?=$this->session->userdata('backpath');?>">Cancel</a>
                    </div>
                </form>
            <?php else:?>
                <p>Parameter "control" is empty!</p>
                <a class="btn btn-link" href="<?=$this->session->userdata('backpath');?>">Back</a>
            <?php endif;?>
            </div>
        </div>
        <?php $this->load->view("admin_interface/includes/rightbar"); ?>
    </div>
</div>
<?php $this->load->view("admin_interface/includes/scripts"); ?>
</body>
</html>