<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

	function to_underscore($uri_string){
		
		if(!empty($uri_string)):
			return preg_replace('/[\/ ~%.:\-]+/','_',$uri_string);
		else:
			return FALSE;
		endif;
	}
	
	function getDomainURL($url){
		$parse = parse_url($url,PHP_URL_HOST);
		return preg_replace('/(www\.)/','',$parse);
	}

	function getUrlLink(){
		
		$CI = & get_instance();
		$get = $CI->input->get();
		$getLink = '';
		if($get !== FALSE):
			$temp = array();
			foreach($get as $key => $value):
				$temp[] = $key.'='.$value;
			endforeach;
			$getLink = '?'.implode('&',$temp);
		endif;
		return $getLink;
	}
	
	function noFirstSegment($url = NULL,$pos = 1){
		
		$getLink = '';
		if(!is_null($url)):
			$temp = explode('/',$url);
			for($i=$pos;$i<count($temp);$i++):
				$getLink .= $temp[$i];
				if(isset($temp[$i+1])):
					$getLink .= '/';
				endif;
			endfor;
		endif;
		return $getLink;
	}
	
	function noLanguage($uri_string,$only_uri = FALSE){
		
		$CI = & get_instance();
		$langURI = $CI->language_url;

        $languages = '';
        foreach($CI->db->select('uri')->get('languages')->result_array() as $lang):
            $languages[] = $lang['uri'];
        endforeach;
        $languages = implode('|',$languages);
		if(!empty($uri_string)):
			return preg_replace('/(.*)\/('.$languages.')(\/)?(.*)?/',"$1/$langURI/$4",$uri_string);
		else:
			return FALSE;
		endif;
	}
	
	function baseURL($url = NULL){
		
		$CI = & get_instance();
		$baseURL = $CI->baseURL;
		if(!is_null($url)):
			return $baseURL.$url;
		else:
			return $baseURL;
		endif;
		
	}
?>