<?php
require_once '../../vendor/autoload.php';
use App\Exercise;
$e = new Exercise();

$categories = $e->getAllCategories();
$categoriesString = '';

//generates html for list of categories 
foreach($categories as $category){
	$categoriesString .=
	"<li>
		<div class='item item-container flex-container'>
			<div class='item-information'>
			<form class='getCategory getForm'>
				<input type='hidden' name='id' value='$category->id' />
				<input type='submit' class='item-title' value='$category->type' />
			</form>
			</div>
			<div class='item-icon-container'>
				<form class='editCategory'>
					<input type='hidden' name='id' value='$category->id' />
					<input type='hidden' name='type' value='$category->type' />
					<button type='submit' data-toggle='modal' data-target='#editCategoryModal' name='edit'><i class='item-icon fas fa-pencil-alt'></i></button>
				</form>
				<form class='deleteCategory'>
					<input type='hidden' name='id' value='$category->id' />
					<button type='submit' name='delete'><i class='item-icon fas fa-times'></i></button>
					</form>
				</div>
		</div>
	</li>";
}
echo $categoriesString;
?>
