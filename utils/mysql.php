<?php 
/**
 * Database wrapper for a MySQL with PHP tutorial
 * 
 * @copyright Eran Galperin
 * @license MIT License
 * @see http://www.binpress.com/tutorial/using-php-with-mysql-the-right-way/17
 */
class mysql {
    
    protected static $connection;

	/**
     * Connect to the database
     * 
     * @return bool false on failure / mysqli MySQLi object instance on success
     */
    public static function connect() {
        // Try and connect to the database
		if(!isset(self::$connection)) {
            self::$connection = new mysqli(Config::$DB_SERVER, Config::$DB_USERNAME, Config::$DB_PASSWORD, Config::$DB_NAME);
			
			if(self::$connection !== false) {
				// try to set mysql connection character set to UTF-8
				if (!mysql::$connection->set_charset("utf8")) {
					printf("Error loading character set: %s\n", self::$connection->error);
				}
			} else {
				// Handle error - notify administrator, log to a file, show an error screen, etc.
				return false;
			}
        }
        return self::$connection;
    }
	
    /**
     * Query the database
     *
     * @param $query The query string
     * @return mixed The result of the mysqli::query() function
     */
    public static function query($query) {
        // Connect to the database
        $connection = mysql::connect();
        
        // Query the database
        $result = $connection->query($query);
		
        return $result;
    }
	
    /**
     * Fetch rows from the database (SELECT query).
     * If $className is set, returns as objects, or arrays otherwise.
     *
     * @param $query The query string
     * @param $className Class name to convert to
     * @return bool False on failure / array Database rows on success
     */
    public static function select($query, string $className = NULL) {
        $rows = array();
        $result = mysql::query($query);
        if($result === false) {
            return false;
        }

        while ($row = $className === NULL ? 
                        $result->fetch_assoc() :
                        $result->fetch_object($className))
            {
            $rows[] = $row;
        }
        return $rows;
    }

    /**
     * Fetch the last error from the database
     * 
     * @return string Database error message
     */
    public static function error() {
        $connection = mysql::connect();
        return $connection->error;
    }

    /**
     * Quote and escape value for use in a database query
     *
     * @param string $value The value to be quoted and escaped
     * @return string The quoted and escaped string
     */
    public static function quote($value) {
        $connection = mysql::connect();
        return "'" . $connection->real_escape_string($value) . "'";
    }
	
	/**
	 * Return id of last inserted row
	 * @return type
	 */
	public static function getLastInsertedId() {
		$connection = mysql::connect();
		return $connection->insert_id;
	}
	
	/**
	 * Escape variable for security
	 * @param type $field
	 * @return type
	 */
	public static function escape($field) {
		$connection =  mysql::connect();
		return mysqli_real_escape_string($connection, $field);
	}
}
