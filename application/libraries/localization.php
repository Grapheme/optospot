<?php if(!defined('BASEPATH')) exit('no direct scripting allowed');

class Localization {
	
	var $languages = array(ENGLAN,RUSLAN,INDLAN);
	var $CI;
	var $baseURL = '';
	var $baseDIR = '';
	
	public function __construct(){
		
		$this->CI = & get_instance();
		$this->baseURL = $this->CI->config->item('base_url').'localization/';
		$this->baseDIR = getcwd().'/localization/';
	}
	
	function getFilePath($file = ''){

		if(!empty($file)):
			if(array_search($this->CI->uri->segment(1),$this->languages) !== FALSE):
				return $this->baseDIR.$this->CI->uri->segment(1).'/'.$file.'.php';
			else:
				return $this->baseDIR.ENGLAN.'/'.$file.'.php';
			endif;
		endif;
		return NULL;
	}
	
	function getLocalPlaceholder($section = '',$method = ''){
		
		if(!empty($method) && !empty($section)):
			include($this->getFilePath('placeholders'));
			return @$localize[$section][$method];
		endif;
		return '';
	}
	
	function getLocalButton($section = '',$method = ''){
		
		if(!empty($method) && !empty($section)):
			include($this->getFilePath('buttons'));
			return @$localize[$section][$method];
		endif;
		return '';
	}
	
	function getLocalMessage($section = '',$method = ''){
		
		if(!empty($method) && !empty($section)):
			include($this->getFilePath('messages'));
			return @$localize[$section][$method];
		endif;
		return '';
	}
	
	function getProblemPlace($section = '',$method = ''){
		
		$localize[ENGLAN] = array(
			'client_cabinet' => array(
				'balance_title' => 'Cabinet - Deposit Info',
				'balance_description' => '',
			)
		);
		$localize[RUSLAN] = array(
			'client_cabinet' => array(
				'balance_title' => 'Личный кабинет - Пополнить счет',
				'balance_description' => '',
			)
		);
		$localize[INDLAN] = array(
			'client_cabinet' => array(
				'balance_title' => 'Cabinet - Deposit Info',
				'balance_description' => '',
			)
			
		);
		return $localize[$this->CI->uri->segment(1)][$section][$method];
	}
	
	function getUserDocuments($section = '',$method = ''){
		
		$localize[ENGLAN] = array(
			'client_cabinet' => array(
				'title' => 'Cabinet - Documents',
				'description' => '',
			)
		);
		$localize[RUSLAN] = array(
			'client_cabinet' => array(
				'title' => 'Личный кабинет - Документы',
				'description' => '',
			)
		);
		$localize[INDLAN] = array(
			'client_cabinet' => array(
				'title' => 'Cabinet - вocuments',
				'description' => '',
			)
			
		);
		return $localize[$this->CI->uri->segment(1)][$section][$method];
	}

    function getWithdrawPlace($section = '',$method = ''){

		$localize[ENGLAN] = array(
			'client_cabinet' => array(
				'balance_title' => 'Cabinet - Withdrawal',
				'balance_description' => '',
			)
		);
		$localize[RUSLAN] = array(
			'client_cabinet' => array(
				'balance_title' => 'Личный кабинет - Вывод средств',
				'balance_description' => '',
			)
		);
		$localize[INDLAN] = array(
			'client_cabinet' => array(
				'balance_title' => 'Cabinet - withdrawal',
				'balance_description' => '',
			)

		);
		return $localize[$this->CI->uri->segment(1)][$section][$method];
	}
}