<?=form_open(uri_string(),array('class'=>'form-horizontal form-edit-user')); ?>
	<fieldset>
		<legend>The form of editing profile. User login: <em><?=strtolower($account['email']);?></em></legend>
		<ul id="ProductTab" class="nav nav-tabs">
			<li class="active"><a href="#general" data-toggle="tab">General</a></li>
			<li><a href="#address" data-toggle="tab">Address</a></li>
			<li><a href="#additionally" data-toggle="tab">Advanced</a></li>
            <?php if($account['moderator'] == 0):?>
			<li><a href="#documents" data-toggle="tab">Documents</a></li>
            <?php else:?>
                <li><a href="#language" data-toggle="tab">Languages</a></li>
            <?php endif;?>
		</ul>
		<div id="ProductTabContent" class="tab-content">
        <?php
            $ApprovedDocuments = TRUE;
            if(!$account['moderator'] && $documentsList = $this->users_documents->getWhere(NULL,array('user_id'=>$account['id']),TRUE)):
                foreach($documentsList as $document):
                    if ($document['approved'] != 1):
                        $ApprovedDocuments = FALSE;
                        break;
                    endif;
                endforeach;
            else:
                $ApprovedDocuments = FALSE;
            endif;
            ?>
			<div class="tab-pane fade in active" id="general">
				<div class="control-group">
					<label for="first_name" class="control-label">First name: </label>
					<div class="controls">
						<input type="text" class="span10 valid-required" autocomplete="off" name="first_name" value="<?=$account['first_name'];?>">
					</div>
				</div>
				<div class="control-group">
					<label for="last_name" class="control-label">Last name: </label>
					<div class="controls">
						<input type="text" class="span10 valid-required" autocomplete="off" name="last_name" value="<?=$account['last_name'];?>">
					</div>
				</div>
				<div class="control-group">
					<label for="zip_code" class="control-label">Zip code: </label>
					<div class="controls">
						<input type="text" class="span6" name="zip_code" autocomplete="off" value="<?=$account['zip_code'];?>">
					</div>
				</div>
				<div class="control-group">
					<label for="day_phone" class="control-label">Day phone: </label>
					<div class="controls">
						<input type="text" class="span6" name="day_phone" autocomplete="off" value="<?=$account['day_phone'];?>">
					</div>
				</div>
				<div class="control-group">
					<label for="home_phone" class="control-label">Home phone: </label>
					<div class="controls">
						<input type="text" class="span6" name="home_phone" autocomplete="off" value="<?=$account['home_phone'];?>">
					</div>
				</div>
				<div class="control-group">
					<label for="signdate" class="control-label">Date of sign up: </label>
					<div class="controls">
						<label class="checkbox" style="padding-left: 0">
							<span class="label label-info"><?=strtoupper($account['signdate'])?></span>
                        <?php if($ApprovedDocuments):?>
                            <span class="label label-success" style="margin: 10px 0 0 15px;">Verified</span>
                        <?php else:?>
                            <span class="label label-warning" style="margin: 10px 0 0 15px;">Unverified</span>
                        <?php endif;?>
                        </label>
					</div>
				</div>
                <div class="control-group">
                    <label for="moderator" class="control-label">Group</label>
                    <div class="controls">
                        <label class="select" style="padding-left: 0">
                            <select autocomplete="off" name="moderator">
                                <option <?= ($account['moderator'] == 0)? 'selected':'';?> value="0">Trader</option>
                                <option <?= ($account['moderator'] == 1)? 'selected':'';?> value="1">Moderator</option>
                                <option <?= ($account['moderator'] == 2)? 'selected':'';?> value="2">Administrator</option>
                                <option <?= ($account['moderator'] == 3)? 'selected':'';?> value="3">Small administrator</option>
                            </select>
                        </label>
                    </div>
                </div>
			</div>
			<div class="tab-pane fade in" id="address">
				<div class="control-group">
					<label for="address1" class="control-label">Address line 1: </label>
					<div class="controls">
						<textarea rows="1" class="span14" autocomplete="off" name="address1"><?=$account['address1'];?></textarea>
					</div>
				</div>
				<div class="control-group">
					<label for="address2" class="control-label">Address line 2: </label>
					<div class="controls">
						<textarea rows="1" class="span14" autocomplete="off" name="address2"><?=$account['address2'];?></textarea>
					</div>
				</div>
				<div class="control-group">
					<label for="country" class="control-label">Country: </label>
					<div class="controls">
						<input type="text" class="span8" autocomplete="off" name="country" value="<?=$account['country'];?>">
					</div>
				</div>
				<div class="control-group">
					<label for="state" class="control-label">State: </label>
					<div class="controls">
						<input type="text" class="span8" autocomplete="off" name="state" value="<?=$account['state'];?>">
					</div>
				</div>
				<div class="control-group">
					<label for="city" class="control-label">City: </label>
					<div class="controls">
						<input type="text" class="span8" autocomplete="off" name="city" value="<?=$account['city'];?>">
					</div>
				</div>
			</div>
			<div class="tab-pane fade in" id="additionally">
				<div class="control-group">
					<label for="email" class="control-label">User email: </label>
					<div class="controls">
						<input type="text" class="span8" disabled="disabled" autocomplete="off" name="email" value="<?=$account['email'];?>">
					</div>
				</div>
				<div class="control-group">
					<label for="trade_login" class="control-label">Trade login: </label>
					<div class="controls">
						<input type="text" class="span8" disabled="disabled" autocomplete="off" name="trade_login" value="<?=$account['trade_login'];?>">
					</div>
				</div>
				<div class="control-group">
					<label for="password" class="control-label">Trade password: </label>
					<div class="controls">
						<input type="text" class="span8" disabled="disabled" autocomplete="off" name="password" value="<?=$account['password'];?>">
					</div>
				</div>
				<div class="control-group info">
					<label for="remote_id" class="control-label">Trade ID: </label>
					<div class="controls">
						<input type="text" class="span3" disabled="disabled" autocomplete="off" name="remote_id" value="<?=$account['remote_id'];?>">
					</div>
				</div>
				<div class="control-group">
					<label for="status" class="control-label">Status user: </label>
					<div class="controls">
						<label class="checkbox" style="width:0;">
							<input type="checkbox" value="1" id="active" name="active" autocomplete="off" <?=($account['active'])?'checked="checked"':'';?>>
							<?=($account['active'])?'<span class="label label-success">ACTIVE</span>':'<span class="label label-important">DEACTIVE</span>';?>
						</label>
					</div>
				</div>
				<div class="control-group">
					<label for="coach" class="control-label">Status of conversation: </label>
					<div class="controls">
						<label class="checkbox" style="width:0;">
							<input type="checkbox" value="1" id="coach" name="coach" autocomplete="off" <?=(!$account['coach'])?'checked="checked" disabled="disabled"':'';?>>
							<?=(!$account['coach'])?'<span class="label label-success">Completed</span>':'<span class="label label-important">NOT FULFILLED</span>';?>
						</label>
					</div>
				</div>
				<hr/>
				<div class="control-group">
					<label for="language" class="control-label">User language: </label>
					<div class="controls">
						<label class="checkbox" style="padding-left: 0">
							<span class="label"><?=strtoupper($langs[$account['language']-1]['name'])?></span>
						</label>
					</div>
				</div>
			</div>
        <?php if($account['moderator'] == 0):?>
			<div class="tab-pane fade in" id="documents">
				<table class="opt-table">
					<thead>
					<tr>
                        <th>Document</th>
                        <th>Date</th>
                        <th>Action</th>
                        <th>Owerride</th>
					</tr>
					</thead>
					<tbody>
					<?php if(count($documents)):?>
						<?php $this->load->helper('date');?>
						<?php foreach($documents as $document): ?>
							<tr>
								<td>
                                <?php if($document['type'] == 1):?>
                                    <a href="<?=$this->baseURL.$document['path'];?>" target="_blank">Proof of identity</a>
                                <?php else:?>
                                    <a href="<?=$this->baseURL.$document['path'];?>" target="_blank">Proof of address</a>
                                <?php endif;?>
                                </td>
								<td><?=swap_dot_date_with_time($document['created_at']);?></td>
								<td>
                                <?php if($document['approved'] == 0):?>
                                    <a class="js-confirm" href="<?=$this->baseURL.'admin-panel/documents/approve/'.@$document['id']?>">Approve</a> /
                                    <a href="#rejectModal" data-action="<?=$this->baseURL.'admin-panel/documents/reject/'.@$document['id'];?>" role="button" class="js-confirm-modal" data-toggle="modal">Reject</a>
                                <?php elseif($document['approved'] == 1):?>
                                    <p class="text-success">Approved</p>
                                <?php elseif($document['approved'] == 2):?>
                                    <a class="js-popover" data-content="<?=htmlspecialchars(@$document['comment']);?>" data-original-title="Reason for rejection" data-placement="bottom" data-toggle="popover" href="javascript:void(0);" data-trigger="hover">Reject</a>
                                <?php endif;?>
								</td>
                                <td>
                                <?php if($document['approved'] > 0):?>
                                    <a class="js-confirm" href="<?=$this->baseURL.'admin-panel/documents/approve/'.@$document['id']?>">Approve</a> /
                                    <a href="#rejectModal" data-action="<?=$this->baseURL.'admin-panel/documents/reject/'.@$document['id'];?>" role="button" class="js-confirm-modal" data-toggle="modal">Reject</a>
                                <?php endif;?>
                                </td>
							</tr>
						<?php endforeach; ?>
					<?php else:?>
						<tr>
							<td colspan="4"><?=$this->localization->getLocalButton('user_documents','empty_list')?></td>
						</tr>
					<?php endif; ?>
					</tbody>
				</table>
			</div>
        <?php else:?>
            <div class="tab-pane fade in" id="language">
                <table class="opt-table">
                    <thead>
                    <tr>
                        <th>Language title</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $langs = new Languages();
                        $languages = $langs->getAll();
                        $moderator_languages = array();
                        foreach ($this->db->select('language_id')->where('user_id',$account['id'])->get('moderator_languages')->result_array() as $user_lang):
                            $moderator_languages[$user_lang['language_id']] = $user_lang['language_id'];
                        endforeach;
                    ?>
                    <?php foreach($languages as $lang):?>
                        <tr>
                            <td><?=$lang['name']?></td>
                            <td><input type="checkbox" name="langs[]" value="<?=$lang['id']?>" autocomplete="off" <?=(isset($moderator_languages[$lang['id']]))?'checked="checked"':'';?>></td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        <?php endif;?>
		</div>
	</fieldset>
	<div class="form-actions">
		<button class="btn btn-success btn-edit-user" type="submit" name="submit" value="send">Save profile</button>
		<button class="btn backpath" type="button">Cancel</button>
	</div>
<?= form_close(); ?>