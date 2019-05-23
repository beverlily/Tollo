<?php
namespace App;
class User
{
    //Add a new user
    public function addUser($username, $password, $email, $avatar, $db)
    {
        $sql = "INSERT INTO users (username, password, email, avatar)
            VALUES (:username, :password, :email, :avatar)";
        $pst = $db->prepare($sql);

        $pst->bindParam(':username', $username);
        $pst->bindParam(':password', $password);
        $pst->bindParam(':email', $email);
        $pst->bindParam(':avatar', $avatar);

        $count = $pst->execute();
        return $count;
    }

    //Edit a user
    public function editUser($id, $username, $password, $email, $avatar, $db)
    {
        $sql = "UPDATE users
                SET username = :username,
                password = :password,
                email = :email,
                avatar = :avatar
                WHERE id = :id"; 
        $pstm = $db->prepare($sql);
        $pstm->bindParam(':id', $id);
        $pstm->bindParam(':username', $username);
        $pstm->bindParam(':password', $password);
        $pstm->bindParam(':email', $email);
        $pstm->bindParam(':avatar', $avatar);
        $pstm->execute();

        //count
        return $pstm->execute();               

    }

    //Check for existing user
    public function checkExistingUser($username, $db)
    {
        $sql = "SELECT * FROM users WHERE username = :username";
        $pdostm = $db->prepare($sql);
        $pdostm->bindValue(':username', $username, \PDO::PARAM_STR);
        $pdostm->execute();
        $u = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $u;
    }

    //Check for existing email
    public function checkExistingEmail($email, $db)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $pdostm = $db->prepare($sql);
        $pdostm->bindValue(':email', $email, \PDO::PARAM_STR);
        $pdostm->execute();
        $u = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $u;
    }

    //Check for existing Google sign-in user
    public function checkExistingGoogleUser($id, $db)
    {
        $sql = "SELECT * FROM users WHERE id = :id";
        $pdostm = $db->prepare($sql);
        $pdostm->bindValue(':id', $id, \PDO::PARAM_STR);
        $pdostm->execute();
        $u = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $u;
    }

    //Get user info in an associative array that will be put into the $user variable
    public function getUser($username, $db)
    {
        $sql = "SELECT * FROM users WHERE username = :username";
        $pdostm = $db->prepare($sql);
        $pdostm->bindValue(':username', $username, \PDO::PARAM_STR);
        $pdostm->execute();
        $u = $pdostm->fetch(\PDO::FETCH_ASSOC);
        return $u;
    }

    //Get user info in an associative array that will be put into the $user variable for forgot password
    public function getUserByEmail($email, $db)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $pdostm = $db->prepare($sql);
        $pdostm->bindValue(':email', $email, \PDO::PARAM_STR);
        $pdostm->execute();
        $u = $pdostm->fetch(\PDO::FETCH_ASSOC);
        return $u;
    }

}
