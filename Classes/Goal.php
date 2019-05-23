<?php
namespace App;
class Goal
{
	private $db;
	public function __construct(){
		$this->db = Database::getDb();
	}

	//Gets a goal by goal id
	public function getGoalById($id){
		$sql = 'SELECT * FROM goals WHERE id = :id';
		$pstmt = $this->db->prepare($sql);
		$pstmt->bindParam(':id', $id);
		$pstmt->execute();
		return $pstmt->fetch(\PDO::FETCH_OBJ);

	}

	//Updates a goal by goal id
	public function updateGoalStatusById($status, $id){
		$sql = 'UPDATE goals
			SET status = :status
			WHERE id =:id';

		$pstmt = $this->db->prepare($sql);

		$pstmt->bindParam(':id', $id);
		$pstmt->bindParam(':status', $status);

		return $pstmt->execute();
	}

	//Gets all the daily goals belonging to a user
	public function getDailyGoals($userId){
		$sql = 'SELECT * FROM goals WHERE type="daily" AND user_id = :userId';
		$pstmt = $this->db->prepare($sql);
		$pstmt->bindParam(':userId', $userId);
		$pstmt->execute();
		return $pstmt->fetchAll(\PDO::FETCH_OBJ);
	}

	//Gets all longterm goals belonging to a user
	public function getLongtermGoals($userId){
		$sql = 'SELECT * FROM goals WHERE type="longterm" AND user_id = :userId';
		$pstmt = $this->db->prepare($sql);
		$pstmt->bindParam(':userId', $userId);
		$pstmt->execute();
		return $pstmt->fetchAll(\PDO::FETCH_OBJ);
	}

	public function addDailyGoal($name, $userId){
		$sql = 'INSERT INTO goals(name, type, user_id)
			VALUES (:name, "daily", :userId)';

		$pstmt = $this->db->prepare($sql);

		$pstmt->bindParam(':name', $name);
		$pstmt->bindParam(':userId', $userId);
		//count
		return $pstmt->execute();
	}

	//Adds a longterm goal to a user
	public function addLongtermGoal($name, $description, $completeBy, $userId){
		$sql = 'INSERT INTO goals(name, description, type, complete_by, user_id)
			VALUES (:name, :description, "longterm", :completeBy, :userId)';

		$pstmt = $this->db->prepare($sql);

		$pstmt->bindParam(':name', $name);
		$pstmt->bindParam(':description', $description);
		$pstmt->bindParam(':completeBy', $completeBy);
		$pstmt->bindParam(':userId', $userId);
		//count
		return $pstmt->execute();
	}

	//Updates a longterm goal by longerm goal id
	public function updateGoal($id, $name, $description, $type, $status, $completeBy){
		$sql = 'UPDATE goals
			SET name = :name,
			description = :description,
			type = :type,
			status = :status,
			complete_by = :completeBy
			WHERE id =:id';

		$pstmt = $this->db->prepare($sql);

		$pstmt->bindParam(':id', $id);
		$pstmt->bindParam(':name', $name);
		$pstmt->bindParam(':description', $description);
		$pstmt->bindParam(':type', $type);
		$pstmt->bindParam(':status', $status);
		$pstmt->bindParam(':completeBy', $completeBy);

		return $pstmt->execute();
	}

	//Deletes goal based on goal id
	public function deleteGoal($id){
		//delete notifications associated with goals
		$sql = 'DELETE FROM notifications WHERE goal_id = :id';
		$pstmt = $this->db->prepare($sql);
		$pstmt->bindParam(':id', $id);
		$pstmt->execute();

		//delete goal
		$sql = 'DELETE FROM goals WHERE id = :id';
		$pstmt = $this->db->prepare($sql);
		$pstmt->bindParam(':id', $id);

		return $pstmt->execute();
	}
}
?>
