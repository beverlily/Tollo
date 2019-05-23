"use strict";
//Validates form values
function validateGoalForm(name, type, description, completeBy) {
	let errorMessage = "";
	if (!name) {
		errorMessage += "Please enter a goal name. <br />";
	}
	if(type==='longterm'){
		if (description === "") {
			errorMessage += "Please enter a description. <br />";
		}
		if (completeBy === "") {
			errorMessage += "Please enter a complete by date. <br />";
		}
	}
	return errorMessage;
}

//prints daily goals
function listDailyGoals(){
	$.post(
		'../Controllers/goalsController.php', {
			flag: "listDailyGoals"
		},
		function(result) {
			$('#daily-goals-list').html(result);
		}
	);
}

//prints longterm goals
function listLongtermGoals(){
	let listLongtermGoals = "true"; //boolean
	$.post(
		'../Controllers/goalsController.php', {
			flag: "listLongtermGoals"
		},
		function(result) {
			$('#longterm-goals-list').html(result);
		}
	);
}

$(document).ready(function() {
	//prints out daily and long term goals beloning to the user
	listDailyGoals();
	listLongtermGoals();

	//when long term goal is clicked, the description is toggled and the details button toggles
	$('#longterm-goals-list').on('click', '.item-information', function(){
		$(this).siblings('.item-description').toggleClass("hidden");
		$(this).find('.details i').toggleClass("fas fa-chevron-down fas fa-chevron-up");
	});

	//when the description box is clicked, the box is hidden and the details button toggles
	$('#longterm-goals-list').on('click', '.item-description', function(){
		$(this).prev('.item-information').find('.details i').toggleClass("fas fa-chevron-down fas fa-chevron-up");
		$(this).toggleClass("hidden");
	});

	//When check box is clicked, change the status value of goal
	$('#item-list').on('submit', '.status', function(e){
		e.preventDefault();

		//change the style of checkbox
		$(this).find('i').toggleClass("fas fa-check-circle complete far fa-circle");
		$(this).siblings('.item-information').find('.item-title').toggleClass("complete");

		//change value of status
		let statusButton= $(this).find('button[name="updateStatus"]');
		if(statusButton.val()==0){
			statusButton.val(1);
		}
		else
		{
			statusButton.val(0);
		}

		let id = $(this).find('input[name="id"]').val();
		let status = statusButton.val();

		//update status of goal
		$.post(
			'../Controllers/goalsController.php', {
				id: id,
				status: status,
				flag: "updateStatus"
			}
		);
	});

	//Add ----------------------------------------------------------------------
	//When user tries to add a daily goal by clicking the add daily goal button
	$('#addDailyGoalForm').submit(function(e){
		e.preventDefault();
		//grabs values from form
		const name = $(this).find('input[name="name"]').val();
		//message container for the add daily goal form
		const addDailyGoalMessage = $('#addDailyGoalForm').find('.form-message');

		//check if form values are valid
		const errorMessage = validateGoalForm(name, 'daily', "", "");

		if(errorMessage!==""){
			//if validation error, print validation error message
			addDailyGoalMessage.html(errorMessage);
		}
		else{
			//if all values validate, add the daily goal
			$.post(
				'../Controllers/goalsController.php', {
					//Sends form values and the ajax flag "addDailyGoal"
					name: name,
					flag: "addDailyGoal"
				},
				function(result){
					//get success/error message from adding goal
					addDailyGoalMessage.html(result);
					//refresh list of daily goals
					listDailyGoals();
				}
			);
		}
	});

	$('#addLongtermGoalForm').submit(function(e){
		e.preventDefault();
		//grabs value from add longterm goal form
		let name = $(this).find('input[name="name"]').val();
		let description = $(this).find('input[name="description"]').val();
		let completeBy = $(this).find('input[name="completeBy"]').val();

		//message container for add longterm goals
		const addLongtermGoalMessage = $('#addLongtermGoalForm').find('.form-message');

		//check if form values are valid
		const errorMessage = validateGoalForm(name, 'longterm', description, completeBy);

		if(errorMessage!=""){
			addLongtermGoalMessage.html(errorMessage);
		}
		else{
			//if all values validate, add the longterm goal
			$.post(
				'../Controllers/goalsController.php', {
					//sends form values and the ajax flag "addLongtermGoal"
					name: name,
					description: description,
					completeBy: completeBy,
					flag: "addLongtermGoal"
				},
				function(result){
					//get success/error message from adding goal
					$('#addLongtermGoalForm').find('.form-message').html(result);
					//refresh list of longterm goals
					listLongtermGoals();
				}
			);
		}
	});
	//End of add ---------------------------------------------------------------

	//Edit ---------------------------------------------------------------------
	//When edit button is clicked, edit modal shows up with populated valuse
	$('#item-list').on('submit', '.editGoal', function(e) {
		e.preventDefault();
		//gets id of goal to be edited from form
		let id = $(this).find('input[name="id"]').val();
		$.post(
			'../Controllers/goalsController.php', {
				id: id,
				flag: "editGoal"
			},
			function(result) {
				$('#editGoalModalContent').html(result);
			}
		);
	});

	//When user edits a goal and presses save
	$('#editGoalModalContent').on('submit', '#editGoalForm', function(e) {
		e.preventDefault();
		//form values of edit form
		const id = $(this).find('input[name="id"]').val();
		const name = $(this).find('input[name="name"]').val();
		const type = $(this).find('input[name="type"]').val();
		const status = $(this).find('input[name="status"]').val();

		//No description or completeby date for daily goals
		let description = "";
		let completeBy = "";

		if(type=="longterm"){
			//longterm goals have description and complete by date
			description = $(this).find('input[name="description"]').val();
			completeBy = $(this).find('input[name="completeBy"]').val();
		}
		//edit goal message container
		const editGoalMessage = $('#editGoalForm').find('.form-message');

		//check if form values are valid
		const errorMessage = validateGoalForm(name, type, description, completeBy);
		if(errorMessage!==""){
			//if validation error, print validation error message
			editGoalMessage.html(errorMessage);
		}
		else{
			$.post(
				'../Controllers/goalsController.php', {
					id: id,
					name: name,
					type: type,
					description: description,
					status: status,
					completeBy: completeBy,
					flag: "saveGoal"
				},
				function(result) {
					editGoalMessage.html(result);
					//if daily goal is updated, the list of daily goals refreshes
					if(type=='daily'){
						listDailyGoals();
					}
					else{
						//if long term goal is updated, the list of long term goals refreshes
						listLongtermGoals();
					}
				}
			);
		}
	});
	//End of edit --------------------------------------------------------------

	//Delete -------------------------------------------------------------------
	//when the delete button is pressed for a goal
	$('#item-list').on('submit', '.deleteGoal', function(e) {
		e.preventDefault();
		//id of goal to delete
		let id = $(this).find('input[name="id"]').val();

		const deleteGoal = confirm("Are you sure you want to delete this?");

		//if user confirms that they want to delete the goal
		if(deleteGoal){
			$.post(
				'../Controllers/goalsController.php', {
					id: id,
					flag: "deleteGoal"
				},
				function(result){
					//get success/error message from deleting goal
					$('#message').html(result);
					//refresh list of longterm goals
					listDailyGoals();
					listLongtermGoals();
				}
			);
		}
	});
	//End of delete ------------------------------------------------------------
});
