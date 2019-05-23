<?php
require_once '../vendor/autoload.php';
use App\Database;
use App\Program;

$userid = $_SESSION['id'];
$dbcon = Database::getDb();
$pro = new Program();


$myprograms = $pro->getUserSubs($userid,$dbcon);

$card = '';
$row = '';
?>

<p class="logPrompt"><a href="workouts.php">Explore workout routines and programs</a></p>

<?php
if(isset($_SESSION['id'])) {
    foreach($myprograms as $myp) {
        $proex = $pro->getThreeExercisesInProgram($myp->id,$dbcon);
        $proauth = $pro->getProgramAuthor($myp->author,$dbcon);

        $card = '<div class="card-group">
        <div class="workout card" style="width: 18rem;">
            <form method="GET" action="viewprogram.php">
                <div class="card-body">
                    <h5 class="card-title"><a href="#">' . $myp->name . '</a></h5>
                    <p class="card-text">' . $myp->description . '</p>
                    <h6 class="card-subtitle mb-2 text-muted">Exercises:</h6>';
        
                    foreach ($proex as $ex) {
                        $row = '<a href="#" class="card-link">' . $ex->name . '</a>';
                        $card .= $row;
                    }
    
        $card .=  '<p class="card-text">Authored by ' . $proauth[0]->username . '</p>
                    <div class="row">
                        <input type="hidden" name="id" value="' . $myp->id . '" />
                        <input type="submit" class="btn btn-primary mar" value="Program Details" />
                        </form>
                       
                        <form method="post" action="../Controllers/programs/unsubscribe.php">
                        <input type="hidden" name="id" value="'.$myp->id.'" />
                        <input class="btn btn-dark mar" name="unsubscribe" type="submit" value="Unsubscribe" />
                        </form>
                    </div>
                </div> 
            </div>
        </div>';
        
        echo $card;
    }
}
?>
