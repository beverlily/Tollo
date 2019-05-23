<?php
	$title = 'Exercises';
	$style = 'exercises.css';
	include_once '../header.php';
	if($_SESSION['id'] == "")
	{
		header('Location: ../Views/dashboard.php');
	}
?>
	<div id="banner"></div>
	<div class="page-wrapper">
	    <main>
	        	<div id="exercises" class="content-container">
		            <h2>Exercises</h2>
		            <div class="button-container">
		                <!-- Button trigger modal -->
		                <button id="addCategoryButton" type="button" class="button button-main" data-toggle="modal" data-target="#addCategoryModal">
		                    Add Category
		           		</button>
						<button id="addExerciseButton" type="button" class="button button-main hidden" data-toggle="modal" data-target="#addExerciseModal">
							Add Exercise
						</button>
						<button id="backToCategories" type="button" class="button button-main hidden">Back to Categories</button>

	            </div>

	            <!-- Add category modal -->
	            <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
	                <div class="modal-dialog" role="document">
	                    <div class="modal-content">
	                        <div class="modal-header">
	                            <h5 class="modal-title" id="addCategoryModalLabel">Add Category</h5>
	                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                                <span aria-hidden="true">&times;</span>
	                            </button>
	                        </div>
	                        <div class="modal-body">
	                            <div class="modal-container">
	                                <form id="addCategoryForm">
	                                    <label for="addCType">Type</label>
	                                    <input id="addCType" name="type" type="text" />
	                                    <div class="button-container">
	                                        <input type="submit" name="addCategory" class="button button-main" value="Add Category" />
	                                    </div>
										<div class="form-message"></div>
	                                </form>
	                            </div>
	                        </div>
	                        <div class="modal-footer">
	                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	                        </div>
	                    </div>
	                </div>
	            </div>

				<!-- Edit category modal -->
				<div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
	                <div class="modal-dialog" role="document">
	                    <div class="modal-content">
							<div id="editCategoryModalContent">
							</div>
	                        <div class="modal-footer">
	                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	                        </div>
	                    </div>
	                </div>
	            </div>

	            <div class="flex-container">
	                <div id="message"></div>
	                <ul id="exercise-list"></ul>
	            </div>
	        </div>

			<!-- Add exercise modal -->
			<div class="modal fade" id="addExerciseModal" tabindex="-1" role="dialog" aria-labelledby="addExerciseModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="addExerciseModalLabel">Add Exercise</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="modal-container">
								<form id="addExerciseForm">
									<div>
										<label for="addEName">Name</label>
										<input id="addEName" name="name" type="text" />
									</div>
									<br />
									<div>
										<label for="addEDescription">Description</label><br />
										<textarea id="addEDescription" name="description" type="text"></textarea>
									</div>
									<br />
									<div>
										<label for="categoryDropdown">Category</label>
										<select id="categoryDropdown" name="category"></select>
									</div>
									<div class="button-container">
										<input type="submit" name="addExercise" class="button button-main" value="Add Exercise" />
									</div>
									<div class="form-message"></div>
								</form>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>

			<!--Edit exercise modal -->
			<div class="modal fade" id="editExerciseModal" tabindex="-1" role="dialog" aria-labelledby="editExerciseModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div id="editExerciseModalContent">
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
	        </main>
	</div>
<?php
    include '../footer.php';
?>
