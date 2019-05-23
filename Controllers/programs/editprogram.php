<?php 
  $title = 'Edit Program';
  $style = 'workouts.css';
  include '../../header.php';

  require_once '../../vendor/autoload.php';
  use App\Database;
  use App\Exercise;
  use App\Program;

  if(!isset($_SESSION['id'])) {
    header('Location: ../Views/dashboard.php');
  }

  $dbcon = Database::getDb();
  $pid = $_POST['id'];
  $pro = new Program();
  $program = $pro->getProgrambyId($pid,$dbcon);


  if (isset($_POST['saveChanges'])) {
    $pid = $_POST['id'];
    $name = $_POST['progName'];
    $desc = $_POST['progDesc'];

    if(($name == "") || ($desc == "")) {
      $err = 'Please fill in all fields';
    } else {
      $program = $pro->getProgrambyId($pid,$dbcon);
      $query = $pro->updateProgramDetails($pid,$name,$desc,$dbcon);
      if($query) {
          echo '<div class="alert alert-success" role="alert">Success! Your program information has been updated!</div>';
      } else {
          $errorMessage = "We have experienced a problem. Please reach out to support!";
          header('Location: ../Views/error.php');
      }
    }

}
?>
<main id="mainContent">
   <div class="pageWrapper wrapper">

   <h1>Edit <?php 
          if(!isset($program)) {
            echo 'Sorry, something went wrong.';
          } else {
            echo $program[0]->name;
          }
        ?></h1>
        <?php
            if(isset($err)) {
                echo '<div class="alert alert-danger">'.$err.'</div>';
            }
        ?>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $pid; ?>" />
        <label for="name">Name of Program:</label>
        <input type="text" name="progName" id="pName" class="form-control col-sm-3" value="<?php echo $program[0]->name; ?>" />
        <label for="name">Description:</label>
        <input type="text" name="progDesc" id="pName" class="form-control col-sm-6" value="<?php echo $program[0]->description; ?>" />
        <input type="submit" name="saveChanges" id="saveChanges" class="btn btn-success col-sm-3 mar" value="Save Changes" />
    </form>

    </div>
</main>
<?php
        include '../../footer.php';
?>