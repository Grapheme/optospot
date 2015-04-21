<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
	
	$config = array(
		'signin' =>array(
			array('field'=>'login','label'=>'Login','rules'=>'required|trim'),
			array('field'=>'password','label'=>'Password','rules'=>'required|trim')
		),
		'forgot' =>array(
			array('field'=>'email','label'=>'Email','rules'=>'required|valid_email|trim'),
		),
		'signup' =>array(
			array('field'=>'answerType','label'=>' ','rules'=>'required|trim|xss_clean'),
			array('field'=>'act','label'=>' ','rules'=>'required|trim|xss_clean'),
			array('field'=>'office','label'=>' ','rules'=>'required|trim|xss_clean'),
			array('field'=>'fname','label'=>' ','rules'=>'required|trim|xss_clean'),
			array('field'=>'lname','label'=>' ','rules'=>'required|trim|xss_clean'),
			array('field'=>'email','label'=>' ','rules'=>'required|valid_email|trim|xss_clean'),
			array('field'=>'country','label'=>' ','rules'=>'required|trim'),
			array('field'=>'account_type','label'=>' ','rules'=>'required|trim|xss_clean'),
		),
        'signup_affiliate' =>array(
			array('field'=>'user_id','label'=>'User ID','rules'=>'required'),
			array('field'=>'answerType','label'=>' ','rules'=>'required|trim|xss_clean'),
			array('field'=>'act','label'=>' ','rules'=>'required|trim|xss_clean'),
			array('field'=>'office','label'=>' ','rules'=>'required|trim|xss_clean'),
			array('field'=>'first_name','label'=>' ','rules'=>'required|trim|xss_clean'),
			array('field'=>'last_name','label'=>' ','rules'=>'required|trim|xss_clean'),
			array('field'=>'email','label'=>' ','rules'=>'required|valid_email|trim|xss_clean'),
			array('field'=>'country','label'=>' ','rules'=>'required|trim'),

			array('field'=>'address1','label'=>' ','rules'=>'required|trim|xss_clean'),
			array('field'=>'city','label'=>' ','rules'=>'required|trim|xss_clean'),
			array('field'=>'state','label'=>' ','rules'=>'required|trim|xss_clean'),
			array('field'=>'passport_id','label'=>' ','rules'=>'required|trim|xss_clean'),
			array('field'=>'departmental','label'=>' ','rules'=>'required|trim|xss_clean'),
			array('field'=>'phone','label'=>' ','rules'=>'required|trim|xss_clean'),
		),
		'account_type' =>array(
			array('field'=>'type','label'=>' ','rules'=>'required|trim|xss_clean'),
		),
		'edit_account' =>array(
			array('field'=>'first_name','label'=>' ','rules'=>'required|trim|xss_clean'),
			array('field'=>'last_name','label'=>' ','rules'=>'required|trim|xss_clean'),
			array('field'=>'zip_code','label'=>' ','rules'=>'trim|xss_clean'),
			array('field'=>'day_phone','label'=>' ','rules'=>'trim'),
			array('field'=>'home_phone','label'=>' ','rules'=>'trim'),
			array('field'=>'address1','label'=>' ','rules'=>'trim'),
			array('field'=>'address2','label'=>' ','rules'=>'trim'),
			array('field'=>'country','label'=>' ','rules'=>'trim'),
			array('field'=>'state','label'=>' ','rules'=>'trim'),
			array('field'=>'city','label'=>' ','rules'=>'trim'),
		),
		'edit_settings' =>array(
			array('field'=>'registration','label'=>' ','rules'=>'required|trim|xss_clean'),
			array('field'=>'charts','label'=>' ','rules'=>'required|trim|xss_clean'),
			array('field'=>'deposit','label'=>' ','rules'=>'trim|xss_clean'),
		),
		'insert_language' =>array(
			array('field'=>'name','label'=>' ','rules'=>'required|trim|xss_clean'),
			array('field'=>'nickname','label'=>' ','rules'=>'required|trim|xss_clean'),
		),
		'page_property' =>array(
			array('field'=>'name','label'=>' ','rules'=>'required|trim|xss_clean'),
			array('field'=>'uri','label'=>' ','rules'=>'required|trim|xss_clean'),
		),
		'insert_category' =>array(
			array('field'=>'title','label'=>' ','rules'=>'required|trim|xss_clean'),
		),
		'update_category' =>array(
			array('field'=>'title','label'=>' ','rules'=>'required|trim|xss_clean'),
			array('field'=>'category_id','label'=>' ','rules'=>'required|numeric|trim'),
		),
		'insert_page' =>array(
			array('field'=>'title','label'=>' ','rules'=>'trim|xss_clean'),
			array('field'=>'description','label'=>' ','rules'=>'trim|xss_clean'),
			array('field'=>'link','label'=>' ','rules'=>'required|trim|xss_clean'),
			array('field'=>'url','label'=>' ','rules'=>'required|trim|xss_clean'),
			array('field'=>'content','label'=>' ','rules'=>'trim'),
			array('field'=>'category','label'=>' ','rules'=>'trim|numeric|xss_clean'),
		),
		'home_page' =>array(
			array('field'=>'home_main','label'=>' ','rules'=>'required|numeric|trim'),
			array('field'=>'title','label'=>' ','rules'=>'trim'),
			array('field'=>'description','label'=>' ','rules'=>'trim'),
			array('field'=>'link','label'=>' ','rules'=>'required|trim'),
			array('field'=>'url','label'=>' ','rules'=>'trim'),
			array('field'=>'home_1','label'=>' ','rules'=>'required|numeric|trim'),
			array('field'=>'link_1','label'=>' ','rules'=>'trim'),
			array('field'=>'content_1','label'=>' ','rules'=>'trim'),
			
			array('field'=>'home_2','label'=>' ','rules'=>'required|numeric|trim'),
			array('field'=>'link_2','label'=>' ','rules'=>'trim'),
			array('field'=>'content_2','label'=>' ','rules'=>'trim'),
			
			array('field'=>'home_3','label'=>' ','rules'=>'required|numeric|trim'),
			array('field'=>'link_3','label'=>' ','rules'=>'trim'),
			array('field'=>'content_3','label'=>' ','rules'=>'trim'),
			
			array('field'=>'home_4','label'=>' ','rules'=>'required|numeric|trim'),
			array('field'=>'link_4','label'=>' ','rules'=>'trim'),
			array('field'=>'content_4','label'=>' ','rules'=>'trim'),
		),
		'withdraw' => array(
			array('field'=>'deposit','label'=>'deposit','rules'=>'required|numeric|trim|xss_clean'),
			array('field'=>'account','label'=>'account','rules'=>'required|numeric|trim|xss_clean'),
			array('field'=>'payment','label'=>'payment','rules'=>'required|numeric|trim|xss_clean'),
			
		),
		'user_withdraw' => array(
			array('field'=>'account_id','label'=>'','rules'=>'required|numeric|trim|xss_clean'),
			array('field'=>'trade_login','label'=>'','rules'=>'required|trim|xss_clean'),
			array('field'=>'email','label'=>'email','rules'=>'required|email|trim|xss_clean'),
			array('field'=>'payment','label'=>'payment','rules'=>'required|numeric|trim|xss_clean'),
			array('field'=>'account','label'=>'account','rules'=>'trim|xss_clean'),
			array('field'=>'amount','label'=>'amount','rules'=>'trim|xss_clean'),
			array('field'=>'name','label'=>'name','rules'=>'trim|xss_clean'),
			array('field'=>'expiry','label'=>'expiry','rules'=>'trim|xss_clean')
		),
	);
?>