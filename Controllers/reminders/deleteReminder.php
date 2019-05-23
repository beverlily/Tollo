<?php
require_once '../../vendor/autoload.php';
use App\Database;
use App\Reminder;

//Delete
if (isset($_POST['flag'])) {
    $flag   = $_POST['flag'];

    if ($flag == 'delete') {
        $id = $_POST['id'];

        $db = Database::getDb();
        $r = new Reminder();
        $delete = $r->deleteReminder($id, $db);

        if ($delete) {
            echo 'success';
        } else {
            echo "error";
        }
    }
}
