<?php

namespace App\Config;

/**
 * The configuration class of the entire application, 
 * its methods are responsible for page components, 
 * pages, database connection configuration, and auth routes
 * 
 */
class AppConfig {

    /**
     * This method is responsible for 
     * the given database configuration
     * 
     * @return array
     */
    public static function DBConfig(): array
    {
        return [
            "host"       =>      "mysql", 
            "port"       =>       "3306", 
            "user"       =>    "my_user", 
            "password"   =>"my_password", 
            "database"   =>"my_database", 
            "usertable"  =>      "Users", 
            "actiontable"=>     "Action"
        ];
    }

    /**
     * This method is responsible for 
     * the installed pages that 
     * will be displayed to the user
     * 
     * @return array
     */
    public static function PageList(): array
    {
        return [
            'login', 
            'register', 
            'b', 
            'a', 
            'report', 
            'activity', 
            'home'
        ];
    }

    /**
     * This method is responsible for 
     * the page components that 
     * will be displayed
     * 
     * @return array
     */
    public static function ComponentList(): array
    {
        return [
            'head', 
            'navbar', 
            'footer'
        ];
    }

    /**
     * This method is responsible 
     * for auth routes
     *
     * @return array
     */
    public static function ActionList(): array
    {
        return [ 
            'auth/register', 
            'auth/login', 
            'auth/loguot'
        ];
    }
}
