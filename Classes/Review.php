<?php
namespace App;
class Review
{
    //Get all reviews
    public function getReviews($db)
    {
        $sql = "SELECT * FROM reviews";
        $pdostm = $db->prepare($sql);
        $pdostm->execute();

        $results = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $results;
    }

    //Get review by id
    public function getReviewById($id, $db)
    {
        $query = 'SELECT *
        FROM reviews WHERE id = :id';
        $pdostm = $db->prepare($query);
        $pdostm->bindParam(':id', $id);
        $pdostm->execute();

        $results = $pdostm->fetch(\PDO::FETCH_OBJ);
        return $results;
    
    }

    //Get review entry 
    public function getUserReview($userid, $db)
    {
        $query = 'SELECT *
        FROM reviews WHERE userid = :userid';
        $pdostm = $db->prepare($query);
        $pdostm->bindParam(':userid', $userid);
        $pdostm->execute();
    
        $results = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $results;
    }

    //Get username
    public function getUserInfo($userid, $db)
    {
        $query = 'SELECT users.username 
        FROM users 
        JOIN reviews
        ON reviews.userid = users.id
        WHERE users.id = :userid';
        $pdostm = $db->prepare($query);
        $pdostm->bindParam(':userid', $userid);
        $pdostm->execute();

        $results = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $results;
    }

    //Add a new review
    public function addReview($rating, $title, $content, $userid, $db)
    {
        $sql = "INSERT INTO reviews (rating, title, content, userid)
            VALUES (:rating, :title, :content, :userid)";
        $pst = $db->prepare($sql);

        $pst->bindParam(':rating', $rating);
        $pst->bindParam(':title', $title);
        $pst->bindParam(':content', $content);
        $pst->bindParam(':userid', $userid);

        $count = $pst->execute();
        return $count;
    }

    //Edit a review
    public function editReview($id, $rating, $title, $content, $db)
    {
        $sql = "UPDATE reviews
                SET rating = :rating,
                title = :title,
                content = :content
                WHERE id = :id"; 
        $pstm = $db->prepare($sql);
        $pstm->bindParam(':id', $id);
        $pstm->bindParam(':rating', $rating);
        $pstm->bindParam(':title', $title);
        $pstm->bindParam(':content', $content);
        $pstm->execute();

        //count
        return $pstm->execute();               

    }

    //Check for existing review
    public function checkExistingReview($username, $db)
    {
        $sql = "SELECT * FROM users WHERE username = :username";
        $pdostm = $db->prepare($sql);
        $pdostm->bindValue(':username', $username, \PDO::PARAM_STR);
        $pdostm->execute();
        $u = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $u;
    }

    //Delete a review
    public function deleteReview($id, $db)
    {
        $sql = "DELETE FROM reviews WHERE id = :id";
        $pst = $db->prepare($sql);
        $pst->bindParam(':id', $id);
        $count = $pst->execute();

        //count
        return $count;
    }

}