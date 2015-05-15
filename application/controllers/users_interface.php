<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Users_interface extends MY_Controller {
	
	function __construct(){
		
		parent::__construct();
        $this->load->model(array('pages','languages','category'));
		if($this->auth()):
			$this->language = $this->accounts->value($this->account['id'],'language');
		else:
			$this->language = $this->languages->getBaseLanguage();
		endif;
		if($this->uri->segment(1) === FALSE):
			if($this->language_url = $this->languages->value($this->language,'uri')):
				$this->config->set_item('base_url',$this->baseURL.$this->language_url.'/');
				redirect();
			endif;
		elseif($language = $this->languages->languageExist($this->uri->segment(1))):
			$this->language = $language['id'];
			$this->language_url = $language['uri'];
			$this->config->set_item('base_url',$this->baseURL.$this->language_url.'/');
        else:
            show_404();
		endif;
        if ($this->input->get('pp') !== FALSE):
            setcookie('pp_reg',$this->input->get('pp'),time()+604800);
        endif;
	}
	
	public function index(){

		$dataPage = $this->pages->getHomePage($this->language);
		$pagevar = array(
			'title' => (isset($dataPage[0]['title']) && !empty($dataPage[0]['title']))?$dataPage[0]['title']:'Optospot trading platform',
			'description' => (isset($dataPage[0]['description']) && !empty($dataPage[0]['description']))?$dataPage[0]['description']:'Optospot trading platform',
			'page' => (isset($dataPage))?$dataPage:array(),
			'languages' => $this->languages->visibleLanguages(),
			'menu' => $this->getMenu(),
		);
        $this->load->view("users_interface/index",$pagevar);
	}
	
	public function pages($page_url = ''){
		
		if(!$dataPage = $this->pages->readFieldsUrl(noFirstSegment(uri_string()),$this->language)):
			show_404();
		endif;
		$pagevar = array(
			'title' => (!empty($dataPage['title']))?$dataPage['title']:'Optospot trading platform',
			'description' => $dataPage['description'],
			'content' => $dataPage['content'],
			'active_category' => $dataPage['category'],
			'languages' => $this->languages->visibleLanguages(),
            'menu' => $this->getMenu(),
		);
		$this->load->view("users_interface/pages",$pagevar);
	}
	
	public function trade(){
		
		if($this->uri->segment(2) =='trade'):
			redirect('binarnaya-platforma/online-treiding','location',301);
		endif;
		$dataPage = $this->pages->readFieldsUrl('binarnaya-platforma/online-treiding',$this->language);
		$pagevar = array(
			'title' => (!empty($dataPage['title']))?$dataPage['title']:'Optospot trading platform',
			'description' => $dataPage['description'],
			'content' => $dataPage['content'],
			'languages' => $this->languages->visibleLanguages(),
			'client' => array(),
            'menu' => $this->getMenu(),
		);
		if($this->loginstatus):
			$pagevar['client'] = $this->accounts->getWhere($this->account['id']);
			$pagevar['client']['password'] = $this->encrypt->decode($pagevar['client']['trade_password']);
		endif;
		$this->load->view("users_interface/trade",$pagevar);
	}

	public function award() {

		$dataPage = $this->pages->readFieldsUrl('award',$this->language);
		$pagevar = array(
			'title' => (!empty($dataPage['title']))?$dataPage['title']:'Optospot trading platform',
			'description' => $dataPage['description'],
			'content' => $dataPage['content'],
			'languages' => $this->languages->visibleLanguages(),
			'client' => array(),
            'menu' => $this->getMenu(),
		);
		if($this->loginstatus):
			$pagevar['client'] = $this->accounts->getWhere($this->account['id']);
			$pagevar['client']['password'] = $this->encrypt->decode($pagevar['client']['trade_password']);
		endif;
		$this->load->view("users_interface/award",$pagevar);
		
	}

	public function chat() {
		
		$dataPage = $this->pages->readFieldsUrl('binarnaya-platforma/online-treiding',$this->language);
		$pagevar = array(
			'title' => (!empty($dataPage['title']))?$dataPage['title']:'Optospot trading platform',
			'description' => $dataPage['description'],
			'content' => $dataPage['content'],
			'languages' => $this->languages->visibleLanguages(),
			'client' => array(),
            'menu' => $this->getMenu(),
        );
		if($this->loginstatus):
			$pagevar['client'] = $this->accounts->getWhere($this->account['id']);
			$pagevar['client']['password'] = $this->encrypt->decode($pagevar['client']['trade_password']);
		endif;
		$this->load->view("users_interface/chat",$pagevar);
		
	}
	
	public function logoff($redirect = TRUE){
		
		$this->session->unset_userdata(array('logon'=>'','profile'=>'','account'=>'','backpath'=>''));
        if ($redirect):
            redirect('');
        endif;
	}
	
	public function forgot_password(){
		
		$statusval = array('status'=>FALSE,'title'=>'<span class="label label-success">Successfully</span>','message'=>'New password sent to your email');
		$user_email = trim($this->input->post('user_email'));
		if(!$user_email):
			show_404();
		endif;
		$user_id = $this->mdusers->user_exist('email',trim($user_email));
		if($user_id):
			$user = $this->mdusers->read_record($user_id,'users');
			ob_start();?>
<p>Dear <em><?=$user['first_name'].' '.$user['last_name'];?></em>,</p>
<p>You have requested a new password to access the site <?=anchor('','Optospot trading platform');?></p>
<p>Login: <?=$user['trade_login'];?><br/>Password: <?=$this->encrypt->decode($user['trade_password']);?></p>
		<?php	$mailtext = ob_get_clean();
			$this->sendMail($user['email'],'support@optospot.net','Optospot trading platform','Requested a new password to optospot.net',$mailtext);
			$statusval['status'] = TRUE;
			$this->session->set_userdata('msgs','Password changed.');
		else:
			$statusval['title'] = '<span class="label label-warning">Specified Email does not exist</span>';
		endif;
		echo json_encode($statusval);
	}

	public function getSignupAccount(){
		
		$where['active'] = 1;
		$where['signdate'] = date('Y-m-d');
		if($days = $this->uri->segment(2)):
			$where['signdate'] = date('Y-m-d',time()-$days*86400);
		endif;
		$this->load->model('accounts');
		$accounts = $this->accounts->getFields('first_name,last_name,email,signdate,demo',$where);
		if($this->input->get('mode') == 'text'):
			print_r($where['signdate']);echo "<br/>";
			print_r($accounts);
		else:
			return $accounts;
		endif;
	}

	public function registering(){

        if ($this->auth()):
            switch ($this->profile['moderator']):
                case 0 : redirect(USER_START_PAGE);
                case 1 : redirect($this->baseURL.'admin-panel/actions/pages');
                case 2 : redirect($this->baseURL.ADMIN_START_PAGE);
                default : redirect('');
            endswitch;
        endif;
		$this->load->model(array('pages','languages','category'));
		$dataPage = $this->pages->readFieldsUrl('registering',$this->language);

		$pagevar = array(
			'title' => ($this->language == 3)?'Торговля бинарными опционами онлайн. Регистрация бинарные опционы. Регистрация на бинарных опционах':'Registering',
			'description' => ($this->language == 3)?'Торговля бинарными опционами онлайн на Оptospot.net – доходное дело. Первый ваш шаг -  регистрации бинарные опционы. Регистрация на нашем сайте бинарных опционов предельно проста.':'',
			'page' => (isset($dataPage))?$dataPage:array(),
			'languages' => $this->languages->visibleLanguages(),
            'menu' => $this->getMenu(),
		);
		$this->load->view("users_interface/registering",$pagevar);
	}

    public function perfectMoneyChecked(){

        $data = array('content'=>$this->input->post());
        $mailtext = $this->load->view('mails/payment/perfect-money',$data,TRUE);
        $this->sendMail('vkharseev@gmail.com','support@optospot.net','Optospot trading platform','Payment Perfect Money',$mailtext);
        if ($this->input->post('PAYMENT_ID') !== FALSE):
            define('ALTERNATE_PHRASE_HASH', '32423UMggmHhMOMGJaZgiTPmT');
            $string =
                $this->input->post('PAYMENT_ID') . ':' . $this->input->post('PAYEE_ACCOUNT') . ':' .
                $this->input->post('PAYMENT_AMOUNT') . ':' . $this->input->post('PAYMENT_UNITS') . ':' .
                $this->input->post('PAYMENT_BATCH_NUM') . ':' .
                $this->input->post('PAYER_ACCOUNT') . ':' . strtoupper(md5(ALTERNATE_PHRASE_HASH)) . ':' .
                $this->input->post('TIMESTAMPGMT');
            $hash = strtoupper(md5($string));
            $this->load->model('perfectmoney');
            $PerfectMoney = $Account = NULL;
            if($PerfectMoney = $this->perfectmoney->getWhere(NULL,array('payment_id'=>$this->input->post('PAYMENT_ID')))):
                $Account = $this->accounts->getWhere($PerfectMoney['user_id']);
                $this->perfectmoney->updateField($PerfectMoney['id'],'amount',$this->input->post('PAYMENT_AMOUNT'));
            endif;
            if ($hash == $this->input->post('V2_HASH')):
                if ($PerfectMoney && $Account):
                    $data = array('content'=>$PerfectMoney['date'].' прошла оплата от '.$Account['first_name'].' '.$Account['last_name'].' ['.$Account['trade_login'].'] на сумму (руб.): '.$this->input->post('PAYMENT_AMOUNT'));
                    $mailtext = $this->load->view('mails/payment/perfect-money',$data,TRUE);
                    $this->sendMail('support@optospot.net','support@optospot.net','Optospot trading platform','Payment Perfect Money',$mailtext);
                    $this->sendMail('vkharseev@gmail.com','support@optospot.net','Optospot trading platform','Payment Perfect Money',$mailtext);
                endif;
            else:
                if ($PerfectMoney && $Account):
                    $data = array('content'=>$PerfectMoney['date'].' оплата от '.$Account['first_name'].' '.$Account['last_name'].' ['.$Account['trade_login'].'] на сумму (руб.): '.$this->input->post('PAYMENT_AMOUNT').' прошла с ошибкой! НЕВЕРНЫЙ ХЕШ! НО оплата прошла.');
                    $mailtext = $this->load->view('mails/payment/perfect-money',$data,TRUE);
                    $this->sendMail('support@optospot.net','support@optospot.net','Optospot trading platform','Payment Perfect Money',$mailtext);
                    $this->sendMail('vkharseev@gmail.com','support@optospot.net','Optospot trading platform','Payment Perfect Money',$mailtext);
                endif;
            endif;
        else:
            exit;
        endif;
        echo 'payment ok';
    }

    public function redactorUploadImage(){

        if($this->auth()):
            $uploadPath = 'download';
            if(isset($_FILES['file']['name']) && $_FILES['file']['error'] === UPLOAD_ERR_OK):
                if($this->imageResize($_FILES['file']['tmp_name'])):
                    $uploadResult = $this->uploadSingleImage(getcwd().'/'.$uploadPath);
                    if($uploadResult['status'] === TRUE && !empty($uploadResult['uploadData'])):
                        if($this->imageResize($_FILES['file']['tmp_name'],NULL,TRUE,100,100,TRUE)):
                            $this->uploadSingleImage(getcwd().'/'.$uploadPath.'/thumbnail','thumb_'.$uploadResult['uploadData']['file_name']);
                        endif;
                        $file = array(
                            'filelink'=>base_url($uploadPath.'/'.$uploadResult['uploadData']['file_name'])
                        );
                        echo stripslashes(json_encode($file));
                    endif;
                endif;
            elseif($_FILES['file']['error'] !== UPLOAD_ERR_OK):
                $message['error'] = $this->getFileUploadErrorMessage($_FILES['file']);
                echo json_encode($message);
            endif;
        endif;
    }

    public function redactorUploadedImages(){

        if($this->auth()):
            $uploadPath = 'download';
            $fullList[0] = $fileList = array('thumb'=>'','image'=>'','title'=>'Изображение','folder'=>'Миниатюры');
            if($listDir = scandir($uploadPath)):
                $index = 0;
                foreach($listDir as $number => $file):
                    if(is_file(getcwd().'/'.$uploadPath.'/'.$file)):
                        $thumbnail = getcwd().'/'.$uploadPath.'/thumbnail/thumb_'.$file;
                        if(file_exists($thumbnail) && is_file($thumbnail)):
                            $fileList['thumb'] = site_url($uploadPath.'/thumbnail/thumb_'.$file);
                        endif;
                        $fileList['image'] = site_url($uploadPath.'/'.$file);
                        $fullList[$index] = $fileList;
                        $index++;
                    endif;
                endforeach;
            endif;
            echo json_encode($fullList);
        endif;
    }

    private function getMenu(){

        $menu = array();
        $categories = $this->category->getWhere(NULL,array('language'=>$this->language),TRUE);
        $pages = $this->pages->getWhere(NULL,array('language'=>$this->language),TRUE);
        foreach ($categories as $index_category => $category):
            $menu[$category['id']]['id'] = $category['id'];
            $menu[$category['id']]['title'] = $category['title'];
            $menu[$category['id']]['pages'] = array();
            $menu[$category['id']]['sub_pages'] = array();
            foreach ($pages as $index_page => $page):
                if($page['category'] == $category['id']):
                    if ($page['second_page'] == 0 && !empty($page['link']) && !empty($page['url'])):
                        $menu[$category['id']]['pages'][$index_page] = array('link' => $page['link'], 'url' => $page['url'],
                            'sort' => $page['sort']);
                    elseif
                    ($page['second_page'] == 1 && !empty($page['link']) && !empty($page['url'])):
                        $menu[$category['id']]['sub_pages'][$index_page] = array('link' => $page['link'],
                            'url' => $page['url'], 'sort' => $page['sort']);
                    endif;
                endif;
            endforeach;
        endforeach;
        return $menu;
    }
}