<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	
	var $account = array('id'=>0,'demo'=>0);
	var $profile = '';
	var $loginstatus = FALSE;
	
	var $baseURL = '';
	var $language = 0;
	var $language_url = 'en';

    var $section_roles = array(
        0 => FALSE,
        1 => 'home|pages',
        2 => 'home|users-list|users|withdraw|documents|settings|log|pages|registered',
        3 => 'home|users-list|users|withdraw|documents|pages',
    );

	function __construct(){
		
		parent::__construct();
		$this->baseURL = base_url();
		
		if($this->session->userdata('logon') !== FALSE):
			if($this->account = json_decode($this->session->userdata('account'),TRUE)):
				if($this->session->userdata('profile') == FALSE):
					$profile = $this->accounts->getWhere($this->account['id']);
					if($profile && ($this->session->userdata('logon') == md5($profile['email']))):
						$this->profile = $profile;
						$this->session->set_userdata('profile',json_encode($this->profile));
						$this->loginstatus = TRUE;
					endif;
				else:
					$this->profile = json_decode($this->session->userdata('profile'),TRUE);
					$this->loginstatus = TRUE;
				endif;
			endif;
		endif;
        if ($this->loginstatus):
            if ($this->profile['moderator'] == 2):
                error_reporting(1);
                ini_set('error_reporting', E_ALL);
            endif;
            if ($this->is_moderator()):
                foreach($this->section_roles as $group => $roles):
                    $this->section_roles[$group] = $roles ? explode('|',$roles) : FALSE;
                endforeach;
            endif;
        endif;
	}
	
	public function clearSession($redirect = TRUE){
		
		if($this->session->userdata('signinvk') || $this->session->userdata('signinfb')):
			$this->session->unset_userdata(array('signinvk' => '','signinfb' => ''));
		elseif($this->session->userdata('step') !== FALSE):
			$this->session->unset_userdata(array('newCourseID'=>'','newProjectID'=>'','step'=>''));
		endif;
		if($redirect == TRUE):
			redirect('');
		endif;
		return TRUE;
		
	}
	
	public function setLoginSession($accountID){

		if($accountInfo = $this->accounts->getWhere($accountID)):
			$account = json_encode(array('id'=>$accountInfo['id'],'demo'=>$accountInfo['demo']));
			$this->session->set_userdata(array('logon'=>md5($accountInfo['email']),'account'=>$account));
			return TRUE;
		endif;
		return FALSE;
	}
	
	public function clearTemporaryCode($accountID){
		
		if(!empty($this->profile['password'])):
			$this->accounts->updateField($accountID,'temporary_code','');
			$this->accounts->updateField($accountID,'code_life','0');
		endif;
	}
	
	public function getAccountLoginBlock($accountID){
		
		$this->profile = $this->accounts->getWhere($accountID);
		$this->account['id'] = $accountID;
		$this->loginstatus = TRUE;
		$this->session->set_userdata('profile',json_encode($this->profile));
		return $this->load->view('html/user-block',NULL,TRUE);
	}
	
	/*************************************************************************************************************/
	public function getTradeAccountInfoDengiOnLine(){
		
		
		$contents = array();
		$result = array('accounts'=>array(),'action_deposit'=>FALSE);
		try{
			$postdata = http_build_query(array('j_username' => $this->profile['trade_login'], 'j_password' => $this->encrypt->decode($this->profile['trade_password'])));
			$opts = array('http' => array('method'=>'POST','header'=>'Content-type: application/x-www-form-urlencoded','content'=>$postdata));
			$context  = stream_context_create($opts);
			$json_string = file_get_contents('http://dengionline.sysfx.com:8080/deal.184/service/serviceLogin.jsp',false, $context);
			$res = json_decode($json_string,true);
			if(isset($res['errorCode'])):
				$pagevar['msgs'] = $res['message'];
			elseif( $res['status'] != 'LOGIN' ):
				$pagevar['msgr'] =  'Error while requesting user balance. Please send email to support@optospot.net with problem description.';
			endif;
			$jsessionid = @$res['jsessionid'];
//			setcookie('jsessioniddengionline', $jsessionid, time() + (86400 * 7)); // 86400 = 1 day
			$opts = array('http' => array('method' => 'GET', 'header'=> 'Cookie: jsessionid=' . $jsessionid."\r\n"));
			$context = stream_context_create($opts);
			$contents = file_get_contents('http://dengionline.sysfx.com:8080/deal.184/service/secure/serviceAccounts.jsp;jsessionid='.$jsessionid, false, $context);
		} catch (Exception $e) {
			
		}
		if($result['accounts'] = json_decode($contents, true)):
			$result['accounts'] = (isset($result['accounts'][0]))?$result['accounts'][0]:array();
		endif;
		$this->load->model('settings');
		$result['action_deposit'] = 'jsessionid='.$jsessionid;
		return $result;
	}
	
	public function getTradeAccountInfoRBKMoney(){
		
		$contents = array();
		$result = array('accounts'=>array(),'action_deposit'=>FALSE);
		try{
			$postdata = http_build_query(array('j_username' => $this->profile['trade_login'], 'j_password' => $this->encrypt->decode($this->profile['trade_password'])));
			$opts = array('http' => array('method'=>'POST','header'=>'Content-type: application/x-www-form-urlencoded','content'=>$postdata));
			$context  = stream_context_create($opts);
			$json_string = file_get_contents('https://optospot.sysfx.com/rbkmoney/service/serviceLogin.jsp',false, $context);
			$res = json_decode($json_string,true);
			if(isset($res['errorCode'])):
				$pagevar['msgs'] = $res['message'];
			elseif( $res['status'] != 'LOGIN' ):
				$pagevar['msgr'] =  'Error while requesting user balance. Please send email to support@optospot.net with problem description.';
			endif;
			$jsessionid = @$res['jsessionid'];
//			setcookie('jsessionidrbkmoney', $jsessionid, time() + (86400 * 7)); // 86400 = 1 day
			$opts = array('http' => array('method' => 'GET', 'header'=> 'Cookie: jsessionid=' . $jsessionid."\r\n"));
			$context = stream_context_create($opts);
			$contents = file_get_contents('https://optospot.sysfx.com/rbkmoney/service/secure/serviceAccounts.jsp;jsessionid='.$jsessionid, false, $context);
		} catch (Exception $e) {
			
		}
		if($result['accounts'] = json_decode($contents, true)):
			$result['accounts'] = (isset($result['accounts'][0]))?$result['accounts'][0]:array();
		endif;
		$this->load->model('settings');
		$result['action_deposit'] = 'jsessionid='.$jsessionid;
		return $result;
	}
	
	public function getTradeAccountInfoOkPay(){
		
		$contents = array();
		$result = array('accounts'=>array(),'action_deposit'=>FALSE);
		try{
			$postdata = http_build_query(array('j_username' => $this->profile['trade_login'], 'j_password' => $this->encrypt->decode($this->profile['trade_password'])));
			$opts = array('http' => array('method'=>'POST','header'=>'Content-type: application/x-www-form-urlencoded','content'=>$postdata));
			$context  = stream_context_create($opts);
			$json_string = file_get_contents('https://optospot.sysfx.com/okpay/service/serviceLogin.jsp',false, $context);
			$res = json_decode($json_string,true);
			if(isset($res['errorCode'])):
				$pagevar['msgs'] = $res['message'];
			elseif( $res['status'] != 'LOGIN' ):
				$pagevar['msgr'] =  'Error while requesting user balance. Please send email to support@optospot.net with problem description.';
			endif;
			$jsessionid = @$res['jsessionid'];
//			setcookie('jsessionidokpay', $jsessionid, time() + (86400 * 7)); // 86400 = 1 day
			$opts = array('http' => array('method' => 'GET', 'header'=> 'Cookie: jsessionid=' . $jsessionid."\r\n"));
			$context = stream_context_create($opts);
			$contents = file_get_contents('https://optospot.sysfx.com/okpay/service/secure/serviceAccounts.jsp;jsessionid='.$jsessionid, false, $context);
		} catch (Exception $e) {
			
		}
		if($result['accounts'] = json_decode($contents, true)):
			$result['accounts'] = (isset($result['accounts'][0]))?$result['accounts'][0]:array();
		endif;
		$this->load->model('settings');
		$result['action_deposit'] = 'jsessionid='.$jsessionid;
		return $result;
	}

	public function getTradeAccountAstroPay(){

		$contents = array();
		$result = array('accounts'=>array(),'action_deposit'=>FALSE);
		try{
			$postdata = http_build_query(array('j_username' => $this->profile['trade_login'], 'j_password' => $this->encrypt->decode($this->profile['trade_password']),'country'=>'RU'));
			$opts = array('http' => array('method'=>'POST','header'=>'Content-type: application/x-www-form-urlencoded','content'=>$postdata));
			$context  = stream_context_create($opts);
			$json_string = file_get_contents('http://optospot.sysfx.com/astropay.deal.184/service/serviceLogin.jsp',false, $context);
			$res = json_decode($json_string,true);
			if(isset($res['errorCode'])):
				$pagevar['msgs'] = $res['message'];
			elseif( $res['status'] != 'LOGIN' ):
				$pagevar['msgr'] =  'Error while requesting user balance. Please send email to support@optospot.net with problem description.';
			endif;
			$jsessionid = @$res['jsessionid'];
//			setcookie('jsessionidokpay', $jsessionid, time() + (86400 * 7)); // 86400 = 1 day
			$opts = array('http' => array('method' => 'GET', 'header'=> 'Cookie: jsessionid=' . $jsessionid."\r\n"));
			$context = stream_context_create($opts);
			$contents = file_get_contents('http://optospot.sysfx.com/astropay.deal.184/service/secure/serviceAccounts.jsp;jsessionid='.$jsessionid, false, $context);
		} catch (Exception $e) {

		}
		if($result['accounts'] = json_decode($contents, true)):
			$result['accounts'] = (isset($result['accounts'][0]))?$result['accounts'][0]:array();
		endif;
		$this->load->model('settings');
		$result['action_deposit'] = 'jsessionid='.$jsessionid;
		return $result;
	}

    public function getPerfectMoney(){

        $result_accounts = array('accounts'=>array(),'action_deposit'=>FALSE);
        try{
            if($file = fopen('https://perfectmoney.is/acct/balance.asp?AccountID=3408791&PassPhrase=z5JDh3qlYF4IB','rb')):
                $out = "";
                while (!feof($file))
                    $out .= fgets($file);
                fclose($file);
                if (preg_match_all("/<input name='(.*)' type='hidden' value='(.*)'>/", $out, $result, PREG_SET_ORDER)):
                    $ar = "";
                    foreach ($result as $item):
                        $key = $item[1];
                        $ar[$key] = $item[2];
                    endforeach;
                    $result_accounts['accounts'] = $ar;
                endif;
            endif;
        } catch (Exception $e){

        }
        return $result_accounts;
    }
	/*************************************************************************************************************/
	public function pagination($url,$uri_segment,$total_rows,$per_page,$get_string = FALSE){
		
		$this->load->library('pagination');
		if($get_string):
			$config['base_url'] = site_url($url); //передавать полностью строку с get параметрами
			$config['page_query_string'] = TRUE;
			$config['query_string_segment'] = 'offset';
		else:
			$config['base_url'] = site_url($url.'/offset/');
		endif;
		$config['uri_segment'] = $uri_segment;
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page;
		$config['num_links'] = 4;
		$config['first_link'] = 'Home';
		$config['last_link'] = 'End';
		$config['next_link'] = 'Next &raquo;';
		$config['prev_link'] = '&laquo; Previous';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['full_tag_open'] = '<div class="pagination"><ul>';
		$config['full_tag_close'] = '</ul></div>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		return $this->pagination->create_links();
	}
	
	public function pagination_old($url,$uri_segment,$total_rows,$per_page){
		
		$this->load->library('pagination');
		$config['base_url'] = site_url($url.'/offset/');
		$config['uri_segment'] = $uri_segment;
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page;
		$config['num_links'] = 4;
		$config['first_link'] = 'В начало';
		$config['last_link'] = 'В конец';
		$config['next_link'] = 'Далее &raquo;';
		$config['prev_link'] = '&laquo; Назад';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['full_tag_open'] = '<div class="pagination"><ul>';
		$config['full_tag_close'] = '</ul></div>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		return $this->pagination->create_links();
	}
	
	public function AJAX_Pagination(){
		
		$arguments = &func_get_args();
		$model = (isset($arguments[0]['model']))?$arguments[0]['model']:NULL;
		$where = (isset($arguments[0]['where']))?$arguments[0]['where']:NULL;
		$perPage = (isset($arguments[0]['per_page']))?$arguments[0]['per_page']:PER_PAGE_DEFAULT;
		$currentPage = (isset($arguments[0]['page']))?$arguments[0]['page']:1;
		
		$pagination = '';
		if(!is_null($model)):
			$this->load->model($model);
			$count = $this->$model->countAllResults($where);
			if(!empty($count)):
				$pagination = $this->load->view('html/pagination',array('pages'=>ceil($count/PER_PAGE_DEFAULT),'page'=>$currentPage),TRUE);
			endif;
		endif;
		return $pagination;
	}
	
	public function sendMail($to,$from_mail,$from_name,$subject,$text,$attach = NULL){
		
		$this->load->library('phpmailer');
		$mail = new PHPMailer();
		$mail->IsSendmail();
		$mail->SetFrom($from_mail,$from_name);
		$mail->AddReplyTo($from_mail,$from_name);
		$mail->AddAddress($to);
		$mail->Subject = $subject;
		$mail->MsgHTML($text);
		$mail->AltBody = strip_tags($text,'<p>,<br>');
		//$mail->AddAttachment('images/phpmailer-mini.gif');
		return $mail->Send();
		
		
//		$this->load->library('email');
//		$this->email->clear(TRUE);
//		$config['smtp_host'] = 'localhost';
//		$config['charset'] = 'utf-8';
//		$config['wordwrap'] = TRUE;
//		$config['mailtype'] = 'html';
//		$this->email->initialize($config);
//		$this->email->to($to);
//		$this->email->from($from_mail,$from_name);
//		$this->email->bcc('');
//		$this->email->subject($subject);
//		for($i=0;$i<count($attach);$i++):
//			$this->email->attach($attach[$i]['path']);
//		endfor;
//		$this->email->message($text);
//		if($this->email->send()):
//			return $this->email->print_debugger();
//			return TRUE;
//		else:
//			show_error($this->email->print_debugger());
//		endif;
	}
	
	public function loadimage(){
		
		$image = NULL;
		switch($this->uri->segment(2)):
			case 'photo':$image = $this->accounts->getImage($this->uri->segment(3),'photo'); break;
			case 'thumbnail':$image = $this->accounts->getImage($this->uri->segment(3),'thumbnail'); break;
			case 'course':$this->load->model('courses'); $image = $this->courses->getImage($this->uri->segment(3),'image'); break;
			case 'course-thumbnail':$this->load->model('courses'); $image = $this->courses->getImage($this->uri->segment(3),'thumbnail'); break;
		endswitch;
		if(is_null($image) || empty($image)):
			$image = file_get_contents(NO_IMAGE);
		endif;
		header('Content-type: image/gif');
		echo $image;
	}
	
	public function loadResource(){
		
		$resource = NULL;
		if($this->input->get('resource_id') != FALSE && is_numeric($this->input->get('resource_id'))):
			switch($this->uri->segment(1)):
				case 'portfolio': 
					$this->load->model('users_portfolio');
					$record = $this->users_portfolio->getWhere($this->input->get('resource_id'));
					break;
				case 'project-lesson':
					$this->load->model('project_lesson_resources');
					if($record = $this->project_lesson_resources->getWhere($this->input->get('resource_id'))):
						if($this->isMyCourse($record['course']) != FALSE):
							$record['account'] = $this->account['id'];
						elseif($this->account['group'] == ADMIN_GROUP_VALUE):
							$this->load->model('courses');
							$record['account'] = $this->courses->value($record['course'],'account');
						elseif($result = $this->isMySubscribeInCourses(array($record))):
							if(isset($result[0]['mysubscribe']) && $result[0]['mysubscribe'] === TRUE):
								$this->load->model('courses');
								$record['account'] = $this->courses->value($record['course'],'account');
							else:
								$record = NULL;
							endif;
						endif;
					endif;
					break;
			endswitch;
			if(!is_null($record) && isset($record)):
				$resource = file_get_contents(getcwd().'/diskspace/user'.$record['account'].'/'.$record['resource']);
			endif;
		endif;
		if(is_null($resource)):
			$resource = file_get_contents(NO_IMAGE);
		endif;
		header('Content-type: image/gif');
		echo $resource;
	}
	
	public function imageManupulation($userfile,$dim = 'width',$ratio = TRUE,$width = 60,$height = 60){
		
		$this->load->library('image_lib');
		$this->image_lib->clear();
		$config['image_library'] = 'gd2';
		$config['source_image'] = $userfile;
		$config['create_thumb'] = FALSE;
		$config['maintain_ratio'] = $ratio;
		$config['master_dim'] = $dim;
		$config['width'] = $width;
		$config['height'] = $height;
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
	}
	
	public function CropToSquare(){
		
		$arguments = &func_get_args();
		$fileName = (isset($arguments[0]['filepath']))?$arguments[0]['filepath']:NULL;
		$edgeWidth = (isset($arguments[0]['edgeSize']))?$arguments[0]['edgeSize']:800;
		$copy = (isset($arguments[0]['copy']))?TRUE:FALSE;
		
		if(!is_null($fileName) && is_file($fileName)):
			$this->load->library('images');
			$newFile = FALSE;
			if($copy === TRUE):
				$this->load->helper('string');
				$newFile = getcwd().'/temporary/'.random_string('alnum',12).'.tmp';
			endif;
			if($this->images->cropToSquare($fileName,$edgeWidth,$edgeWidth,$newFile)):
				if($copy === TRUE):
					return $newFile;
				else:
					return TRUE;
				endif;
			endif;
		endif;
		return FALSE;
	}
	
	public function getImageContent($content = NULL,$manupulation = NULL){
		
		if(!is_null($content)):
			$filepath = TEMPORARY.'file-content.tmp';
			file_put_contents($filepath,$content);
			if(!is_null($manupulation) && is_array($manupulation)):
				$this->imageManupulation($filepath,$manupulation['dim'],$manupulation['ratio'],$manupulation['width'],$manupulation['height']);
			endif;
			$fileContent = file_get_contents($filepath);
			$this->filedelete($filepath);
			return $fileContent;
		else:
			return '';
		endif;
	}
	
	public function uploadServerFiles($documents,$parameters){
		
		$errorMessage = '';
		if(!isset($parameters['upload_path']) || empty($parameters['upload_path'])):
			$parameters['upload_path'] = getcwd().'/diskspace/user'.$this->account['id'].'/';
		else:
			$parameters['upload_path'] = getcwd().'/diskspace/user'.$this->account['id'].'/'.$parameters['upload_path'];
		endif;
		$resources = array();
		for($file=0;$file<count($documents['resources']['name']);$file++):
			if($documents['resources']['error'][$file] != 4):
				$files['userfile']['name'] = $documents['resources']['name'][$file];
				$files['userfile']['type'] = $documents['resources']['type'][$file];
				$files['userfile']['tmp_name'] = $documents['resources']['tmp_name'][$file];
				$files['userfile']['error'] = $documents['resources']['error'][$file];
				$files['userfile']['size'] = $documents['resources']['size'][$file];
				$resultUpload = $this->uploadFile(array('document'=>$files,'upload_path'=>$parameters['upload_path']));
				if($resultUpload['status'] == TRUE):
					$errorMessage .= $resultUpload['message'];
					$resources[$file]['name'] = $resultUpload['uploadData']['file_name'];
					$resources[$file]['size'] = $resultUpload['uploadData']['file_size'];
					$resources[$file]['type'] = substr($resultUpload['uploadData']['file_ext'],1);
				endif;
			endif;
		endfor;
		if(!empty($resources) && (isset($parameters['create_zip']) && $parameters['create_zip'] == TRUE)):
			$resultCreateZip = $this->createZIP(array('zip_path'=>$parameters['upload_path'],'resources'=>$resources));
			if($resultCreateZip['status'] == FALSE):
				$errorMessage .= $resultCreateZip['message'];
			else:
				if(isset($parameters['model']) && isset($parameters['recordID'])):
					$this->load->model($parameters['model']);
					$this->$parameters['model']->updateField($parameters['recordID'],'resources',json_encode($resources));
					$this->$parameters['model']->updateField($parameters['recordID'],'zip',$resultCreateZip['file_path'].'/'.$resultCreateZip['file_name']);
				endif;
			endif;
		endif;
		return $errorMessage;
	}
	
	public function validationUploadImage(){
		
		$arguments = &func_get_args();
		$fileName = (isset($arguments[0]['file_name']))?$arguments[0]['file_name']:NULL;
		$minWidth = (isset($arguments[0]['min_width']))?$arguments[0]['min_width']:NULL;
		$maxWidth = (isset($arguments[0]['max_width']))?$arguments[0]['max_width']:NULL;
		$onlyWide = (isset($arguments[0]['only_wide']))?$arguments[0]['only_wide']:FALSE;
		$maxSize = (isset($arguments[0]['max_size']))?$arguments[0]['max_size']:NULL;
		$return = array('status'=>FALSE,'response'=>'');
		if(!is_null($fileName) && is_file($fileName)):
			$fileSize = getimagesize($fileName);
			$acceptedTypes = array('image/png','image/jpeg','image/gif');
			if(array_search($fileSize['mime'],$acceptedTypes) !== FALSE):
				if(!is_null($minWidth)):
					if($fileSize[0] >= $minWidth):
						$return['status'] = TRUE;
					else:
						$return['status'] = FALSE;
						$return['response'] = 'Ширина меньше '.$minWidth.'px';
					endif;
				endif;
				if(!is_null($maxWidth)):
					if($fileSize[0] <= $maxWidth):
						$return['status'] = TRUE;
					else:
						$return['status'] = FALSE;
						$return['response'] = 'Ширина больше '.$maxWidth.'px';
					endif;
				endif;
				if($return['status'] == TRUE && $onlyWide === TRUE):
					if($fileSize[0] > $fileSize[1]):
						$return['status'] = TRUE;
					else:
						$return['status'] = FALSE;
						$return['response'] = 'Ширина меньше высоты';
					endif;
				endif;
				if($return['status'] == TRUE && !is_null($maxSize)):
					if(filesize($fileName) < $maxSize):
						$return['status'] = TRUE;
					else:
						$return['status'] = FALSE;
						$return['response'] = 'Размер более '.round($maxSize/1048576).'Мб';
					endif;
				endif;
			endif;
		endif;
		return $return;
	}
	
	public function uploadSingleImage($uploadPath = NULL,$allowed_types = null){
		
		if(is_null($uploadPath) || ($this->createDir($uploadPath) == FALSE)):
			$uploadPath = NULL;
		endif;
		if(!is_null($uploadPath)):
			if(!empty($_FILES)):
				$this->load->library('upload');
				$this->load->helper('string');
				$config = array();
				$config['upload_path'] = $uploadPath.'/';
				$config['allowed_types'] = is_null($allowed_types) ? ALLOWED_TYPES_IMAGES : $allowed_types;
				$config['remove_spaces'] = TRUE;
				$config['overwrite'] = TRUE;
				$config['max_size'] = 5120;
				$config['file_name'] = preg_replace('/.+(.)(\.)+/',random_string('nozero',12)."\$2",$_FILES['file']['name']);
				$this->upload->initialize($config);
				if($this->upload->do_upload('file')):
					return $config['file_name'];
				endif;
			endif;
		endif;
		return FALSE;
	}
	
	public function dropUploadFile(){
	
		$arguments = &func_get_args();
		$uploadPath = (isset($arguments[0]['upload_path']))?$arguments[0]['upload_path']:NULL;
		if(is_null($uploadPath) || ($this->createDir($uploadPath) == FALSE)):
			$uploadPath = NULL;
		endif;
		$uploadStatus = array('status'=>FALSE,'message'=>'','uploadData'=>array());
		if(!is_null($uploadPath)):
			$this->load->helper('string');
			$fileName = preg_replace('/.+(.)(\.)+/',random_string('nozero',12)."\$2",$this->input->get_request_header('X-file-name',TRUE));
			file_put_contents($uploadPath.$fileName,file_get_contents('php://input'));
			if(is_file($uploadPath.$fileName)):
				$uploadStatus['uploadData']['file_name'] = $fileName;
				$uploadStatus['uploadData']['file_size'] = filesize($uploadPath.$fileName);
				$uploadStatus['status'] = TRUE;
			else:
				$uploadStatus['message'] = $this->load->view('html/print-error',array('alert_header'=>'Загрузка файлов','message'=>'Отсутствует файл для загрузки'),TRUE);
			endif;
		else:
			$uploadStatus['message'] = $this->load->view('html/print-error',array('alert_header'=>'Загрузка файлов','message'=>'Отсутствует каталог загрузки'),TRUE);
		endif;
		return $uploadStatus;
	}
	
	public function uploadFile(){
		
		$arguments = &func_get_args();
		$uploadPath = (isset($arguments[0]['upload_path']))?$arguments[0]['upload_path']:NULL;
		if(is_null($uploadPath) || ($this->createDir($uploadPath) == FALSE)):
			$uploadPath = NULL;
		endif;
		$document = (isset($arguments[0]['document']))?$arguments[0]['document']:NULL;
		$uploadStatus = array('status'=>FALSE,'message'=>'','uploadData'=>array());
		if(!is_null($uploadPath)):
			if(!is_null($document) && is_array($document)):
				$_FILES = $document;
				$this->load->library('upload');
				$this->load->helper('string');
				$config = array();
				$config['upload_path'] = $uploadPath.'/';
				$config['allowed_types'] = (isset($arguments[0]['allowed_types']))?$arguments[0]['allowed_types']:ALLOWED_TYPES_DOCUMENTS.'|'.ALLOWED_TYPES_IMAGES;
				$config['remove_spaces'] = TRUE;
				$config['overwrite'] = (isset($arguments[0]['overwrite']))?$arguments[0]['overwrite']:TRUE;
				$config['max_size'] = (isset($arguments[0]['max_size']))?$arguments[0]['max_size']:5120;
				$config['file_name'] = preg_replace('/.+(.)(\.)+/',random_string('nozero',12)."\$2",$_FILES['userfile']['name']);
				$this->upload->initialize($config);
				if(!$this->upload->do_upload()):
					$uploadStatus['message'] = $this->load->view('html/print-error',array('alert_header'=>'Файл: '.$_FILES['userfile']['name'],'message'=>$this->upload->display_errors()),TRUE);
				else:
					$uploadStatus['uploadData'] = $this->upload->data();
					$uploadStatus['status'] = TRUE;
				endif;
			else:
				$uploadStatus['message'] = $this->load->view('html/print-error',array('alert_header'=>'Загрузка файлов','message'=>'Отсутствует файл для загрузки'),TRUE);
			endif;
		else:
			$uploadStatus['message'] = $this->load->view('html/print-error',array('alert_header'=>'Загрузка файлов','message'=>'Отсутствует каталог загрузки'),TRUE);
		endif;
		return $uploadStatus;
	}
	
	public function createZIP(){
		
		$zip = new ZipArchive;
		
		$arguments = &func_get_args();
		$filename = (isset($arguments[0]['file_name']))?$arguments[0]['file_name']:'resources.zip';
		$resources = (isset($arguments[0]['resources']))?$arguments[0]['resources']:NULL;
		$zipPath = (isset($arguments[0]['zip_path']))?$arguments[0]['zip_path']:NULL;
		$zipStatus = array('status'=>FALSE,'message'=>'','file_name'=>$filename,'file_path'=>$zipPath);
		if(is_null($zipPath) || $this->createDir($zipPath) == FALSE):
			$zipPath = NULL;
		endif;
		if(!is_null($zipPath)):
			if(!is_null($resources) && is_array($resources)):
				if($zip->open($zipPath.'/'.$filename,ZIPARCHIVE::CREATE)):
					$root = getcwd();
					chdir($zipPath);
					for($file=0;$file<count($resources);$file++):
						if(is_file($resources[$file]['name'])):
							$result = $zip->addFile($resources[$file]['name']);
						endif;
					endfor;
					$zip->close();
					for($file=0;$file<count($resources);$file++):
						$this->filedelete($resources[$file]['name']);
					endfor;
					chdir($root);
					$zipStatus['status'] = TRUE;
				else:
					$zipStatus['message'] = $this->load->view('html/print-error',array('alert_header'=>'Создание архива','message'=>'Невозможно создать архив'),TRUE);
				endif;
			else:
				$zipStatus['message'] = $this->load->view('html/print-error',array('alert_header'=>'Создание архива','message'=>'Отсутствуют файлы для создания архива'),TRUE);
			endif;
		else:
			$zipStatus['message'] = $this->load->view('html/print-error',array('alert_header'=>'Создание архива','message'=>'Отсутствует каталог'),TRUE);
		endif;
		return $zipStatus;
	}

	public function filedelete($file = NULL){
		
		if(!is_null($file) && is_file($file)):
			@unlink($file);
			return TRUE;
		else:
			return FALSE;
		endif;
	}
	
	public function dirDelete($dir = NULL){
		
		if(!is_null($dir) && is_dir($dir)):
			return rmdir($dir);
		endif;
		return FALSE;
	}

	public function translite($string){
		
		$rus = array("1","2","3","4","5","6","7","8","9","0","ё","й","ю","ь","ч","щ","ц","у","к","е","н","г","ш","з","х","ъ","ф","ы","в","а","п","р","о","л","д","ж","э","я","с","м","и","т","б","Ё","Й","Ю","Ч","Ь","Щ","Ц","У","К","Е","Н","Г","Ш","З","Х","Ъ","Ф","Ы","В","А","П","Р","О","Л","Д","Ж","Э","Я","С","М","И","Т","Б"," ");
		$eng = array("1","2","3","4","5","6","7","8","9","0","yo","iy","yu","","ch","sh","c","u","k","e","n","g","sh","z","h","","f","y","v","a","p","r","o","l","d","j","е","ya","s","m","i","t","b","Yo","Iy","Yu","CH","","SH","C","U","K","E","N","G","SH","Z","H","","F","Y","V","A","P","R","O","L","D","J","E","YA","S","M","I","T","B","-");
		$string = str_replace($rus,$eng,$string);
		if(!empty($string)):
			$string = preg_replace('/[^a-z0-9-\.]/','',mb_strtolower($string));
			$string = preg_replace('/[-]+/','-',$string);
			$string = preg_replace('/[\.]+/','.',$string);
			return $string;
		else:
			return FALSE;
		endif;
	}
	
	public function filterSymbols($string){
		
		if(!empty($string)):
			$string = preg_replace('/[ ]+/','-',mb_strtolower($string));
//			$string = preg_replace('/[^a-z,-]/','',$string);
			$string = preg_replace('/[-]+/','-',$string);
			return $string;
		else:
			return FALSE;
		endif;
	}
	
	public function setActiveUsers($usersList,$field = 'id'){
		
		$list = NULL;
		$session_data = $this->accounts->activeUserData();
		for($i=0;$i<count($session_data);$i++):
			preg_match("/\"userid\"\;s\:[0-9]+\:\"([0-9]+)\"/i",$session_data[$i]['user_data'], $userid);
			if(isset($userid[1])):
				$list[] = (int)$userid[1];
			endif;
		endfor;
		for($i=0;$i<count($usersList);$i++):
			$usersList[$i]['online'] = FALSE;
			for($j=0;$j<count($list);$j++):
				if($usersList[$i][$field] == $list[$j]):
					$usersList[$i]['online'] = TRUE;
				endif;
			endfor;
		endfor;
		if($usersList):
			return $usersList;
		else:
			return NULL;
		endif;
	}
	
	public function postDataValidation($rules){
		
		$this->load->library('form_validation');
		return $this->form_validation->run($rules);
	}
	
	public function createDir($path){
		
		if(!file_exists($path) && !is_dir($path)):
			return mkdir($path,0777,TRUE);
		else:
			return TRUE;
		endif;
	}

	public function insertItem(){
		
		$arguments = &func_get_args();
		$insert = (isset($arguments[0]['insert']))?$arguments[0]['insert']:NULL;
		$model = (isset($arguments[0]['model']))?$arguments[0]['model']:NULL;
		$translit = (isset($arguments[0]['translit']))?$arguments[0]['translit']:NULL;
		unset($arguments);
		if(!is_null($insert) && is_array($insert)):
			if(!is_null($translit)):
				$insert['translit'] = $this->translite($translit);
			endif;
			if(!is_null($model)):
				$this->load->model($model);
				return $this->$model->insertRecord($insert);
			endif;
		endif;
		return FALSE;
	}
	
	public function updateItem(){
		
		$arguments = &func_get_args();
		$update = (isset($arguments[0]['update']))?$arguments[0]['update']:NULL;
		$model = (isset($arguments[0]['model']))?$arguments[0]['model']:NULL;
		$translit = (isset($arguments[0]['translit']))?$arguments[0]['translit']:NULL;
		unset($arguments);
		if(!is_null($update) && is_array($update)):
			if(!is_null($translit)):
				$update['translit'] = $this->translite($translit);
			endif;
			if(!is_null($model)):
				$this->load->model($model);
				return $this->$model->updateRecord($update);
			endif;
		endif;
		return FALSE;
	}
	
	public function getCurlLink($url){

		$ch = curl_init($url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
		curl_setopt($ch,CURLOPT_HEADER,0);
		$result = curl_exec($ch);
		curl_close($ch);
		if($result == FALSE):
			return file_get_contents($url);
		else:
			return $result;
		endif;
	}

    public function curlPost($url,$attr = null){

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST, 1);
        if (!is_null($attr)):
            curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($attr));
        endif;
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT ,3);
        curl_setopt($ch,CURLOPT_TIMEOUT, 20);
        $server_output = curl_exec ($ch);
        curl_close ($ch);
        if($server_output == FALSE):
            return file_get_contents($url);
        else:
            return $server_output;
        endif;
    }

	public function getValuesInArray($array,$value){
		
		$ids = array();
		for($i=0;$i<count($array);$i++):
			$ids[] = $array[$i][$value];
		endfor;
		return $ids;
	}
	
	public function getDBRecordsIDs($courses,$field = 'course'){
		
		$ids = array();
		for($i=0;$i<count($courses);$i++):
			$ids[] = $courses[$i][$field];
		endfor;
		return $ids;
	}
	
	public function reIndexArray($array){
		
		$newArray = array();
		foreach($array as $key => $value):
			$newArray[] = $value;
		endforeach;
		return $newArray;
	}
	
	public function ToCurl($url)
	{
	    if(empty($url))
	    {
	        return 'Error: invalid Url';
	    }
	
	    $ch = curl_init();
	
	    curl_setopt($ch, CURLOPT_HEADER, 0);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Set curl to return the data instead of printing it to the browser.
	    curl_setopt($ch, CURLOPT_URL, $url); #set the url and get string together
	
	    $return = curl_exec($ch);
	    curl_close($ch);
	 
	    return $return;
	}

    /**************************************************************************************************************/
    public static function is_client(){

        $CI = & get_instance();
        if ($CI->profile['moderator'] == 0):
            return TRUE;
        else:
            return FALSE;
        endif;
    }

    public static function is_administrator(){

        $CI = & get_instance();
        if (in_array($CI->profile['moderator'],array(2,3))):
            return TRUE;
        else:
            return FALSE;
        endif;
    }

    public static function auth(){

        $CI = & get_instance();
        if (!$CI->loginstatus):
            return FALSE;
        else:
            return TRUE;
        endif;
    }

    public static function is_moderator($groups = NULL){

        if (is_null($groups)):
            $groups = array(1,2,3);
        endif;

        $CI = & get_instance();
        if (in_array($CI->profile['moderator'],$groups)):
            return TRUE;
        else:
            return FALSE;
        endif;
    }

    public static function sectionRoles($item){

        $CI = &get_instance();
        if (!isset($CI->section_roles[$CI->profile['moderator']])):
            show_error('Access Denied');
        endif;
        if (!in_array($item, $CI->section_roles[$CI->profile['moderator']])):
            return FALSE;
        endif;
        return TRUE;
    }
}