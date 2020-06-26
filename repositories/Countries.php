<?php

class Countries {
    public static function GetAll()
    {
        // TODO pagination
        $query = "SELECT * FROM `country`";
        $data = mysql::select($query);
        return $data;
    }
}