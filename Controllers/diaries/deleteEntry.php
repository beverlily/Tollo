<?php
$title = 'Delete Entry';
$style = 'diary.css';
require_once '../../vendor/autoload.php';
use App\Database;
use App\Diary;

//Instantiate db
$db = Database::getDb();

//Take the diary entry's id and use it to delete the entry
if(isset($_POST['id']))
{
    $id = $_POST['id'];
    //Instantiate new instance of diary class
    $d = new Diary();
    //Run our delete operation
    $count = $d->deleteDiaryEntry($id, $db);
    //If the query is successful redirect the user to the list of entries
    if($count)
    {
        header('Location: ../../Views/diarylist.php');
    }
    else
    {
        
    }
}


?>