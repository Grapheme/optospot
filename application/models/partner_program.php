<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Partner_program extends MY_Model {

    protected $table = "partner_program";
    protected $primary_key = "id";
    protected $fields = array("*");

    function __construct()
    {

        parent::__construct();
    }

}