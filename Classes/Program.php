<?php
namespace App;

class Program
{
    public function addNewProgram($name,$authorid,$description,$dbcon) {
        $sql = "INSERT INTO programs (name, authorid, description) VALUES (:name, :authorid, :description) ";
        $pst = $dbcon->prepare($sql);
        
        $pst->bindParam(':name',$name);
        $pst->bindParam(':authorid',$authorid);
        $pst->bindParam(':description',$description);
        $count = $pst->execute();
        $lastid = $dbcon->lastInsertId();
        return $lastid;
    }

    public function addDay($name,$program,$dbcon) {
        $sql = "INSERT INTO days (name, program) VALUES (:name, :program) ";
        $pst = $dbcon->prepare($sql);
        
        $pst->bindParam(':name',$name);
        $pst->bindParam(':program',$program);
        $count = $pst->execute();
        $lastid = $dbcon->lastInsertId();
        return $lastid;
    }

    public function addExercisesToDays($day,$ex,$seq,$sets,$reps,$dbcon) {
        $sql = "INSERT INTO days_exercises (day_id, exercise_id, sequence, sets, reps) 
                VALUES (:day,:ex,:seq,:sets,:reps) ";
        $pst = $dbcon->prepare($sql);

        $pst->bindParam(':day',$day);
        $pst->bindParam(':ex',$ex);
        $pst->bindParam(':seq',$seq);
        $pst->bindParam(':sets',$sets);
        $pst->bindParam(':reps',$reps);
        $count = $pst->execute();
        return $count;
    }

    public function subscribeToProgram($pid,$userid,$dbcon) {
        $sql = "INSERT INTO programs_users (program, user) 
            VALUES (:pid,:userid) ";
        $pst = $dbcon->prepare($sql);

        $pst->bindParam(':pid',$pid);
        $pst->bindParam(':userid',$userid);
        $count = $pst->execute();
        return $count;
    }

    public function isUserSubscribedToThisProgram($userid,$pid,$dbcon) {
        $sql = 'SELECT * FROM programs_users WHERE user = :userid AND program = :pid ';
        $pst = $dbcon->prepare($sql);

        $pst->bindParam(':userid',$userid);
        $pst->bindParam(':pid',$pid);
        $count = $pst->execute();

        $is = $pst->fetchAll(\PDO::FETCH_OBJ);
        return $is;
    }

    public function getUserSubs($userid,$dbcon) {
        $sql = 'SELECT programs.id as id, programs.name as name, programs.authorid as author, programs.description as description
            FROM programs 
            INNER JOIN programs_users ON programs.id = programs_users.program
            WHERE programs_users.user = :userid' ;

        $pst = $dbcon->prepare($sql);

        $pst->bindParam(':userid',$userid);
        $count = $pst->execute();

        $programs = $pst->fetchAll(\PDO::FETCH_OBJ);
        return $programs;  
    }


    public function getDistinctPrograms($dbcon) {
        $sql = 'SELECT DISTINCT * from programs';
        $pdostm = $dbcon->prepare($sql);
        $pdostm->execute();

        $programs = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $programs;
    }

    public function findAuthorofProgram($id,$dbcon) {
        $sql = 'SELECT * from programs WHERE authorid = :id';
        $pdostm = $dbcon->prepare($sql);
        $pdostm->bindParam(':id',$id);
        $pdostm->execute();

        $author = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $author;
    }

    public function getProgramAuthor($aid,$dbcon) {
        $sql = 'SELECT username FROM users WHERE users.id = :aid';
        $pdostm = $dbcon->prepare($sql);
        $pdostm->bindParam(':aid',$aid);
        $pdostm->execute();

        $author = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $author;
    }

    public function getThreeExercisesInProgram($pid,$dbcon) {
        $sql = 'SELECT DISTINCT exercises.name 
                        FROM programs
                        INNER JOIN days
                            ON days.program = programs.id
                        INNER JOIN days_exercises
                            ON days_exercises.day_id = days.id
                        INNER JOIN exercises 
                            ON days_exercises.exercise_id = exercises.id
                        WHERE programs.id = :id LIMIT 3
        ';
        $pdostm = $dbcon->prepare($sql);
        $pdostm->bindParam(':id',$pid);
        $pdostm->execute();

        $exercises = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $exercises;

    }

    public function getProgrambyId($id,$dbcon) {
        $sql = 'SELECT * FROM programs WHERE id = :id ';
        $pdostm = $dbcon->prepare($sql);
        $pdostm->bindParam(':id',$id);
        $pdostm->execute();

        $program = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $program;
    }

    public function getDayInfobyId($did,$dbcon) {
        $sql = 'SELECT * FROM days WHERE days.id = :id ';
        $pdostm = $dbcon->prepare($sql);
        $pdostm->bindParam(':id',$did);
        $pdostm->execute();

        $info = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $info;
    }

    public function getDaysbyId($id,$dbcon) {
        $sql = 'SELECT * FROM programs INNER JOIN days ON days.program = programs.id WHERE programs.id = :id ';
        $pdostm = $dbcon->prepare($sql);
        $pdostm->bindParam(':id',$id);
        $pdostm->execute();

        $days = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $days;
    }

    public function getDxEDetailsByDayId($did,$dbcon) {
        $sql = 'SELECT  exercises.id as ex_id,
                        exercises.name as exercise,
                        days_exercises.id as dxeid,
                        days_exercises.sequence as sequence,
                        days_exercises.sets as sets,
                        days_exercises.reps as reps
                        FROM days
                        INNER JOIN days_exercises
                            ON days_exercises.day_id = days.id
                        INNER JOIN exercises 
                            ON days_exercises.exercise_id = exercises.id
                        WHERE days.id = :id
                ';
        $pdostm = $dbcon->prepare($sql);
        $pdostm->bindParam(':id',$did);
        $pdostm->execute();

        $exercises = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $exercises;
    }

    public function updateProgramDetails($id,$name,$desc,$dbcon){
        $sql = "UPDATE programs
            SET name = :name,
            description = :desc
            WHERE id = :id
        ";

        $pst = $dbcon->prepare($sql);
        $pst->bindParam(':id',$id);
        $pst->bindParam(':name',$name);
        $pst->bindParam(':desc',$desc);
        $count = $pst->execute();
        return $count;
    }

    public function updateDxE($dxeid,$ex,$sets,$reps,$dbcon) {
        $sql = "UPDATE days_exercises
            SET exercise_id = :ex,
            sets = :sets,
            reps = :reps
            WHERE id = :dxeid ";
        $pst = $dbcon->prepare($sql);

        $pst->bindParam(':dxeid',$dxeid);
        $pst->bindParam(':ex',$ex);
        $pst->bindParam(':sets',$sets);
        $pst->bindParam(':reps',$reps);
        $count = $pst->execute();
        return $count;
    }

    public function deleteDxE($dxeid,$dbcon) {
        $sql = 'DELETE FROM days_exercises WHERE id = :dxeid ';
        $pst = $dbcon->prepare($sql);

        $pst->bindParam(':id',$dxeid);
        $count = $pst->execute();

        return $count;
    }

    public function deleteDaysbyId($id,$dbcon) {
        $sql = 'DELETE FROM days_exercises WHERE day_id = :id; DELETE FROM days WHERE id = :id2 ';
        $pst = $dbcon->prepare($sql);

        $pst->bindParam(':id',$id);
        $pst->bindParam(':id2',$id);
        $count = $pst->execute();

        return $count;
    }

    public function deleteProgram($id,$dbcon) {
        $sql = "DELETE FROM programs WHERE id = :id";
        $pst = $dbcon->prepare($sql);

        $pst->bindParam(':id',$id);
        $count = $pst->execute();
        return $count;
    }

    public function unsubscribeFromProgram($pid,$userid,$dbcon) {
        $sql = "DELETE FROM programs_users WHERE program = :pid AND user = :userid" ;
        $pst = $dbcon->prepare($sql);

        $pst->bindParam(':pid',$pid);
        $pst->bindParam(':userid',$userid);
        $count = $pst->execute();
        return $count;
    }
}
?>