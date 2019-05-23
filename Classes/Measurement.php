<?php
namespace App;
class Measurement
{
	private $db;
	public function __construct(){
		$this->db = Database::getDb();
	}

	//Gets all measurement of a user
	public function getAllMeasurements($userId){
		$sql = 'SELECT * FROM measurements WHERE user_id = :userId';
		$pstmt = $this->db->prepare($sql);
		$pstmt->bindParam(':userId', $userId);
		$pstmt->execute();
		return $pstmt->fetchAll(\PDO::FETCH_OBJ);
	}

	//Gets measurement by id
	public function getMeasurementById($id){
		$sql = 'SELECT * FROM measurements WHERE id = :id';
		$pstmt = $this->db->prepare($sql);
		$pstmt->bindParam(':id', $id);
		$pstmt->execute();
		return $pstmt->fetch(\PDO::FETCH_OBJ);
	}

	//Adds measurement for a user
	public function addMeasurement($userId, $name, $current, $goal){
		$sql = 'INSERT INTO measurements(user_id, name, current, goal)
			VALUES (:userId, :name, :current, :goal)';

		$pstmt = $this->db->prepare($sql);
		$pstmt->bindParam(':userId', $userId);
		$pstmt->bindParam(':name', $name);
		$pstmt->bindParam(':current', $current);
		$pstmt->bindParam(':goal', $goal);

		//count
		return $pstmt->execute();
	}

	//Updates measurement's name, current measurement, and goal measurement by id
	public function updateMeasurement($id, $name, $current, $goal){
		$sql = 'UPDATE measurements
			SET name = :name,
			current = :current,
			goal = :goal
			WHERE id = :id';

		$pstmt = $this->db->prepare($sql);

		$pstmt->bindParam(':id', $id);
		$pstmt->bindParam(':name', $name);
		$pstmt->bindParam(':current', $current);
		$pstmt->bindParam(':goal', $goal);

		return $pstmt->execute();
	}

	//Deletes measurements by measurement id
	public function deleteMeasurement($id){
		$sql = 'DELETE FROM measurements WHERE id = :id';
		$pstmt = $this->db->prepare($sql);
		$pstmt->bindParam(':id', $id);
		$pstmt->execute();

		return $pstmt->execute();
	}
}
?>
