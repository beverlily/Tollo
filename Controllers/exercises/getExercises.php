<?php
require_once '../../vendor/autoload.php';
use App\Exercise;

$e = new Exercise();

$category = $_POST['category'];

//gets all exercises of a specific category
$exercises = $e->getExercisesByCategory($category);
$exercisesString = '';

//generates html of list of exercises from a specific category 
foreach($exercises as $exercise){
	$exerciseCategory = $e->getExerciseCategoryById($exercise->category_id);
	$exercisesString .=
	"<li>
		<div class='item item-container flex-container'>
			<div class='item-information'>
			<form class='getExercise getForm'>
				<input type='hidden' name='id' value='$exercise->id' />
				<input type='submit' class='item-title' name='exercise' value='$exercise->name' />
			</form>
			</div>
			<div class='item-icon-container'>
				<form class='editExercise'>
					<input type='hidden' name='id' value='$exercise->id' />
					<input type='hidden' name='name' value='$exercise->name' />
					<input type='hidden' name='description' value='$exercise->description' />
					<input type='hidden' name='category' value='$exerciseCategory->id' />
					<button type='submit' data-toggle='modal' data-target='#editExerciseModal' name='edit'><i class='item-icon fas fa-pencil-alt'></i></button>
				</form>
				<form class='deleteExercise'>
					<input type='hidden' name='id' value='$exercise->id' />
					<input type='hidden' name='category' value='$exerciseCategory->id' />
					<button type='submit' name='delete'><i class='item-icon fas fa-times'></i></button>
					</form>
				</div>
		</div>
	</li>";
}

echo "$exercisesString"
?>
