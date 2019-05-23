<?php //to-do: allow users to add any number of exercises in a given workout
$title = 'Log Your Workout';
$style = 'logs.css';
include '../../header.php';

require_once '../../vendor/autoload.php';
use App\Database;
use App\Exercise;
use App\Log;

if(!isset($_SESSION['id'])) {
    header('Location: ../../Views/dashboard.php');
}

$userid = $_SESSION['id'];
$dbcon = Database::getDb();
$ex = new Exercise();
$tl = new Log();
$myexers = $ex->getAllExercises($dbcon);
$opts = '';

if(isset($_POST['logEx'])){

    //$userid = $_POST['uid'];
    $userid = $_SESSION['id'];
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
        
        $l = $tl->addLog($exercise,$sets,$reps,$weight,$userid,$dbcon);
    
        if ($l) {
            echo '<div class="alert alert-success" role="alert">Success! Your workout has been logged!</div>';
            //header('Location: ../../Views/logs.php');
        } else {
            $err = "We have experienced a problem logging your workout. Please reach out to support!";
            //header("Location: ../../Views/error.php?error=".$err);
        }       
    }
}

?>

<main id="mainContent">
   <div class="pageWrapper wrapper">
        <h1>Log a Workout</h1>
        <p><a href="../../Views/logs.php">Back to Training Log</a></p>

        <?php
            if(isset($err)) {
                echo '<div class="alert alert-danger">'.$err.'</div>';
            }
        ?>

        <form action="#" method="POST">
            <p>
                <label for="exercise">Exercise:</label>
                <select id="exercise" name="exercise_id" class="form-control col-sm-3">
                <?php
                    foreach ($myexers as $ex) {
                        $opts .= "<option value='" . $ex->id . "'>" . $ex->name . "</option>";
                    }
                    echo $opts;
                ?>
                </select>
            </p>
            <p>
                <label for="numSets">Number of Sets:</label>
                <input type="number" id="numSets" class="form-control col-sm-3" name="numSets" />
            </p>
            <p>
                <label for="numReps">Number of Reps:</label>
                <input type="number" id="numReps" class="form-control col-sm-3" name="numReps" />
            </p>
            <p>
                <label for="numWeight">Weight:</label>
                <input type="number" id="numWeight" class="form-control col-sm-3" name="numWeight" />
            </p>
            <input class="btn btn-success col-sm-3" type="submit" name="logEx" value="Save" />
        </form>
    </div>
</main>
<?php
include '../../footer.php';
?>