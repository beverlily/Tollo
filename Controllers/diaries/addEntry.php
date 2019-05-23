<?php
//Start our session - This is started in the header so this is not needed anymore
session_start();
require_once '../../vendor/autoload.php';
use App\Database;
use App\Diary;

$_SESSION['DiaryErrorMessage'] = "";

//Instantiate db
$db = Database::getDb();
$c = "";

//Regex pattern numbers, letters and select symbols allowed
$pattern = "/^[a-zA-Z0-9,.?!' ]*$/";

//When the user submits a diary entry
if (isset($_POST['submit']))
{
    //Set our variables to post variables
    $title = $_POST['title'];
    $date = $_POST['date'];
    $content = $_POST['content'];
    $id = $_SESSION['id'];

    //Instantiate new instance of diary class
    $d = new Diary();

    //If there are any unfilled fields return user to diary entry page
    if($title == "" || $date == "" || $content == "")
    {
        $_SESSION['DiaryErrorMessage'] = "All the fields must be filled out";
        header('Location: ../../Views/diaryentry.php');
    }
    //If the submission doesn't pass validation
    elseif(!preg_match($pattern, $title) || !preg_match($pattern, $content))
    {
        $_SESSION['DiaryErrorMessage'] = "You are not allowed to use symbols in your entry";
        header('Location: ../../Views/diaryentry.php');
    }
    //If everything validates correctly add diary entry into db
    else
    {
        $c = $d->addDiaryEntry($title, $date, $content, $id, $db);
    }
    //If the diary entry was successfully added redirect the user to the diary list
    if($c)
    {
        header('Location: /project-no-tears/Views/diarylist.php');
        echo "Diary entry added!";
    }
    else
    {
        echo "Error adding entry";
    }

}



