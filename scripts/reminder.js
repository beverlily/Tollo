function listReminder() {

    $.post(
        '../Controllers/reminders/listReminder.php', {
            flag: "list"
        },
        function (r) {
            $('#listRemContainer').html(r);
        }
    )
}
listReminder();

$(document).ready(function () {
    $('#addRemindersForm').on('submit', function (e) {
        e.preventDefault();
        let title = $(this).find('input[name="title"]').val();
        let date = $(this).find('input[name="date"]').val();
        let time = $(this).find('input[name="time"]').val();

        //validation

        //get fields
        let titleIn = document.getElementById('remTitle');
        let dateIn = document.getElementById('remDate');
        let timeIn = document.getElementById('remTime');

        if (title === "") {
            titleIn.style.borderColor = "red";
        }
        if (date === "") {
            dateIn.style.borderColor = "red";
        }
        if (time === "") {
            timeIn.style.borderColor = "red";
        }

        $.post(
            '../Controllers/reminders/addReminder.php', {
                flag: "add",
                title: title,
                date: date,
                time: time
            },
            function (result) {
                // //get success/error message from adding exercise category
                $('#errorMsg').html(result);
                listReminder();


            }
        )

    });
    $('#listRemContainer').on('submit', '.deleteReminder', function (e) {
        e.preventDefault();
        let id = $(this).find('input[name="id"]').val();
        $.post(
            '../Controllers/reminders/deleteReminder.php', {
                id: id,
                flag: "delete"
            },
            function (result) {
                // //get success/error message from adding exercise category
                $('#errorMsg').html(result); //add div
                listReminder();


            }
        )

    });
    // $('#updateRemForm').on('submit', function (e) {
    //     e.preventDefault();
    //     alert('1');
    //     let id = $(this).find('input[name="id"]').val();
    //     let title = $(this).find('input[name="title"]').val();
    //     let date = $(this).find('input[name="date"]').val();
    //     let time = $(this).find('input[name="time"]').val();
    //     $.post(

    //         '../Controllers/reminders/updateReminder.php', {
    //             id: id,
    //             title: title,
    //             date: date,
    //             time: time,
    //             flag: "edit"
    //         },
    //         function (result) {
    //             alert('3');
    //             // //get success/error message from adding exercise category
    //             $('#errorMsg').html(result); //add div
    //             listReminder();



    //         }
    //     )

    // });
});