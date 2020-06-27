<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $name = $_POST['name'];
    $area = $_POST['area'];
    $population = $_POST['population'];
    $phoneCode = $_POST['phoneCode'];

    $country =
    [
        'id' => -1,
        'name' => $name,
        'area' => $area,
        'population' => $population,
        'phoneCode' => $phoneCode
    ];

    $errors = '';
    if (!InputValidator::ValidateCountry(NULL, $name, $area, $population, $phoneCode, $errors))
    {
        ToastMessages::Add('danger', $errors);
        $infoExists = true; // for form prefilling
        include Router::View('countries/form');
    }
    else
    {
        $id = Countries::Insert($name, $area, $population, $phoneCode);
        ToastMessages::Add('success', 'New country successfully added.');
        Router::Redirect('countries', 'details', $id);
    }
}
else // GET request
{
    $infoExists = false; // if true, tries to prefill the form with country information.
    include Router::View('countries/form');
}
