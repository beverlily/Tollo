<?php
require_once '../vendor/autoload.php';
use App\Database;
use App\Diary;

//Instantiate our db and diary class
$db = Database::getDb();
$d = new Diary();
$userid = $_SESSION['id'];

//Run query that gets all diary entries the user has
$item = $d->getAllEntries($userid, $db);
