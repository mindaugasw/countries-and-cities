<?php
	include 'config-default.php';
	foreach (glob("utils/*.php") as $filename)
		include $filename;

	foreach (glob("libraries/*.php") as $filename)
		include $filename;

	session_start();

	/*if (!isset($_SESSION['email']) || !isset($_SESSION['rolelevel'])) { // NOT LOGGED IN - forward to login page
		if (isset($_GET['module']) && $_GET['module'] == 'login' && isset($_GET['action']) && $_GET['action'] == 'register')
		{
			 // Not logged in, but going to registration page
		} else {
			$_GET['module'] = 'login';
			$_GET['action'] = 'log_in';
		}
	}*/
	
	// Set default pages
	/*if (!isset($_GET['module']) || !isset($_GET['action'])) {
		$_GET['module'] = 'jobs';
		if ($_SESSION['rolelevel'] === 'user') {
			$_GET['action'] = 'all_untaken_list';
		} else if ($_SESSION['rolelevel'] === 'manager') {
			$_GET['action'] = 'my_manager_list';
		} else if ($_SESSION['rolelevel'] === 'admin') {
			$_GET['action'] = 'all_admin_list';
		}
	}*/

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
        header("Location: ./?module=countries&action=list");
        die();
    }
		
	$actionFile = "";
	if(!empty($module) && !empty($action)) {
		$actionFile = "controls/{$module}/{$action}.php";
	}
	
	include 'views/main.php';
?>