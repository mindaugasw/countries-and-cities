<?php

if (!ctype_digit($_GET['id']))
{
    ToastMessages::Add("danger", $_GET['id']." is not a valid country ID!");
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