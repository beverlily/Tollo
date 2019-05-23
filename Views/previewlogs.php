<?php
require_once '../vendor/autoload.php';
use App\Database;
use App\Exercise;
use App\Log;

$userid = $_SESSION['id'];
$dbcon = Database::getDb();
$tl = new Log();
$mydates = $tl->getRecentLogDates($userid,$dbcon);
$table = '';
$row = '';
?>

<?php
if(isset($_SESSION['id'])) {
    echo '<p class="logPrompt"><a href="../Controllers/logs/logworkout.php">Log a Workout</a></p>';
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
            </tr>';
            $table .= $row;
        }
        $table .= '</tbody></table>';
        echo $table;
    }
    echo '<p class="listAllPrompt"><a href="../Views/logs.php">List All Training Logs</a></p>';
} else {
    echo '<a href="../Views/dashboard.php"><strong>You have no logs to show. Create an account today!</strong>';
}
?>

