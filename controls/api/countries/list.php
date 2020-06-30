<?php

// Validation
$validator = new InputValidator();

list($name, $dateFrom, $dateFrom, $dateTo, $sortField, $sortAsc, $page) = NULL;

$errors = '';
if (!Validators::ValidateCountryFilters($name, $dateFrom, $dateTo, $sortField, $sortAsc, $page, $errors))
{
    MiscUtils::APIReturn(['errors' => $errors], 400);
}

// Pagination
$offset = Config::COUNTRIES_PAGE_SIZE * ($page - 1);

// Get data
$repo = new CountryRepository();
$data = $repo->GetAdvanced($name, $dateFrom, $dateTo, $sortField, $sortAsc, $offset, Config::COUNTRIES_PAGE_SIZE);
$data['pages'] = MiscUtils::ListPages($data['totalCount'], $page, Config::COUNTRIES_PAGE_SIZE);

MiscUtils::APIReturn($data);