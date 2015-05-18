<?php
$documentsTitle = 'Documents';
if($countDocuments = $this->db->where('approved',0)->count_all_results('users_documents')):
    $documentsTitle = 'Documents <span class="badge">'.$countDocuments.'</span>';
endif;
?>
<div class="span5">
	<div class="well sidebar-nav">
		<ul class="nav nav-pills nav-stacked">
            <li class="nav-header">Navigation</li>
<?php if(MY_Controller::sectionRoles('home')): ?><li num="home"><?=anchor('','Home page');?></li><?php endif;?>
<?php if(MY_Controller::sectionRoles('users-list')): ?><li num="users-list"><?=anchor('admin-panel/actions/users-list','Accounts');?></li><?php endif;?>
<?php if(MY_Controller::sectionRoles('withdraw')): ?><li num="withdraw"><?=anchor('admin-panel/withdraw','Withdrawal');?></li><?php endif;?>
<?php if(MY_Controller::sectionRoles('documents')): ?><li num="documents"><?=anchor('admin-panel/documents',$documentsTitle);?></li><?php endif; ?>
<?php if(MY_Controller::sectionRoles('pages')): ?><li num="pages"><?=anchor('admin-panel/actions/pages','Content');?></li><?php endif;?>
<?php if(MY_Controller::sectionRoles('settings')): ?><li num="settings"><?=anchor('admin-panel/actions/settings','Settings');?></li><?php endif;?>
<?php if(MY_Controller::sectionRoles('log')): ?><li num="log"><?=anchor('admin-panel/log','Logs List');?></li><?php endif;?>
            <li class="nav-header">Actions</li>
                <li num="profile"><?=anchor('admin-panel/profile','Profile');?></li>
<?php if(MY_Controller::sectionRoles('registered')): ?><li num="registered"><?=anchor('admin-panel/registered','Registered');?></li><?php endif;?>
			<li><?=anchor($this->language_url.'/logoff','Logout');?></li>
		</ul>
	</div>
</div>