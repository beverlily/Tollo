<?php
session_start();
require_once '../../vendor/autoload.php';
use App\Database;
use App\Reminder;
use App\Goal;
use App\Notification;

//if user is logged in and there is an ajax flag
if (isset($_SESSION['id']) && isset($_POST['flag'])) {
    $userId = $_SESSION['id'];
    $flag   = $_POST['flag'];

    $db = Database::getDb();
    $g  = new Goal();
    $r  = new Reminder();
    $n  = new Notification();

    //gets goal notifications and reminder notifications

    $gNotif = $n->displayGoalNotifs($userId, $db);
    $rNotif = $n->displayReminderNotifs($userId, $db);

    //if the flag is list, print out list of notifications
    if ($flag == "listNotif") {
        //prints goal notifications
        foreach ($gNotif as $gN) {
            echo "<li>
                <b>Goal Reached</b><br>
                <p> $gN->name </p>
                <small><i> $gN->complete_by </i></small><br>

                </li>
                <div class='dropdown-divider'></div>";
        }
        //prints reminder notifications
        foreach ($rNotif as $rN) {
            echo "<li>
                    <b> $rN->name </b><br />
                    <p> $rN->title </p>
                    <small><i> $rN->date </i></small><br>
                    </li>
                    <div class='dropdown-divider'></div>";
        }
    }

    //if the flag is count, print out the number of notifications
    if ($flag == "count") {
        //total goal notifs + total reminder notifs
        echo count($gNotif) + count($rNotif);
    }

    //Checks longterm goals
    if ($flag == "checkGoals") {
        //get all longterm goals
        $listGoals = $g->getLongtermGoals($_SESSION['id']);
        foreach ($listGoals as $goal) {
            $goalDate = $goal->complete_by;

            //format date and time
            $timezone = date_default_timezone_set('US/Eastern');
            $d = date('Y-m-d');
            $t = date('G:i:s');

            //Checks if the goal complete by day is today
            if ($goalDate == $d) {
                $newName    = 'Goal reached';
                $newMessage = $goal->name;
                $newStatus  = 'unread';
                $time       = "12:00 a.m.";
                $newGoalId  = $goal->id;

                //If the complete by day is today, adds a notification for the goal in the notifications table
                $newNotif = $n->addGoalNotif($newName, $newMessage, $newStatus, $time, $goalDate, $newGoalId, $userId, $db);
            }
        }
    }


    if ($flag == "checkReminders") { //ajax call
        //get all reminders from db
        $listRem = $r->listReminder($userId, $db);

        //gets timezone
        $timezone = date_default_timezone_set('US/Eastern');
        //format date and time
        $currentDate = date('Y-m-d');
        $currentTime = date('G:i:s');

        foreach ($listRem as $r) {
            $remDate = $r->date;
            $remTime = $r->time;

            //checks if date and time are met
            if ($remDate == $currentDate && $currentTime >= $remTime) {
                $newName    = 'Reminder';
                $newMessage = $r->title;
                $newStatus  = 'unread';
                $reminderId = $r->id;

                //inputs the reminder data into the notifications table
                //will grab data from Notifications table in header.php to insert into dropdown

                $newNotif = $n->addReminderNotif($newName, $newMessage, $newStatus, $remDate, $remTime, $reminderId, $userId, $db);
            }
        }
    }
}
