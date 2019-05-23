<?php
require_once '../../vendor/autoload.php';
use App\Exercise;

$e = new Exercise();

//Values of a specific exercise
$id = $_POST['id'];
$name = $_POST['name'];
$description = $_POST['description'];
$category = $_POST['category'];

//Generates the html for the edit modal for a specific exercise
$editModal =
            "<div class='modal-header'>
                <h5 class='modal-title' id='editExerciseModalLabel'>Edit $name </h5>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>
            <div class='modal-body'>
                <div class='modal-container'>
                    <form id='editExerciseForm'>
					<div>
						<label for='editEId' class='hidden'>Id</label>
						<input id='editEId' name='id' class='hidden' type='text' value='$id' />
					</div>
					<br />
					<div>
						<label for='editEName'>Name</label>
						<input id='editEName' name='name' type='text' value='$name' />
					</div>
					<br />
                    <div>
						<label for='editEDescription'>Description</label><br />
						<textarea class='editEDescription' name='description' type='text'>$description</textarea>
					</div>
					<br />
					<label for='editECategory'>Category</label> <br />
					<select id='editECategory' name='category'>";

					//Gets all categories from database and generates a html dropdown 
					$categories = $e->getAllCategories();
					foreach ($categories as $index=>$exerciseCategory) {
						$selected = $exerciseCategory->id == $category ? "selected" : '';
						$editModal .= "<option $selected value='$exerciseCategory->id'>$exerciseCategory->type</option>";
					}

	$editModal .= "</select>
						<br />
						<br />
		                <div class='button-container'>
		                    <input type='submit' name='editCategory' class='button button-main' value='Save' />
		                </div>
						<div class='form-message'></div>
		            </form>
		        </div>
			</div>
		    ";

echo $editModal;
?>
