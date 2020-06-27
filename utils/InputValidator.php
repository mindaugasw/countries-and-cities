<?php

/**
 * Usage:
 * TODO
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
            $this->errors[] = "$name must contain non-whitespace characters.";
        }

        if (strlen($input) > $maxLen)
        {
            $s = false;
            $this->errors[] = "$name lenght must not exceed $maxLen characters.";
        }

        if ($input !== mysql::escape($input))
        {
            $s = false;
            $this->errors[] = "$name contains characters that are not allowed.";
        }

        return $s;
    }

    /**
     * Validates integer input. Returns false if input could not be converted to integer or if it is
     * not in range [min, max].
     * 
     * @param mixed $input Input to validate.
     * @param string $name Variable name (to show in error messages).
     * @param int @min Minimum allowed value.
     * @param int @max Maximum allowed value.
     * 
     * @return bool
     */
    public function IntegerCheck($input, $name, $min = 0, $max = PHP_INT_MAX)
    {
        $s = true;

        $input = filter_var($input, FILTER_VALIDATE_INT, ['options' => ['min_range' => $min, 'max_range' => $max]]);

        if ($input === false)
        {
            $s = false;
            $this->errors[] = "$name is not a valid integer. It must be between $min and $max and contain only numeric characters.";
        }

        return $s;
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
     * Validates country fields. Returns false if at least one test failed and error explanations in $errors.
     * 
     * @param int $id ID. Optional.
     * @param string $errors Output parameter for errors.
     * 
     * @return bool
     */
    public static function ValidateCountry($id = NULL, $name, $area, $population, $phoneCode, &$errors)
    {
        $validator = new InputValidator;

        $results =
        [
            $id === NULL ? true : $validator->IntegerCheck($id, 'ID'),
            $validator->StringCheck($name, 'Name'),
            $validator->IntegerCheck($area, 'Area'),
            $validator->IntegerCheck($population, 'Population'),
            $validator->IntegerCheck($phoneCode, 'Phone code', 0, 999),
        ];

        if (in_array(false, $results, true))
        {
            // $xx = $validator->GetErrors();
            $errors = implode('<br>', $validator->GetErrors());
            return false;
        }
        else
            return true;
    }

}
?>