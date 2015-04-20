<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_interface extends MY_Controller {
	
	function __construct(){
		
		parent::__construct();
	}
	
	/******************************************** guests interface *******************************************************/
	
	public function loginIn(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'','redirect'=>site_url());
		if($this->postDataValidation('signin')):
			if($user = $this->accounts->authentication($_POST['login'],$_POST['password'])):
                $this->load->model('languages');
                if($newLanguage = $this->languages->languageExist($this->uri->segment(1))):
                    $this->accounts->updateField($user['id'],'language',$newLanguage['id']);
                endif;
                $json_request['status'] = TRUE;
                $json_request['message'] = '';
                $this->setLoginSession($user['id']);
				$json_request['responseText'] = $this->localization->getLocalMessage('signin','login_success');

                if($user['id'] == 0):
					$json_request['redirect'] = site_url(ADMIN_START_PAGE);
				elseif($user['id'] == 1):
					$json_request['redirect'] = site_url('admin-panel/actions/pages');
				else:
					$this->config->set_item('base_url',$this->baseURL.$this->uri->segment(1).'/');
					$json_request['redirect'] = site_url(USER_START_PAGE);
				endif;
			else:
				$json_request['responseText'] = $this->localization->getLocalMessage('signin','failure');
			endif;
		else:
			$json_request['responseText'] = $this->localization->getLocalMessage('signin','failure');
		endif;
		echo json_encode($json_request);
	}
	
	public function signUp(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'','redirect'=>site_url(),'responseText_step3'=>'');
		if($this->postDataValidation('signup') === TRUE):
			if($this->accounts->search('email',$this->input->post('email')) === FALSE):
				if($resultData = $this->sendResisterData($this->input->post())):
                    $resultData['auto_demo'] = NULL;
                    if (isset($_COOKIE["pp_reg"]) && $this->input->post('account_type') == 2):
                        $partnerID = $_COOKIE["pp_reg"];
                        $partnerDemo = 0;
                        $partner = $this->accounts->getWhere(NULL,array('remote_id'=>$partnerID,'demo'=>$partnerDemo));
                        if (!empty($partnerID) && $partner):
                            $this->load->model('partner_program');
                            if (!$this->partner_program->getWhere(NULL,array('partner_id'=>$partner['id'],'invite_id'=>@$resultData['accountID']['id']))):
                                $this->partner_program->insertRecord(array('partner_id'=>$partner['id'],'invite_id'=>@$resultData['accountID']['id'],'created_at'=>date('Y-m-d H:i:s')));
                            endif;
                        endif;
                    endif;
                    if($this->input->post('account_type') == 2):
                        $resultData['auto_demo'] = $this->sendResisterData($this->input->post(),1);
                    endif;
					$mailtext = $this->load->view('mails/signup',array('account'=>$resultData['accountID'],'reg_data'=>$resultData),TRUE);
					$this->sendMail($this->input->post('email'),'support@optospot.net','Optospot trading platform','Welcome to Optospot.net',$mailtext);
                    $this->setLoginSession($resultData['accountID']['id']);
					$json_request['redirect'] = FALSE;
					$json_request['status'] = TRUE;
				else:
					$json_request['responseText'] = $this->localization->getLocalMessage('signup','server_failure');
				endif;
			else:
				$json_request['responseText'] = $this->localization->getLocalMessage('signup','email_exit');
			endif;
		else:
			$json_request['responseText'] = $this->localization->getLocalMessage('signup','failure');
		endif;
		echo json_encode($json_request);
	}

    public function createAffiliateAccount(){

        $this->load->model('users_affiliate');
        $json_request = array('status'=>FALSE,'responseText'=>'','redirect'=>site_url());
        if(!$this->input->is_ajax_request()):
            show_error('Access Denied');
        endif;
        if ($this->profile['demo']):
            show_error('Access Denied');
        endif;
        if ($this->users_affiliate->getWhere(NULL,array('user_id'=>$this->profile['id']))):
            show_error('Access Denied');
        endif;
        if($this->postDataValidation('signup_affiliate') == TRUE):
            if($resultData = $this->sendResisterAffiliateData($this->input->post())):
                $mailtext = $this->load->view('mails/signup-affiliate',array('account'=>$resultData['accountID'],'reg_data'=>$resultData),TRUE);
                $this->sendMail($resultData['email'],'support@optospot.net','Optospot trading platform','Welcome to Optospot.net',$mailtext);
                $json_request['status'] = TRUE;
                $json_request['redirect'] = site_url($this->uri->segment(1).'/cabinet/partner-program');
            else:
                $json_request['responseText'] = $this->localization->getLocalMessage('signup','failure');
            endif;
        else:
            $json_request['responseText'] = $this->localization->getLocalMessage('signup','failure');
        endif;
        echo json_encode($json_request);
    }

	public function createRealAccount(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'','redirect'=>site_url());
		if($this->postDataValidation('signup') == TRUE):
			$registerData = $this->input->post();
			$registerData['coach'] = 0;
            if($this->accounts->getWhere(NULL,array('email'=>$registerData['email'],'demo'=>0),TRUE)):
                $json_request['responseText'] = $this->localization->getLocalMessage('signup','email_exit');
                echo json_encode($json_request);
                exit;
            endif;
			if($resultData = $this->sendResisterData($registerData)):
                if (isset($_COOKIE["pp_reg"])):
                    $partnerID = $_COOKIE["pp_reg"];
                    $partnerDemo = 0;
                    $partner = $this->accounts->getWhere($partnerID,array('demo'=>$partnerDemo));
                    if (!empty($partnerID) && $partner):
                        $this->load->model('partner_program');
                        if (!$this->partner_program->getWhere(NULL,array('partner_id'=>$partner['id'],'invite_id'=>@$resultData['accountID']['id']))):
                            $this->partner_program->insertRecord(array('partner_id'=>$partner['id'],'invite_id'=>@$resultData['accountID']['id'],'created_at'=>date('Y-m-d H:i:s')));
                        endif;
                    endif;
                endif;
				$mailtext = $this->load->view('mails/signup',array('account'=>$resultData['accountID'],'reg_data'=>$resultData),TRUE);
				$this->sendMail($registerData['email'],'support@optospot.net','Optospot trading platform','Welcome to Optospot.net',$mailtext);
				$json_request['status'] = TRUE;
				$this->setLoginSession($resultData['accountID']['id']);
				$this->profile = $this->accounts->getWhere($resultData['accountID']['id']);
				$this->session->set_userdata('profile',json_encode($this->profile));
				$json_request['redirect'] = site_url($this->uri->segment(1).'/cabinet/balance');
			else:
				$json_request['responseText'] = $this->localization->getLocalMessage('signup','failure');
			endif;
		else:
			$json_request['responseText'] = $this->localization->getLocalMessage('signup','failure');
		endif;
		echo json_encode($json_request);
	}
	
	public function createDemoAccount(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'','redirect'=>site_url());
		if($this->postDataValidation('signup') == TRUE):
			$registerData = $this->input->post();
			$registerData['coach'] = 0;
			if($resultData = $this->sendResisterData($registerData)):
				$mailtext = $this->load->view('mails/signup',array('account'=>$registerData,'reg_data'=>$resultData),TRUE);
				$this->sendMail($registerData['email'],'support@optospot.net','Optospot trading platform','Welcome to Optospot.net',$mailtext);
				$json_request['status'] = TRUE;
				$json_request['redirect'] = site_url($this->uri->segment(1).'/cabinet/my-accounts');
			else:
				$json_request['responseText'] = $this->localization->getLocalMessage('signup','failure');
			endif;
		else:
			$json_request['responseText'] = $this->localization->getLocalMessage('signup','failure');
		endif;
		echo json_encode($json_request);
	}
	
	public function forgotPassword(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'','redirect'=>FALSE);
		if($this->postDataValidation('forgot') == TRUE):
			if($account = $this->accounts->getWhere(NULL,array('email'=>$_POST['email']))):
				$mailtext = $this->load->view('mails/forgot',$account,TRUE);
				$this->sendMail($account['email'],'support@optospot.net','Optospot trading platform','Requested a new password to optospot.net',$mailtext);
				$json_request['status'] = TRUE;
				$json_request['responseText'] = $this->localization->getLocalMessage('forgot','success');
			else:
				$json_request['responseText'] = $this->localization->getLocalMessage('forgot','error');
			endif;
		else:
			$json_request['responseText'] = $this->localization->getLocalMessage('forgot','valid_email');
		endif;
		echo json_encode($json_request);
	}
	
	public function getChartLink(){
		
		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$this->load->model('settings');
		echo json_encode(array('vlink'=>$this->settings->value(2,'link')));
	}

	public function withdrawRequest($registerData = FALSE){

		if(!$this->input->is_ajax_request()):
			show_error('В доступе отказано');
		endif;
		$json_request = array('status'=>FALSE,'responseText'=>'','redirect'=>site_url());
		if($this->postDataValidation('user_withdraw') == TRUE):
			$mailtext = $this->load->view('mails/withdraw',array('post'=>$this->input->post()),TRUE);
			$this->sendMail('support@optospot.net','support@optospot.net','Optospot trading platform','Withdrawal Optospot.net',$mailtext);
			$this->sendMail('vkharseev@gmail.com','support@optospot.net','Optospot trading platform','Withdrawal Optospot.net',$mailtext);
			$json_request['status'] = TRUE;
			$json_request['redirect'] = FALSE;
			$json_request['responseText'] = $this->localization->getLocalMessage('withdraw','success');
		else:
			print_r(validation_errors());
			$json_request['responseText'] = $this->localization->getLocalMessage('withdraw','failure');
		endif;
		echo json_encode($json_request);
	}
	
	private function ExecuteCreatingAccount($registerData = NULL){
		
		$demo = 0;
		if($registerData['mode'] == 'demo'):
			$demo = 1;
		endif;
		if(!isset($registerData['coach'])):
			$registerData['coach'] = 1;
		endif;
		$this->load->library('encrypt');
		$account = array("remote_id"=>$registerData['remote_id'],'demo'=>$demo,'first_name'=>$registerData['fname'],'last_name'=>$registerData['lname'],
			'email'=>$registerData['email'],'country'=>$registerData['country'],'day_phone'=>'','coach'=>$registerData['coach'],
			'password'=>md5($registerData['password']),'trade_login'=>$registerData['trade_login'],'trade_password'=>$this->encrypt->encode($registerData['password']),
			'signdate'=>date("Y-m-d"),'language'=>$registerData['language']);
        $registerData['id'] = $this->insertItem(array('insert'=>$account,'model'=>'accounts'));
        return $registerData;
	}
	
	private function registerLoging($loginResponse = NULL){
		
		$log = array('method'=>'','fields'=>'','Error'=>'','Result'=>'');
		if(!is_null($loginResponse)):
			if(isset($loginResponse->Method)):
				$log['method'] = $loginResponse->Method;
			endif;
			if(isset($loginResponse->Params[0]['fields']) && !empty($loginResponse->Params[0]['fields'])):
				$log['fields'] = $loginResponse->Params[0]['fields'];
			endif;
			if(isset($loginResponse->Error) && !empty($loginResponse->Error)):
				$log['Error'] = $loginResponse->Error;
			endif;
			if(isset($loginResponse->Result) && !empty($loginResponse->Result)):
				$log['Result'] = $loginResponse->Result;
			endif;
		endif;
		$insert = array('data'=>json_encode($log));
		return $this->insertItem(array('insert'=>$insert,'model'=>'log'));
	}
	
	public function tickerCurl(){
		$postdata = $_POST['postdata'];
		
		$JSONdata = json_decode($postdata, true);
		
		$responce = "";
				
		for($i = 1; $i <= count($JSONdata); $i++)
		{
			$cc1 = $JSONdata[$i]['cc1'];
			$cc2 = $JSONdata[$i]['cc2'];
			
			$resp = $this->ToCurl('http://va122.sysfx.com:8383/advertisments/content/demo.184/rates/json/dispatcher?cc1='.$cc1.'&cc2='.$cc2);
			$bid_data = json_decode($resp, true);
			$bid = $bid_data[count($bid_data)-2]['bid'];
					
			$resp = $this->ToCurl('http://va122.sysfx.com:8383/advertisments/content/demo.184/winPayout/json/dispatcher?cc1='.$cc1.'&cc2='.$cc2);
			$win_data = json_decode($resp, true);
			$winmin = $win_data['minWinPayout'];
			$winmax = $win_data['maxWinPayout'];
			
			$resp = $this->ToCurl('http://va122.sysfx.com:8383/advertisments/content/demo.184/payoutByDateTime/json/dispatcher?cc1='.$cc1.'&cc2='.$cc2.'&dt='.date('Y-m-d').'%20'.date('h:m:s'));
			$payout_data = json_decode($resp, true);
			$payout = $payout_data['payout'];
			
			$resp = $this->ToCurl('http://va122.sysfx.com:8383/advertisments/content/demo.184/binaryOptionExperationDate/json/dispatcher?cc1='.$cc1.'&cc2='.$cc2.'&exptype=I');
			$exp_data = json_decode($resp, true);
			$exp_time = $exp_data['expirationDate'];
			$exp = $exp_time/1000 - time();
			
			$responce .= '{"id":'.$i.',"payout":'.$payout.',"bid":'.$bid.',"winmin":'.$winmin.',"winmax":'.$winmax.',"exp":"'.$exp.'"}';
			if($i != count($JSONdata)) {
				$responce .= ",";
			}
		} 
		
		/* Responce */
		$data = "[".$responce."]";
		echo $data;
	}
    /***********************************************************************************************/
    public function sendResisterData($registerData = FALSE,$setModeStatus = NULL){

        if(file_exists(getcwd().'/BaseJsonRpcClient.php') && $registerData !== FALSE):
            include_once getcwd().'/BaseJsonRpcClient.php';
            $this->load->model(array('settings'));
            $client = new BaseJsonRpcClient($this->settings->value(1,'link'));
            $demoStatus = TRUE;
            if(!is_null($setModeStatus)):
                $registerData['account_type'] = $setModeStatus;
            endif;
            $office = 'Main';
            if($registerData['account_type'] == 1):
                $registerData['mode'] = 'demo';
                $schema = 'edforex184';
            else:
                $registerData['mode'] = 'real';
                $schema = 'eforex184';
                $demoStatus = FALSE;
                if (isset($_COOKIE["pp_reg"])):
                    $this->load->model('users_affiliate');
                    $affiliate = $this->users_affiliate->getWhere(NULL,array('user_id'=>$_COOKIE["pp_reg"]));
                    $office = $affiliate['remote_id'];
                endif;
            endif;
            $params = array('providerId'=>'ICTS','fields'=>array('fname'=>$registerData['fname'],'lname'=>$registerData['lname'],'schema$'=>$schema,'office'=>$office,'Send_Email'=>'N','email'=>$registerData['email'],'phone'=>'','Gen_Login'=> 'COMPANY'));
            if($registerData['account_type'] == 1):
                $params['fields']['Balance'] = '1000';
            endif;
            $response = $client->registrate($params);
            if(!empty($response->Result)):
                $registerData['remote_id'] = intval($response->Result['ACCOUNT']);
                $registerData['trade_login'] = (string)$response->Result['LOGIN'];
                $registerData['password'] = (string)$response->Result['PASSWORD'];
                $this->load->model('languages');
                $registerData['language'] = $this->languages->getLanguageID($this->uri->segment(1));
                if($registerData['remote_id']):
                    if($accountID = $this->ExecuteCreatingAccount($registerData)):
                        return array('accountID'=>$accountID,'demoStatus'=>$demoStatus,'login'=>$registerData['trade_login'],'password'=>$registerData['password']);
                    endif;
                endif;
            else:
                $this->registerLoging($response);
                $statusval['message'] = $this->localization->getLocalMessage('signup','server_failure');
            endif;
        endif;
        return FALSE;
    }

    public function sendResisterAffiliateData($registerData){

        if(file_exists(getcwd().'/BaseJsonRpcClient.php') && $registerData !== FALSE):
            include_once getcwd().'/BaseJsonRpcClient.php';
            $this->load->model(array('settings'));
            $client = new BaseJsonRpcClient($this->settings->value(1,'link'));
            $params = array(
                'providerId' => 'ICTS',
                'fields' => array(
                    'fname' => $registerData['first_name'], 'lname' => $registerData['last_name'],
                    'passport' => $registerData['passport_id'],
                    'email' => $registerData['email'], 'address1' => $registerData['address1'],
                    'city' => $registerData['city'],
                    'state' => $registerData['state'], 'country' => $registerData['country'],
                    'phone' => $registerData['phone'],
                    'departmental' => $registerData['departmental'], 'country' => $registerData['country'],
                    'phone' => $registerData['phone'],
                    'schema$' => 'eforex184', 'Email_From' => '', 'office' => $registerData['office'],
                    'Send_Email' => 'N',
                    'Withhold_Percent' => 3, 'Cust_Type' => 'AFFILIATE'
                )
            );
            $response = $client->registrate($params);
            if(!empty($response->Result)):
                $registerData['remote_id'] = intval($response->Result['ACCOUNT']);
                $registerData['login'] = (string)$response->Result['LOGIN'];
                $registerData['password'] = (string)$response->Result['PASSWORD'];
                if($registerData['remote_id']):
                    if($accountID = $this->ExecuteCreatingAffiliateAccount($registerData)):
                        return array('accountID'=>$accountID,'email'=>$registerData['email'],'login'=>$registerData['login'],'password'=>$registerData['password']);
                    endif;
                endif;
            else:
                $this->registerLoging($response);
                $statusval['message'] = $this->localization->getLocalMessage('signup','server_failure');
            endif;
        endif;
        return FALSE;
    }
    /***********************************************************************************************/

    private function ExecuteCreatingAffiliateAccount($registerData = NULL){

        $affiliate = array(
            'user_id' => $this->profile['id'],
            'remote_id' => $registerData['remote_id'],
            'login' => $registerData['login'],
            'password' => $registerData['password'],
            'first_name' => $registerData['first_name'],
            'last_name' => $registerData['last_name'],
            'passport_id' => $registerData['passport_id'],
            'email' => $registerData['email'],
            'address' => $registerData['address1'],
            'city' => $registerData['city'],
            'state' => $registerData['state'],
            'country' => $registerData['country'],
            'day_phone' => $registerData['phone'],
            'departmental' => $registerData['departmental']
        );
        return $this->insertItem(array('insert'=>$affiliate,'model'=>'users_affiliate'));
    }
}