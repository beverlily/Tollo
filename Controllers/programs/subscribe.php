<?php
require_once '../../vendor/autoload.php';
use App\Database;
use App\Program;
session_start();

if(isset($_POST['subscribe'])) {
    $id = $_POST['id'];
    $userid = $_SESSION['id'];

    $db = Database::getDb();

    $pro = new Program;
    $count = $pro->subscribeToProgram($id,$userid,$db);

    if($count) {
        header('Location: ../../Views/profile.php');
    } else {
        $errorMessage = "We have experienced a problem. Please reach out to support!";
        header('Location: ../../Views/error.php');
    }
};
?>