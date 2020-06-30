<?php

// Validation
$validator = new InputValidator;

if (!$validator->IntegerCheck($_GET['id'], 'ID'))
{
    ToastMessages::Add("danger", $validator->GetErrors());
    Router::Redirect();
}

// Get data
$repo = new CityRepository();
$city = $repo->GetById($_GET['id']);

if (empty($city))
{
    ToastMessages::Add("danger", "Could not find city with ID: {$_GET['id']}!");
    Router::Redirect();
}

include Router::View('cities/details');
