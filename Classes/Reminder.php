<?php
namespace App;

class Reminder
{
    public function addReminder($userid, $title, $date, $time, $db)
    {
        $sql = "INSERT INTO reminders (user_id, title, date, time)
        VALUES (:userid, :title, :date, :time)";

        $pst = $db->prepare($sql);

        $pst->bindParam(':userid', $userid);
        $pst->bindParam(':title', $title);
        $pst->bindParam(':date', $date);
        $pst->bindParam(':time', $time);

        $count = $pst->execute();
        return $count;
    }

    public function listReminder($userid, $db)
    {
        $sql = "SELECT * FROM reminders WHERE user_id = :userid";
        $pdostm = $db->prepare($sql);
        $pdostm->bindParam(':userid', $userid);
        $pdostm->execute();

        $rem = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $rem;
    }

    public function deleteReminder($id, $db)
    {
        $sql = "DELETE FROM reminders WHERE id = :id";

        $pst = $db->prepare($sql);

        $pst->bindParam(':id', $id);

        $count = $pst->execute();
        return $count;
    }

    public function updateReminder($userid, $id, $title, $date, $time, $db)
    {
        $sql = "UPDATE reminders
        set title = :title,
        date = :date,
        time = :time
        WHERE id = :id && user_id = :userid";

        $pst = $db->prepare($sql);

        $pst->bindParam(':userid', $userid);
        $pst->bindParam(':id', $id);
        $pst->bindParam(':title', $title);
        $pst->bindParam(':date', $date);
        $pst->bindParam(':time', $time);

        $count = $pst->execute();
        return $count;
    }

    public function getReminderById($id, $db)
    {
        $sql = "SELECT * FROM reminders where id = :id";
        $pst = $db->prepare($sql);
        $pst->bindParam(':id', $id);
        $pst->execute();
        return $pst->fetch(\PDO::FETCH_OBJ);
    }


}
