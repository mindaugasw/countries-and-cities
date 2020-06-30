<?php

// Validation
$validator = new InputValidator;

if ($_SERVER['REQUEST_METHOD'] === 'POST') // POST
{
    list($id, $name, $area, $population, $zip_code, $country_id) = NULL;
    $errors = '';
    $result = Validators::ValidateCity($id, true, $name, $area, $population, $zip_code, $country_id, $errors);

    $city = new City($id, $name, $area, $population, $zip_code, $country_id);

    if (!$result)
    {
        $countryRepo = new CountryRepository(); // Get all countries for country select input
        $countries = $countryRepo->GetAll();

        ToastMessages::Add('danger', $errors);
        $infoExists = true; // for form prefilling
        include Router::View('cities/form');
    }
    else
    {
        // Update data
        $repo = new CityRepository();
        if ($repo->Update($city))
            ToastMessages::Add('success', 'City successfully updated.');
        else
            ToastMessages::Add('danger', 'Could not complete action.');
        Router::Redirect('cities', 'details', $id);
    }
}
else // GET
{
    if (!$validator->IntegerCheck($_GET['id'], 'ID'))
    {
        ToastMessages::Add("danger", $validator->GetErrorsText());
        Router::Redirect();
    }

    // Get data
    $repo = new CityRepository(); // Check that city exists
    $city = $repo->GetById($id);

    if (empty($city))
    {
        ToastMessages::Add("danger", "Could not find city with ID: $id!");
        Router::Redirect();
    }
    
    $country_id = $city->country_id;
    $countryRepo = new CountryRepository(); // Get all countries for country select input
    $countries = $countryRepo->GetAll();

    $infoExists = true; // for form prefilling
    include Router::View('cities/form');
}
