<?php
$title = 'Delete Review';
$style = 'review.css';
require_once '../../vendor/autoload.php';
use App\Database;
use App\Review;

//Instantiate db
$db = Database::getDb();

//Get the id of the review we want to delete 
if(isset($_POST['id']))
{
    //Set id to post value, instantiate our review class and run query
    $id = $_POST['id'];
    $r = new Review();
    $count = $r->deleteReview($id, $db);

    //If query is successful redirect users to public reviews page
    if($count)
    {
        header('Location: ../../Views/reviews/publicReviews.php');
    }
    else
    {
        
    }
}
?>