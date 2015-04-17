<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "users_interface";
$route['404_override'] = '';

$route['redactor/upload'] = "users_interface/redactorUploadImage";
$route['redactor/get-uploaded-images'] = "users_interface/redactorUploadedImages";
$route['get-signup-accounts(\/:num)*?'] = "users_interface/getSignupAccount";
/************************************************** CLIENT INTRERFACE ***********************************************/
$route[':any/cabinet/balance'] = "clients_interface/balance";
$route[':any/cabinet/open-account'] = "clients_interface/openAccount";
$route[':any/cabinet/my-accounts'] = "clients_interface/myAccounts";
$route[':any/cabinet/partner-program'] = "clients_interface/partnerProgram";
$route[':any/cabinet/profile'] = "clients_interface/profile";
$route[':any/cabinet/withdraw'] = "clients_interface/withdraw";
$route[':any/cabinet/documents/upload'] = "clients_interface/uploadWithdrawDocument";
/************************************* CLIENT INTRERFACE IB PROGRAMM ***********************************************/
$route[':any/cabinet/partner-program'] = "clients_interface/partnerProgram";
$route[':any/cabinet/register-affiliate'] = "clients_interface/partnerProgramRegisterAffiliate";
/*************************************************** ADMINS INTRERFACE ***********************************************/
$route['admin-panel/actions/users-list(\/:any)*?'] = "admin_interface/accountsList";
$route['admin-panel/actions/users/edit/id/:num'] = "admin_interface/accountEdit";
$route['admin-panel/actions/users/delete/id/:num'] = "admin_interface/accountDelete";
$route['admin-panel/actions/pages'] = "admin_interface/pagesLang";
$route['admin-panel/actions/pages/lang/:num/categories'] = "admin_interface/langCategories";
$route['admin-panel/actions/pages/lang/:num/properties'] = "admin_interface/langProperties";
$route['admin-panel/actions/pages/lang/:num/new-page'] = "admin_interface/insertNewPage";
$route['admin-panel/actions/pages/lang/:num/page/:num'] = "admin_interface/editPage";
$route['admin-panel/actions/pages/lang/:num/page/home'] = "admin_interface/homePage";
$route['admin-panel/actions/pages/lang/:num/page/trade'] = "admin_interface/menuPage";
$route['admin-panel/actions/pages/lang/:num/page/faq'] = "admin_interface/menuPage";
$route['admin-panel/actions/pages/lang/:num/page/deposit'] = "admin_interface/menuPage";
$route['admin-panel/actions/pages/lang/:num/page/contact-us']= "admin_interface/menuPage";
$route['admin-panel/actions/pages/delete-lang/:num'] = "admin_interface/langDetele";
$route['admin-panel/actions/pages/delete-category/:num'] = "admin_interface/deleteCategory";
$route['admin-panel/actions/pages/delete-page/:num'] = "admin_interface/deletePage";
$route['admin-panel/actions/settings'] = "admin_interface/settings";
$route['admin-panel/actions/profile'] = "admin_interface/actions_profile";
$route['redactor/upload'] = "admin_interface/redactorUploadImage";
$route['admin-panel/withdraw'] = "admin_interface/withdraw";
$route['admin-panel/withdraw-astropay-request'] = "admin_interface/withdrawAstropayRequest";

$route['admin-panel/documents'] = "admin_interface/documents";
$route['admin-panel/documents/approve/:num'] = "admin_interface/approveDocuments";
$route['admin-panel/documents/reject/:num'] = "admin_interface/rejectDocuments";
$route['admin-panel/documents/delete/:num'] = "admin_interface/deleteDocuments";

$route['admin-panel/registered(\/:any)*?'] = "admin_interface/registered";
$route['admin-panel/log(\/:any)*?'] = "admin_interface/logList";
/*************************************************** USERS INTRERFACE ***********************************************/
$route[':any/login'] = "ajax_interface/loginIn";
$route[':any/signup'] = "ajax_interface/signUp";
$route[':any/signup-account'] = "ajax_interface/signUp";
$route[':any/signup-real-account'] = "ajax_interface/createRealAccount";
$route[':any/signup-demo-account'] = "ajax_interface/createDemoAccount";
$route[':any/signup-affiliate-account'] = "ajax_interface/createAffiliateAccount";

$route[':any/cabinet/withdraw/request'] = "ajax_interface/withdrawRequest";

$route['get-chart-link'] = "ajax_interface/getChartLink";
$route[':any/forgot-password'] = "ajax_interface/forgotPassword";
$route[':any/create-account'] = "users_interface/createAccount";
$route['(:any\/)*?logoff'] = "users_interface/logoff";

$route[':any/trade'] = "users_interface/trade";
$route['ru/award'] = "users_interface/award";
//$route[':any/chat'] = "users_interface/chat";
$route[':any/binarnaya-platforma/online-treiding'] = "users_interface/trade";
$route[':any/ticker-curl'] = "ajax_interface/tickerCurl";

$route[':any/registering'] = "users_interface/registering";
$route[':any/change-site-language/:any'] = "global_interface/changeLanguage";

$route[':any/perfectmoney/checked'] = "users_interface/perfectMoneyChecked";

$route[':any/:any'] = "users_interface/pages";
$route['ru|ind|en'] = "users_interface/index";