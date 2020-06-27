<?php
    include 'config-default.php';
    
    // Load utils classes
	foreach (glob("utils/*.php") as $filename)
		include $filename;

    // Load repositories
	foreach (glob("repositories/*.php") as $filename)
		include $filename;

    if (!isset($_SESSION)) 
        session_start();

    // Routing
	$module = '';
	if(isset($_GET['module'])) {
		$module = mysql::escape($_GET['module']);
	}
	
	$id = '';
	if(isset($_GET['id'])) {
		$id = mysql::escape($_GET['id']);
	}
	
	$action = '';
	if(isset($_GET['action'])) {
		$action = mysql::escape($_GET['action']);
    }
    
    if(empty($module) || empty($action))
    {
        Router::Redirect();
    }
        
    // Load action file
	$actionFile = "";
    if(!empty($module) && !empty($action))
    {
		$actionFile = "controls/{$module}/{$action}.php";
    }
    
    if (!file_exists($actionFile))
    {
        ToastMessages::Add('danger', 'Requested action could not be completed!');
        Router::Redirect();
    }
	
	include 'views/main.php';
?>