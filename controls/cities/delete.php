<?php

// Validation
if ($_SERVER['REQUEST_METHOD'] === 'GET')
{
    ToastMessages::Add("danger", "Unsupported method ({$_SERVER['REQUEST_METHOD']}) for this action.");
    Router::Redirect();
}

$validator = new InputValidator;
$id = $_GET['id'];
if (!$validator->IntegerCheck($id, 'ID'))
{
    ToastMessages::Add("danger", $validator->GetErrorsText());
    Router::Redirect();
}

$repo = new CityRepository();
$city = $repo->GetById($id);

if (empty($city))
{
    ToastMessages::Add("danger", "Could not find city with ID: $id!");
    Router::Redirect();
}

// Deletion
$country_id = $city->country_id;
if ($repo->Delete($id))
    ToastMessages::Add('success', 'City successfully deleted.');
else
    ToastMessages::Add('danger', 'Could not complete action.');
Router::Redirect('countries', 'details', $country_id);
