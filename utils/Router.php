<?php

class Router {

    /**
     * Client files directory
     */
    private static $clientDir = "public";

    /**
     * Creates a clickable link for specified action, e.g. ./module=countries&action=details&id=5
     * Defaults to countries/list if no arguments are specified.
     * 
     * @param string $module
     * @param string $action
     * @param int $id
     * @return string Clickable link
     */
    public static function Link($module = "countries", $action = "list", $id = NULL)
    {
        $a = "./?module=$module&action=$action";

        if ($id !== NULL)
            $a .= "&id=$id";
        
        return $a;
    }

    /**
     * Redirects to specified action. Defaults to homepage if no module/action are specified.
     * 
     * @param string $module
     * @param string $action
     * @param int $id
     * @return exit
     */
    public static function Redirect($module = "countries", $action = "list", $id = NULL)
    {
        header("Location: ".Router::Link($module, $action, $id));
        die();
    }

    /**
     * Returns full path for a view.
     * 
     * @param string $view View path, e.g. 'countries/form'.
     * @return string
     */
    public static function View($view)
    {
        return "views/$view.php";
    }

    /**
     * Returns full path for JS file
     */
    public static function Js($path)
    {
        return Router::$clientDir."/js/".$path.".js";
    }

    /**
     * Returns full path for CSS file
     */
    public static function Css($path)
    {
        return Router::$clientDir."/css/".$path.".css";
    }

    /**
     * Returns full path for an image
     */
    public static function Img($path)
    {
        return Router::$clientDir."/imgs/".$path;
    }	
}