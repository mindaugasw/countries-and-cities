<?php

class City extends Area
{
    public $zip_code;
    public $country_id;
    public $country_name;

    public $countryViewLink;

    /**
     * When fecthing object from DB, all properties are filled automatically (hence NULL default parameters).
     */
    public function __construct($id = NULL, $name = NULL, $area = NULL, $population = NULL, $zip_code = NULL, $country_id = NULL)
    {
        if ($id !== NULL)
            $this->id = $id;
        if ($name !== NULL)
            $this->name = $name;
        if ($area !== NULL)
            $this->area = $area;
        if ($population !== NULL)
            $this->population = $population;
        if ($zip_code !== NULL)
            $this->zip_code = $zip_code;
        if ($country_id !== NULL)
            $this->country_id = $country_id;

        parent::__construct();
        $this->zip_code = (int)$this->zip_code;
        $this->country_id = (int)$this->country_id;

        $this->countryViewLink = Router::Link("countries", "details", $this->country_id);

        $this->viewLink = Router::Link('cities', 'details', $this->id);
        $this->editLink = Router::Link('cities', 'edit', $this->id);
        $this->deleteLink = Router::Link('cities', 'delete', $this->id);
    }
}


class CityRepository extends AreaRepository {

    protected $module = 'city';

    /**
     * Get single city by ID
     * 
     * @return mixed City object or empty array if not found.
     */
    public function GetById(int $id)
    {
        $query = "SELECT `city`.*, `country`.`name` AS 'country_name' FROM `city`
                LEFT JOIN `country` ON `city`.`country_id` = `country`.`id`
                WHERE `city`.`id` = $id";

        $data = mysql::select($query, ucfirst($this->module));
        
        if (!empty($data))
            $data = $data[0];
        
        return $data;
    }

    /**
     * Get all cities of a country
     * 
     * @return mixed City objects array
     */
    public function GetByCountry(int $country_id)
    {
        $query = "SELECT * FROM `city` WHERE `country_id` = $country_id";

        $data = mysql::select($query);
            
        return $data;
    }

    /**
     * Get cities array with optional filtering, ordering, and pagination.
     * If filtering is not needed, set those filter arguments to NULL ($name, $dateFrom, $dateTo).
     * Additionally returns total items count in DB (used for pagination).
     * 
     * @return mixed An array of City objects and total items count in DB. Format: [items => [], totalCount => int]
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
     * Create new City
     * 
     * @return int Newly inserted item ID or false on failure.
     */
    public function Insert(City $city)
    {
        $query = "INSERT INTO `city`
                (`name`, `area`, `population`, `zip_code`, `country_id`) VALUES
                ('$city->name', $city->area, $city->population, $city->zip_code, $city->country_id)";
        $result = mysql::query($query);

        if (!$result)
            return false;
        else
            return mysql::getLastInsertedId();
    }

    /**
     * Update city
     * 
     * @return bool True on success, false otherwise
     */
    public function Update(City $city)
    {
        $query = "UPDATE `city` SET
                `name`='$city->name',`area`=$city->area,`population`=$city->population,`zip_code`=$city->zip_code,`country_id`=$city->country_id
                WHERE `id` = $city->id";
        $result = mysql::query($query);
        return $result;
    }
}