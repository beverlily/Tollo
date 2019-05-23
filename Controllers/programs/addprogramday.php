<?php 
  $title = 'Add Program Day';
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
  $pid = $_POST['id'];
  $pro = new Program();
  $program = $pro->getProgrambyId($pid,$dbcon);

  if(isset($_POST['saveDay'])) {
    $day_name = $_POST['dayName'];
    $num_ex = $_POST['numEx'];
    $id = $_POST['id'];

    if(($day_name == "") || ($num_ex == "")) {
      $err = 'Please fill in all fields';
    } else {
      $new_day = $pro->addDay($day_name,$id,$dbcon);

      for ($i = 0; $i < $num_ex; $i++) {
        ${'ex' . $i} = $_POST['exercise_id' . $i];
        ${'sets' . $i} = $_POST['numSets' . $i];
        ${'reps' . $i} = $_POST['numReps' . $i];
        ${'ndx' . $i} =   $pro->addExercisesToDays($new_day,
                                ${'ex' . $i},
                                $i,
                                ${'sets' . $i},
                                ${'reps' . $i},
                                $dbcon);
      }

      echo '<div class="alert alert-success" role="alert">Success! The day has been added!</div>';
    }


  }
?>
<main id="mainContent">
    <div class="pageWrapper wrapper">
      <h1>Add a Day to an Existing Program</h1>
      <?php
            if(isset($err)) {
                echo '<div class="alert alert-danger">'.$err.'</div>';
            }
        ?>
      <form method="post">
      <input type="hidden" name="id" value="<?php echo $pid; ?>" /> 
        <div class="card bg-light" style="max-width: 18rem;">
          <div class="card-header">Day Name: 
            <input type="text" name="dayName" class="form-control" />
          </div>
          <div class="card-body">
            How many exercises? 
            <input type="number" name="numEx" id="n_Ex" class="form-control" placeholder="1" />
          </div>
        </div>
        
        <div id="exBox" class="card bg-light" style="max-width: 18rem;"></div>
        <input type="submit" name="saveDay" id="saveDay" class="btn btn-success col-sm-3" value="Save" />
      </form>
    </div>
</main>

<script src="<?= SCRIPTPATH ?>adddays.js"></script>

<?php
        include '../../footer.php';
?>