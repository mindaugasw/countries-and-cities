<?php

class Countries {

    /**
     * Get all countries.
     * 
     * @return mixed An array of countries.
     */
    public static function GetAll()
    {
        // TODO pagination
        $query = "SELECT * FROM `country`";
        $data = mysql::select($query);
        return $data;
    }

    /**
     * Get single country by its ID.
     * 
     * @return mixed A single country or empty array if not found.
     */
    public static function GetById($id)
    {
        $query = "SELECT * FROM `country` WHERE `id` = $id";

        $data = mysql::select($query);
        
        if (!empty($data))
            $data = $data[0];

        return $data;
    }

    /**
     * Creates new country with specified data.
     * 
     * @return int Newly inserted item ID.
     */
    public static function Insert($name, $area, $population, $phoneCode)
    {
        $query = "INSERT INTO `country`(`name`, `area`, `population`, `phone_code`) VALUES
                ('$name', $area, $population, $phoneCode)";
        mysql::query($query);
        return mysql::getLastInsertedId();
    }
}