<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    // TODO DRY
    $name = $_POST['name'];
    $area = $_POST['area'];
    $population = $_POST['population'];
    $phone_code = $_POST['phone_code'];

    /*$country =
    [
        'id' => -1,
        'name' => $name,
        'area' => $area,
        'population' => $population,
        'phone_code' => $phone_code
    ];*/
    $country = new Country($id, $name, $area, $population, $phone_code); // for form prefilling

    $errors = '';
    if (!Validators::ValidateCountry(NULL, $name, $area, $population, $phone_code, $errors))
    {
        ToastMessages::Add('danger', $errors);
        $infoExists = true; // for form prefilling
        include Router::View('countries/form');
    }
    else
    {
        $repo = new CountryRepository();
        $id = $repo->Insert($country);
        ToastMessages::Add('success', 'New country successfully added.');
        Router::Redirect('countries', 'details', $id);
    }
}
else // GET request
{
    $infoExists = false; // if true, tries to prefill the form with country information.
    include Router::View('countries/form');
}
