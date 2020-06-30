<?php

/**
 * Various methods for input validation.
 * Usage: run all needed validations and call GetErrors() afterwards to get error explanations.
 */
class InputValidator
{
    private $errors = []; // error messages

    /**
     * Validate string input.
     * 
     * @param string $input Input to validate.
     * @param string $name Variable name (to show in error messages).
     * @param int @maxLen Max string length for input.
     * 
     * @return bool False if input is whitespace-only, too long, or contains
     * illegal characters. True if everything is ok.
     */
    public function StringCheck($input, $name, $maxLen=255)
    {
        $s = true; // s for "successful"

        if (ctype_space($input))
        {
            $s = false;
            $this->AddError("$name ($input) must contain non-whitespace characters.");
        }

        if (strlen($input) > $maxLen)
        {
            $s = false;
            $this->AddError("$name ($input) length must not exceed $maxLen characters.");
        }

        if ($input !== mysql::escape($input))
        {
            $s = false;
            $this->AddError("$name ($input) contains characters that are not allowed.");
        }

        return $s;
    }

    /**
     * Validate integer input. If successful, $input is converted to int.
     * 
     * @param mixed $input Input to validate. Will be converted to int on success.
     * @param string $name Variable name (to show in error messages).
     * @param int @min Minimum allowed value.
     * @param int @max Maximum allowed value.
     * 
     * @return bool False if input could not be converted to integer or if it is
     * not in range [min, max]. True otherwise.
     */
    public function IntegerCheck(&$input, $name, $min = 0, $max = PHP_INT_MAX)
    {
        $s = true;

        $result = filter_var($input, FILTER_VALIDATE_INT, ['options' => ['min_range' => $min, 'max_range' => $max]]);

        if ($result === false)
        {
            $s = false;
            $this->AddError("$name ($input) is not a valid integer. It must be between $min and $max and contain only numeric characters.");
        }
        else
            $input = $result;

        return $s;
    }

    /**
     * Validate date input. On success $input is converted to DateTime object.
     * 
     * @param string $input Input to validate. On success will be converted to DateTime object
     * @param string $name Variable name (to show in error messages)
     * @return bool  True on success / false on failure
     */
    public function DateCheck(&$input, string $name)
    {
        $s = true;

        $timeInput = strtotime($input);

        if ($timeInput === false)
        {
            $s = false;
            $this->AddError("$name is not a valid date.");
        }
        else
        {
            $dt = new DateTime();
            $dt->setTimestamp($timeInput);
            $input = $dt;
        }

        return $s;
    }

    /**
     * Validate boolean input and convert $input to bool value. 
     * 
     * @param string $input Input to validate. Will be converted to bool.
     * @return bool  Always true
     */
    public function BoolCheck(&$input)
    {
        if (strtolower($input) === 'true' || strtolower($input) === '1')
            $input = true;
        else
            $input = false;
        
        return true;
    }

    /**
     * Add error message to the list
     */
    public function AddError(string $message)
    {
        $this->errors[] = $message;
    }

    /**
     * Returns all errors and clears error list
     * 
     * @return mixed Errors (strings) array
     */
    public function GetErrors()
    {
        $e = $this->errors;
        $this->errors = [];
        return $e;
    }

    /**
     * Returns all errors as a single string and clears error list
     * 
     * @return string Error messages as a single string
     */
    public function GetErrorsText()
    {
        return implode('<br>', $this->GetErrors());
    }
}

/**
 * Validations for specific data structures.
 */
class Validators
{

    /**
     * Validates Area object (form data) before submitting to DB.
     * Gets all data from POST parameters, validates them, and sets to reference parameters.
     * 
     * @return bool True if all validations passed. False otherwise. Errors array returned in $errors.
     */
    static function ValidateArea(&$id, bool $idNeeded, &$name, &$area, &$population, &$errors)
    {
        $validator = new InputValidator;

        $id = NULL;
        if (isset($_POST['id']))
            $id = $_POST['id'];
        $name = NULL;
        if (isset($_POST['name']))
            $name = $_POST['name'];
        $area = NULL;
        if (isset($_POST['area']))
            $area = $_POST['area'];
        $population = NULL;
        if (isset($_POST['population']))
            $population = $_POST['population'];

        $results =
        [
            $idNeeded ? $validator->IntegerCheck($id, 'ID') : true,
            $validator->StringCheck($name, 'Name'),
            $validator->IntegerCheck($area, 'Area'),
            $validator->IntegerCheck($population, 'Population'),
        ];

        if (in_array(false, $results, true))
        {
            $errors = $validator->GetErrors();
            return false;
        }
        else
            return true;
    }

    /**
     * Validates Country object (form data) before submitting to DB.
     * Gets all data from POST parameters, validates them, and sets to reference parameters.
     * 
     * @param bool $idNeeded Is $id validation needed? If true, checks if Country with given $id exists in DB.
     * @return bool True if all validations passed. False otherwise. Errors array returned in $errors.
     */
    public static function ValidateCountry(&$id, bool $idNeeded, &$name, &$area, &$population, &$phone_code, &$errors)
    {
        $validator = new InputValidator;

        $phone_code = NULL;
        if (isset($_POST['phone_code']))
            $phone_code = $_POST['phone_code'];

        $errorsTmp1 = [];
        $results =
        [
            Validators::ValidateArea($id, $idNeeded, $name, $area, $population, $errorsTmp1),
            $validator->IntegerCheck($phone_code, 'Phone code', 0, 999),
        ];

        if ($idNeeded && is_int($id)) // Check if Country exists in DB
        {
            $repo = new CountryRepository();
            $country = $repo->GetById($id);
            if (empty($country))
            {
                $results[] = false;
                $validator->AddError("Country with ID: $id does not exist in DB.");
            }
            else
                $results[] = true;
        }

        if (in_array(false, $results, true))
        {
            $errorsTmp2 = $validator->GetErrors();
            $errors = implode('<br>', array_merge($errorsTmp1, $errorsTmp2));
            return false;
        }
        else
            return true;
    }

    /**
     * Validates City object (form data) before submitting to DB.
     * Gets all data from POST parameters, validates them, and sets to reference parameters.
     * 
     * @param bool $idNeeded Is $id validation needed? If true, checks if City with given $id exists in DB.
     * @param mixed $country_id Country id that city is assigned to. Will check if Country exists in DB.
     * @return bool True if all validations passed. False otherwise. Errors array returned in $errors.
     */
    public static function ValidateCity(&$id, bool $idNeeded, &$name, &$area, &$population, &$zip_code, &$country_id, &$errors)
    {
        $validator = new InputValidator;

        $zip_code = NULL;
        if (isset($_POST['zip_code']))
            $zip_code = $_POST['zip_code'];

        $country_id = NULL;
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['country_id']))
            $country_id = $_POST['country_id'];
        else if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_POST['id']))
            $country_id = $_GET['id'];

        $errorsTmp1 = [];
        $results =
        [
            Validators::ValidateArea($id, $idNeeded, $name, $area, $population, $errorsTmp1),
            $validator->IntegerCheck($zip_code, 'ZIP code', 10000, 999999),
            $validator->IntegerCheck($country_id, 'Country ID'),
        ];

        if ($idNeeded && is_int($id)) // Check if City exists in DB
        {
            $repo = new CityRepository();
            $city = $repo->GetById($id);
            if (empty($city))
            {
                $results[] = false;
                $validator->AddError("City with ID: $id does not exist in DB.");
            }
            else
                $results[] = true;
        }


        if (is_int($country_id)) // Check if Country exists in DB
        {
            $repo = new CountryRepository();
            $country = $repo->GetById($country_id);
            if (empty($country))
            {
                $results[] = false;
                $validator->AddError("Country with ID: $country_id does not exist in DB.");
            }
            else
                $results[] = true;
        }

        if (in_array(false, $results, true))
        {
            $errorsTmp2 = $validator->GetErrors();
            $errors = implode('<br>', array_merge($errorsTmp1, $errorsTmp2));
            return false;
        }
        else
            return true;
    }

    /**
     * Validate filters, sorting, and pagination parameters.
     * Converts some parameters to their appropriate types, e.g. dates to DateTime.
     * 
     * @return bool True if all validations passed. False otherwise. Errors array returned in $errors.
     */
    static function ValidateAreaFilters(&$name, &$dateFrom, &$dateTo, &$sortAsc, &$page, &$errors)
    {
        $validator = new InputValidator();

        // Filtering
        $name = NULL;
        if (isset($_GET['name']))
            $name = $_GET['name'];
        $dateFrom = NULL;
        if (isset($_GET['dateFrom']))
            $dateFrom = $_GET['dateFrom'];
        $dateTo = NULL;
        if (isset($_GET['dateTo']))
            $dateTo = $_GET['dateTo'];
        
        // Sorting
        $sortAsc = true;
        if (isset($_GET['sortAsc']))
            $sortAsc = $_GET['sortAsc'];

        // Paginatyion
        $page = 1;
        if (isset($_GET['page']))
            $page = $_GET['page'];


        $results = 
        [
            $name === NULL ? true : $validator->StringCheck($name, 'Name', 1000),
            $dateFrom === NULL ? true : $validator->DateCheck($dateFrom, 'Date from'),
            $dateTo === NULL ? true : $validator->DateCheck($dateTo, 'Date to'),
            $validator->BoolCheck($sortAsc),
            $validator->IntegerCheck($page, 'Page', 1),
        ];

        if (in_array(false, $results, true))
        {
            $errors = $validator->GetErrors();
            return false;
        }
        else
            return true;
    }

    /**
     * Validate filters, sorting, and pagination parameters.
     * Converts some parameters to their appropriate types, e.g. dates to DateTime.
     * 
     * @return bool True if all validations passed. False otherwise. Errors array returned in $errors.
     */
    public static function ValidateCountryFilters(&$name, &$dateFrom, &$dateTo, &$sortField, &$sortAsc, &$page, &$errors)
    {
        $validator = new InputValidator;

        $errorsTmp1 = [];
        $results = 
        [
            Validators::ValidateAreaFilters($name, $dateFrom, $dateTo, $sortAsc, $page, $errorsTmp1)
        ];

        $sortField = 'name';
        if (isset($_GET['sort']))
            $sortField = $_GET['sort'];

        $sortFields = ['id', 'name', 'area', 'population', 'added_at', 'phone_code'];
        if (in_array($sortField, $sortFields, true))
            $results[] = true;
        else
        {
            $results[] = false;
            $validator->AddError("Unknown sorting field ($sortField).");
        }

        if (in_array(false, $results, true))
        {
            $errorsTmp2 = $validator->GetErrors();
            $errors = array_merge($errorsTmp1, $errorsTmp2);
            return false;
        }
        else
            return true;
    }

    /**
     * Validate filters, sorting, and pagination parameters.
     * Converts some parameters to their appropriate types, e.g. dates to DateTime.
     * 
     * @return bool True if all validations passed. False otherwise. Errors array returned in $errors.
     */
    public static function ValidateCityFilters(&$name, &$dateFrom, &$dateTo, &$sortField, &$sortAsc, &$country_id, &$page, &$errors)
    {
        $validator = new InputValidator;

        $country_id = -1;
        if (isset($_GET['id']))
            $country_id = $_GET['id'];

        $errorsTmp1 = [];
        $results = 
        [
            Validators::ValidateAreaFilters($name, $dateFrom, $dateTo, $sortAsc, $page, $errorsTmp1),
            $validator->IntegerCheck($country_id, 'Country ID'),
        ];

        $sortField = 'name';
        if (isset($_GET['sort']))
            $sortField = $_GET['sort'];

        $sortFields = ['id', 'name', 'area', 'population', 'added_at', 'zip_code'];
        if (in_array($sortField, $sortFields, true))
            $results[] = true;
        else
        {
            $results[] = false;
            $validator->AddError("Unknown sorting field ($sortField).");
        }

        if (in_array(false, $results, true))
        {
            $errorsTmp2 = $validator->GetErrors();
            $errors = array_merge($errorsTmp1, $errorsTmp2);
            return false;
        }
        else
            return true;
    }
}
