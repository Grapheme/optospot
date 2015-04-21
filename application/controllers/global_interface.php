<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Global_interface extends MY_Controller{
	
	function __construct(){
		
		parent::__construct();
		$this->load->model('languages');
	}
	
	public function changeLanguage(){
	
		if($this->uri->segment(3) !== FALSE):
			if($newLanguage = $this->languages->languageExist($this->uri->segment(3))):
				$this->language = $newLanguage['id'];
				$this->language_url = $newLanguage['uri'];
				if($this->auth()):
					$this->accounts->updateField($this->account['id'],'language',$newLanguage['id']);
					$this->profile = $this->accounts->getWhere($this->account['id']);
					$this->session->set_userdata('profile',json_encode($this->profile));
				endif;
				$this->config->set_item('base_url',$this->baseURL.$this->language_url.'/');
			endif;
		endif;
		if(isset($_SERVER['HTTP_REFERER'])):
			redirect(noLanguage($_SERVER['HTTP_REFERER']));
		else:
			redirect();
		endif;
	}
}