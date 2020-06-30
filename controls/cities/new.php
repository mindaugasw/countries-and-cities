<?php

// Validation
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    list($id, $name, $area, $population, $zip_code, $country_id) = NULL;
    
    $errors = '';
    $result = Validators::ValidateCity($id, false, $name, $area, $population, $zip_code, $country_id, $errors);

    $city = new City($id, $name, $area, $population, $zip_code, $country_id);

    if (!$result)
    {
        $countryRepo = new CountryRepository(); // Get all countries to show in select input
        $countries = $countryRepo->GetAll();

        ToastMessages::Add('danger', $errors);
        $infoExists = true; // for form prefilling
        include Router::View('cities/form');
    }
    else
    {
        // Create new
        $cityRepo = new CityRepository();
        $id = $cityRepo->Insert($city);
        if ($id !== false)
        {
            ToastMessages::Add('success', 'New city successfully added.');
            Router::Redirect('countries', 'details', $country_id);
        }
        else
        {
            ToastMessages::Add('danger', 'Could not complete action.');
            Router::Redirect('cities', 'new', $country_id);
        }
    }
}
else // GET request
{
    $countryRepo = new CountryRepository();  // Get all countries to show in select input
    $countries = $countryRepo->GetAll();

    $country_id = -1;
    if (isset($_GET['id']))
        $country_id = $_GET['id'];

    $infoExists = false; // for form prefilling
    include Router::View('cities/form');
}
