<?php

class City extends Area
{
    public $zip_code;
    public $country_id;

    public $countryViewLink;

    public function __construct()
    {
        parent::__construct();
        $this->zip_code = (int)$this->zip_code;
        $this->country_id = (int)$this->country_id;

        $this->countryViewLink = Router::Link("countries", "details", $this->country_id);
    }
    
}

class CityRepository extends AreaRepository {

    protected $module = 'city';

    /**
     * Get all cities of a country
     * 
     * @param int $country_id
     * @return mixed City objects array
     */
    public function GetByCountry(int $country_id)
    {
        $query = "SELECT * FROM `city` WHERE `country_id` = $country_id";

        $data = mysql::select($query);
            
        return $data;
    }

    /**
     * Get areas array with optional filtering, ordering, and pagination.
     * If filtering is not needed, set those filter arguments to NULL.
     * Additionally returns total items count in DB (used for pagination).
     * 
     * @return mixed An array of Area objects and total items count in DB. Format: [items, totalCount]
     */
    public function GetAdvanced(
        ?string $name, ?DateTime $dateFrom, ?DateTime $dateTo, int $country_id, // Filtering
        string $sortField, bool $sortAsc, // Sorting
        int $offset, int $limit // pagination
        )
    {
        // Function returns both data and total rows count
        $selectData = "SELECT * FROM `city`";
        $selectCount = "SELECT COUNT(`id`) AS 'count' FROM `city`";

        // Filtering
        $where = [];
        if ($name !== NULL)
            $where[] = "`name` LIKE \"%$name%\"";
        if ($dateFrom !== NULL)
            $where[] = '`added_at` >= "'.MiscUtils::Date($dateFrom).'"';
        if ($dateTo !== NULL)
            $where[] = '`added_at` <= "'.MiscUtils::Date($dateFrom).'"';
        if ($country_id !== NULL)
            $where[] = "`country_id` = $country_id";
        

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
            'items' => mysql::select($dataQuery, 'City'),
            'totalCount' => (int)mysql::select($countQuery)[0]['count']
        ];
        
        return $data;
    }
    
    /**
     * Creates new City with specified data.
     * 
     * @return int Newly inserted item ID.
     */
    public function Insert($city) // $name, $area, $population, $phone_code)
    {
        $query = "INSERT INTO `city`
                (`name`, `area`, `population`, `zip_code`) VALUES
                ('$city->name', $city->area, $city->population, $city->zip_code)";
        mysql::query($query);
        return mysql::getLastInsertedId();
    }

    /**
     * Update city.
     */
    public function Update($city)
    {
        $query = "UPDATE `city` SET
                `name`='$city->name',`area`=$city->area,`population`=$city->population,`zip_code`=$city->zip_code
                WHERE `id` = $city->id";
        mysql::query($query);
    }
}