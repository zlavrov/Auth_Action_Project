<?php

namespace App\Controller;

use App\Model\DBActionModel;

/**
 * This class is responsible for 
 * identifying events in the application.
 */
class EventController {

    /**
     * This method is responsible for 
     * determining the event that happened
     *
     * @param string $action
     * @param string $event
     * @return string|false
     */
    public static function Events(string $action, string $event): ?string
    {
        if($action == "click") {
            $result = DBActionModel::SendEvent($_SESSION['user']['id'], $event);
            if($result) {
                return "Success event buy cow";
            } else {
                return false;
            }
        }
    }
    
    /**
     * This method is responsible for determining 
     * which page the user has viewed
     *
     * @param array $user
     * @param string $page
     * @return void
     */
    public static function SendView(array $user, string $page): void
    {
        if($page == "a") {
            DBActionModel::SendEvent($user['id'], "VIEW_A");
        } else if($page == "b") {
            DBActionModel::SendEvent($user['id'], "VIEW_B");
        }
    }
}
