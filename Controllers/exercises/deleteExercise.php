<?php
require_once '../../vendor/autoload.php';
use App\Exercise;

$count = "";

if(isset($_POST['id'])){
	$id = $_POST['id'];
	$e = new Exercise();
	//deletes exercise based on exercise id 
	$count = $e->deleteExercise($id);
}

    if($count){
    	echo "<div class='alert alert-success' role='alert'>
  			The exercise has been deleted.
			</div>";
    } else {
        echo '<p class="error"> Problem deleting exercise.</p>';
    }
?>
