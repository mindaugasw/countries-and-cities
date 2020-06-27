<?php

// TODO DRY
// Validate ID
$validator = new InputValidator;
// TODO check if id is set
$id = $_SERVER['REQUEST_METHOD'] === 'POST' ? $_POST['id'] : $_GET['id'];
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


// POST
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    // $id = $_POST['id'];
    $name = $_POST['name'];
    $area = $_POST['area'];
    $population = $_POST['population'];
    $phone_code = $_POST['phone_code'];

    $country =
    [
        'id' => $id,
        'name' => $name,
        'area' => $area,
        'population' => $population,
        'phone_code' => $phone_code
    ];

    $errors = '';
    if (!Validators::ValidateCountry($id, $name, $area, $population, $phone_code, $errors))
    {
        ToastMessages::Add('danger', $errors);
        $infoExists = true; // for form prefilling
        include Router::View('countries/form');
    }
    else
    {
        Countries::Update($id, $name, $area, $population, $phone_code);
        ToastMessages::Add('success', 'Country successfully updated.');
        Router::Redirect('countries', 'details', $id);
    }
}
else // GET
{
    $infoExists = true; // for form prefilling
    include Router::View('countries/form');
}
