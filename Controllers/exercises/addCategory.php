<?php
require_once '../../vendor/autoload.php';
use App\Exercise;

$count = "";
//Value from add category form 
$type = ucwords($_POST['type']);

$e = new Exercise();

//gets all exercise categories
$count = $e->addExerciseCategory($type);

if($count){
    echo "<p class='success'> Added $type successfully.</p>";
} else {
    echo '<p class="error"> Problem adding exercise category.</p>';
}

?>
