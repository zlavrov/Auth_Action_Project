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
     * @param array $events
     * @param string|null $user_id
     * @param string|null $start_data
     * @param string|null $finish_data
     * @return string|false
     */
    public static function Events(string $action, array $events, string $user_id = null, string $start_data = null, string $finish_data = null): ?string
    {
        if($action == "click") {
            $result = DBActionModel::SendEvent($_SESSION['user']['id'], $events[0]);
            if($result) {
                return "Success event buy cow";
            } else {
                return false;
            }
        } else if ($action == "report" || $action == "activity") {
            $result = DBActionModel::CountBuyOrDownload($events, $user_id, $start_data, $finish_data);
            if($result) {
                return $result;
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
