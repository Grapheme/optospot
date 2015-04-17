<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Log extends MY_Model{
	
	protected $table = "log";
	protected $primary_key = "id";
	protected $fields = array("id","data","date");

	function __construct(){
		parent::__construct();
	}
}