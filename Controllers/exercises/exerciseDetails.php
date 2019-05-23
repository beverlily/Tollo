<?php
require_once '../../vendor/autoload.php';
use App\Exercise;

$id = $_POST['id'];
$e = new Exercise();

//gets exercise by id
$exercise = $e->getExerciseById($id);

//generates html for the details page of an exercise 
$exerciseString = "
<div class='exercise'>
	<h2>$exercise->name</h2>
	<p>
		Type: $exercise->type
	</p>
	<h3>Description</h3>
	<p>
		$exercise->description
	</p>
</div>
";

echo $exerciseString;
?>
