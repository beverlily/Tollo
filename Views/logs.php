<?php
$title = 'Workout History';
$style = 'logs.css';
include '../header.php';

require_once '../vendor/autoload.php';
use App\Database;
use App\Exercise;
use App\Log;

if(!isset($_SESSION['id'])) {
    header('Location: ../Views/dashboard.php');
}

$userid = $_SESSION['id'];
$dbcon = Database::getDb();
$tl = new Log();
$mydates = $tl->getAllLogDates($userid,$dbcon);
$mylogs = $tl->getAllLogs($userid,$dbcon);
$table = '';
$row = '';
?>

<main id="mainContent">
   <div class="pageWrapper wrapper">
        <h1>Workout History</h1>
        <!--<p class="text-right"><a href="charts.php">View User Charts</a></p>-->
        <p><a href="../Controllers/logs/logworkout.php">Log a Workout</a></p>

        <?php
            //we want to show workouts organized by date, so get all distinct workout dates
            //and loop through result set
            foreach ($mydates as $d) {
                $tdata = $tl->getLogsByDate($d->date,$userid,$dbcon);
                
                $table = '<h5>Logged Workout from ' . $d->date . '</h5>
                <table class="table table-sm">
                <thead>
                    <tr>
                        <th scope="col">Exercise</th>
                        <th scope="col">Sets</th>
                        <th scope="col">Reps</th>
                        <th scope="col">Weight</th>
                        <th scope="col">Manage</th>
                    </tr>
                </thead>
                <tbody>';

                //there will be as many rows as there are rows in db for the date, so loop again
                foreach ($tdata as $tdl) {
                    $row = '<tr>
                    <td>' . $tdl->name . '</td>
                    <td>' . $tdl->sets . '</td>
                    <td>' . $tdl->reps . '</td>
                    <td>' . $tdl->weight . '</td>
                    <td>
                        <form action="../Controllers/logs/editlog.php" method="post">
                        <input type="hidden" name="id" value='. $tdl->id .'/>
                        <input type="submit" class="btn btn-primary manageRow" name="update" value="Update" />
                        </form>
                        <form action="../Controllers/logs/deletelog.php" method="post">
                        <input type="hidden" name="id" value='. $tdl->id .'/>
                        <input type="submit" class="btn btn-danger manageRow" name="delete" value="Delete" />
                        </form>
                    </td>
                    </tr>';
                    $table .= $row;
                }
                $table .= '</tbody></table>';
                echo $table;
            }
        ?>
    </div>
</main>
<?php
include '../footer.php';
?>
