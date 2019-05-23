<?php
session_start();
require_once '../../vendor/autoload.php';
use App\Database;
use App\Reminder;

$error = "";

if (isset($_SESSION['id']) && isset($_POST['flag'])) {
    $userId = $_SESSION['id'];
    $flag   = $_POST['flag'];

    if ($flag == 'add') {
        $ntitle = $_POST['title'];
        $ndate = $_POST['date'];
        $ntime = $_POST['time'];

        $title = filter_var($ntitle, FILTER_SANITIZE_STRING);
        $date = filter_var($ndate, FILTER_SANITIZE_STRING);
        $time = filter_var($ntime, FILTER_SANITIZE_STRING);

        //Validiation
        if (empty($title) || empty($date) || empty($time)) {
            echo '<span style="color:red;">Not all required fields are filled</span>';
        } else {
            $db = Database::getDb();
            $r = new Reminder();
            $c = $r->addReminder($userId, $title, $date, $time, $db);

            if ($c) {

                echo "Reminder added";
            } else {
                echo "error adding reminder";
            }
        }
    }
}
