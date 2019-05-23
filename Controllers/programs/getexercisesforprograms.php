<?php
require_once '../../vendor/autoload.php';
use App\Database;
use App\Exercise;

$dbcon = Database::getDb();
$ex = new Exercise();
$opts = "";

$exercises = $ex->getAllExercises($dbcon);

foreach ($exercises as $e) {
    $opts .= "<option value='" . $e->id . "'>" . $e->name . "</option>";
}
echo $opts;

?>