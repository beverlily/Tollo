<?php
require_once '../../vendor/autoload.php';
use App\Database;
use App\Program;

if(isset($_POST['deleteDay'])) {
    $id = $_POST['id'];
    $db = Database::getDb();

    $pro = new Program;
    $count = $pro->deleteDaysbyId($id,$db);
    if($count) {
        header('Location: ../../Views/workouts.php');
    } else {
        $errorMessage = "We have experienced a problem. Please reach out to support!";
        header('Location: ../../Views/error.php');
    }
};
?>