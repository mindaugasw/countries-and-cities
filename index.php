<?php

    include 'Startup.php';
    list($module, $action, $id) = Startup::Start();
       
    // Load action file
    $actionFile = "";
    if(empty($module) || empty($action))
        Router::Redirect();
    else
		$actionFile = "controls/{$module}/{$action}.php";
    
    if (!file_exists($actionFile))
    {
        ToastMessages::Add('danger', 'Requested action could not be completed!');
        Router::Redirect();
    }
	
	include Router::View('main');
?>