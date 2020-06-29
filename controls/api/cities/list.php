<?php

$validator = new InputValidator();

list($name, $dateFrom, $dateFrom, $dateTo, $sortField, $sortAsc, $country_id, $page) = NULL;

$errors = '';
if (!Validators::ValidateCityFilters($name, $dateFrom, $dateTo, $sortField, $sortAsc, $country_id, $page, $errors))
{
    MiscUtils::APIReturn(['errors' => $errors], 400);
}

// Pagination
$offset = Config::CITIES_PAGE_SIZE * ($page - 1);

$repo = new CityRepository();
$data = $repo->GetAdvanced($name, $dateFrom, $dateTo, $country_id, $sortField, $sortAsc, $offset, Config::CITIES_PAGE_SIZE);

$data['pages'] = MiscUtils::ListPages($data['totalCount'], $page, Config::CITIES_PAGE_SIZE);

MiscUtils::APIReturn($data);