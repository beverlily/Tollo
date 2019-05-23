<?php
// This controller returns a list of all reviews for everyone to see
require_once '../../vendor/autoload.php';
use App\Database;
use App\Review;

//Instantiate db and review class
$db = Database::getDb();
$r = new Review();

//Run query to get all reviews
$item = $r->getReviews($db);

