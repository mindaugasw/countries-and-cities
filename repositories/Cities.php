<?php

class Cities {
    public static function GetAll()
    {
        // TODO pagination
        $query = "SELECT * FROM `city`";
        $data = mysql::select($query);
        return $data;
    }

    public static function GetByCountry($country_id)
    {
        $query = "SELECT * FROM `city` WHERE `country_id` = $country_id";

        $data = mysql::select($query);
            
        return $data;
    }
}