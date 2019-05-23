<?php
namespace App;

class Notification
{
    public function displayGoalNotifs($user_id, $db)
    {
        $sql = "SELECT goals.name, goals.complete_by
			FROM notifications
			JOIN goals
			ON notifications.goal_id = goals.id
			WHERE notifications.status = 'unread' && notifications.user_id = :user_id";
        $pst = $db->prepare($sql);
        $pst->bindParam(':user_id', $user_id);
        $pst->execute();
        $n = $pst->fetchAll(\PDO::FETCH_OBJ);
        return $n;
    }

    public function displayReminderNotifs($user_id, $db)
    {
        $sql = "SELECT notifications.name,reminders.title, reminders.date, reminders.time
			FROM notifications
			JOIN reminders
			ON notifications.reminder_id = reminders.id
			WHERE notifications.status = 'unread' && notifications.user_id = :user_id";
        $pst = $db->prepare($sql);
        $pst->bindParam(':user_id', $user_id);
        $pst->execute();
        $n = $pst->fetchAll(\PDO::FETCH_OBJ);
        return $n;
    }

    public function addGoalNotif($name, $message, $status, $time, $date, $goal_id, $user_id, $db)
    {
        //checks to see if goal notification is already in the table
        $sql = 'SELECT * FROM notifications WHERE goal_id = :goalid';
        $pst = $db->prepare($sql);
        $pst->bindParam(':goalid', $goal_id);
        $pst->execute();
        $count = $pst->fetch(\PDO::FETCH_OBJ);

        if (!$count) {
            $sql = "INSERT INTO notifications (name, message, status, time, date, goal_id, user_id)
	        VALUES (:name, :message, :status, :time, :date, :goalid, :userid)";

            $pst = $db->prepare($sql);

            $pst->bindParam(':name', $name);
            $pst->bindParam(':message', $message);
            $pst->bindParam(':status', $status);
            $pst->bindParam(':time', $time);
            $pst->bindParam(':date', $date);
            $pst->bindParam(':goalid', $goal_id);
            $pst->bindParam(':userid', $user_id);

            $count = $pst->execute();
            return $count;
        }
    }

    public function addReminderNotif($name, $message, $status, $date, $time, $reminder_id, $user_id, $db)
    {
        //checks to see if reminder notification is already in the table
        $sql = 'SELECT * FROM notifications WHERE reminder_id = :reminderid';
        $pst = $db->prepare($sql);
        $pst->bindParam(':reminderid', $reminder_id);
        $pst->execute();
        $count = $pst->fetch(\PDO::FETCH_OBJ);

        if (!$count) {
            $sql = "INSERT INTO notifications (name, message, status, date, time, reminder_id, user_id)
	        VALUES (:name, :message, :status, :date, :time, :reminderid, :userid)";

            $pst = $db->prepare($sql);

            $pst->bindParam(':name', $name);
            $pst->bindParam(':message', $message);
            $pst->bindParam(':status', $status);
            $pst->bindParam(':time', $time);
            $pst->bindParam(':date', $date);
            $pst->bindParam(':reminderid', $reminder_id);
            $pst->bindParam(':userid', $user_id);

            $count = $pst->execute();
            return $count;
        }
    }

    public function deleteAllRemNotifs($user_id, $db)
    {
        $sql = "DELETE notifications, reminders
        FROM notifications
        JOIN reminders ON notifications.reminder_id = reminders.id
       WHERE notifications.user_id = :userid";

        $pst = $db->prepare($sql);
        $pst->bindParam(':userid', $user_id);

        return $pst->execute();
    }

    public function deleteAllGoalNotifs($user_id, $db)
    {
        $sql = "DELETE notifications, goals
        FROM notifications
        JOIN goals ON notifications.goal_id = goals.id
       WHERE notifications.user_id = :userid";

        $pst = $db->prepare($sql);
        $pst->bindParam(':userid', $user_id);

        return $pst->execute();
    }
}
