<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends MY_Model{
	
	protected $table = "settings";
	protected $primary_key = "id";
	protected $fields = array("id","link");

	function __construct(){
		parent::__construct();
	}
}