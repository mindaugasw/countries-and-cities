<?php

// Validation
$validator = new InputValidator;

if (!$validator->IntegerCheck($_GET['id'], 'ID'))
{
    ToastMessages::Add("danger", $validator->GetErrors());
    Router::Redirect();
}

// Get data
$countryRepo = new CountryRepository();
$country = $countryRepo->GetById($_GET['id']);

if (empty($country))
{
    ToastMessages::Add("danger", "Could not find country with ID: {$_GET['id']}!");
    Router::Redirect();
}

$cityRepo = new CityRepository(); // Get cities count in country
$cities = $cityRepo->GetByCountry($_GET['id']);

include Router::View('countries/details');
