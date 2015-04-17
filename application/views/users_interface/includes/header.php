<header>
	<div class="container_12 top-div">
		<div class="grid_2">
			&nbsp;
			<a href="<?=site_url('/');?>" class="header-logo<?=($this->uri->total_segments() == 1)?' no-clickable':'';?>"></a>
		</div>
		<?php $this->load->view('users_interface/includes/top-menu');?>
	</div>
</header>