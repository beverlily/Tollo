<?php 
  $title = 'Program Details';
  $style = 'workouts.css';
  include '../header.php';

  require_once '../vendor/autoload.php';
  use App\Database;
  use App\Exercise;
  use App\Program;

  $dbcon = Database::getDb();
  if(isset($_SESSION['id'])) {
    $userid = $_SESSION['id'];
  }
  $pid = $_GET['id'];
  $pro = new Program();
  $program = $pro->getProgrambyId($pid,$dbcon);
  $days = $pro->getDaysbyId($pid,$dbcon);
  $author = $pro->getProgramAuthor($program[0]->authorid,$dbcon);
  $pro_auth = $pro->findAuthorofProgram($pid,$dbcon);
  $is_sub = $pro->isUserSubscribedToThisProgram($userid,$pid,$dbcon);
  $card = '';
  $row = '';
?>

<main id="mainContent">
   <div class="pageWrapper wrapper">

   
   <?php
    if(isset($_POST['alert'])) {
      $warning = '<div class="alert alert-danger" role="alert">
      <p>Are you sure you want to delete this program? This cannot be undone.</p>
      <form method="post" action="../Controllers/programs/deleteprogram.php">
      <input type="hidden" name="id" value="'.$pid.'" />
      <input class="btn btn-danger" name="delete" type="submit" value="Yes, delete it" />
      </form>
      </div>';

      echo $warning;
    }
   ?>
        <h1><?php 
          if(!isset($program)) {
            echo 'Sorry, something went wrong.';
          } else {
            echo $program[0]->name;
          }
        ?></h1>
        <p>uploaded by <?php echo $author[0]->username; ?>

        <?php 
          if(isset($_SESSION['id'])) {
            $sub = "";

            if($is_sub == true) {
              $sub =  '<input type="submit" class="btn btn-success col-sm-3 float-right mar" value="Subcribed" />';
      
            } else {
              $sub = '<form method="post" action="../Controllers/programs/subscribe.php">
              <input type="hidden" name="id" value="'.$pid.'" />
              <input class="btn btn-info mar float-right" name="subscribe" type="submit" value="Click here to subscribe" />
              </form>
            ';
            }
      
            echo $sub;
          }
          ?>
            <p><a href="javascript:history.go(-1)">Go back</a></p>
            <p><?php echo $program[0]->description; ?></p>
          <?php 
          if(isset($_SESSION['id'])) {
            if($userid == $program[0]->authorid) {
            echo '
            <div class="container">

            <!--ADD A DAY-->
            <form method="post" action="../Controllers/programs/addprogramday.php"> 
            <input type="hidden" name="id" value="'. $pid .'" />
            <input class="btn btn-primary col-sm-3 mar" type="submit" value="Add Day" />
            </form>

            <!--EDIT NAME AND DESCRIPTION-->
            <form method="post" action="../Controllers/programs/editprogram.php">
            <input type="hidden" name="id" value="'. $pid .'" /> 
            <input class="btn btn-warning col-sm-3 mar" name="editprogram" type="submit" value="Edit Program" />
            </form>

            <!--DELETE-->
            <form method="post"> 
            <input class="btn btn-danger col-sm-3 mar" name="alert" type="submit" value="Delete Program" />
            </form>
            
            </div>
            ';
          }
        }
        ?>


        <?php
            foreach ($days as $d) {
              $exercises = $pro->getDxEDetailsByDayId($d->id,$dbcon);

              $card = '<div class="card-group"><div class="workout card">
              <div class="card-body">
              <h5 class="card-title">' . $d->name . '</h5>';

              $row = '<ul class="list-group list-group-flush">';

              foreach ($exercises as $ex) {
                $row .= '<li class="list-group-item">' . $ex->exercise . ' ' . $ex->sets . 'x' . $ex->reps . '</li>';
              }
              $card .= $row;
              $card .= '</ul></div>';
              if(isset($_SESSION['id'])) {
                if($userid == $program[0]->authorid) {
                  $card .= '<div class="row align-self-center">
                  <form method="post" action="../Controllers/programs/addexercise.php"> 
                  <input type="hidden" name="id" value="'.$d->id.'" />
                  <input class="btn btn-primary mar" type="submit" name="addDay" value="Add an Exercise" />
                  </form>
                  <form method="post" action="../Controllers/programs/editprogramday.php"> 
                  <input type="hidden" name="id" value="'.$d->id.'" />
                  <input class="btn btn-secondary mar" type="submit" name="editDay" value="Edit" />
                  </form>
                  <form method="post" action="../Controllers/programs/deleteprogramday.php"> 
                  <input type="hidden" name="id" value="'.$d->id.'" />
                  <input class="btn btn-danger mar" type="submit" name="deleteDay" value="Delete" />
                  </form>
                  </div>';
                }
              }
              $card .= '</div></div>';

              echo $card;
            }

        ?>
    </div>
</main>
<?php
        include '../footer.php';
?>
