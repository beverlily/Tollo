<?php
require_once '../../vendor/autoload.php';
use App\Exercise;

$e = new Exercise();
$dropdown = '';

	//Gets all exercise categories
	$categories = $e->getAllCategories();

	//Generates html for exercise categories dropdown
	foreach ($categories as $index=>$category) {
		$select = isset($_POST['select'])? ($_POST['select']) : '';
		$selected = $select == $category->type ? "selected" : '';
		$dropdown .= "<option $selected value='$category->id'>$category->type</option>";
	}

echo $dropdown;
 ?>
