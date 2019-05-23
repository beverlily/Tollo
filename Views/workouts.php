<?php 
  $title = 'Workouts';
  $style = 'workouts.css';
  include '../header.php';

  require_once '../vendor/autoload.php';
  use App\Database;
  use App\Exercise;
  use App\Program;
  if(isset($_SESSION['id'])) {
    $userid = $_SESSION['id'];
  }
  $dbcon = Database::getDb();
  $pro = new Program();
  $allpros = $pro->getDistinctPrograms($dbcon);
  
  $card = '';
  $row = '';
?>

<main id="mainContent">
   <div class="pageWrapper wrapper">
        <h1>Workout Programs</h1>
        <?php
          if(isset($_SESSION['id'])) {
            echo '<p><a href="../Controllers/programs/createprogram.php">Create a New Workout Program</a></p>';
          }
        ?>
<div class="card-deck card-columns">
<?php

  foreach ($allpros as $alp) {
    $proex = $pro->getThreeExercisesInProgram($alp->id,$dbcon);
    $proauth = $pro->getProgramAuthor($alp->authorid,$dbcon);
    
    $card = '<div class="card-group"><div class="workout card" style="width: 18rem;">
    <form method="GET" action="viewprogram.php">
    <div class="card-body">
      <h5 class="card-title"><a href="#">' . $alp->name . '</a></h5>
      <p class="card-text">' . $alp->description . '</p>
      <h6 class="card-subtitle mb-2 text-muted">Exercises:</h6>';
    
    foreach ($proex as $ex) {
      $row = '<a href="#" class="card-link">' . $ex->name . '</a>';
      $card .= $row;
    }

    $card .=  '<p class="card-text">Authored by ' . $proauth[0]->username . '</p>
    <input type="hidden" name="id" value="' . $alp->id . '" />
    <input type="submit" class="btn btn-primary" value="Program Details" />
    </div></div></form></div>';
    
    echo $card;
}
?> 
</div>           

<!--  Different card style. If we decide we want to allow users to upload images 
      to go with their programs, I would doctor this one.
          <div class="workout card" style="width: 18rem;">
            <img class="card-img-top workout-title-img" src="<?= IMGPATH ?>61ALLNS1B4L.png" alt="Card Image" />
            <div class="card-body">
              <h5 class="card-title"><a href="#">Texas Method</a></h5>
              <p class="card-text">Intermediate programming. The next step after Starting Strength.</p>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">Squats</li>
              <li class="list-group-item">Deadlifts</li>
              <li class="list-group-item">Bench Press</li>
            </ul>
            <div class="card-body">
              <p class="card-text">Similar programs:</p>
              <a href="#" class="card-link">Starting Strength</a>
              <a href="#" class="card-link">Stronglifts</a>
            </div>
          </div>
-->

  </div>
</main>
<?php
        include '../footer.php';
?>
