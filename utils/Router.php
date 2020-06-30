<?php

/**
 * Class for generating various links
 */
class Router {

    /**
     * Client files directory
     */
    private static $clientDir = "public";

    /**
     * Create a clickable link for specified action, e.g. ./module=countries&action=details&id=5
     * Defaults to countries/list if no arguments are specified.
     */
    public static function Link(string $module = "countries", string $action = "list", $id = NULL)
    {
        $a = "./?module=$module&action=$action";

        if ($id !== NULL)
            $a .= "&id=$id";
        
        return $a;
    }

    /**
     * Redirect to specified action. Defaults to homepage if no module/action are specified.
     */
    public static function Redirect(string $module = "countries", string $action = "list", $id = NULL)
    {
        header("Location: ".Router::Link($module, $action, $id));
        die();
    }

    /**
     * Returns full path for a view file
     * 
     * @param string $view Partial view path, e.g. 'countries/form'
     */
    public static function View(string $view)
    {
        return "views/$view.php";
    }

    /**
     * Returns full path for JS file
     * 
     * @param string $path Partial file path, e.g. 'Utils'
     */
    public static function Js(string $path)
    {
        return Router::$clientDir."/js/".$path.".js";
    }

    /**
     * Returns full path for CSS file
     * 
     * @param string $view Partial file path, e.g. 'style'.
     */
    public static function Css(string $path)
    {
        return Router::$clientDir."/css/".$path.".css";
    }

    /**
     * Returns full path for an image
     * 
     * @param string $path Partial file path, e.g. 'loading.gif'
     */
    public static function Img(string $path)
    {
        return Router::$clientDir."/imgs/".$path;
    }	
}