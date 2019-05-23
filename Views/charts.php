<?php


// I could not get this to work, so I focused on giving users the ability to subscribe to workout programs instead. :)


  $title = 'Charts';
  //$style = 'TEMPLATE.css';   
  include '../header.php';

require_once '../vendor/autoload.php';
use App\Database;
use App\Exercise;
use App\Log;

if(!isset($_SESSION['id'])) {
  header('Location: ../Views/dashboard.php');
}

$dbcon = Database::getDb();
$ex = new Exercise();
$tl = new Log();
$myexers = $ex->getAllExercises($dbcon);
$opts = '';
?>

<main id="mainContent">
    <div class="pageWrapper">

        <h1>Graphing Your Progress</h1>

        <label for="exercise">Exercise:</label>
                <select id="exercise" name="exercise_id" class="form-control col-sm-3">
                <?php
                    $opts = "<option value='' selected disabled hidden>--Pick an Exercise--</option>";
                    foreach ($myexers as $ex) {
                        $opts .= "<option value='" . $ex->id . "'>" . $ex->name . "</option>";
                    }
                    echo $opts;
                ?>
        </select>
        
        <div id="tester" style="width:600px;height:250px;"></div>
    
    
    </div>

    <script src="<?= SCRIPTPATH ?>charts.js"></script>
</main>

<?php
        include '../footer.php';
?>