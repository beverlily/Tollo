<?php
require_once '../vendor/autoload.php';
use App\Database;
use App\Measurement;
session_start();
$m = new Measurement();

//function to validate form fields
function validateForm($name, $current, $goal){
	$errors = "";
	if (empty($name)){
		$errors .= "Please enter a measurement name. <br />";
	}
	if (empty($current)){
		$errors .= "Please enter your current measurement. <br />";
	}
	else if(!is_numeric($current)){
		$errors .= "Current measurement must be a number. <br />";
	}
	if (empty($goal)){
		$errors .= "Please enter your goal measurement. <br />";
	}
	else if(!is_numeric($goal)){
		$errors .= "Goal measurement must be a number. <br />";
	}
	return $errors;
}

//if user is logged in and there is an ajax flag
if(isset($_SESSION['id']) && isset($_POST['flag'])){
	 $userId = $_SESSION['id'];
	 $flag = $_POST['flag'];

	 //Gets post values from the measurement form and assigns to local variables
	 //Name of measurement, current measurement, and goal measurement
	 isset($_POST['id']) ? $id = ($_POST['id']) : $id = "";
	 isset($_POST['name']) ? $name = ucwords($_POST['name']) : $name = "";
 	 isset($_POST['current']) ? $current = $_POST['current'] : $current = "";
 	 isset($_POST['goal']) ? $goal = $_POST['goal'] : $goal = "";

	 //Checks for validation errors
	 $errors = validateForm($name, $current, $goal);

 	if($flag == 'listMeasurements'){
		//Gets all the measurements belonging to the user
		$userMeasurements = $m->getAllMeasurements($userId);

		$userMeasurementsList = "";
		foreach($userMeasurements as $measurement){
			$userMeasurementsList .=
				"<li class='list-group-item item flex-container'>
					<div class='item-information measurement-info'>
						<h3>$measurement->name</h3>
						<span class='measurement-title first'>Current:</span> $measurement->current inches
						<span class='measurement-title'>Goal:</span> $measurement->goal inches
						<div class='measurement-msg'></div>
					</div>
					<form class='item-information edit-measurement-form hidden'>
						<input type='hidden' name='id' value='$measurement->id' />
						<label class='hidden'>Measurement Name</label>
						<input type='text' class='mName' name='name' value='$measurement->name'>
						<br />
						<label>Current:</label>
						<input type='number' name='current' step='0.01' class='small' value='$measurement->current'> inches
						<label>Goal:</label>
						<input type='number' name='goal' step='0.01' class='small' value='$measurement->goal'> inches
						<input class='hidden' type='submit' name='save'/>
					<div class=update-measurement-msg>
					</div>
					</div>
					</form>
					<div class='item-icon-container'>
						<form class='edit-measurement'>
							<input type='hidden' name='id' value='$measurement->id' />
							<input class='mName' type='hidden' name='name' value='$measurement->name' />
							<input type='hidden' name='current' value='$measurement->current' />
							<input type='hidden' name='goal' value='$measurement->goal' />
							<button type='submit' name='edit'><i class='item-icon fas fa-pencil-alt'></i></button>
						</form>
						<form class='delete-measurement'>
							<input type='hidden' name='id' value='$measurement->id' />
							<button type='submit' name='delete'><i class='item-icon fas fa-times'></i></button>
						</form>
					</div>
				</li>";
		}

		echo $userMeasurementsList;
	}

 	//Adds measurement if ajax flag is "addMeasurement"
 	if($flag == 'addMeasurement'){
		if($errors != ""){
			echo $errors;
		}
		else{
			$addCount = $m->addMeasurement($userId, $name, $current, $goal);
			 if($addCount){
				   echo "<p class='success'> Added measurement successfully.</p>";
			   } else {
				   echo "<p class='error'>Problem adding measurement</p>";
			   }
		}
 	}

	//Updates measurement if ajax flag is "updateMeasurement"
	if($flag == 'updateMeasurement'){
		if($errors != ""){
			echo "<p class='error'>$errors</p>";
		}
		else{
			$editCount = $m->updateMeasurement($id, $name, $current, $goal);
			 if($editCount){
				   echo "<p class='success'> Updated measurement successfully.</p>";
			   } else {
				   echo "<p class='error'>Problem updating measurement</p>";
			   }
		}
	}

	//Delete measurement if ajax flag is "updateMeasurement"
	if($flag == 'deleteMeasurement'){
		$editCount = $m->deleteMeasurement($id);
		 if($editCount){
			   echo "<p class='success'> Deleted measurement successfully.</p>";
		   } else {
			   echo "<p class='error'>Problem deleting measurement</p>";
		   }
	}
}
?>
