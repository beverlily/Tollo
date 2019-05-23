<?php // make a log as an object and pass only the object into the add and update functions
namespace App;
class Log
{
    public function getAllLogs($uid,$dbcon) {
        $sql = 'SELECT logs.id as id, logs.exerciseid as ex_id, exercises.name, logs.sets, logs.reps, logs.weight 
        FROM logs INNER JOIN exercises WHERE logs.exerciseid = exercises.id AND logs.user = :uid ORDER BY date DESC';
        $pdostm = $dbcon->prepare($sql);
        $pdostm->bindParam(':uid',$uid);
        $pdostm->execute();

        $logs = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $logs;
    }

    public function getLogById($id,$dbcon) {
        $sql = "SELECT * FROM logs WHERE id = :id ";
        $pdostm = $dbcon->prepare($sql);
        $pdostm->bindParam(':id',$id);
        $pdostm->execute();
    
        $log = $pdostm->fetch(\PDO::FETCH_OBJ);

        return $log;
    }

    public function getLogsByDate($date,$uid,$dbcon) {
        $sql = 'SELECT logs.id as id, logs.exerciseid as ex_id, logs.date, exercises.name, logs.sets, logs.reps, logs.weight 
            FROM logs INNER JOIN exercises WHERE logs.exerciseid = exercises.id AND date = :date AND user = :uid ORDER BY date DESC';
        $pdostm = $dbcon->prepare($sql);
        $pdostm->bindParam(':date',$date);
        $pdostm->bindParam(':uid',$uid);
        $pdostm->execute();

        $logs = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $logs;
    }

    public function getAllLogDates($uid,$dbcon) {
        $sql = 'SELECT DISTINCT date FROM logs WHERE user = :uid ORDER BY date DESC';
        $pdostm = $dbcon->prepare($sql);
        $pdostm->bindParam(':uid',$uid);
        $pdostm->execute();

        $dates = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $dates;
    }

    public function getRecentLogDates($uid,$dbcon) {
        $sql = 'SELECT DISTINCT date FROM logs WHERE user = :uid ORDER BY date DESC LIMIT 3';
        $pdostm = $dbcon->prepare($sql);
        $pdostm->bindParam(':uid',$uid);
        $pdostm->execute();

        $dates = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $dates;
    }

    public function getLogsbyExercise($exid,$dbcon) {
        $sql = "SELECT * FROM logs WHERE exerciseid = :exid ";
        $pdostm = $dbcon->prepare($sql);
        $pdostm->bindParam(':exid',$exid);
        $pdostm->execute();

        $data = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $data;
    }

    public function addLog($exercise,$sets,$reps,$weight,$uid,$db) {
        $sql = "INSERT INTO logs (date, exerciseid, sets, reps, weight, user) VALUES (:date, :exercise, :sets, :reps, :weight, :uid) ";
        $pst = $db->prepare($sql);
        $now = new \DateTime('now');
        $pst->bindParam(':date',$now->format('y-m-d'));
        $pst->bindParam(':exercise',$exercise);
        $pst->bindParam(':sets',$sets);
        $pst->bindParam(':reps',$reps);
        $pst->bindParam(':weight',$weight);
        $pst->bindParam(':uid',$uid);
        $count = $pst->execute();
        return $count;
    }

    public function deleteLog($id,$db) {
        $sql = "DELETE FROM logs WHERE id = :id";
        $pst = $db->prepare($sql);

        $pst->bindParam(':id',$id);
        $count = $pst->execute();
        return $count;
    }

    public function updateLog($id,$exercise,$sets,$reps,$weight,$db){
        $sql = "UPDATE logs
            SET exerciseid = :exerciseid,
            sets = :sets,
            reps = :reps,
            weight = :weight
            WHERE id = :id
        ";

        $pst = $db->prepare($sql);
        $pst->bindParam(':id',$id);
        $pst->bindParam(':exerciseid',$exercise);
        $pst->bindParam(':sets',$sets);
        $pst->bindParam(':reps',$reps);
        $pst->bindParam(':weight',$weight);
        $count = $pst->execute();
        return $count;
    }
}
?>
