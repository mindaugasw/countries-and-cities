<?php

class Router {

    /**
     * Creates a clickable link for specified action, e.g. ./module=countries&action=details&id=5
     */
    public static function Link($module, $action, $id = NULL)
    {
        $a = "./?module=$module&action=$action";

        if ($id !== NULL)
            $a .= "&id=$id";
        
        return $a;
    }

    public static function Redirect($module, $action, $id = NULL)
    {
        header("Location: ".Router::Link($module, $action, $id));
        die();
    }


    /*private static $clientFiles = "client_files/";

    public static function ml($module, $action, $id = -1, $alert = -1, $message = -1) {
		$link = "index.php?module={$module}&action={$action}";

		if ($id !== -1)
			$link .= "&id={$id}";
		
		if ($alert !== -1 && $message !== -1)
			$link .= "&alert={$alert}&message=".urlencode($message);

		return $link;
    }*/

    /*public static function home($alert = -1, $message = -1) {
		$link = "index.php";

		if ($alert !== -1 && $message !== -1)
			$link .= "?alert={$alert}&message=".urlencode($message);

		return $link;
    }*/

    /*public static function img($file) {
        return makeLink::$clientFiles.'imgs/'.$file;
	}*/
	
    /*public static function jobImage($file) {
        return makeLink::img("jobs_images/{$file}");
	}*/

	/*public static function uploadsDir() {
		return makeLink::$clientFiles.'imgs/jobs_images/';
	}*/

	/*public static function uploadedImage($jobId, $fileId, $extension) {
		return makeLink::uploadsDir()."{$jobId}_{$fileId}.{$extension}";
	}*/

    /*public static function js($file) {
        return makeLink::$clientFiles.'scripts/'.$file;
    }

    public static function css($file) {
        return makeLink::$clientFiles.'style/'.$file;
	}*/

	/*public static function template($template) {
        return "templates/{$template}.tpl.php";
	}
	
	public static function library($library) {
        return "libraries/{$library}.class.php";
	}*/
	
}