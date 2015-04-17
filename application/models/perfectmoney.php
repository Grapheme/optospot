<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Perfectmoney extends MY_Model {

    protected $table = "perfectmoney";
    protected $primary_key = "id";
    protected $fields = array("*");

    function __construct(){

        parent::__construct();
    }

}