<?php

namespace App\Model;

use PDO;
use PDOException;
use App\Config\AppConfig;

/**
 * This class is responsible for 
 * communicating with the database
 */
class DBActionModel {

    /**
     * This method is responsible for 
     * checking the database connection, 
     * 
     * returns true if successful 
     * 
     * returns false on failure and an error message
     * 
     * @return array
     */
    public static function checkDataBaseConnect(): array
    {
        try {
            $config = AppConfig::DBConfig();
            $conn = new PDO("mysql:host=" . $config['host'] . ":" . $config['port'] . "", $config['user'], $config['password']);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return ['status' => true];
        }
        catch (PDOException $e) {
            switch($e->getCode()) {
                case "2002":
                    $message = "Wrong host or wrong port specified in database configuration.";
                    break;
                case "1045":
                    $message = "Wrong user or wrong password specified in database configuration.";
                    break;
            }
            return ['status' => false, 'message' => $message];
        }
    }
}
