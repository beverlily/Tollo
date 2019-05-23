function updateValidation() {
    //get fields
    let titleIn = document.getElementById('remTitle');
    let dateIn = document.getElementById('remDate');
    let timeIn = document.getElementById('remTime');

    if (titleIn.value === "") {
        titleIn.style.borderColor = "red";
    }
    if (dateIn.value === "") {
        dateIn.style.borderColor = "red";
    }
    if (timeIn.value === "") {
        timeIn.style.borderColor = "red";
    }
}
updateValidation();