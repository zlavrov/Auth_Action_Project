<?php
session_start();
use App\Service\RouterService;
use App\Controller\EventController;
require_once __DIR__ . "/vendor/autoload.php";
// start method call
RouterService::Start();
if(isset($_POST['action']) && isset($_POST['events'])) {
    $result = EventController::Events($_POST['action'], $_POST['events'], $_POST['userId'], $_POST['startData'], $_POST['finishData']);
    if($result) {
        echo json_encode(['status' => true, 'message' => $result]);
    } else {
        echo json_encode(['status' => false, 'message' => "fail_event"]);
    }
}
