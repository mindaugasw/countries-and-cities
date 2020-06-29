<?php

class Country extends Area
{
    public $phone_code;

    public function __construct($id = NULL, $name = NULL, $area = NULL, $population = NULL, $phone_code = NULL)
    {
        if ($id !== NULL)
            $this->id = $id;
        if ($name !== NULL)
            $this->name = $name;
        if ($area !== NULL)
            $this->area = $area;
        if ($population !== NULL)
            $this->population = $population;
        if ($phone_code !== NULL)
            $this->phone_code = $phone_code;

        parent::__construct();
        $this->phone_code = (int)$this->phone_code;
    }
}


class CountryRepository extends AreaRepository {

    protected $module = 'country';

    /**
     * Get areas array with optional filtering, ordering, and pagination.
     * If filtering is not needed, set those filter arguments to NULL.
     * Additionally returns total items count in DB (used for pagination).
     * 
     * @return mixed An array of Area objects and total items count in DB. Format: [items, totalCount]
     */
    public function GetAdvanced(
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
     * Creates new Country with specified data.
     * 
     * @return int Newly inserted item ID.
     */
    public function Insert($country) // $name, $area, $population, $phone_code)
    {
        $query = "INSERT INTO `country`
                (`name`, `area`, `population`, `phone_code`) VALUES
                ('$country->name', $country->area, $country->population, $country->phone_code)";
        mysql::query($query);
        return mysql::getLastInsertedId();
    }

    /**
     * Update country.
     */
    public static function Update($country)// $id, $name, $area, $population, $phone_code)
    {
        $query = "UPDATE `country` SET
                `name`='$country->name',`area`=$country->area,`population`=$country->population,`phone_code`=$country->phone_code
                WHERE `id` = $country->id";
        mysql::query($query);
    }
}