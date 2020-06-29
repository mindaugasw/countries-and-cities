<?php

/**
 * Various methods for input validation.
 * Usage: run all needed validations and call GetErrors() afterwards to get error explanations.
 */
class InputValidator
{
    private $errors = []; // error messages

    /**
     * Validates string input. Returns false if input is whitespace-only, too long, or contains
     * illegal characters. Returns true if everything is ok.
     * 
     * @param string $input Input to validate.
     * @param string $name Variable name (to show in error messages).
     * @param int @maxLen Max string lenght for input.
     * 
     * @return bool
     */
    public function StringCheck($input, $name, $maxLen=255)
    {
        $s = true; // s for successful

        if (ctype_space($input))
        {
            $s = false;
            $this->AddError("$name ($input) must contain non-whitespace characters.");
        }

        if (strlen($input) > $maxLen)
        {
            $s = false;
            $this->AddError("$name ($input) lenght must not exceed $maxLen characters.");
        }

        if ($input !== mysql::escape($input))
        {
            $s = false;
            $this->AddError("$name ($input) contains characters that are not allowed.");
        }

        return $s;
    }

    /**
     * Validates integer input. Returns false if input could not be converted to integer or if it is
     * not in range [min, max].
     * TODO mention that input is replaced
     * 
     * @param mixed $input Input to validate.
     * @param string $name Variable name (to show in error messages).
     * @param int @min Minimum allowed value.
     * @param int @max Maximum allowed value.
     * 
     * @return bool
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
     * Validates date input and sets $input to DateTime object. Returns true/false indicating if conversion
     * was successful.
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
     * Validates boolean input and converts $input to bool value. Returns true/false indicating if conversion
     * was successful.
     */
    public function BoolCheck(&$input, string $name)
    {
        if (strtolower($input) === 'true' || strtolower($input) === '1')
            $input = true;
        else
            $input = false;
        
        return true;
    }

    /**
     * Adds error message to the list.
     */
    public function AddError(string $message)
    {
        $this->errors[] = $message;
    }

    /**
     * Returns all errors and clears error list;
     * 
     * @return mixed Errors array.
     */
    public function GetErrors()
    {
        $e = $this->errors;
        $this->errors = [];
        return $e;
    }

    /**
     * Returns all errors as a single string and clears error list;
     * 
     * @return string Error messages as a single string.
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
    static function ValidateArea($id = NULL, $name, $area, $population, &$errors)
    {
        $validator = new InputValidator;

        $results =
        [
            $id === NULL ? true : $validator->IntegerCheck($id, 'ID'),
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

    public static function ValidateCity($id = NULL, $name, $area, $population, $zip_code, &$errors)
    {
        $validator = new InputValidator;

        $errorsTmp1 = [];
        $results =
        [
            Validators::ValidateArea($id, $name, $area, $population, $errorsTmp1),
            $validator->IntegerCheck($zip_code, 'ZIP code', 10000, 99999)
        ];

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
     * Validates country fields and returns errors text.
     * Returns false if at least one test failed and error explanations in $errors.
     * 
     * @param int $id ID. Optional.
     * @param string $errors Output parameter for errors.
     * 
     * @return bool
     */
    public static function ValidateCountry($id = NULL, $name, $area, $population, $phone_code, &$errors)
    {
        $validator = new InputValidator;

        $errorsTmp1 = [];
        $results =
        [
            Validators::ValidateArea($id, $name, $area, $population, $errorsTmp1),
            $validator->IntegerCheck($phone_code, 'Phone code', 0, 999)
        ];

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
     * Validates countries/cities list filters, sorting, and pagination parameters.
     * Returns errors text in $errors.
     * 
     * Sets $sortAsc to boolean value.
     * 
     * @param string $objectType Either 'Country' or 'City'. Needed for sorting field validation.
     */
    /*static function ValidateFiltersOLD(
        $name = NULL, &$dateFrom = NULL, &$dateTo = NULL,
        $sortField, &$sortAsc, string $objectType,
        $page, &$errors)
    {
        $validator = new InputValidator;

        // Filters+page validation
        $results = 
        [
            $name === NULL ? true : $validator->StringCheck($name, 'Name', 1000),
            $dateFrom === NULL ? true : $validator->DateCheck($dateFrom, 'Date from'),
            $dateTo === NULL ? true : $validator->DateCheck($dateTo, 'Date to'),
            $page === NULL ? true : $validator->IntegerCheck($page, 'Page', 1)
        ];

        // Sorting validation // TODO
        $sortFields = ['id', 'name', 'area', 'population', 'added_at', $objectType === 'Country' ? 'phone_code' : 'zip_code'];
        if (in_array($sortField, $sortFields, true))
            $results[] = true;
        else
        {
            $results[] = false;
            $validator->AddError("Unknown sorting field ($sortField).");
        }

        if (strtolower($sortAsc) === 'true' || strtolower($sortAsc) === '1')
            $sortAsc = true;
        else
            $sortAsc = false;
        

        if (in_array(false, $results, true))
        {
            $errors = $validator->GetErrorsText();
            return false;
        }
        else
            return true;
    }*/


    // TODO docblock
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
            $validator->BoolCheck($sortAsc, 'Sort direction'),
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
?>