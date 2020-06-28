<?php

class Country extends Area
{
    public $phone_code;

    /**
     * Default constructor, used when fetching objects from DB.
     */
    public function __construct()
    {
        parent::__construct();
        $this->phone_code = (int)$this->phone_code;
    }
}

class CountryRepository {

    /**
     * Get all countries.
     * 
     * @return mixed An array of countries.
     */
    public static function GetAll()
    {
        // TODO pagination
        $query = "SELECT * FROM `country`";
        $data = mysql::select($query, 'Country');
        return $data;
    }

    /**
     * Get all countries, with optional filtering, ordering, and pagination.
     * If filtering is not needed, set those filters arguments to NULL.
     * 
     * @return mixed An array of countries.
     */
    public static function GetAllAdvanced(
        ?string $name, ?DateTime $dateFrom, ?DateTime $dateTo, // Filtering
        string $sortField, bool $sortAsc // Sorting
        // Pagination
        )
    {
        $query = "SELECT * FROM `country`";

        // Filtering
        $where = [];
        if ($name !== NULL)
            $where[] = "`name` LIKE \"%$name%\"";
        if ($dateFrom !== NULL)
            $where[] = '`added_at` >= "'.MiscUtils::Date($dateFrom).'"';
        if ($dateTo !== NULL)
            $where[] = '`added_at` <= "'.MiscUtils::Date($dateFrom).'"';

        if (!empty($where))
        {
            $query .= ' WHERE '.implode(' AND ', $where);
        }

        // Sorting
        $query .= " ORDER BY `$sortField` ".($sortAsc ? 'ASC' : 'DESC');

        $data = mysql::select($query, 'Country');
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

        $data = mysql::select($query, 'Country');
        
        if (!empty($data))
            $data = $data[0];
        
        return $data;
    }

    /**
     * Creates new country with specified data.
     * 
     * @return int Newly inserted item ID.
     */
    /*public static function Insert($name, $area, $population, $phone_code)
    {
        $query = "INSERT INTO `country`(`name`, `area`, `population`, `phone_code`) VALUES
                ('$name', $area, $population, $phone_code)";
        mysql::query($query);
        return mysql::getLastInsertedId();
    }*/

    /**
     * Updates country.
     */
    /*public static function Update($id, $name, $area, $population, $phone_code)
    {
        $query = "UPDATE `country` SET
                `name`='$name',`area`=$area,`population`=$population,`phone_code`=$phone_code
                WHERE `id` = $id";
        mysql::query($query);
    }*/

    /**
     * Deletes country and all of its cities.
     */
    /*public static function Delete($id)
    {
        $query = "DELETE FROM `country` WHERE `id` = $id";
        mysql::query($query);
    }*/
}