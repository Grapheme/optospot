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
            <p><?=$this->localization->getLocalMessage('registration-affiliate','annotation')?></p>
            <div class="span9">
                <div class="signup-form" id="affiliate-signup">
                    <?php $this->load->view("clients_interface/forms/register-affiliate-account");?>
                </div>
            </div>
        </div>
        <?php $this->load->view("clients_interface/includes/rightbar");?>
    </div>
</div>
<?php $this->load->view("clients_interface/includes/scripts");?>
</body>
</html>