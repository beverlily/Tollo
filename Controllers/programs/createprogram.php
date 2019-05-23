<?php
$title = 'Create a Program';
$style = 'workouts.css';
include '../../header.php';

require_once '../../vendor/autoload.php';
use App\Database;
use App\Exercise;
use App\Program;

if(!isset($_SESSION['id'])) {
    header('Location: ../../Views/dashboard.php');
}

$dbcon = Database::getDb();
$ex = new Exercise();
$pro = new Program();
$myexers = $ex->getAllExercises($dbcon);
$opts = '';

if(isset($_POST['saveProgram'])) {
    // add program name
    $pro_name = $_POST['progName'];
    $pro_desc = $_POST['progDesc'];
    $pro_auth = $_SESSION['id'];

    if(($pro_name == "") || ($pro_desc == "")) {
        $err = 'Please fill in all fields';
    } else {
        $np = $pro->addNewProgram($pro_name,$pro_auth,$pro_desc,$dbcon);
        $day_num = $_POST['numDays'];

        if (($day_num == "") || (!is_numeric($day_num))) {
            $err = 'Please fill in all fields';
        } else {
            // for each day enumerated, add to the days table
            $total_days = array();

            for ($i = 1; $i <= $day_num; $i++) {
                ${'day' . $i} = $_POST['dayName' . $i];
                ${'nd' . $i} = $pro->addDay(${'day' . $i},$np,$dbcon);
                $total_days[] .= ${'nd' . $i};
            }

            if($total_days == "") {
                $err = 'Please fill in all fields';
            } else {
                // for each day, add the exercises and rep schema
            foreach ($total_days as $index => $did) { // Day # => day_id
                // get number of exercises for the day
                $fixnum = $index+1; // if fixnum is 1, it points to the 0 index
                $num_ex = $_POST['numEx'.$fixnum]; // i.e. numEx1 for Day 1 exercises numbers, etc.
        
                for ($i = 0; $i < $num_ex; $i++) {
                    ${'ex' . $fixnum . $i} = $_POST['exercise_id' . $fixnum . $i];
                    ${'sets' . $fixnum . $i} = $_POST['numSets'. $fixnum . $i];
                    ${'reps' . $fixnum . $i} = $_POST['numReps' . $fixnum . $i];
                    ${'ndx' . $fixnum . $i} =   $pro->addExercisesToDays($did,
                                                ${'ex' . $fixnum . $i},
                                                $i,
                                                ${'sets' . $fixnum . $i},
                                                ${'reps' . $fixnum . $i},
                                                $dbcon);
                }
            }  
        }
    }   
    }
    echo '<div class="alert alert-success" role="alert">Success! Your program has been created!</div>';
}
?>

<main id="mainContent">
    <div class="pageWrapper wrapper">
        <h1>Create a New Program</h1>
        <p><a href="../../Views/workouts.php">Back to Workouts</a></p>

        <?php
            if(isset($err)) {
                echo '<div class="alert alert-danger">'.$err.'</div>';
            }
        ?>

        <p>First, define how many days there are in the program, and then add as many exercises as you need to each day!</p>

        <form action="" method="POST">
        <!-- name program, add to programs table -->
        <div id="programForm" class="container">
            <label for="name">Name of Program:</label>
            <input type="text" name="progName" id="pName" class="form-control col-sm-3" />
            <label for="name">Description:</label>
            <input type="text" name="progDesc" id="pName" class="form-control col-sm-6" />
            <label for="days">Days:</label>
            <input type="number" name="numDays" id="n_Days" class="form-control col-sm-3" placeholder="0" />
        </div>
        <!-- set number of days and name days and save to days -->

        <div id="dayBox" class="card-deck">

        </div>
        <!-- add exercises to days, save to days_exercises -->

        <div id="exBox" class="card-deck">
        
        </div>
        <!-- save everything -->
        <input type="submit" name="saveProgram" id="saveProgram" class="btn btn-success col-sm-3" value="Save This Program" />
        </form>
    </div>
</main>

<script src="<?= SCRIPTPATH ?>program.js"></script>

<?php
        include '../../footer.php';
?>
