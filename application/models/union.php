<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Union extends CI_Model{

	function __construct(){
		parent::__construct();
	}
	
	function readPassports($count,$from){
		
		$query = "SELECT register.*,organization.title FROM register INNER JOIN organization ON register.expert=organization.id ORDER BY register.number DESC,organization.title LIMIT $from,$count";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
}