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
        Router::Redirect("countries", "list");
    }
        
    // Load action file
	$actionFile = "";
	if(!empty($module) && !empty($action)) {
		$actionFile = "controls/{$module}/{$action}.php";
	}
	
	include 'views/main.php';
?>