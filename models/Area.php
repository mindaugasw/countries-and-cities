<?php

/**
 * Parent class for Country and City
 */
abstract class Area
{
    public $id;
    public $name;
    public $area;
    public $population;
    public $added_at;

    public $areaNice;
    public $populationNice;

    public $viewLink;
    public $editLink;
    public $deleteLink;

    /**
     * Default constructor used when fetching objects from DB (properties from DB are filled in automatically).
     */
    public function __construct()
    {
        $this->id = (int)$this->id;
        $this->area = (int)$this->area;
        $this->population = (int)$this->population;

        $this->areaNice = MiscUtils::FormatBigNumber($this->area);
        $this->populationNice = MiscUtils::FormatBigNumber($this->population);
    }
}


abstract class AreaRepository
{
    protected $module = '-'; // Should be 'country' or 'city'

    /**
     * Get all items
     * 
     * @return mixed An array of Area objects
     */
    public function GetAll()
    {
        $query = "SELECT * FROM `{$this->module}` ORDER BY `name`";
        $data = mysql::select($query, ucfirst($this->module));
        return $data;
    }

    /**
     * Get single area by ID
     * 
     * @return mixed Area object or empty array if not found
     */
    public function GetById(int $id)
    {
        $query = "SELECT * FROM `{$this->module}` WHERE `id` = $id";

        $data = mysql::select($query, ucfirst($this->module));
        
        if (!empty($data))
            $data = $data[0];
        
        return $data;
    }

    /**
     * Delete area by id
     * 
     * @return bool True on success, false otherwise
     */
    public function Delete(int $id)
    {
        $query = "DELETE FROM `{$this->module}` WHERE `id` = $id";
        $result = mysql::query($query);
        return $result;
    }
}
