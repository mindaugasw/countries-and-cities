<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $name = $_POST['name'];
    $area = $_POST['area'];
    $population = $_POST['population'];
    $phone_code = $_POST['phone_code'];

    $country =
    [
        'id' => -1,
        'name' => $name,
        'area' => $area,
        'population' => $population,
        'phone_code' => $phone_code
    ];

    $errors = '';
    if (!InputValidator::ValidateCountry(NULL, $name, $area, $population, $phone_code, $errors))
    {
        ToastMessages::Add('danger', $errors);
        $infoExists = true; // for form prefilling
        include Router::View('countries/form');
    }
    else
    {
        $id = Countries::Insert($name, $area, $population, $phone_code);
        ToastMessages::Add('success', 'New country successfully added.');
        Router::Redirect('countries', 'details', $id);
    }
}
else // GET request
{
    $infoExists = false; // if true, tries to prefill the form with country information.
    include Router::View('countries/form');
}
