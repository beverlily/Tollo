<?php
session_start();
$title = 'Review Update';
$style = 'review.css';
require_once '../../vendor/autoload.php';
use App\Database;
use App\Review;

//Set our variables and instantiate our db
$_SESSION['ReviewErrorMessage'] = "";
$c = "";
$pattern = "/^[a-zA-Z0-9,.?!' ]*$/";
$db = Database::getDb();

//On form submission
if (isset($_POST['submit']))
{
    //Set our variables and instantiate our review class
    $id = $_POST['eid'];
    $rating = $_POST['rating'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $r = new Review();

    //Validation
    if($rating == "" || $title == "" || $content == "")
    {
        $_SESSION['ReviewErrorMessage'] = "All the fields must be filled out";
        header('Location: ../../Views/reviews/reviewUpdate.php');
    }
    //Validation
    elseif(!preg_match($pattern, $title) || !preg_match($pattern, $content))
    {
        $_SESSION['ReviewErrorMessage'] = "You are not allowed to use inappropriate symbols in your entry";
        header('Location: ../../Views/reviews/reviewUpdate.php');
    }
    //If validation is passed then run our query
    else
    {
        $c = $r->editReview($id, $rating, $title, $content, $db);
    }
    //If the query is successful then redirect the user to view his review page
    if($c)
    {
        header('Location: ../../Views/reviews/myReview.php');        
    }
    else
    {
        
    }

}
