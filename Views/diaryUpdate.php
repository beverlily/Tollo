<?php
$title = 'Diary Update';
$style = 'diary.css';
include '../header.php';
require_once '../vendor/autoload.php';
use App\Database;
use App\Diary;

//Instantiate db and variables
$db = Database::getDb();
$c = $title = $date = $content = "";

//To get our field data
if(isset($_POST['id']))
{
    $id = $_POST['id'];
    $d = new Diary();
    $entry = $d->getEntryById($id, $db);

    $title = $entry->title;
    $date = $entry->date;
    $content = $entry->content;
}
?>

<main id="mainContent">
<div class="pageWrapper">
    <form method="post" action="../Controllers/diaries/updateEntry.php">
        <div id="formBox">
            <h1>Update Diary Entry</h1>
            <input type="hidden" name="eid" value="<?= $id; ?>">
            <div><label>Title:</label></div>
            <input type="text" class="formFields" name="title" value="<?= $title ?>"/>
            <div><label>Date:</label></div>
            <input type="date" class="formFields" name="date" value="<?= $date ?>">
            <div><label>Text:</label></div>
            <textarea class="formFields" id="textArea" name="content" wrap="soft"><?= $content ?></textarea>                 
            <div><button type="submit" id="submitBtn" name="submit">Submit Entry</div>
            <div id="errMsg"><?=$_SESSION['DiaryErrorMessage']?></div>        
        </div>
    </form>
</div>
</main>

<?php
        $_SESSION['DiaryErrorMessage'] = "";
        include '../footer.php';
?>
