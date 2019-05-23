<?php
namespace App;

class About
{
    private $db;
    public function __construct()
    {
        $this->db = Database::getDb();
    }

    public function editAbout($id, $fullname, $age, $gender, $bio)
    {
        $sql = "UPDATE about
        set fullname = :fullname,
        age = :age,
        gender = :gender,
        bio = :bio
        WHERE id = :id";

        $pst = $this->db->prepare($sql);

        $pst->bindParam(':id', $id);
        $pst->bindParam(':fullname', $fullname);
        $pst->bindParam(':age', $age);
        $pst->bindParam(':gender', $gender);
        $pst->bindParam(':bio', $bio);

        return $pst->execute();
    }

    public function showAbout($userid)
    {
        $sql = "SELECT * FROM about WHERE user_id = :userid";

        $pst = $this->db->prepare($sql);
        $pst->bindParam(':userid', $userid);
        $pst->execute();

        return $pst->fetchAll(\PDO::FETCH_OBJ);
    }

    public function getAboutId($id)
    {
        $sql = "SELECT * FROM about WHERE id = :id";

        $pst = $this->db->prepare($sql);
        $pst->bindParam(':id', $id);
        $pst->execute();

        return $pst->fetchAll(\PDO::FETCH_OBJ);
    }

    public function addUserId($userid, $fullname, $age, $gender, $bio)
    {
        $sql = "INSERT INTO about (user_id, fullname, age, gender, bio)
        VALUES (:userid, :fullname, :age, :gender, :bio)";

        $pst = $this->db->prepare($sql);
        $pst->bindParam(':userid', $userid);
        $pst->bindParam(':fullname', $fullname);
        $pst->bindParam(':age', $age);
        $pst->bindParam(':gender', $gender);
        $pst->bindParam(':bio', $bio);

        return $pst->execute();
    }
}
