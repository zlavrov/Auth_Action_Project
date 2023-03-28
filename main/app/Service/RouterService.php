<?php

namespace App\Service;

use App\Config\AppConfig;
use App\Model\DBActionModel;

/**
 * This class is responsible for 
 * routing the entire application.
 */
class RouterService {

    /**
     * This method is responsible for 
     * displaying page components
     *
     * @param string $component
     * @return void
     */
    public static function ShowComponent(string $component): void
    {
        if(in_array($component, AppConfig::ComponentList())) {
            require_once "app/Views/Component/" . $component . ".php";
        }
    }

    /**
     * This method matches the page 
     * the user wants to go to with 
     * the pages available in the application
     * 
     * successful matching opens the desired page
     * 
     * if matching fails, a 404 page is opened
     * 
     * @var bool $checkDataBase
     * @return void
     */
    public static function ShowPage(bool $checkDataBase): void
    {
        $query = $_GET["q"];
        if($_SERVER['REQUEST_METHOD'] === "GET") {
            if(in_array($query, AppConfig::PageList()) && $checkDataBase) {
                require_once "app/Views/Page/" . $query . ".php";
                die();
            } else if (!$query) {
                require_once "app/Views/Page/home.php";
                die();
            }
            require_once "app/Views/Error/404.php";
        }
    }
    
    /**
     * This startup method polls the method 
     * responsible for connecting to the database 
     * to see if there is a problem.
     *
     * Сalls the method responsible for opening 
     * the page components and the pages themselves, 
     * which are available with the true flag if there are no problems 
     * and with the false flag if there are problems
     *
     * @return void
     */
    public static function Start(): void
    {
        $response = DBActionModel::checkDataBaseConnect();
        $response['status'] ? self::ShowPage(true) : self::ShowPage(false);
    }
}
