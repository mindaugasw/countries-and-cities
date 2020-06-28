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
        $query = "SELECT * FROM `country`";
        $data = mysql::select($query, 'Country');
        return $data;
    }

    /**
     * Get countries, with optional filtering, ordering, and pagination.
     * If filtering is not needed, set those filters arguments to NULL.
     * Additionally returns total items count in DB (used for pagination).
     * 
     * @return mixed An array of Country objects and total items count in DB. Format: [items, totalCount]
     */
    public static function GetAdvanced(
        ?string $name, ?DateTime $dateFrom, ?DateTime $dateTo, // Filtering
        string $sortField, bool $sortAsc, // Sorting
        int $offset, int $limit // pagination
        )
    {
        // Function returns both data and total rows count
        $selectData = "SELECT * FROM `country`";
        $selectCount = "SELECT COUNT(`id`) AS 'count' FROM `country`";

        // Filtering
        $where = [];
        if ($name !== NULL)
            $where[] = "`name` LIKE \"%$name%\"";
        if ($dateFrom !== NULL)
            $where[] = '`added_at` >= "'.MiscUtils::Date($dateFrom).'"';
        if ($dateTo !== NULL)
            $where[] = '`added_at` <= "'.MiscUtils::Date($dateFrom).'"';

        $whereQuery = '';
        if (!empty($where))
            $whereQuery = ' WHERE '.implode(' AND ', $where);

        // Sorting
        $sortQuery = " ORDER BY `$sortField` ".($sortAsc ? 'ASC' : 'DESC');
        
        // Pagination
        $pagesQuery = " LIMIT $offset,$limit";
        
        $dataQuery = $selectData.$whereQuery.$sortQuery.$pagesQuery;
        $countQuery = $selectCount.$whereQuery;

        $data =
        [
            'items' => mysql::select($dataQuery, 'Country'),
            'totalCount' => (int)mysql::select($countQuery)[0]['count']
        ];
        
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