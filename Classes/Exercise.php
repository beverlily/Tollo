<?php
namespace App;
class Exercise
{
	private $db;
	public function __construct(){
		$this->db = Database::getDb();
	}
	//Exercise Categories  -------------------------------------

	//Gets all exercise categories in the database
	public function getAllCategories(){
		$query = 'SELECT *
		          FROM categories';
		$pdostm = $this->db->prepare($query);
		$pdostm->execute();

		$results = $pdostm->fetchAll(\PDO::FETCH_OBJ);
		return $results;
	}

	//Gets all exercises belonging to given category (uses category id)
	public function getExercisesByCategory($categoryId){
		$query = 'SELECT *
				  FROM exercises
				  WHERE category_id = :category';
		$pdostm = $this->db->prepare($query);
		$pdostm->bindParam(':category', $categoryId);
		$pdostm->execute();

		$results = $pdostm->fetchAll(\PDO::FETCH_OBJ);
		return $results;
	}

	//Gets category by category id
	public function getExerciseCategoryById($id){
		$query = 'SELECT *
				  FROM categories
				  WHERE id = :id';
		$pdostm = $this->db->prepare($query);
		$pdostm->bindParam(':id', $id);
		$pdostm->execute();

		return $pdostm->fetch(\PDO::FETCH_OBJ);
	}

	//Adds an exercise category
	public function addExerciseCategory($type){
		$sql = 'INSERT INTO categories (type)
		 		VALUES (:type)';
		$pstm = $this->db->prepare($sql);
		$pstm->bindParam(':type', $type);

		//count
		return $pstm->execute();
	}

	//Edits an exercise category based on cateogry id
	public function editExerciseCategory($id, $type){
		$sql = 'UPDATE categories
				SET type = :type
				WHERE id = :id';
		$pstm = $this->db->prepare($sql);
		$pstm->bindParam(':id', $id);
		$pstm->bindParam(':type', $type);
		$pstm->execute();

		//count
		return $pstm->execute();
	}

	//Delets an exercise category based on category id
	public function deleteExerciseCategory($id){
		//Delete all exercises of that category
		$sql = 'DELETE FROM exercises WHERE category_id = :id';
		$pstm = $this->db->prepare($sql);
		$pstm->bindParam(':id', $id);
		$pstm->execute();

		//Delete category
		$sql = 'DELETE FROM categories WHERE id = :id';
		$pstm = $this->db->prepare($sql);
		$pstm->bindParam(':id', $id);
		$pstm->execute();

		//count
		return $pstm->execute();
	}


	//Exercises -------------------------------------

	//Gets an exercise by id
	public function getExerciseById($id){
		$query = 'SELECT exercises.id, name, description, type
				  FROM exercises
				  JOIN categories
				  ON exercises.category_id = categories.id
				  WHERE exercises.id = :id';
		$pdostm = $this->db->prepare($query);
		$pdostm->bindParam(':id', $id);
		$pdostm->execute();

		return $pdostm->fetch(\PDO::FETCH_OBJ);
	}

	//Gets all exercises in the database
	public function getAllExercises(){
		$query = 'SELECT *
		          FROM exercises';
		$pdostm = $this->db->prepare($query);
		$pdostm->execute();

		$results = $pdostm->fetchAll(\PDO::FETCH_OBJ);
		return $results;
	}

	//Adds new exercise
	public function addExercise($name, $description, $category){
		$sql = 'INSERT INTO exercises (name, description, category_id)
				VALUES (:name, :description, :category)';
		$pstm = $this->db->prepare($sql);
		$pstm->bindParam(':name', $name);
		$pstm->bindParam(':description', $description);
		$pstm->bindParam(':category', $category);

		//count
		return $pstm->execute();
	}


	//Edits an exercise based on exericse id
	public function editExercise($id, $name, $description, $category){
		$sql = 'UPDATE exercises
				SET name = :name,
				description = :description,
				category_id = :category
				WHERE id = :id';
		$pstm = $this->db->prepare($sql);
		$pstm->bindParam(':id', $id);
		$pstm->bindParam(':name', $name);
		$pstm->bindParam(':description', $description);
		$pstm->bindParam(':category', $category);
		$pstm->execute();

		//count
		return $pstm->execute();
	}

	//Deletes an exercise based on exercise id
	public function deleteExercise($id){
		$sql = 'DELETE FROM exercises WHERE id = :id';
		$pstm = $this->db->prepare($sql);
		$pstm->bindParam(':id', $id);
		$pstm->execute();

		//count
		return $pstm->execute();
	}

}
?>
