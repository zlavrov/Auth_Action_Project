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
     * connecting to the database
     * @return PDO|null
     */
    public static function connection(): ?PDO
    {
        $config = AppConfig::DBConfig();
        return new PDO("mysql:host=" . $config['host'] . ":" . $config['port'] . ";dbname=" . $config['database'], $config['user'], $config['password']);
    }

    /**
     * This method is responsible 
     * for saving the event
     *
     * @param string $user
     * @param string $event
     * @return int|null
     */
    public static function SendEvent(string $user, string $event): ?int
    {
        try {
            $conn = self::connection();
            $sql = "INSERT INTO `Events`(`user_id`, `event_types`, `event_date`) VALUES ((SELECT id FROM `Users` WHERE id = '" . $user . "'),'" . $event . "','" . date("Y-m-d H:i:s") . "');";            
            $result = $conn->exec($sql);
            return $result;
        }
        catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    }

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
