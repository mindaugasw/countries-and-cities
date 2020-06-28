<?php

class API
{
    /**
     * Returns specified status code and exits.
     */
    public static function StatusCode($code)
    {
        http_response_code($code);
        die();
    }

    /**
     * Returns specified data as JSON and exits.
     */
    public static function Json($data)
    {
        echo json_encode($data);
        die();
    }
}