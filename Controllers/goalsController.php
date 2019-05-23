<?php
session_start();
require_once '../vendor/autoload.php';
use App\Database;
use App\Goal;
$goal = new Goal();

//function to validate form fields
function validateForm($name, $type, $description, $completeBy){
	$errors = "";
	if (empty($name)){
		$errors .= "Please enter a goal name. <br />";
	}
	if($type=='longterm'){
		if (empty($description)){
			$errors .= "Please enter a description. <br />";
		}
		if (empty($completeBy)){
			$errors .= "Please select a complete by date. <br />";
		}
	}
	return $errors;
}

//if user is logged in and there is an ajax flag
if(isset($_SESSION['id']) && isset($_POST['flag'])){
	 $userId = $_SESSION['id'];
	 $flag = $_POST['flag'];

	 //Gets post values from the goal form and assigns to local variables
	 //Name of measurement, current measurement, and goal measurement
	 isset($_POST['id']) ? $id = ($_POST['id']) : $id = "";
	 isset($_POST['name']) ? $name = ucwords($_POST['name']) : $name = "";
 	 isset($_POST['description']) ? $description = $_POST['description'] : $description = "";
	 isset($_POST['type']) ? $type = $_POST['type'] : $type = "";
 	 isset($_POST['status']) ? $status = $_POST['status'] : $status = "";
	 isset($_POST['completeBy']) ? $completeBy = $_POST['completeBy'] : $completeBy = "";

	 //Checks for validation errors
	 if($type != ""){
		$errors = validateForm($name, $type, $description, $completeBy);
	 }

	 //CREATE -----------------------------------------------------
  	//Adds daily goal and displays success/error message
  	if($flag == 'addDailyGoal'){
  		$count = $goal->addDailyGoal($name, $userId);
  		 if($count){
  		       echo "<p class='success'> Added goal successfully.</p>";
  		   } else {
  		       echo "<p class='error'>Problem adding goal</p>";
  		   }
  	}

  	//Adds longterm goal and displays success/error
  	if($flag == 'addLongtermGoal'){
  		$count = $goal->addLongtermGoal($name, $description, $completeBy, $userId);
  		 if($count){
  		       echo "<p class='success'> Added goal successfully.</p>";
  		   } else {
  		       echo "<p class='error'>Problem adding goal</p>";
  		 }
  	}
 	//END OF CREATE -----------------------------------------------------

	//READ -----------------------------------------------------
 	//prints daily goals
 	if($flag == 'listDailyGoals'){
 		$dailyGoals = $goal->getDailyGoals($userId);
 		$dailyGoalsList = "";
 		foreach($dailyGoals as $dailyGoal){
 			$dailyGoalsList .= "<li class='dailyGoal'>
 			<div class='item item-container flex-container'>
 			<form class='status'>
 			<input type='hidden' name='id' value='$dailyGoal->id' />";

 				if($dailyGoal->status==1){
 					 $class = 'fas fa-check-circle complete';
 					 $value = 1;
 				}
 				else {
 					 $class = 'far fa-circle';
 					 $value = 0;
 				}

 				$dailyGoalsList .= "<button name='updateStatus' class='updateStatus' type='submit' value='$value'><i class='$class'></i></button>
 					</form>
 				<div class='item-information flex-container'>
 					<div class='item-title ";
 						$dailyGoal->status==1? $dailyGoalsList .= 'complete' : $dailyGoalsList .= "";
 						$dailyGoalsList .=
 							"'>
 							$dailyGoal->name
 					</div>
 				<div class='item-icon-container'>
 				   <form class='editGoal'>
 					  <input type='hidden' name='id' value='$dailyGoal->id' />
 					  <button type='submit' name='edit' data-toggle='modal' data-target='#editGoalModal'><i class='item-icon fas fa-pencil-alt'></i></button>
 				   </form>
 				   <form class='deleteGoal'>
 					  <input type='hidden' name='id' value='$dailyGoal->id' />
 					  <button type='submit' name='delete'><i class='item-icon fas fa-times'></i></button>
 				   </form>
 				</div>
 				</div>
 				</li>
 				";
 		}
 		echo $dailyGoalsList;
 	}

 	//prints longterm goals
 	if($flag == 'listLongtermGoals'){
 		$longtermGoals = $goal->getLongtermGoals($userId);
 		$longtermGoalsList = "";
 		foreach($longtermGoals as $longtermGoal){
 			$longtermGoalsList .= "<li class='longtermGoal'>
 			<div class='item item-container flex-container'>
 			<form class='status'>
 			<input type='hidden' name='id' value='$longtermGoal->id' />";
 				if($longtermGoal->status==1){
 					 $class = 'fas fa-check-circle complete';
 					 $value = 1;
 				}
 				else{
 					 $class = 'far fa-circle';
 					 $value = 0;
 				}

 				$longtermGoalsList .= "<button name='updateStatus' class='updateStatus' type='submit' value='$value'><i class='$class'></i></button>
 					</form>
 					<div class='item-information flex-container'>
 						<div class='item-title ";
 							$longtermGoal->status==1? $longtermGoalsList .= 'complete' : $longtermGoalsList .= "";
 							$longtermGoalsList .= "'>
 								$longtermGoal->name
 						<div class='item-complete-by'> <span class='goalLabel'>Complete by:</span> $longtermGoal->complete_by </div>
 						</div>
 						<button class='details'><i class='fas fa-chevron-down'></i></button>
 					</div>
 					<div class='item-icon-container'>
 					   <form class='editGoal'>
 						  <input type='hidden' name='id' value='$longtermGoal->id' />
 						  <button type='submit' name='edit' data-toggle='modal' data-target='#editGoalModal'><i class='item-icon fas fa-pencil-alt'></i></button>
 					   </form>
 					   <form class='deleteGoal'>
 						  <input type='hidden' name='id' value='$longtermGoal->id' />
 						  <button type='submit' name='delete'><i class='item-icon fas fa-times'></i></button>
 					   </form>
 					</div>
 					<div class='item item-description hidden'>
 					   $longtermGoal->description
 					</div>
 				</div>
 				</li>
 				";
 		}
 		echo $longtermGoalsList;
 	}
	//END OF READ -----------------------------------------------------

	//UPDATE -----------------------------------------------------
	//if checkmark is clicked, update status
	if($flag == 'updateStatus'){
		$goal->updateGoalStatusById($status, $id);
	}

 	//if user wants to edit a goal, displays a modal with details filled out
 	if($flag == 'editGoal'){
		if($errors != ''){
			//if there are validation errors
			echo "<p class='error'>$errors</p>";
		}
		else{
			$myGoal = $goal->getGoalById($id);
			echo
				"<div class='modal-header'>
					<h5 class='modal-title' id='editGoalModalLabel'>Edit $myGoal->name </h5>
					<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
						<span aria-hidden='true'>&times;</span>
					</button>
				</div>
				<div class='modal-body'>
					<div class='modal-container'>
						<form id='editGoalForm'>
							<input id='editGId' name='id' class='hidden' type='hidden' value='$id' />
							<input id='editGType' name='type' type='hidden' value='$myGoal->type' />
							<input id='editGType' name='status' type='hidden' value='$myGoal->status' />
							<div>
								<label for='editGName'>Name</label>
								<input id='editGName' name='name' type='text' value='$myGoal->name' />
							</div>";
						if($myGoal->type=="longterm"){
							echo "<br />
							<div>
								<label for='editGDescription'>Description</label>
								<input id='editGDescription' name='description' type ='text' value='$myGoal->description' />
							</div>
							<br />
							<div>
								<label for='editGCompleteBy'>Complete By</label>
								<input id='editCompleteBy' name='completeBy' type ='date' value='$myGoal->complete_by' />
							</div>
							";
						}
				echo "<div class='button-container'>
								<input type='submit' name='editGoal' class='button button-main' value='Save' />
							</div>
							<div class='form-message'></div>
						</form>
					</div>
				</div>";
		}
 	}

 	//if user edits a goal and wants to save it
 	if($flag == 'saveGoal'){
		if($errors != ''){
			//if there are validation errors
			echo "<p class='error'>$errors</p>";
		}
		else{
			if($type=='daily'){
				$count = $goal->updateGoal($id, $name, null, $type, $status, null);
			}
			else{
				$description = $_POST['description'];
				$completeBy = $_POST['completeBy'];
				$count = $goal->updateGoal($id, $name, $description, $type, $status, $completeBy);
			}
			if($count){
				  echo "<p class='success'>Edit has been saved.</p>";
			  } else {
				  echo "<p class='error'>Problem saving goal</p>";
			}
		}
 	}
	//END OF UPDATE -----------------------------------------------------

	//DELETE -----------------------------------------------------
 	if($flag == 'deleteGoal'){
		if($errors != ''){
			//if there are validation errors
			echo "<p class='error'>$errors</p>";
		}
		else{
	 		$count = $goal->deleteGoal($id);
	 		 if($count){
	 		       echo "<p class='success'> Deleted goal successfully.</p>";
	 		   } else {
	 		       echo "<p class='error'>Problem deleting goal</p>";
	 		 }
 		}
	}
	//END OF DELETE -----------------------------------------------------
}
?>
