<?php 
  $title = 'Add Exercise to Day';
  $style = 'workouts.css';
  include '../../header.php';

  if(!isset($_SESSION['id'])) {
    header('Location: ../../Views/dashboard.php');
  }

  require_once '../../vendor/autoload.php';
  use App\Database;
  use App\Exercise;
  use App\Program;

  $dbcon = Database::getDb();
  $day_id = $_POST['id'];
  $pro = new Program();
  $exers = new Exercise();
  $day = $pro->getDayInfobyId($day_id,$dbcon);
  $exercises = $pro->getDxEDetailsByDayId($day_id,$dbcon);
  $options = $exers->getAllExercises($dbcon);
  $row = '';

  if(isset($_POST['addex'])) {
    $did = $_POST['dayid'];
    $ex = $_POST['exercise_id'];
    $sets = $_POST['numSets'];
    $reps = $_POST['numReps'];

    if(($ex == "") || ($sets == "") || ($reps == "")) {
      $err = 'Please enter an amount of exercises.';
    } elseif((!is_numeric($ex)) || (!is_numeric($sets)) || !is_numeric($reps)) {
      $err = 'Please enter only numbers.';
    } else {
      //get highest sequence #
      $sequence = array();
      foreach ($exercises as $e) {
          $seq = $e->sequence;
          $seqint = (int) $seq;
          $sequence[] .= $seqint;
      }
      $max = max($sequence);
      $seq = $max+1;

      $count = $pro->addExercisesToDays($did,$ex,$seq,$sets,$reps,$dbcon);
      echo '<div class="alert alert-success" role="alert">Success! Your exercise has been added!</div>';
    }
  }
?>

<main id="mainContent">
    <div class="pageWrapper wrapper">
    <h1>Add an Exercise</h1>
      <?php
            if(isset($err)) {
                echo '<div class="alert alert-danger">'.$err.'</div>';
            }
        ?>
    <form method="POST">
        <input type="hidden" name="dayid" value="<?php echo $day_id; ?>" />
        <select class="form-control" name="exercise_id">
        <?php
            foreach ($options as $o) {
            $row .= "<option value='" . $o->id . "'>" . $o->name . "</option>";
            }
            $row .= '</select>';
            echo $row;
        ?>
        </select>
        Sets: <input type="number" name="numSets" id="n_Sets" class="exers form-control" placeholder="1" />
        Reps: <input type="number" name="numReps" id="n_Reps" class="exers form-control" placeholder="1" /> 
        <input type="submit" name="addex" id="addex" class="btn btn-success col-sm-3 mar" value="Add" />
    </form>
    </div>
</main>
<?php
        include '../../footer.php';
?>