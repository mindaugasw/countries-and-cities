<?php

class Country extends Area
{
    public $phone_code;

    /**
     * When fecthing object from DB, all properties are filled automatically (hence NULL default parameters).
     */
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

        $this->viewLink = Router::Link('countries', 'details', $this->id);
        $this->editLink = Router::Link('countries', 'edit', $this->id);
        $this->deleteLink = Router::Link('countries', 'delete', $this->id);
    }
}


class CountryRepository extends AreaRepository {

    protected $module = 'country';

    /**
     * Get countries array with optional filtering, ordering, and pagination.
     * If filtering is not needed, set those filter arguments to NULL ($name, $dateFrom, $dateTo).
     * Additionally returns total items count in DB (used for pagination).
     * 
     * @return mixed An array of Country objects and total items count in DB. Format: [items => [], totalCount => int]
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
            $where[] = '`added_at` <= "'.MiscUtils::Date($dateTo).'"';

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
     * Create new Country
     * 
     * @return int Newly inserted item ID or false on failure
     */
    public function Insert(Country $country)
    {
        $query = "INSERT INTO `country`
                (`name`, `area`, `population`, `phone_code`, `added_at`) VALUES
                ('$country->name', $country->area, $country->population, $country->phone_code, '".MiscUtils::Date(new DateTime())."')";
        $result = mysql::query($query);

        if (!$result)
            return false;
        else
            return mysql::getLastInsertedId();
    }

    /**
     * Update country.
     * 
     * @return bool True on success, false otherwise
     */
    public static function Update($country)
    {
        $query = "UPDATE `country` SET
                `name`='$country->name',`area`=$country->area,`population`=$country->population,`phone_code`=$country->phone_code
                WHERE `id` = $country->id";
        $result = mysql::query($query);
        return $result;
    }
}
