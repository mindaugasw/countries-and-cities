<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET')
{
    ToastMessages::Add("danger", "Unsupported method ({$_SERVER['REQUEST_METHOD']}) for this action.");
    Router::Redirect();
}

// TODO DRY
// Validate ID
$validator = new InputValidator;
$id = $_GET['id'];
if (!$validator->IntegerCheck($id, 'ID'))
{
    ToastMessages::Add("danger", $validator->GetErrorsText());
    Router::Redirect();
}

$country = Countries::GetById($id);

if (empty($country))
{
    ToastMessages::Add("danger", "Could not find country with ID: $id!");
    Router::Redirect();
}

Countries::Delete($id);
ToastMessages::Add('success', 'Country successfully deleted.');
Router::Redirect('countries', 'list');
