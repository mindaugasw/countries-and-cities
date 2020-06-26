<?php

class miscUtils {
	public static function setAlert($flavor, $message) {
		$_GET['alert'] = $flavor;
		$_GET['message'] = $message;
	}

	public static function jobStateToLithuanian($state) {
		switch ($state) {
			case 'unstarted':
				return 'Nepradėtas';
				break;
			case 'started':
				return 'Pradėtas';
				break;
			case 'postponed':
				return 'Atidėtas';
				break;
			case 'completed':
				return 'Pabaigtas';
				break;
		}
	}

	public static function roleLevelToLithuanian($level) {
		if ($level === 'user')
			return 'vartotojas';
		else if ($level === 'manager')
			return 'valdytojas';
		else if ($level === 'admin')
			return 'administratorius';
	}

	public static function roleLevelToLithuanianWithIcon($level) {
		if ($level === 'user')
			return 'Vartotojas '.printer::glyphGet('user');
		else if ($level === 'manager')
			return 'Valdytojas '.printer::glyphGet('user-astronaut');
		else if ($level === 'admin')
			return 'Administratorius '.printer::glyphGet('street-view');
	}

	public static function checkPasswordStrength($password) {
		$errors = [];

		if (strlen($password) < 8)
			$errors[] = "Per trumpas slaptažodis!";
	
		if (!preg_match("#[0-9]+#", $password))
			$errors[] = "Slaptažodyje turi būti bent vienas skaičius.";
	
		if (!preg_match("#[a-zA-Z]+#", $password))
			$errors[] = "Slaptažodyje turi būti bent viena raidė.";
	
		if (sizeof($errors) === 0)
			return true;
		else 
			return $errors;
	}
}

?>