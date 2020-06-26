<?php

class Countries {
    public static function GetAll()
    {
        // TODO pagination
        $query = "SELECT * FROM `country`";
        $data = mysql::select($query);
        return $data;
    }

    public static function GetById($id)
    {
        $query = "SELECT * FROM `country` WHERE `id` = $id";

        $data = mysql::select($query);
        
        if (!empty($data))
            $data = $data[0];

        return $data;
    }
}