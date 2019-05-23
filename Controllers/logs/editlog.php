<?php
$title = 'Edit Log';
$style = 'logs.css';
include '../../header.php';

if(!isset($_SESSION['id'])) {
    header('Location: ../Views/dashboard.php');
}

require_once '../../vendor/autoload.php';
use App\Database;
use App\Exercise;
use App\Log;

$dbcon = Database::getDb();
$tl = new Log();
$ex = new Exercise();
$lid = $_POST['id'];
$myexers = $ex->getAllExercises($dbcon);
$log = $tl->getLogById($lid,$dbcon);

$opts = '';

if(isset($_POST['updatelog'])) {
    $exercise = $_POST['exercise_id'];
    $sets = $_POST['numSets'];
    $reps = $_POST['numReps'];
    $weight = $_POST['numWeight'];

    //VALIDATION
    if(($sets == "") || ($reps == "") || ($weight == "")) {
        $err = 'Please fill in all fields';
    } elseif((!is_numeric($sets)) || (!is_numeric($reps)) || (!is_numeric($weight))) {
        $err = 'Please enter only numbers.';
    } else {
        
        $count = $tl->updateLog($lid,$exercise,$sets,$reps,$weight,$dbcon);

        if ($count) {
            echo '<div class="alert alert-success" role="alert">Success! Your workout has been updated!</div>';
            //header("Location: ../../Views/logs.php");
        } else {
            $err = "We have experienced a problem editing your workout. Please reach out to support!";
            //header("Location: ../../Views/error.php?error=".$err);
        }       
    }
}
?>

<main id="mainContent">
   <div class="pageWrapper wrapper">
        <h1>Edit Log</h1>
        <p><a href="../Views/logs.php">Back to Training Log</a></p>

        <?php
            if(isset($err)) {
                echo '<div class="alert alert-danger">'.$err.'</div>';
            }
        ?>

        <form action="<?= CONPATH ?>logs/updatelog.php" method="POST">
            <input type="hidden" name="lid" value="<?php echo $log->id; ?>" />
            <p>
            <label for="exercise">Exercise:</label>
                <select id="exercise" name="exercise_id" class="form-control col-sm-3">
                <?php
                    foreach ($myexers as $e) {
                        $sel = "";
                        if ($e->id == $log->exerciseid) {
                            $sel = " selected";
                        }
                        $opts .= "<option value='" . $e->id . "'" . $sel . ">" . $e->name . "</option>";
                    }
                    echo $opts;
                ?>
                </select>
            </p>
            <p>
                <label for="numSets">Number of Sets:</label>
                <input type="number" id="numSets" name="numSets" class="form-control col-sm-3" value="<?php echo $log->sets; ?>" />
            </p>
            <p>
                <label for="numReps">Number of Reps:</label>
                <input type="number" id="numReps" name="numReps" class="form-control col-sm-3" value="<?php echo $log->reps; ?>" />
            </p>
            <p>
                <label for="numWeight">Weight Lifted:</label>
                <input type="number" id="numWeight" name="numWeight" class="form-control col-sm-3" value="<?php echo $log->weight; ?>" />
            </p>
            <input type="submit" name="updatelog" class="btn btn-success col-sm-3" value="Update Log" />
</form>

    </div>
</main>

<?php
include '../../footer.php';
?>
