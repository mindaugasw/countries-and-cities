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
        Config::$DB_SERVER   = getenv('DB_HOST');
        Config::$DB_NAME     = getenv('DB_NAME');
        Config::$DB_USERNAME = getenv('DB_USERNAME');
        Config::$DB_PASSWORD = getenv('DB_PASSWORD');
    }
}
