<?php

// Validation
$validator = new InputValidator;

if ($_SERVER['REQUEST_METHOD'] === 'POST') // POST
{
    list($id, $name, $area, $population, $phone_code) = NULL;
    $errors = '';
    $result = Validators::ValidateCountry($id, true, $name, $area, $population, $phone_code, $errors);

    $country = new Country($id, $name, $area, $population, $phone_code);

    if (!$result)
    {
        ToastMessages::Add('danger', $errors);
        $infoExists = true; // for form prefilling
        include Router::View('countries/form');
    }
    else
    {
        // Update data
        $repo = new CountryRepository();
        if ($repo->Update($country))
            ToastMessages::Add('success', 'Country successfully updated.');
        else
            ToastMessages::Add('danger', 'Could not complete action.');
        Router::Redirect('countries', 'details', $id);
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
    $repo = new CountryRepository(); // Check that country exists
    $country = $repo->GetById($id);

    if (empty($country))
    {
        ToastMessages::Add("danger", "Could not find country with ID: $id!");
        Router::Redirect();
    }

    $infoExists = true; // for form prefilling
    include Router::View('countries/form');
}
