<?php

namespace App\Controller;

use App\Model\DBActionModel;

/**
 * This is an authorization class, its methods are 
 * responsible for registration and logging
 */
class AuthController {

    /**
     * This method is responsible 
     * for user registration
     *
     * @param string $username
     * @param string $password
     * @return void
     */
    public static function register(string $username, string $password): void
    {
        $result = DBActionModel::SaveNewUserToDataBase($username, $password);
        if($result) {
            header("Location: /login");
        } else {
            header("Location: /register");
        }
    }

    /**
     * This method is responsible 
     * for user authorization
     *
     * @param string $username
     * @param string $password
     * @return void
     */
    public static function login(string $username, string $password): void
    {
        $result = DBActionModel::SelectUserFromDataBase($username, $password);
        $data = $result->fetch();
        if(password_verify($password, $data["password"])) {
            session_start();
            $_SESSION["user"] = ["id" => $data["id"], "username" => $data["username"], "role" => $data["role"]];
            header("Location: /home");
        } else {
            header("Location: /login");
        }
    }
}
