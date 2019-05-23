<?php
require_once '../../vendor/autoload.php';
use App\Database;
use App\Program;

if(isset($_POST['delete'])) {
    $id = $_POST['id'];
    $db = Database::getDb();

    $pro = new Program;
    $days = $pro->getDaysbyId($id,$db);
    foreach ($days as $d) {
        $del = $pro->deleteDaysbyId($d->id,$db);
    }
    $count = $pro->deleteProgram($id, $db);
    if($count) {
        header('Location: ../../Views/workouts.php');
    } else {
        $errorMessage = "We have experienced a problem deleting them program. Please reach out to support!";
        header('Location: ../../Views/error.php');
    }
};
?>
