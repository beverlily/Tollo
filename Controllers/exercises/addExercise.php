<?php
require_once '../../vendor/autoload.php';
use App\Exercise;

$count = "";

//Values from add exercise form
$name = ucwords($_POST['name']);
$description = ucwords($_POST['description']);
$category = ucwords($_POST['category']);

$e = new Exercise();

//adds exercise 
$count = $e->addExercise($name, $description, $category);

if($count){
    echo "<p class='success'> Added $name successfully.</p>";
} else {
    echo '<p class="error"> Problem adding exercise.</p>';
}

?>
