<?php
$id = $_POST['id'];
$type = $_POST['type'];

$editModal =
            "<div class='modal-header'>
                <h5 class='modal-title' id='editCategoryModalLabel'>Edit $type </h5>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>
            <div class='modal-body'>
                <div class='modal-container'>
                    <form id='editCategoryForm'>
						<input id='editCId' name='id' class='hidden' type='hidden' value='$id' />
                        <label for='editType'>Type</label>
                        <input id='editCType' name='type' type='text' value='$type' />

                        <div class='button-container'>
                            <input type='submit' name='editCategory' class='button button-main' value='Save' />
                        </div>
						<div class='form-message'></div>
                    </form>
                </div>
			</div>
            ";

echo $editModal;

?>
