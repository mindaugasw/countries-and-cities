<?php

class City extends Area
{
    public $zip_code;
    public $country_id;

    /**
     * Default constructor, used when fetching objects from DB.
     */
    public function __construct()
    {
        parent::__construct();
        $this->zip_code = (int)$this->zip_code;
        $this->country_id = (int)$this->country_id;
    }
    
}