<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_users_interface extends MY_Controller{
	
	var $per_page = PER_PAGE_DEFAULT;
	var $offset = 0;
	var $TotalCount = 0;
	
	function __construct(){
		
		parent::__construct();

        if (!$this->sectionRoles($this->uri->segment(3))):
            show_error('Access Denied.');
        endif;
	}
    /********************************************************************************************************/
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
		if($this->input->get('search') !== FALSE):
			$pagevar['accounts'] = $this->foundUsers($this->input->get());
			$pagevar['pagination'] = $this->pagination('admin-panel/actions/users-list'.getUrlLink(),5,$this->TotalCount,PER_PAGE_DEFAULT,TRUE);
		else:
			$pagevar['accounts'] = $this->accounts->limit($this->per_page,$this->offset,NULL,array('moderator'=>(int)$this->input->get('group')));
            $pagevar['pagination'] = $this->pagination('admin-panel/actions/users-list',5,$this->accounts->countAllResults(array('moderator'=>(int)$this->input->get('group'))),$this->per_page);
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