<?php
require_once '../../vendor/autoload.php';
use App\Database;
use App\Log;

if(isset($_POST['id'])) {
    $id = $_POST['id'];
    $db = Database::getDb();

    $l = new Log;
    $count = $l->deleteLog($id, $db);
    if($count) {
        header('Location: ../../Views/logs.php');
    } else {
        $errormessage = "We have experienced a problem deleting your record. Please reach out to support!";
        header('Location: ../../Views/error.php');
    }
};
?>
