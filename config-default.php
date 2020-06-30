<?php

class Config {
    public static $DB_SERVER   = '';
    public static $DB_NAME     = '';
    public static $DB_USERNAME = '';
    public static $DB_PASSWORD = '';

    const COUNTRIES_PAGE_SIZE    = 15; // Number of items in one page
    const CITIES_PAGE_SIZE    = 9;

    /**
     * Initilize environment variables
     */
    public static function Initialize()
    {
        Config::$DB_SERVER   = '127.0.0.1';
        Config::$DB_NAME     = 'salys_ir_miestai';
        Config::$DB_USERNAME = 'root';
        Config::$DB_PASSWORD = '';
    }
}
