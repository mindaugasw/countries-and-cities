<?php

class Startup
{
    /**
     * Load all utility classes and models, sanitize path variables.
     */
    public static function Start()
    {
        include 'config-default.php';
        Config::Initialize();
    
        // Load utils, models
        foreach (glob("utils/*.php") as $filename)
            include $filename;

        foreach (glob("models/*.php") as $filename)
            include $filename;

        if (!isset($_SESSION)) 
            session_start();

        // Routing
        $module = '';
        if(isset($_GET['module']))
            $module = mysql::escape($_GET['module']);
        
        $action = '';
        if(isset($_GET['action']))
            $action = mysql::escape($_GET['action']);

        $id = '';
        if(isset($_GET['id']))
            $id = mysql::escape($_GET['id']);

        return [$module, $action, $id];
    }
}
