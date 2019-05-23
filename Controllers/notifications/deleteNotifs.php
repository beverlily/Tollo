<?php
session_start();
require_once '../../vendor/autoload.php';
use App\Database;
use App\Notification;

$db = Database::getDb();
$n = new Notification();
if (isset($_SESSION['id']) && isset($_POST['flag'])) {
    $userId = $_SESSION['id'];
    $flag   = $_POST['flag'];
    if ($flag == "clear") {
        $clearN = $n->deleteAllRemNotifs($userId, $db);
        $clearG = $n->deleteAllGoalNotifs($userId, $db);
    }
}
