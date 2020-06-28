<?php

$validator = new InputValidator();

// Filtering
$name = NULL;
$dateFrom = NULL;
$dateTo = NULL;

if (isset($_GET['name']))
    $name = $_GET['name'];
if (isset($_GET['dateFrom']))
    $dateFrom = $_GET['dateFrom'];
if (isset($_GET['dateTo']))
    $dateTo = $_GET['dateTo'];

// Sorting
$sortField = 'name';
if (isset($_GET['sort']))
    $sortField = $_GET['sort'];
$sortAsc = true;
if (isset($_GET['sortAsc']))
    $sortAsc = $_GET['sortAsc'];

// Pagination
$page = 1;
if (isset($_GET['page']))
    $page = $_GET['page'];

$errors = '';
if (!Validators::ValidateFilters($name, $dateFrom, $dateTo, $sortField, $sortAsc, 'Country', $page, $errors))
{
    // TODO send errors as well
    API::StatusCode(400);
}

// Pagination
$page = (int)$page;
$offset = Config::PAGE_SIZE * ($page - 1);

$data = CountryRepository::GetAdvanced($name, $dateFrom, $dateTo, $sortField, $sortAsc, $offset, Config::PAGE_SIZE);

$data['pages'] = MiscUtils::ListPages($data['totalCount'], $page);

API::Json($data);