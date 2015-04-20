<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Page_interface extends MY_Controller{
	
	var $per_page = PER_PAGE_DEFAULT;
	var $offset = 0;
	var $TotalCount = 0;
	
	function __construct(){
		
		parent::__construct();

        if (!$this->sectionRoles('pages')):
            show_error('Access Denied.');
        endif;
	}
	/********************************************************************************************************/
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
		$this->load->view("admin_interface/pages/list",$pagevar);
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
		$this->load->view("admin_interface/pages/list",$pagevar);
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
		$this->load->view("admin_interface/pages/list",$pagevar);
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
		$this->load->view("admin_interface/pages/home",$pagevar);
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
}