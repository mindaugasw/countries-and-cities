<?php

$validator = new InputValidator();

$name = NULL;
$dateFrom = NULL;
$dateTo = NULL;

if (isset($_GET['name']))
    $name = $_GET['name'];
if (isset($_GET['dateFrom']))
    $dateFrom = $_GET['dateFrom'];
if (isset($_GET['dateTo']))
    $dateTo = $_GET['dateTo'];

$sortField = 'name';
if (isset($_GET['sort']))
    $sortField = $_GET['sort'];
$sortAsc = true;
if (isset($_GET['sortAsc']))
    $sortAsc = $_GET['sortAsc'];


$errors = '';
if (!Validators::ValidateFilters($name, $dateFrom, $dateTo, $sortField, $sortAsc, 'Country', $errors))
{
    // TODO send errors as well
    API::StatusCode(400);
}

$countries = CountryRepository::GetAllAdvanced($name, $dateFrom, $dateTo, $sortField, $sortAsc);
API::Json($countries);