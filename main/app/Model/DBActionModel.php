<?php

namespace App\Model;

use PDO;
use PDOException;
use PDOStatement;
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
     * This method is responsible for 
     * adding a new user to the database
     *
     * @param string $username
     * @param string $password
     * @return int|null
     */
    public static function SaveNewUserToDataBase(string $username, string $password): ?int
    {
        try {
            $conn = self::connection();
            $sql = "INSERT INTO Users (username, password) VALUES ('" . $username . "', '" . $password . "')";            
            $result = $conn->exec($sql);
            return $result;
        }
        catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    }

    /**
     * This method is responsible for 
     * searching for a user during logging
     *
     * @param string $username
     * @param string $password
     * @return PDOStatement|null
     */
    public static function SelectUserFromDataBase(string $username, string $password): ?PDOStatement
    {
        try {
            $conn = self::connection();
            $sql = "SELECT * FROM Users WHERE username = '" . $username . "'";            
            $result = $conn->query($sql);
            return $result;
        }
        catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
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
            $sql = "INSERT INTO `Events`(`user_id`, `event_type`, `event_date`) VALUES ((SELECT id FROM `Users` WHERE id = '" . $user . "'),'" . $event . "','" . date("Y-m-d H:i:s") . "');";            
            $result = $conn->exec($sql);
            return $result;
        }
        catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    }

    /**
     * This method is responsible 
     * for find the users
     *
     * @return int|null
     */
    public static function UsersList() {
        try {
            $conn = self::connection();
            $sql = "SELECT id, username FROM Users";            
            $result = $conn->query($sql);
            return $result;
        }
        catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    }

    /**
     * This method is responsible for the number 
     * of cow purchases and exe file downloads
     *
     * @param array $events
     * @param string $user_id
     * @param string $start_data
     * @param string $finish_data
     * @return string|null
     */
    public static function CountBuyOrDownload(array $events, string $user_id, string $start_data, string $finish_data): ?string
    {
        $answerList = [];
        foreach($events as $event) {
            try {
                $conn = self::connection();

                if($user_id == "All") {
                    $part = "";
                } else {
                    $part = "AND `user_id` = '" .  $user_id . "'";
                }


                $sql = "SELECT COUNT(*) AS 'count_buy', `event_date` FROM `Events` WHERE `event_type` = '" . $event . "' " . $part . " AND `event_date` BETWEEN '" . $start_data . "' AND '" . $finish_data . "' GROUP BY `event_date`";          

                $result = $conn->query($sql);
                $resultList = [];
                foreach($result as $row) {
                    $resultList[] = [
                        "count_buy" => $row['count_buy'], 
                        "event_date" => $row['event_date'], 
                    ];
                }
                array_push($answerList, $resultList);
            }
            catch (PDOException $e) {
                echo "Database error: " . $e->getMessage();
            }
        }

        return json_encode($answerList);
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
