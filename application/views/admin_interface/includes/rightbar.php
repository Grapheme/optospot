<div class="span5">
	<div class="well sidebar-nav">
		<ul class="nav nav-pills nav-stacked">
            <li class="nav-header">Navigation</li>
            <li num="home"><?=anchor('','Home page');?></li>
        <?php if($this->account['id'] == 0):?>
			<li num="users-list"><?=anchor('admin-panel/actions/users-list','Accounts');?></li>
			<li num="withdraw"><?=anchor('admin-panel/withdraw','Withdrawal');?></li>
			<?php $countDocuments = $this->db->where('approved',0)->count_all_results('users_documents');?>
			<li num="documents">
				<?php if($countDocuments > 0):?>
					<?=anchor('admin-panel/documents','Documents <span class="badge">'.$countDocuments.'</span>');?>
				<?php else:?>
					<?=anchor('admin-panel/documents','Documents');?>
				<?php endif; ?>
			</li>
        <?php endif;?>
			<li num="pages"><?=anchor('admin-panel/actions/pages','Content');?></li>
        <?php if($this->account['id'] == 0): ?>
			<li num="settings"><?=anchor('admin-panel/actions/settings','Settings');?></li>
			<li num="log"><?=anchor('admin-panel/log','Logs List');?></li>
			<li class="nav-header">Actions</li>
			<li><?=anchor('admin-panel/registered','Registered');?></li>
        <?php endif;?>
			<li><?=anchor('logoff','Logout');?></li>
		</ul>
	</div>
</div>