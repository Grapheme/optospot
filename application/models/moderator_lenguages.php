<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Moderator_lenguages extends MY_Model {

    protected $table = "moderator_lenguages";
    protected $primary_key = "id";
    protected $fields = array("*");

    function __construct(){

        parent::__construct();
    }

}