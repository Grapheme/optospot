<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Languages extends MY_Model{
	
	protected $table = "languages";
	protected $primary_key = "id";
	protected $fields = array("id","name","uri","active","base");
    protected $order_by = 'id';

	function __construct(){
		parent::__construct();
	}
	
	function visibleLanguages($field = 'id',$order = 'ASC'){
		
		$this->db->where('active',1);
		$this->db->order_by($field,$order);
		$query = $this->db->get($this->table);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function getBaseLanguage(){
	
		$this->db->where('base',TRUE);
		$query = $this->db->get($this->table,1);
		$data = $query->result_array();
		if($data) return $data[0]['id'];
		return FALSE;
	}
	
	function languageExist($string){
		
		$this->db->select($this->fields);
		$this->db->where('active',1);
		$this->db->where('uri',$string);
		$query = $this->db->get($this->table,1);
		if($data = $query->result_array()):
			return $data[0];
		endif;
		return FALSE;
	}
	
	function getLanguageID($string){
		
		$this->db->select($this->primary_key);
		$this->db->where('name',$string);
		$this->db->or_where('uri',$string);
		$query = $this->db->get($this->table,1);
		if($data = $query->result_array()):
			return $data[0][$this->primary_key];
		endif;
		return FALSE;
	}

    public function getLangs(){

        if ($this->profile['moderator'] == 1):
            $languagesIDs = array();
            foreach($this->db->select('language_id')->where('user_id',$this->profile['id'])->get('moderator_languages')->result_array() as $index => $langs):
                $languagesIDs[] = $langs['language_id'];
            endforeach;
            if ($languagesIDs):
                $this->db->select($this->_fields())->order_by($this->order_by)->where_in('id',$languagesIDs);
            else:
                return NULL;
            endif;
        else:
            $this->db->select($this->_fields())->order_by($this->order_by);
        endif;
        $query = $this->db->get($this->table);
        if($data = $query->result_array()):
            return $data;
        endif;
        return NULL;
    }
}