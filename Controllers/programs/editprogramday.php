<?php 
  $title = 'Edit Program Day';
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
  $day_id = $_POST['id'];
  $pro = new Program();
  $exers = new Exercise();
  $day = $pro->getDayInfobyId($day_id,$dbcon);
  $exercises = $pro->getDxEDetailsByDayId($day_id,$dbcon);
  $options = $exers->getAllExercises($dbcon);
  $row = '';

  if(isset($_POST['saveDay'])){
    $did = $_POST['dayid'];
    $numex = $_POST['numex'];
    
    if(($numex == "") || (!is_numeric($numex))) {
      $err = "Please fill in all fields and use only numbers";
    } else {
      for ($i = 0; $i < $numex; $i++){
        $pivid = $_POST['dxeid'.$i];
        $ex = $_POST['exercise_id'.$i];
        $sets = $_POST['numSets'.$i];
        $reps = $_POST['numReps'.$i];
        $update = $pro->updateDxE($pivid,$ex,$sets,$reps,$dbcon);
      }
      header('Location: ../../Views/error.php');
    }
  }

?>

<main id="mainContent">
    <div class="pageWrapper wrapper">
    <h1><?php 
          if(!isset($day)) {
            echo 'Sorry, something went wrong.';
          } else {
            echo $day[0]->name;
          }
        ?></h1>

        <?php
            if(isset($err)) {
                echo '<div class="alert alert-danger">'.$err.'</div>';
            }
        ?>

      <form method="post">
      <div class="text-right mar">
      <input type="submit" name="saveDay" id="saveDay" class="btn btn-success col-sm-3" value="Save Changes" />
      </div>
      <div class="card">
        <input type="hidden" name="dayid" value="<?php echo $day_id; ?>" /> 
        <input type="hidden" name="numex" value="<?php echo count($exercises); ?>" />
        <div class="card-header">Day Name: 
              <input type="text" name="dayName" class="form-control" value="<?php echo $day[0]->name;?>" />
        </div>
        <?php
          foreach ($exercises as $index => $ex) {
            $row = '<input type="hidden" name="dxeid'.$index.'" value="'.$ex->dxeid.'" /> 
            <ul class="list-group list-group-flush mar">
            <li class="list-group-item bg-info">
              <select class="form-control" name="exercise_id'.$index.'">';
              foreach ($options as $o) {
                $is = "";
                if ($o->id == $ex->ex_id) {
                  $is = ' selected';
                }
                $row .= "<option value='" . $o->id . "'" . $is .">" . $o->name . "</option>";
              }
            $row .= '</select></li>
            <li class="list-group-item">
            Sets: <input type="number" name="numSets'.$index.'" id="n_Sets'.$index.'" class="exers form-control" value="'.$ex->sets.'" />
            </li>
            <li class="list-group-item">
            Reps: <input type="number" name="numReps'.$index.'" id="n_Reps'.$index.'" class="exers form-control" value="'.$ex->reps.'" />
            </li>
            </ul>';
            echo $row;
          }
        ?>
    </div>
    </form>
    </div>
</main>

<?php
        include '../../footer.php';
?>
