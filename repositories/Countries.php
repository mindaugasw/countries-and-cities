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
    public static function Insert($name, $area, $population, $phone_code)
    {
        $query = "INSERT INTO `country`(`name`, `area`, `population`, `phone_code`) VALUES
                ('$name', $area, $population, $phone_code)";
        mysql::query($query);
        return mysql::getLastInsertedId();
    }

    /**
     * Updates country.
     */
    public static function Update($id, $name, $area, $population, $phone_code)
    {
        $query = "UPDATE `country` SET
                `name`='$name',`area`=$area,`population`=$population,`phone_code`=$phone_code
                WHERE `id` = $id";
        mysql::query($query);
    }

    /**
     * Deletes country and all of its cities.
     */
    public static function Delete($id)
    {
        $query = "DELETE FROM `country` WHERE `id` = $id";
        mysql::query($query);
    }
}