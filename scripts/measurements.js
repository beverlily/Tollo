"use strict";
//list all measurements belonging to the user
function listMeasurements(message) {
    $.post(
        '../Controllers/measurementsController.php', {
            flag: "listMeasurements"
        },
        function(result) {
            $('#measurements-list').html(result);

        }
    );
}

// validates form values
function validateMeasurementForm(name, current, goal) {
    let errorMessage = "";
    if (!name) {
        errorMessage += "Please enter a measurement name. <br />";
    }
    if (current === "") {
        errorMessage += "Please enter your current measurement. <br />";
    } else if (isNaN(Number(current))) {
        errorMessage += "Current measurement must be a number <br />";
    }
    if (goal === "") {
        errorMessage += "Please enter your goal measurement. <br />";
    } else if (isNaN(Number(goal))) {
        errorMessage += "Current goal must be a number.";
    }
    return errorMessage;
}

$(document).ready(function() {
    //prints list of measurements belonging to the user
    listMeasurements();

    //When the add measurement button is clicked, displays the add measurement form
    $('#add-measurement-btn').click(function() {
        $('#add-measurement-btn').addClass("hidden"); //hides add measurement button
        $('#add-measurement-form').removeClass("hidden"); //shows measurement form
    });

    //if they press cancel, hides the add measurement form
    $('#cancel-add-btn').click(function() {
        $('#add-measurement-btn').removeClass("hidden"); //hides add measurement button
        $('#add-measurement-form').addClass("hidden"); //shows measurement form
        $("#measurement-message").html(""); //clears the status message
    });

    //When user adds a measurement (submits the add measurement form)
    $('#add-measurement-form').submit(function(e) {
        e.preventDefault();
        //grabs input from add measurements form
        const name = $(this).find('input[name="name"]').val();
        const current = $(this).find('input[name="current"]').val();
        const goal = $(this).find('input[name="goal"]').val();

        const errorMessage = validateMeasurementForm(name, current, goal);

        if (errorMessage !== "") {
            $("#measurement-message").html(errorMessage);
        } else {
            $.post(
                '../Controllers/measurementsController.php', {
                    //posts form values to controller and sends an ajax flag called "addMeasurement"
                    name: name,
                    current: current,
                    goal: goal,
                    flag: "addMeasurement"
                },
                result => {
                    //clears the form values
                    $(this).trigger("reset");

                    //prints the error/success message for adding measurements
                    $("#measurement-message").html(result);

                    //updates the list of measurements with the added measurement
                    listMeasurements();
                }
            );
        }
    });

    //When a user clicks the edit button
    $('#measurements-list').on('submit', '.edit-measurement', function(e) {
        e.preventDefault();
        //gets list of measurements
        const measurementList = $(this).closest('.list-group-item');

        //hides/shows measurement information and edit measurement form
        measurementList.find('.measurement-info').toggleClass("hidden");
        measurementList.find('.edit-measurement-form').toggleClass("hidden");

        //When the edit form is closed, clears all changes
        if (measurementList.find('.edit-measurement-form').hasClass("hidden")) {
            listMeasurements();
        }
    });


    //When the edit measurement form is submitted
    $('#measurements-list').on('submit', '.edit-measurement-form', function(e) {
        e.preventDefault();
        //gets values from
        const id = $(this).find('input[name="id"]').val();
        const name = $(this).find('input[name="name"]').val();
        const current = $(this).find('input[name="current"]').val();
        const goal = $(this).find('input[name="goal"]').val();

        const errorMessage = validateMeasurementForm(name, current, goal);

        if (errorMessage !== "") {
            $(this).find(".update-measurement-msg").html(errorMessage);
        } else {
            $.post(
                '../Controllers/measurementsController.php', {
                    //posts form values to controller and sends an ajax flag called "updateMeasurement"
                    id: id,
                    name: name,
                    current: current,
                    goal: goal,
                    flag: "updateMeasurement"
                },
                function() {
                    //reprints list of measurements with updated measurement
                    listMeasurements();
                }
            );
        }
    });

    //When the delete button is clicked
    $('#measurements-list').on('submit', '.delete-measurement', function(e) {
        e.preventDefault();
        const deleteMeasurement = confirm("Are you sure you want to delete this?");

        //if user confirms that they want to delete the measurement
        if (deleteMeasurement) {

            //gets values from
            const id = $(this).find('input[name="id"]').val();

            $.post(
                '../Controllers/measurementsController.php', {
                    //posts form values to controller and sends an ajax flag called "deleteMeasurement"
                    id: id,
                    flag: "deleteMeasurement"
                },
                function() {
                    //reprints list of measurements
                    listMeasurements();
                }
            );
        }

    });
});
