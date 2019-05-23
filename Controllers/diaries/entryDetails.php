<?php
require_once '../../vendor/autoload.php';
  use App\Database;
  use App\Diary;

  //Instantiate an instance of our db
  $db = Database::getDb();
  $id = $_POST['id'];
  //Instantiate an instance of our diary class
  $d = new Diary();
  //Run our query to get the specific diary entry
  $entry = $d->getEntryById($id, $db);
  include '../../Views/diarydetails.php';