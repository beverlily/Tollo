<?php
require_once '../../vendor/autoload.php';
use App\Exercise;

$count = "";

//values from edit category form
$id = $_POST['id'];
$type = $_POST['type'];

$e = new Exercise();

//edits exercise category
$count = $e->editExerciseCategory($id, $type);

if($count){
    echo "<p class='success'> Edit has been saved.</p>";
} else {
    echo '<p class="error"> Problem editing exercise category.</p>';
}

?>
