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

$errors = '';
if (!Validators::ValidateFilters($name, $dateFrom, $dateTo, $errors))
{
    API::StatusCode(400);
}


$countries = CountryRepository::GetAllAdvanced($name, $dateFrom, $dateTo);
API::Json($countries);