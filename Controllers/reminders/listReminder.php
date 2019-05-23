<?php
session_start();
require_once '../../vendor/autoload.php';
use App\Database;
use App\Reminder;

if (isset($_SESSION['id']) && isset($_POST['flag'])) {
    $userId = $_SESSION['id'];
    $flag   = $_POST['flag'];

    if ($flag == 'list') {
        $db = Database::getDb();
        $r = new Reminder();
        $item = $r->listReminder($userId, $db);
        echo " <div id='listRem'>";
        //List Reminders
        foreach ($item as $rem) {
            $date = new DateTime($rem->date);
            $time = new DateTime($rem->time);
            echo "
                <ul>
                    <li>
                        <p><b> $rem->title </b></p>" . " " .
                "<p>" . date_format($date, 'D-m-y') . "</p>" . " " .
                "<p>" . date_format($time, 'g:ia') . "</p>" . " " . "

                        <form action='../Controllers/reminders/updateReminder.php' method='post'>
                        <input type='hidden' name='id' value='$rem->id' />
                        <button type='submit' class='btn btn-primary' id='remBtn'>Update</button>
                        </form>

                        <form class='deleteReminder'>
                        <input type='hidden' name='id' value='$rem->id' />
                        <button type='submit' name='delete' class='btn btn-danger' value='Delete'>Delete</button>
                        </form>
                    </li>
                </ul>
            
        ";
        }
        echo "</div>";
    }
}
