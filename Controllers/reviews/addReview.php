<?php
//Start our session
session_start();
require_once '../../vendor/autoload.php';
use App\Database;
use App\Review;

//set variables and instantiate db
$_SESSION['ReviewErrorMessage'] = "";
$db = Database::getDb();
$c = "";
$pattern = "/^[a-zA-Z0-9,.?!' ]*$/";

//On submission
if (isset($_POST['submit']))
{
    //Set variables, instantiate review class
    $rating = $_POST['rating'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $id = $_SESSION['id'];
    $r = new Review();

    //Validation
    if($rating == "" || $title == "" || $content == "")
    {
        $_SESSION['ReviewErrorMessage'] = "All the fields must be filled out";
        header('Location: ../../Views/reviews/reviewentry.php');
    }
    //Validation
    elseif(!preg_match($pattern, $title) || !preg_match($pattern, $content))
    {
        $_SESSION['ReviewErrorMessage'] = "You are not allowed to use inappropriate symbols in your entry";
        header('Location: ../../Views/reviews/reviewentry.php');
    }
    //If validation is passed, then run our query
    else
    {
        $c = $r->addReview($rating, $title, $content, $id, $db);
    }
    //If the query is successful redirect the user to his review page
    if($c)
    {
        header('Location: /project-no-tears/Views/reviews/myReview.php');
        echo "Review added!";
    }
    else
    {
        echo "Error adding review";
    }

}



