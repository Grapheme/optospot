<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_interface extends MY_Controller{
	
	var $per_page = PER_PAGE_DEFAULT;
	var $offset = 0;
	var $TotalCount = 0;
	
	function __construct(){
		
		parent::__construct();

		if($this->loginstatus === FALSE || $this->account['id'] > 1):
			redirect('');
		endif;
        if ($this->account['id'] == 1 && $this->uri->segment(3) != 'pages'):
            redirect('admin-panel/actions/pages');
        endif;
	}

    /******************************************* WITHDRAWAL ******************************************************/
    public function withdraw(){

        $this->load->helper('form');
        $this->load->config('withdraw');

        $this->session->set_userdata('backpath',current_url());
        $this->load->view("admin_interface/withdraw");
    }

    public function withdrawAstropayRequest(){

        $this->load->config('withdraw');
        $post_data = $this->input->post();

        $message = $this->input->post('external_id').'I'.$this->input->post('cpf').'L'.$this->input->post('country').'2'.$this->input->post('amount').'8'.$this->input->post('bank').'C'.$this->input->post('bank_branch').'O'.$this->input->post('bank_account');
        $post_data['control'] = strtoupper(hash_hmac('sha256',pack('A*',$message),pack('A*',$this->config->item('astropay_secret_key'))));
        $this->load->view("admin_interface/withdraw/astropay_request",compact('post_data'));
    }
    /**************************************************************************************************************/

	public function settings(){

		if($this->input->post('submit') !== FALSE):
			unset($_POST['submit']);
			if($this->postDataValidation('edit_settings') == TRUE):
				$this->ExecuteUpdatingSettings($this->input->post());
				$this->session->set_userdata('msgs','Settings saved!');
				redirect($this->session->userdata('backpath'));
			else:
				$this->session->set_userdata('msgr','Error. Incorrectly filled in the required fields!');
			endif;
		endif;
        if($this->input->post('submit-mail') !== FALSE):
            $this->load->helper('file');
            $file_path = 'application/views/mails/'.$this->input->post('file_name');
            if($edit_file = get_file_info($file_path)):
                write_file($file_path,$this->input->post('mail_file'));
                $this->session->set_userdata('msgs','Mail text saved!');
                redirect('admin-panel/actions/settings');
            endif;
        endif;
		$this->load->model('settings');
		$pagevar = array(
			'settings' => array('registration'=>$this->settings->value(1,'link'),'charts'=>$this->settings->value(2,'link'),'deposit'=>$this->settings->value(3,'link')),
			'form_legend' => 'The form of editing settings links.',
			'form_legend_mail' => 'The form of editing settings mails.',
			'msgs' => $this->session->userdata('msgs'),
			'msgr' => $this->session->userdata('msgr')
		);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		$this->load->helper('form');
		$this->session->set_userdata('backpath',base_url(uri_string()));
		$this->load->view("admin_interface/settings",$pagevar);
	}

	public function registered(){
		
		$pagevar = array(
			'registered' => $this->accounts->getRegisteredList(PER_PAGE_DEFAULT,(int)$this->uri->segment(4)),
			'pagination' => $this->pagination('admin-panel/registered',4,$this->accounts->getCountRegistered(FALSE),PER_PAGE_DEFAULT),
			'total_registerd' => $this->accounts->getCountRegistered(TRUE),
			'msgs' => $this->session->userdata('msgs'),
			'msgr' => $this->session->userdata('msgr')
		);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		$this->load->helper('date');
		$this->session->set_userdata('backpath',base_url(uri_string()));
		$this->load->view("admin_interface/registered",$pagevar);
	}
	
	private function ExecuteUpdatingSettings($post){
		
		$this->load->model('settings');
		$this->settings->updateField(1,'link',$post['registration']);
		$this->settings->updateField(2,'link',$post['charts']);
		$this->settings->updateField(3,'link',$post['deposit']);
	}
	/******************************************* pages_lang ******************************************************/
	public function pagesLang(){
		
		if($this->input->post('insleng') !== FALSE):
			unset($_POST['insleng']);
			if($this->postDataValidation('insert_language') == TRUE):
				if($message = $this->ExecuteCreatingLanguage($_POST['name'])):
					$this->session->set_userdata('msgs',$message);
				else:
					$this->session->set_userdata('msgr','Error. Language is not added!');
				endif;
				redirect(uri_string());
			else:
				$this->session->set_userdata('msgr','Error. Incorrect language name!');
			endif;
		endif;
		$this->load->model(array('languages','pages'));
		$pagevar = array(
			'langs' => $this->languages->getAll('id'),
			'langs_pages' => $this->pages->getPages(),
			'page' => FALSE,
			'redactor' => FALSE,
			'form_legend' => FALSE,
			'msgs' => $this->session->userdata('msgs'),
			'msgr' => $this->session->userdata('msgr')
		);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		$this->load->helper('form');
		$this->load->view("admin_interface/pages",$pagevar);
	}
	
	public function insertNewPage(){
		
		if($this->input->post('submit') !== FALSE):
			unset($_POST['submit']);
			if($this->postDataValidation('insert_page') == TRUE):
				if($this->ExecuteCreatingPage($this->uri->segment(5),$this->input->post(),1)):
					$this->session->set_userdata('msgs','Page added!');
				else:
					$this->session->set_userdata('msgr','Error. Page is not added!');
				endif;
				redirect(uri_string());
			else:
				$this->session->set_userdata('msgr','Error. Incorrect filled fields!');
			endif;
		endif;
		
		$this->load->model(array('languages','pages','category'));
		$pagevar = array(
			'langs' => $this->languages->getAll(),
			'langs_pages' => $this->pages->getPages(),
			'page' => array('title'=>'','description'=>'','link'=>'','url'=>'','content'=>'','category'=>0,'manage'=>1,'sort'=>0),
			'redactor' => TRUE,
			'form_legend' => 'The form of creating a new page. Language: '.mb_strtoupper($this->languages->value($this->uri->segment(5),'name')),
			'category' => $this->category->getWhere(NULL,array('language'=>$this->uri->segment(5)),TRUE),
			'msgs' => $this->session->userdata('msgs'),
			'msgr' => $this->session->userdata('msgr')
		);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		$this->load->helper('form');
		$this->load->view("admin_interface/pages",$pagevar);
	}
	
	public function editPage(){
		
		$this->load->model(array('languages','pages','category'));
		if(!$this->pages->pageOnLanguage($this->uri->segment(5),$this->uri->segment(7))):
			redirect('admin-panel/actions/pages');
		endif;
		if($this->input->post('submit') !== FALSE):
			unset($_POST['submit']);
			if($this->postDataValidation('insert_page') == TRUE):
				if($this->ExecuteUpdatingPage($this->uri->segment(7),$this->input->post())):
					$this->session->set_userdata('msgs','Page saved!');
				else:
					$this->session->set_userdata('msgr','Error. Language is not added!');
				endif;
				redirect(uri_string());
			else:
				$this->session->set_userdata('msgr','Error. Incorrect language name!');
			endif;
		endif;
		$pagevar = array(
			'langs' => $this->languages->getAll(),
			'langs_pages' => $this->pages->getPages(),
			'page' => $this->pages->getWhere($this->uri->segment(7)),
			'redactor' => TRUE,
			'form_legend'=> 'The form of editing page. Language: '.mb_strtoupper($this->languages->value($this->uri->segment(5),'name')),
			'category' => $this->category->getWhere(NULL,array('language'=>$this->uri->segment(5)),TRUE),
			'msgs' => $this->session->userdata('msgs'),
			'msgr' => $this->session->userdata('msgr')
		);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		$this->load->helper('form');
		$this->load->view("admin_interface/pages",$pagevar);
	}
	
	public function deletePage(){
		
		$this->load->model('pages');
		$manage = $this->pages->value($this->uri->segment(5),'manage');
		if($this->uri->segment(5) !== FALSE && $manage):
			$this->pages->delete($this->uri->segment(5));
			$this->session->set_userdata('msgs','Page deleted successfully.');
		else:
			$this->session->set_userdata('msgr','Error! Impossible to remove page.');
		endif;
		if(isset($_SERVER['HTTP_REFERER'])):
			redirect($_SERVER['HTTP_REFERER']);
		else:
			redirect('admin-panel/actions/pages');
		endif;
	}
	
	public function homePage(){
		if($this->input->post('submit') !== FALSE):
			unset($_POST['submit']);
			if($this->postDataValidation('home_page') == TRUE):
				if($this->ExecuteUpdatingHomePage($this->uri->segment(5),$this->input->post())):
					$this->session->set_userdata('msgs','Page saved!');
				else:
					$this->session->set_userdata('msgr','Error. Language is not added!');
				endif;
				redirect(uri_string());
			else:
				$this->session->set_userdata('msgr','Error. Incorrect language name!');
			endif;
		endif;
		$this->load->model(array('languages','pages'));
		$pagevar = array(
			'langs' => $this->languages->getAll(),
			'langs_pages' => $this->pages->getPages(),
			'page' => $this->pages->getHomePage($this->uri->segment(5)),
			'form_legend' => 'The form of editing home page. Language: '.mb_strtoupper($this->languages->value($this->uri->segment(5),'name')),
			'msgs' => $this->session->userdata('msgs'),
			'msgr' => $this->session->userdata('msgr')
		);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		$this->load->helper('form');
		$this->load->view("admin_interface/page-home",$pagevar);
	}
	
	public function menuPage(){
		
		$this->load->model('pages');
		$pageURL = $this->uri->segment(7);
		if($pageURL == 'trade'):
			$pageURL = 'binarnaya-platforma/online-treiding';
		endif;
		$page = $this->pages->readFieldsUrl($pageURL,$this->uri->segment(5));
		if($page['id']):
			redirect('admin-panel/actions/pages/lang/'.$this->uri->segment(5).'/page/'.$page['id']);
		else:
			redirect('admin-panel/actions/pages');
		endif;
	}
	
	public function redactorUploadImage(){
		
		$uploadPath = getcwd().'/download/';
		$fileName = $this->uploadSingleImage($uploadPath);
		$file = array(
			'filelink'=>base_url('download/'.$fileName)
		);
		echo stripslashes(json_encode($file));
	}
	
	private function ExecuteCreatingLanguage($languageName = ''){
		
		$this->load->model(array('languages','pages','category'));
		$baseLan = 1;
		if($this->languages->countAllResults()):
			$baseLan = 0;
		endif;
		$language = array("name"=>$this->filterSymbols($languageName),'uri'=>'en','active'=>0,'base'=>$baseLan);
		if($newLanguageID = $this->insertItem(array('insert'=>$language,'model'=>'languages'))):
			if($pagesCount = $this->pages->getAll()):
				if($baseLanguage = $this->languages->getBaseLnguage()):
					$pages = $this->pages->getCategoryPages(0,$baseLanguage);
					for($i=0;$i<count($pages);$i++):
						$this->ExecuteCreatingPage($newLanguageID,$pages[$i]);
					endfor;
					$home = array('title'=>'home_0','description'=>'','link'=>'How to trade options','content'=>'','url'=>'','category'=>-1,'manage'=>0);
					$this->ExecuteCreatingPage($newLanguageID,$home);
					$home['title'] = 'home_1'; $home['link'] = 'Optospot trading platform features';
					$this->ExecuteCreatingPage($newLanguageID,$home);
					$home['title'] = 'home_2'; $home['link'] = 'Check out the features below, or go ahead and sign up.';
					$this->ExecuteCreatingPage($newLanguageID,$home);
					$home['title'] = 'home_3'; $home['link'] = '';
					$this->ExecuteCreatingPage($newLanguageID,$home);
					$category = $this->category->getWhere(NULL,array('language'=>$baseLanguage),TRUE);
					for($i=0;$i<count($category);$i++):
						$categoryID = $this->ExecuteCreatingPageCategories($newLanguageID,$category[$i]['title']);
						$pages = $this->pages->getCategoryPages($category[$i]['id'],$baseLanguage);
						for($j=0;$j<count($pages);$j++):
							$pages[$i]['category'] = $categoryID;
							$this->ExecuteCreatingPage($newLanguageID,$pages[$i]);
						endfor;
					endfor;
					return 'New language added!';
				endif;
			else:
				$page = array('title'=>'Home page','description'=>'','link'=>'home','content'=>'','url'=>'','category'=>0,'manage'=>0);
				$this->ExecuteCreatingPage($newLanguageID,$page);
				$page['title'] = 'home_0'; $page['link'] = 'How to trade options'; $page['category'] = -1;
				$this->ExecuteCreatingPage($newLanguageID,$page);
				$page['title'] = 'home_1'; $page['link'] = 'Optospot trading platform features'; $page['category'] = -1;
				$this->ExecuteCreatingPage($newLanguageID,$page);
				$page['title'] = 'home_2'; $page['link'] = 'Check out the features below, or go ahead and sign up.'; $page['category'] = -1;
				$this->ExecuteCreatingPage($newLanguageID,$page);
				$page['title'] = 'home_3'; $page['link'] = ''; $page['category'] = -1;
				$this->ExecuteCreatingPage($newLanguageID,$page);
				$page['title'] = 'Trade page'; $page['link'] = 'trade'; $page['url'] = 'trade'; $page['category'] = 0;
				$this->ExecuteCreatingPage($newLanguageID,$page);
				$page['title'] = 'FAQ page'; $page['link'] = 'faq'; $page['url'] = 'faq'; $page['category'] = 0;
				$this->ExecuteCreatingPage($newLanguageID,$page);
				$page['title'] = 'Deposit Info'; $page['link'] = 'deposit'; $page['url'] = 'deposit'; $page['category'] = 0;
				$this->ExecuteCreatingPage($newLanguageID,$page);
				$page['title'] = 'Contact us page'; $page['link'] = 'contact us'; $page['url'] = 'contact-us'; $page['category'] = 0;
				$this->ExecuteCreatingPage($newLanguageID,$page);
				$this->languages->updateField($newLanguageID,'active',1);
				return 'Base language added!';
			endif;
		endif;
		return FALSE;
	}
	
	private function ExecuteCreatingPage($langID,$post,$manage = NULL){
		
		if(!is_null($manage)):
			$post['manage'] = $manage;
		endif;
		$second_page = 0;
		if (isset($post['second_page'])):
			$second_page = $post['second_page'];
		endif;
		$page = array(
			"language"=>$langID,'title'=>$post['title'],'description'=>$post['description'],'link'=>$post['link'],
			'content'=>$post['content'],'url'=>$post['url'],'category'=>$post['category'],'manage'=>$post['manage'],'sort'=>$post['sort'],
			'second_page'=>$second_page
		);
		return $this->insertItem(array('insert'=>$page,'model'=>'pages'));
	}
	
	private function ExecuteUpdatingPage($pageID,$post){

		$second_page = 0;
		if (isset($post['second_page'])):
			$second_page = $post['second_page'];
		endif;
		$page = array("id"=>$pageID,'title'=>$post['title'],'description'=>$post['description'],'link'=>$post['link'],
			'content'=>$post['content'],'url'=>$post['url'],'sort'=>$post['sort'],'second_page'=>$second_page);
		if(isset($post['category'])):
			$page['category'] = $post['category'];
		endif;
		return $this->updateItem(array('update'=>$page,'model'=>'pages'));
	}
	
	private function ExecuteCreatingPageCategories($langID,$categoryTitle){
		
		$category = array("language"=>$langID,'title'=>$categoryTitle);
		return $this->insertItem(array('insert'=>$category,'model'=>'category'));
	}
	
	private function ExecuteUpdatingHomePage($langID,$post){
		
		$this->load->model('pages');
		$this->pages->updateField($post['home_main'],'title',$post['title']);
		$this->pages->updateField($post['home_main'],'description',$post['description']);
		$this->pages->updateField($post['home_main'],'link',$post['link']);
		$this->pages->updateField($post['home_main'],'url','');
		for($i=1;$i<5;$i++):
			$this->pages->updateField($post['home_'.$i],'link',$post['link_'.$i]);
			$this->pages->updateField($post['home_'.$i],'content',$post['content_'.$i]);
		endfor;
		return TRUE;
	}
	/******************************************* categories ******************************************************/
	public function langCategories(){
		
		if($this->input->post('inscategory') !== FALSE):
			unset($_POST['inscategory']);
			if($this->postDataValidation('insert_category') === TRUE):
				$this->ExecuteInsertingLangCategories($this->uri->segment(5),$this->input->post('title'));
				$this->session->set_userdata('msgs','Category added!');
				redirect('admin-panel/actions/pages/lang/'.$this->uri->segment(5).'/categories');
			else:
				$this->session->set_userdata('msgr','Error. Incorrectly filled in the required fields!');
			endif;
		endif;
		if($this->input->post('updcategory') !== FALSE):
			unset($_POST['updcategory']);
			if($this->postDataValidation('update_category') === TRUE):
				$this->ExecuteUpdatingLangCategories($this->input->post());
				$this->session->set_userdata('msgs','Category updated!');
				redirect('admin-panel/actions/pages/lang/'.$this->uri->segment(5).'/categories');
			else:
				$this->session->set_userdata('msgr','Error. Incorrectly filled in the required fields!');
			endif;
		endif;
		$this->load->model(array('languages','pages','category'));
		$pagevar = array(
			'langs' => $this->languages->getAll(),
			'langs_pages' => $this->pages->getPages(),
			'category' => $this->category->getWhere(NULL,array('language'=>$this->uri->segment(5)),TRUE),
			'form_legend' => 'Category list pages. Language: '.mb_strtoupper($this->languages->value($this->uri->segment(5),'name')),
			'msgs' => $this->session->userdata('msgs'),
			'msgr' => $this->session->userdata('msgr')
		);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		$this->load->helper('form');
		$this->load->view("admin_interface/categories",$pagevar);
	}
	
	public function deleteCategory(){
		
		if($this->uri->segment(5)):
			$this->load->model(array('category','pages'));
			$this->category->delete($this->uri->segment(5));
			$this->pages->deleteCategory($this->uri->segment(5));
			$this->session->set_userdata('msgs','Category deleted successfully.');
		else:
			$this->session->set_userdata('msgr','Error! Impossible to remove category.');
		endif;
		if(isset($_SERVER['HTTP_REFERER'])):
			redirect($_SERVER['HTTP_REFERER']);
		else:
			redirect('admin-panel/actions/pages/lang/'.$this->uri->segment(5).'/categories');
		endif;
	}
	
	private function ExecuteInsertingLangCategories($langID,$categoryTitle){
		
		$category = array("language"=>$langID,'title'=>$categoryTitle);
		return $this->insertItem(array('insert'=>$category,'model'=>'category'));
	}
	
	private function ExecuteUpdatingLangCategories($post){
		
		$category = array("id"=>$post['category_id'],'title'=>$post['title']);
		return $this->updateItem(array('update'=>$category,'model'=>'category'));
	}
	/********************************************** LOG **********************************************************/
	public function logList(){
		
		$this->offset = intval($this->uri->segment(5));
		$this->load->model('log');
		$pagevar = array(
			'logs' => array(),
			'pagination' => $this->pagination('admin-panel/log',5,$this->log->countAllResults(),$this->per_page),
		);
		$logs = $this->log->limit($this->per_page,$this->offset,'date DESC');
		$this->load->helper('date');
		for($i=0;$i<count($logs);$i++):
			$jsonLog = json_decode($logs[$i]['data'],TRUE);
			$pagevar['logs'][$i]['method'] = isset($jsonLog['method'])?$jsonLog['method']:'';
			$pagevar['logs'][$i]['fields'] = isset($jsonLog['fields'])?$jsonLog['fields']:'';
			$pagevar['logs'][$i]['Result'] = isset($jsonLog['Result'])?$jsonLog['Result']:'';
			$pagevar['logs'][$i]['Error'] = isset($jsonLog['Error'])?$jsonLog['Error']:'';
			$pagevar['logs'][$i]['date'] = swap_dot_date_without_time($logs[$i]['date']);
		endfor;
		$this->load->view("admin_interface/logList",$pagevar);
	}
	/******************************************* properties ******************************************************/
	public function langProperties(){
		
		if($this->input->post('submit') !== FALSE):
			unset($_POST['submit']);
			if($this->postDataValidation('page_property') == TRUE):
				$this->ExecuteUpdatingPageProperies($this->uri->segment(5),$this->input->post());
				$this->session->set_userdata('msgs','Language updated!');
				redirect('admin-panel/actions/pages');
			else:
				$this->session->set_userdata('msgr','Error. Incorrectly filled in the required fields!');
			endif;
		endif;
		
		$this->load->model(array('languages','pages'));
		$pagevar = array(
			'langs' => $this->languages->getAll(),
			'langs_pages' => $this->pages->getPages(),
			'lang' => $this->languages->getWhere($this->uri->segment(5)),
			'form_legend' => 'Properties language. Language: '.mb_strtoupper($this->languages->value($this->uri->segment(5),'name')),
			'msgs' => $this->session->userdata('msgs'),
			'msgr' => $this->session->userdata('msgr')
		);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		$this->load->helper('form');
		$this->load->view("admin_interface/properties",$pagevar);
	}
	
	public function langDetele(){
		
		show_error("УДАЛИТЬ ЯЗЫК НЕВОЗМОЖНО");
		
		$this->load->model(array('languages','category','pages'));
		$baseLanguage = $this->languages->getBaseLnguage();
		$lang = $this->uri->segment(5);
		if($lang != $baseLanguage):
			$this->languages->delete_record($lang,'languages');
			$this->pages->deleteLanguage($lang);
			$this->category->delete(NULL,array('language'=>$lang));
			$this->accounts->setBaseLang($lang,$baseLanguage);
			$this->session->set_userdata('msgs','Languages deleted successfully.');
			redirect('admin-panel/actions/pages');
		else:
			$this->session->set_userdata('msgr','Error! Impossible to remove language.');
			redirect(uri_string());
		endif;
	}
	
	private function ExecuteUpdatingPageProperies($languageID,$post){
		
		if(!isset($post['active'])):
			$this->load->model('languages');
			$baseLanguage = $this->languages->getBaseLnguage();
			$this->accounts->setBaseLang($this->uri->segment(5),$baseLanguage);
		endif;
		$languages = array("id"=>$languageID,"name"=>$this->filterSymbols($post['name']),"uri"=>$post['uri']);
		$this->updateItem(array('update'=>$languages,'translit'=>NULL,'model'=>'languages'));
		return TRUE;
	}
	/********************************************* users ********************************************************/
	public function accountsList(){
		
		$this->offset = intval($this->uri->segment(5));
		$pagevar = array(
			'accounts' => NULL,
			'pagination' => NULL,
			'msgs' => $this->session->userdata('msgs'),
			'msgr' => $this->session->userdata('msgr')
		);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		if($this->input->get() !== FALSE):
			$pagevar['accounts'] = $this->foundUsers($this->input->get());
			$pagevar['pagination'] = $this->pagination('admin-panel/actions/users-list'.getUrlLink(),5,$this->TotalCount,PER_PAGE_DEFAULT,TRUE);
		else:
            $moderator = $this->input->get('moderators') ? 1 : 0;
            $moderator = $this->input->get('administrators') ? 2 : 0;
			$pagevar['accounts'] = $this->accounts->limit($this->per_page,$this->offset,NULL,array('moderator'=>$moderator));
			$pagevar['pagination'] = $this->pagination('admin-panel/actions/users-list',5,$this->accounts->countAllResults(array('id >'=> 0)),$this->per_page);
		endif;
		$this->load->helper(array('date','form'));
		for($i=0;$i<count($pagevar['accounts']);$i++):
			$pagevar['accounts'][$i]['password'] = $this->encrypt->decode($pagevar['accounts'][$i]['trade_password']);
			$pagevar['accounts'][$i]['signdate'] = swap_dot_date($pagevar['accounts'][$i]['signdate']);
			$pagevar['accounts'][$i]['verification'] = FALSE;
		endfor;
        if (count($pagevar['accounts'])):
            $accountIDs = array();
            foreach($pagevar['accounts'] as $account):
                $accountIDs[] = $account['id'];
            endforeach;
            if (count($accountIDs)):
                $this->load->model('users_documents');
                if($documents = $this->users_documents->getWhereIN(array('field'=>'user_id','where_in'=>$accountIDs,'where'=>array('approved'=>1),'many_records'=>TRUE))):
                    $accountDocuments = array();
                    foreach($documents as $index => $document):
                        @$accountDocuments[$document['user_id']]++;
                    endforeach;
                endif;
            endif;
            foreach($pagevar['accounts'] as $index => $account):
                if (isset($accountDocuments[$account['id']]) && $accountDocuments[$account['id']] == 2):
                    $pagevar['accounts'][$index]['verification'] = TRUE;
                endif;
            endforeach;
        endif;
		$this->session->set_userdata('backpath',base_url(uri_string()));
		$this->load->view("admin_interface/users/users",$pagevar);
	}
	
	private function foundUsers($get_params){
		
		$searchParameters = array();
		$users = array();
		if($this->input->get('period_begin') !== ''):
			$searchParameters['signdate >='] = preg_replace("/(\d+)\.(\w+)\.(\d+)/i","\$3-\$2-\$1",$this->input->get('period_begin'));
		endif;
		if($this->input->get('period_end') !== ''):
			$searchParameters['signdate <='] = preg_replace("/(\d+)\.(\w+)\.(\d+)/i","\$3-\$2-\$1",$this->input->get('period_end'));
		endif;
			$users = $this->accounts->search_limit($searchParameters,$this->input->get('login'),$this->input->get('email'));
			$this->TotalCount = $this->accounts->search_count($searchParameters,$this->input->get('login'),$this->input->get('email'));
		return $users;
	}

	public function accountEdit(){
		
		if($this->input->post('submit') !== FALSE):
			unset($_POST['submit']);
			if($this->postDataValidation('edit_account') == TRUE):
				$this->ExecuteUpdatingAccount($this->uri->segment(6),$this->input->post());
				$this->session->set_userdata('msgs','Profile saved!');
				redirect($this->session->userdata('backpath'));
			else:
				$this->session->set_userdata('msgr','Error. Incorrectly filled in the required fields!');
			endif;
		endif;
		$this->load->model(array('languages','users_documents'));
		$pagevar = array(
			'langs' => $this->languages->getAll(),
			'account' => $this->accounts->getWhere($this->uri->segment(6)),
			'msgs' => $this->session->userdata('msgs'),
			'msgr' => $this->session->userdata('msgr'),
			'documents' => $this->users_documents->getWhere(NULL,array('user_id'=>$this->uri->segment(6)),TRUE)
		);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		$this->load->helper(array('date','form'));
		$pagevar['account']['password'] = $this->encrypt->decode($pagevar['account']['trade_password']);
		$pagevar['account']['signdate'] = swap_dot_date($pagevar['account']['signdate']);
		$this->load->view("admin_interface/users/user-edit",$pagevar);
	}
	
	public function accountDelete(){
		
		if($this->uri->segment(6) !== FALSE):
			$result = $this->accounts->delete($this->uri->segment(6));
			$this->session->set_userdata('msgs','User deleted successfully.');
			redirect($this->session->userdata('backpath'));
		else:
			show_404();
		endif;
	}

	public function documents(){

		$this->load->model('users_documents');
		$pagevar = array(
			'documents' => array(),
			'msgs' => $this->session->userdata('msgs'),
			'msgr' => $this->session->userdata('msgr'),
		);
		$documents = array();
		if($all_documents = $this->users_documents->getAll()):
			foreach($this->db->select('id,first_name,last_name,trade_login')->get('users')->result_array() as $account):
				foreach($all_documents as $index => $document):
					if ($document['user_id'] == $account['id']):
						$all_documents[$index]['name'] = $account['first_name'].' '.$account['last_name'];
						$all_documents[$index]['trade_login'] = $account['trade_login'];
					endif;
				endforeach;
			endforeach;
			foreach($all_documents as $index => $document):
				$documents[$document['user_id']][$index]['document_id'] = $document['id'];
				$documents[$document['user_id']][$index]['type'] = $document['type'];
				$documents[$document['user_id']][$index]['path'] = $document['path'];
				$documents[$document['user_id']][$index]['comment'] = $document['comment'];
				$documents[$document['user_id']][$index]['approved'] = $document['approved'];
				$documents[$document['user_id']][$index]['original_name'] = $document['original_name'];
				$documents[$document['user_id']][$index]['filesize'] = $document['filesize'];
				$documents[$document['user_id']][$index]['date'] = $document['created_at'];
				$documents[$document['user_id']][$index]['name'] = @$document['name'];
				$documents[$document['user_id']][$index]['trade_login'] = @$document['trade_login'];
			endforeach;
		endif;
		$pagevar['documents'] = $documents;
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		$this->load->view("admin_interface/documents",$pagevar);
	}

	public function approveDocuments(){

		$this->db->where('id',$this->uri->segment(4))->update('users_documents',array('approved'=>1));
        if (!empty($_SERVER['HTTP_REFERER'])):
            redirect($_SERVER['HTTP_REFERER']);
        endif;
        redirect('admin-panel/documents');
	}

	public function rejectDocuments(){

		$record = $this->db->where('id',$this->uri->segment(4))->select('user_id,path')->get('users_documents')->result_array();
		if ($this->input->post('content') != '' && isset($record[0]['user_id'])):
			$account = $this->db->select('email,language')->where('id',$record[0]['user_id'])->get('users')->result_array();
			if (isset($account[0]['email'])):
                $data = $this->input->post();
                $data['lang'] = @$account[0]['language'];
                if (empty($data['lang'])):
                    $data['lang'] = 3;
                endif;
				$mailtext = $this->load->view('mails/reject-document',$data,TRUE);
				$result = $this->sendMail($account[0]['email'],'support@optospot.net','Optospot trading platform','Ваш документ для верификации был отлонён',$mailtext);
			endif;
		endif;
		$this->db->where('id',$this->uri->segment(4))->update('users_documents',array('approved'=>2,'comment'=>$this->input->post('content')));
		if (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])):
			redirect($_SERVER['HTTP_REFERER']);
		else:
			redirect('admin-panel/documents');
		endif;
	}

    public function deleteDocuments(){

		$record = $this->db->where('id',$this->uri->segment(4))->select('user_id,path')->get('users_documents')->result_array();
		if ($this->input->post('content') != '' && isset($record[0]['user_id'])):
			$account = $this->db->select('email')->where('id',$record[0]['user_id'])->get('users')->result_array();
			if (isset($account[0]['email'])):
				$mailtext = $this->load->view('mails/reject-document',$this->input->post(),TRUE);
				$result = $this->sendMail($account[0]['email'],'support@optospot.net','Optospot trading platform','The reason for the deviation of the document',$mailtext);
			endif;
		endif;
		if (isset($record[0]['path'])):
			unlink(getcwd().'/'.$record[0]['path']);
		endif;
		$this->db->where('id',$this->uri->segment(4))->delete('users_documents');
		if (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])):
			redirect($_SERVER['HTTP_REFERER']);
		else:
			redirect('admin-panel/documents');
		endif;
	}

	private function ExecuteUpdatingAccount($accountID,$post){
		
		if(isset($post['coach'])):
			$post['coach'] = 0;
		else:
			$post['coach'] = 1;
		endif;
		if(!isset($post['active'])):
			$post['active'] = 0;
		endif;
		$account = array("id"=>$accountID,"first_name"=>$post['first_name'],"last_name"=>$post['last_name'],"zip_code"=>$post['zip_code'],
						"day_phone"=>$post['day_phone'],"home_phone"=>$post['home_phone'],"address1"=>$post['address1'],"address2"=>$post['address2'],
						"country"=>$post['country'],"state"=>$post['state'],"city"=>$post['city'],"active"=>$post['active'],"coach"=>$post['coach']);
		$this->updateItem(array('update'=>$account,'translit'=>NULL,'model'=>'accounts'));
		return TRUE;
	}
}