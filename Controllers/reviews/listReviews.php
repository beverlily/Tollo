<?php
//Start our session
// session_start();
require_once '../../vendor/autoload.php';
use App\Database;
use App\Review;

//Instantiate db, review class and get our user id
$db = Database::getDb();
$r = new Review();
$userid = $_SESSION['id'];

//Run query to get specific users review
$item = $r->getUserReview($userid, $db);
