<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Accounts extends MY_Model
{

	protected $table = "users";
	protected $primary_key = "id";
	protected $fields = array("*");

	function __construct()
	{

		parent::__construct();
	}

	function authentication($login = NULL,$password = NULL)
	{

		if(!is_null($login) || !is_null($password)):
		$this->db->select($this->_fields());
		$this->db->where('trade_login',$login);
		$this->db->where('password',md5($password));
		$query = $this->db->get($this->table,1);
		if($data = $query->result_array()):
		return $data[0];
		endif;
		endif;
		return FALSE;
	}

	function validationTemporaryCode($code = NULL)
	{

		if(!is_null($code)):
		$this->load->helper('date');
		$this->db->where('temporary_code',$code);
		$this->db->where('code_life >=',now());
		$query = $this->db->get($this->table,1);
		$data  = $query->result_array();
		if($data):
		return $data[0][$this->primary_key];
		endif;
		endif;
		return FALSE;
	}

	function setBaseLang($language,$baseLang)
	{

		$this->db->set('language',$baseLang);
		$this->db->where('language',$language);
		$this->db->update($this->table);
		return $this->db->affected_rows();
	}

	function getFields($fields,$where = NULL)
	{

		$this->db->select($fields);
		if(!is_null($where)):
		$this->db->where($where);
		endif;
		$query = $this->db->get($this->table);
		if($data = $query->result_array()):
		return $data;
		endif;
		return NULL;

	}

	function getRegisteredList($limit,$offset)
	{

		$this->db->select('COUNT(*) AS count,signdate');
		$this->db->where('active',1);
		$this->db->limit($limit,$offset);
		$this->db->group_by('signdate');
		$this->db->order_by('signdate DESC');
		$query = $this->db->get($this->table);
		if($data = $query->result_array()):
		return $data;
		endif;
		return NULL;
	}

	function getCountRegistered($total = FALSE)
	{

		$this->db->select('COUNT(*) AS count');
		$this->db->where('active',1);
		$this->db->group_by('signdate');
		$query = $this->db->get($this->table);
		if($data = $query->result_array()):
		if($total === FALSE):
		return count($data);
		else:
		$summa_counts = 0;
		for($i = 0;$i < count($data);$i++):
		$summa_counts += $data[$i]['count'];
		endfor;
		return $summa_counts;
		endif;
		endif;
		return 0;
	}

	function search_limit($where = NULL,$login = '',$email = '',$field_where_in = NULL)
	{

		$this->db->select($this->_fields());
		$this->db->order_by('signdate DESC,trade_login,email');
		$this->db->limit(PER_PAGE_DEFAULT,(int)$this->input->get('offset'));
		if(!is_null($where) && is_array($where)):
		$this->db->where($where);
		endif;
		if(!is_null($field_where_in)):
		$this->db->where_in($field_where_in['field'],$field_where_in['value']);
		endif;
		if(!is_null($field_where_in)):
		$this->db->where_in($field_where_in['field'],$field_where_in['value']);
		endif;
		if(!empty($email)):
		$this->db->like('email',$email);
		endif;
		if(!empty($login)):
		$this->db->like('trade_login',$login);
		endif;
		$query = $this->db->get($this->table);
		if($data = $query->result_array()):
		return $data;
		endif;
		return NULL;
	}

	function search_count($where = NULL,$login = '',$email = '',$field_where_in = NULL)
	{

		$this->db->select($this->_fields());
		if(!is_null($where) && is_array($where)):
		$this->db->where($where);
		endif;
		if(!is_null($field_where_in)):
		$this->db->where_in($field_where_in['field'],$field_where_in['value']);
		endif;
		if(!empty($email)):
		$this->db->like('email',$email);
		endif;
		if(!empty($login)):
		$this->db->like('trade_login',$login);
		endif;
		return $this->db->count_all_results($this->table);
	}

}