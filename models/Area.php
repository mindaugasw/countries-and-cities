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
     * Default constructor, used when fetching objects from DB.
     */
    public function __construct()
    {
        $this->id = (int)$this->id;
        $this->area = (int)$this->area;
        $this->population = (int)$this->population;

        $this->areaNice = MiscUtils::FormatBigNumber($this->area);
        $this->populationNice = MiscUtils::FormatBigNumber($this->population);

        $this->viewLink = Router::Link('countries', 'details', $this->id);
        $this->editLink = Router::Link('countries', 'edit', $this->id);
        $this->deleteLink = Router::Link('countries', 'delete', $this->id);
    }
}