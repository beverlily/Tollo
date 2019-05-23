<?php
require_once '../../vendor/autoload.php';
use App\Exercise;

$count = "";

if(isset($_POST['id'])){
	$id = $_POST['id'];
	$e = new Exercise();
	//deletes a category based on category id 
	$count = $e->deleteExerciseCategory($id);
}

    if($count){
    	echo "<div class='alert alert-success' role='alert'>
  			The exercise category has been deleted.
			</div>";
    } else {
        echo '<p class="error"> Problem deleting exercise category.</p>';
    }

?>
