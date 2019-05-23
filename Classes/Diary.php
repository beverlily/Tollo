<?php
namespace App;
class Diary
{
    //Get entry by id
    public function getEntryById($id, $db)
    {
        $query = 'SELECT *
        FROM diaries WHERE id = :id';
        $pdostm = $db->prepare($query);
        $pdostm->bindParam(':id', $id);
        $pdostm->execute();

        return $pdostm->fetch(\PDO::FETCH_OBJ);
    }

    //Get all diary entries for specific user
    public function getAllEntries($userid, $db)
    {
        $query = 'SELECT *
        FROM diaries WHERE userid = :userid';
        $pdostm = $db->prepare($query);
        $pdostm->bindParam(':userid', $userid);
        $pdostm->execute();

        $results = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $results;
    }

    //Add a new entry
    public function addDiaryEntry($title, $date, $content, $userid, $db)
    {
        $sql = "INSERT INTO diaries (title, date, content, userid)
            VALUES (:title, :date, :content, :userid)";
        $pst = $db->prepare($sql);

        $pst->bindParam(':title', $title);
        $pst->bindParam(':date', $date);
        $pst->bindParam(':content', $content);
        $pst->bindParam(':userid', $userid);

        $count = $pst->execute();
        return $count;
    }

    //Edit an entry
    public function editDiaryEntry($id, $title, $date, $content, $db)
    {
        $sql = "UPDATE diaries
                SET title = :title,
                date = :date,
                content = :content
                WHERE id = :id"; 
        $pstm = $db->prepare($sql);
        $pstm->bindParam(':id', $id);
        $pstm->bindParam(':title', $title);
        $pstm->bindParam(':date', $date);
        $pstm->bindParam(':content', $content);
        $pstm->execute();

        //count
        return $pstm->execute();               

    }

    //Delete entry
    public function deleteDiaryEntry($id, $db)
    {
        $sql = "DELETE FROM diaries WHERE id = :id";
        $pst = $db->prepare($sql);
        $pst->bindParam(':id', $id);
        $count = $pst->execute();

        //count
        return $count;
    }
}