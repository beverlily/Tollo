<?php
require_once '../../vendor/autoload.php';
use App\Exercise;

$count = "";

//values from edit exercise form
$id = $_POST['id'];
$name = $_POST['name'];
$description = $_POST['description'];
$category = $_POST['category'];

$e = new Exercise();

//edits an exercise based on exercise id 
$count = $e->editExercise($id, $name, $description, $category);

if($count){
    echo "<p class='success'> Edit has been saved.</p>";
} else {
    echo '<p class="error"> Problem editing exercise category.</p>';
}

?>
