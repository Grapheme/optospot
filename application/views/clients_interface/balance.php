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
						<a class="brand none" href=""><?=$this->localization->getLocalButton('client_cabinet','balance')?></a>
					</div>
				</div>
				<?php $this->load->view("alert_messages/alert-error");?>
				<?php $this->load->view("alert_messages/alert-success");?>
				<p>
					<?=$this->localization->getLocalMessage('payment','annotation')?>
				</p>
				<div>
				<?php if(!empty($accounts)):?>
					<div class="clear"> </div>
					<div id="deposit_system" class="none-display clearfix">
						<button type="button" class="pay-btn submit_deposit_form" data-form-id="form_rbkmoney"><img src="<?=baseURL('img/visamc.png');?>" /></button>
					<?php foreach($accounts as $system => $account):?>
						<button type="button" class="pay-btn submit_deposit_form" data-form-id="form_<?=$system;?>"><img src="<?=baseURL('img/'.$system.'.png');?>" /></button>
					<?php endforeach; ?>
                        <a href="<?=site_url('wire-deposit-insftuction');?>" target="-_blank" class="pay-btn submit_deposit_form" data-form-id="form_wire_transfer"><img style="width: 220px;height: 112px;" src="<?=baseURL('img/wire_transfer.png');?>" /></a>
						<hr/>
						<button type="button" id="submit_deposit_form_cancel" class="btn btn-mini btn-success"><?=$this->localization->getLocalButton('client_cabinet','deposit_submit_cancel');?></button>
					</div>
				<?php endif;?>
					<table id="div_deposit_value" class="opt-table">
						<thead>
							<tr>
								<th><?=$this->localization->getLocalButton('client_cabinet','account')?></th>
								<th><?=$this->localization->getLocalButton('client_cabinet','deposit')?>, $</th>
								<th><?=$this->localization->getLocalButton('client_cabinet','amount')?></th>
							</tr>
						</thead>
						<tbody>
					<?php if(!empty($accounts)):?>
							<tr>
								<td width="100px"><?=(isset($accounts['dengionline']['accountId']))?$accounts['dengionline']['accountId']:'undefined';?></td>
								<td width="150px"><?=(isset($accounts['dengionline']['amount']))?$accounts['dengionline']['amount']:'undefined';?></td>
								<td>
									<input class="opt-input" id="deposit_value" autocomplete="off" type="text" class="span2" value="50" />
									<button type="submit" id="set_deposit_value" class="opt-btn"><?=$this->localization->getLocalButton('client_cabinet','deposit_funds')?></button>
								</td>
							</tr>
						<?php foreach($accounts as $system => $account):?>
							<tr class="none-display">
								<td width="100px">&nbsp;</td>
								<td width="150px">&nbsp;</td>
								<td>
									<form id="form_<?=$system;?>" method="post" action="<?=@$account['deposit'];?>">
                                    <?php if($system != 'perfectmoney'): ?>
                                        <input type="hidden" name="amount" value="50" />
                                        <input type="hidden" name="account" value="<?= @$account['accountId']; ?>" />
										<input type="hidden" name="success" value="<?=site_url(USER_START_PAGE.'?status=success')?>" />
										<input type="hidden" name="cancel" value="<?=site_url(USER_START_PAGE.'?status=failure')?>" />
                                    <?php else: ?>
                                        <input type="hidden" name="PAYEE_ACCOUNT" value="U7342695">
                                        <input type="hidden" name="PAYEE_NAME" value="OptoSpot">
                                        <input type='hidden' name='PAYMENT_ID' value='<?=$payment_id;?>'>
                                        <input type="hidden" name="PAYMENT_AMOUNT" value="50">
                                        <input type="hidden" name="PAYMENT_UNITS" value="USD">
                                        <input type="hidden" name="STATUS_URL" value="<?=site_url('perfectmoney/checked');?>">
                                        <input type="hidden" name="PAYMENT_URL" value="<?=site_url(USER_START_PAGE.'?status=success')?>">
                                        <input type="hidden" name="PAYMENT_URL_METHOD" value="POST">
                                        <input type="hidden" name="NOPAYMENT_URL" value="<?=site_url(USER_START_PAGE.'?status=failure')?>">
                                        <input type="hidden" name="NOPAYMENT_URL_METHOD" value="POST">
                                        <input type="hidden" name="SUGGESTED_MEMO" value="">
                                        <input type="hidden" name="BAGGAGE_FIELDS" value="IDENT"><br>
                                    <?php endif; ?>
										<button id="submit_<?=$system;?>" type="submit">Submit</button>
									</form>
								</td>
							</tr>
						<?php endforeach; ?>
					<? else : ?>
							<div class="alert-error">
								<p>Error while requesting user balance. Please send email to support@optospot.net with problem description.</p>
							</div>
					<? endif; ?>
						</tbody>
					</table>	
				</div>
				<?=$this->localization->getLocalMessage('payment','description')?>
			</div>
		<?php $this->load->view("clients_interface/includes/rightbar");?>
		</div>
	</div>
	<?php $this->load->view("clients_interface/includes/scripts");?>
</body>
</html>