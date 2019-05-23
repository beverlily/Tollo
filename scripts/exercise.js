"use strict";
function printCategories() {
    //Hides add exercise and back to exercise button
    $("#addExerciseButton").addClass("hidden");
    $("#backToCategories").addClass("hidden");

    //Shows add cateogry button
    $('#addCategoryButton').removeClass("hidden");

    $.post(
        '../Controllers/exercises/getCategories.php',
        function(result) {
            //gets all categories and displays it in the exercise list container
            $('#exercise-list').html(result);
        }
    );
}

function printExercisesByCategory(category) {
    //displays add exercise button and back to categories button
    $("#addExerciseButton").removeClass("hidden");
    $("#backToCategories").removeClass("hidden");

    //hides add exercise button
    $('#addCategoryButton').addClass("hidden");

    $.post(
        '../Controllers/exercises/getExercises.php', {
            category: category
        },
        function(result) {
            //gets all exercise by category and then displays it in the exercise list
            $('#exercise-list').html(result);
        }
    );

    $.post(
        '../Controllers/exercises/exerciseDropdown.php', {
            select: category
        },
        function(result) {
            //Gets a dropdown of all the exercise categories
            $('#categoryDropdown').html(result);
        }
    );
}

//Validates exercise form values
function validateExerciseForm(name, description, category) {
    let errorMessage = "";
    if (!name) {
        errorMessage += "Please enter an exercise name. <br />";
    }
    if (!description) {
        errorMessage += "Please enter a description. <br />";
    }
    if (!category) {
        errorMessage += "Please enter a category. <br />";
    }
    return errorMessage;
}

//Validates category form values
function validateCategoryForm(type) {
    let errorMessage = "";
    if (!type) {
        errorMessage += "Please enter a category name. <br />";
    }
    return errorMessage;
}

$(document).ready(function() {
    printCategories();

    //When back to categories button is clicked, prints a list of all categories
    $('#backToCategories').click(function() {
		//clears any status messages 
		$('#message').html("");
        printCategories();
    });

    // on modal close
    $(".modal").on("hidden.bs.modal", function() {
        //resets form
        $(this).find('form').trigger('reset');
        //resets form message
        $(this).find('.form-message').empty();
    });

    //EXERCISE CATEGORIES ------------------------------------------------------

	//CREATE EXERCISE CATEGORY -------------------------------------------------
    //When presses add in the add category form
    $('#addCategoryForm').submit(function(e) {
        e.preventDefault();
        let type = $(this).find('input[name="type"]').val();

        //container for message in the add category form
        const addCategoryFormMessage = $('#addCategoryForm').find('.form-message');
        const errorMessage = validateCategoryForm(type);

        if (errorMessage !== "") {
            //if values don't validate, prints out an error message
            addCategoryFormMessage.html(errorMessage);
        } else {
            $.post(
                '../Controllers/exercises/addCategory.php', {
                    type: type
                },
                function(result) {
                    //get success/error message from adding exercise category
                    addCategoryFormMessage.html(result);
                    //update the printed list of categories
                    printCategories();
                }
            );
        }
    });

	//READ EXERCISE CATEGORY ---------------------------------------------------
	//When category is clicked, print all exercises in that category
    $('#exercise-list').on('submit', '.getCategory', function(e) {
        e.preventDefault();
        $('#message').html("");
        const id = $(this).find('input[name="id"]').val();
        printExercisesByCategory(id);
    });

	//EDIT EXERCISE CATEGORY ---------------------------------------------------
    //Edit category modal
    //When user clicks the edit button for a category, shows the edit modal
    $('#exercise-list').on('submit', '.editCategory', function(e) {
        e.preventDefault();

        //values of the category
        const id = $(this).find('input[name="id"]').val();
        const type = $(this).find('input[name="type"]').val();

        $.post(
            '../Controllers/exercises/getCategory.php', {
                id: id,
                type: type
            },
            function(result) {
                $('#editCategoryModalContent').html(result);
                //update the printed list of categories
                printCategories();
            }
        );
    });

    //When user edits a category and presses save
    $('#editCategoryModal').on('submit', '#editCategoryForm', function(e) {
        e.preventDefault();

        //values from edit category modal
        const id = $(this).find('input[name="id"]').val();
        const type = $(this).find('input[name="type"]').val();

        //message container of the edit modal
        const editCategoryModalMessage = $('#editCategoryForm').find('.form-message');

        //check to see if all values are valid in the edit category modal
        const errorMessage = validateCategoryForm(type);

        if (errorMessage !== "") {
            //if values are not valid, displays error message in the modal
            editCategoryModalMessage.html(errorMessage);
        } else {
            $.post(
                '../Controllers/exercises/editCategory.php', {
                    id: id,
                    type: type
                },
                function(result) {
                    //get success/error message from adding exercise category
                    editCategoryModalMessage.html(result);
                    //update the printed list of categories
                    printCategories();
                }
            );
        }
    });

	//DELETE EXERCISE CATEGORY -------------------------------------------------
    //When the delete button is pressed for an exercise category
    $('#exercise-list').on('submit', '.deleteCategory', function(e) {
        e.preventDefault();
        let id = $(this).find('input[name="id"]').val();
        const deleteCategory = confirm("Are you sure you want to delete this?");
        //if user confirms that they want to delete the exercise category
        if (deleteCategory) {
            $.post(
                '../Controllers/exercises/deleteCategory.php', {
                    id: id
                },
                function(result) {
                    //get success/error message from adding exercise category
                    $('#message').html(result);
                    //update the printed list of categories
                    printCategories();
                }
            );
        }

    });

	//END OF EXERCISE CATEGORIES-------------------------------------------------

    //EXERCISES ----------------------------------------------------------------

    //CREATE EXERCISE ----------------------------------------------------------
    $('#addExerciseForm').submit(function(e) {
        e.preventDefault();
		//values from add exercise form
        const name = $(this).find('input[name="name"]').val();
        const description = $('#addEDescription').val();
        const category = $(this).find('select[name="category"]').val();

		//container for add exercise form message
		const addExerciseModalMessage = $('#addExerciseForm').find('.form-message');

		const errorMessage = validateExerciseForm(name, description, category);

        if (errorMessage !== "") {
            //if values are not valid, displays error message in the modal
            addExerciseModalMessage.html(errorMessage);
        } else {
            $.post(
                '../Controllers/exercises/addExercise.php', {
                    name: name,
                    description: description,
                    category: category
                },
                function(result) {
                    //get success/error message from adding exercise
                    addExerciseModalMessage.html(result);
                    //update the printed list of exercises
                    printExercisesByCategory(category);
                }
            );
        }
    });

	//READ EXERCISE ------------------------------------------------------------
    //When exercise is clicked, print the details of the exercise
    $('#exercise-list').on('submit', '.getExercise', function(e) {
        e.preventDefault();
		$('#message').html("");
        let id = $(this).find('input[name="id"]').val();
        $.post(
            '../Controllers/exercises/exerciseDetails.php', {
                id: id
            },
            function(result) {
                $('#exercise-list').html(result);
            }
        );
    });

	//EDIT EXERCISE ------------------------------------------------------------
    //When user clicks on the edit button of an exercise, displays the edit exercise modal
    $('#exercise-list').on('submit', '.editExercise', function(e) {
        e.preventDefault();

		//values of the exercise
        let id = $(this).find('input[name="id"]').val();
        let name = $(this).find('input[name="name"]').val();
        let description = $(this).find('input[name="description"]').val();
        let category = $(this).find('input[name="category"]').val();

        $.post(
            '../Controllers/exercises/getExercise.php', {
                id: id,
                name: name,
                description: description,
                category: category
            },
            function(result) {
				//gets edit exercise modal
                $('#editExerciseModalContent').html(result);
            }
        );
    });

    //When user presses save on the edit exercise modal
    $('#editExerciseModal').on('submit', '#editExerciseForm', function(e) {
        e.preventDefault();

		//gets value from the edit exercise form
        let id = $(this).find('input[name="id"]').val();
        let name = $(this).find('input[name="name"]').val();
        let description = $(this).find('.editEDescription').val();
        let category = $(this).find('select[name="category"]').val();

		//container for edit exercise modal message
		const editExerciseModalMessage = $('#editExerciseForm').find('.form-message');

		const errorMessage = validateExerciseForm(name, description, category);

        if (errorMessage !== "") {
			editExerciseModalMessage.html(errorMessage);
        } else {
            $.post(
                '../Controllers/exercises/editExercise.php', {
                    id: id,
                    name: name,
                    description: description,
                    category: category
                },
                function(result) {
                    //get success/error message from adding exercise
                    editExerciseModalMessage.html(result);
                    //update the printed list of exercises of the category
                    printExercisesByCategory(category);
                }
            );
        }
    });

	//DELETE EXERCISE ----------------------------------------------------------
    //When the user clicks on the delete button of an exercise
    $('#exercise-list').on('submit', '.deleteExercise', function(e) {
        e.preventDefault();

		//values of the exercise to be deleted
        let id = $(this).find('input[name="id"]').val();
        let category = $(this).find('input[name="category"]').val();

		const deleteExercise = confirm("Are you sure you want to delete this?");
        //if user confirms that they want to delete the exercise
        if (deleteExercise){
            $.post(
                '../Controllers/exercises/deleteExercise.php', {
                    id: id
                },
                function(result) {
                    //get success/error message from adding exercise category
                    $('#message').html(result);
                    //update the printed list of categories
                    printExercisesByCategory(category);
                }
            );
        }

    });
    // END OF EXERCISES --------------------------------------------------------
});
