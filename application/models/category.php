<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Category extends MY_Model{
	
	protected $table = "category";
	protected $primary_key = "id";
	protected $fields = array("id","language","title");

	function __construct(){
		parent::__construct();
	}
}