<?php
require_once '../vendor/autoload.php';
use App\Database;
use App\Log;

$dbcon = Database::getDb();
$l = new Log();
$opts = "";

$exid = $_POST['id'];

$logs = $l->getLogsbyExercise($exid,$dbcon);

$data = json_encode($logs);

echo $data;

?>