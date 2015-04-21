<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_interface extends MY_Controller{
	
	var $per_page = PER_PAGE_DEFAULT;
	var $offset = 0;
	var $TotalCount = 0;
	
	function __construct(){
		
		parent::__construct();
        if (!$this->is_moderator()):
            show_error('Access Denied.');
        endif;
	}

    public function redactorUploadImage(){

        $uploadPath = getcwd().'/download/';
        $fileName = $this->uploadSingleImage($uploadPath);
        $file = array('filelink'=>base_url('download/'.$fileName));
        echo stripslashes(json_encode($file));
    }
    /******************************************* WITHDRAWAL ******************************************************/
    public function withdraw(){

        if (!$this->sectionRoles($this->uri->segment(2))):
            show_error('Access Denied.');
        endif;

        $this->load->helper('form');
        $this->load->config('withdraw');
        $this->session->set_userdata('backpath',current_url());
        $this->load->view("admin_interface/withdraw");
    }

    public function withdrawAstropayRequest(){

        if (!$this->sectionRoles('withdraw')):
            show_error('Access Denied.');
        endif;

        $this->load->config('withdraw');
        $post_data = $this->input->post();

        $message = $this->input->post('external_id').'I'.$this->input->post('cpf').'L'.$this->input->post('country').'2'.$this->input->post('amount').'8'.$this->input->post('bank').'C'.$this->input->post('bank_branch').'O'.$this->input->post('bank_account');
        $post_data['control'] = strtoupper(hash_hmac('sha256',pack('A*',$message),pack('A*',$this->config->item('astropay_secret_key'))));
        $this->load->view("admin_interface/withdraw/astropay_request",compact('post_data'));
    }
    /**************************************************************************************************************/
	public function settings(){

        if (!$this->sectionRoles($this->uri->segment(3))):
            show_error('Access Denied.');
        endif;

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

        if (!$this->sectionRoles($this->uri->segment(2))):
            show_error('Access Denied.');
        endif;

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

        if (!$this->sectionRoles('settings')):
            show_error('Access Denied.');
        endif;

		$this->load->model('settings');
		$this->settings->updateField(1,'link',$post['registration']);
		$this->settings->updateField(2,'link',$post['charts']);
		$this->settings->updateField(3,'link',$post['deposit']);
	}
	/********************************************** LOG **********************************************************/
	public function logList(){

        if (!$this->sectionRoles($this->uri->segment(2))):
            show_error('Access Denied.');
        endif;

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
    /********************************************* DOCUMENTS *****************************************************/
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
}