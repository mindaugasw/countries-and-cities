<?php

// TODO DRY
$validator = new InputValidator;

if (!$validator->IntegerCheck($_GET['id'], 'ID'))
{
    ToastMessages::Add("danger", $validator->GetErrors());
    Router::Redirect();
}

$country = Countries::GetById($_GET['id']);

if (empty($country))
{
    ToastMessages::Add("danger", "Could not find country with ID: {$_GET['id']}!");
    Router::Redirect();
}

$cities = Cities::GetByCountry($_GET['id']);

include 'views/countries/details.php';

?>