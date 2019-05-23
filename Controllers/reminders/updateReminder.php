<?php
$title = 'Edit Reminder';
$style = 'profile.css';
include '../../header.php';

require_once '../../vendor/autoload.php';
use App\Database;
use App\Reminder;

$error = "";
$title = $date = $time = "";

//Get data from ID
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $db = Database::getDb();
    $r = new Reminder();
    $rem = $r->getReminderById($id, $db);

    $title = $rem->title;
    $date = $rem->date;
    $time = $rem->time;
}

if (isset($_SESSION['id'])) $userId = $_SESSION['id'];
//Update

//if (isset($_SESSION['id']) && isset($_POST['flag'])) {
// $userId = $_SESSION['id'];
//$flag   = $_POST['flag'];

//if ($flag == 'edit') {
if (isset($_POST['updateRem'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    //Validation
    if (empty($title) || empty($date) || empty($time)) {
        $error .= 'All fields are required';
    } else {
        $db = Database::getDb();
        $r = new Reminder();
        $u = $r->updateReminder($userId, $id, $title, $date, $time, $db);

        if ($u) {
            //header("Location: profile.php");
        } else {
            echo "error";
        }
    }
}


?>
<h2 id='editTitle'>Edit Reminder</h2>
<form action='' method='post' class='form-horizontal' id='updateRemForm'>
    <input type='hidden' name='id' value='<?= $id; ?>'>
    <div class='form-group'>
        <label for='remTitle'>Title</label>
        <input type='text' class='form-control' name='title' id='remTitle' value='<?= $rem->title; ?>'>
        <span style="color:red;">
    </div>
    <div class='row'>
        <div class='col-sm-10'>
            <label for='remDate'>Date</label>
            <input type='date' class='form-control' name='date' id='remDate' value='<?= $rem->date; ?>'>

        </div>
        <div class='col'>
            <label for='remTime'>Time</label>
            <input type='time' class='form-control' name='time' id='remTime' value='<?= $rem->time; ?>'>

        </div>
    </div>

    <input type='submit' name='updateRem' class='btn btn-primary' value='Update' />
    <div class='form-message'><span style="color:red;"><?php
                                                        echo $error;
                                                        ?></span><br /></div>
</form>


<?php
include '../../footer.php';
?>