<?php

// Validation
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    list($id, $name, $area, $population, $phone_code) = NULL;
    
    $errors = '';
    $result = Validators::ValidateCountry($id, false, $name, $area, $population, $phone_code, $errors);

    $country = new Country($id, $name, $area, $population, $phone_code);

    if (!$result)
    {
        ToastMessages::Add('danger', $errors);
        $infoExists = true; // for form prefilling
        include Router::View('countries/form');
    }
    else
    {
        // Create new
        $repo = new CountryRepository();
        $id = $repo->Insert($country);
        if ($id !== false)
        {
            ToastMessages::Add('success', 'New country successfully added.');
            Router::Redirect('countries', 'details', $id);
        }
        else
        {
            ToastMessages::Add('danger', 'Could not complete action.');
            Router::Redirect('countries', 'new');
        }
    }
}
else // GET request
{
    $infoExists = false; // for form prefilling
    include Router::View('countries/form');
}
