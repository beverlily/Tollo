<?php
session_start();
$title = 'Update Entry';
$style = 'diary.css';
require_once '../../vendor/autoload.php';
use App\Database;
use App\Diary;

//Set variables 
$_SESSION['DiaryErrorMessage'] = "";
$c = "";
$pattern = "/^[a-zA-Z0-9,.?!' ]*$/";

//Instantiate db
$db = Database::getDb();

//If the submit button is pressed
if (isset($_POST['submit']))
{
    //Set our variables to post variables
    $id = $_POST['eid'];
    $title = $_POST['title'];
    $date = $_POST['date'];
    $content = $_POST['content'];

    //Get our diary class ready
    $d = new Diary();

    //If there are any blank fields throw an error and redirect the user
    if($title == "" || $date == "" || $content == "")
    {
        $_SESSION['DiaryErrorMessage'] = "All the fields must be filled out";
        header('Location: ../../Views/diarylist.php');
    }
    //If the updated entry does not pass validation, throw an error and redirect the user
    elseif(!preg_match($pattern, $title) || !preg_match($pattern, $content))
    {
        $_SESSION['DiaryErrorMessage'] = "You are not allowed to use symbols in your entry";
        header('Location: ../../Views/diarylist.php');
    }
    //If everything is fine then update the entry in the database
    else
    {
        $c = $d->editDiaryEntry($id, $title, $date, $content, $db);
    }
    //If the update was successful, redirect the user to the list of entries
    if($c)
    {
        header('Location: ../../Views/diarylist.php');        
    }
    else
    {
        
    }

}
