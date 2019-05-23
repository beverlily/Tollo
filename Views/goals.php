<?php
      $title = 'Goals';
      $style = 'goals.css';
	  include '../header.php';
	  if($_SESSION['id'] == "")
	  {
		  header('Location: ../Views/dashboard.php');
	  }
 ?>
<div class="page-wrapper">
   <main>
	   <!-- Add daily goal modal -->
	   <div class="modal fade" id="addDailyGoalModal" tabindex="-1" role="dialog" aria-labelledby="addDailyGoalLabel" aria-hidden="true">
		   <div class="modal-dialog" role="document">
			   <div class="modal-content">
				   <div class="modal-header">
					   <h5 class="modal-title" id="addDailyGoalModalLabel">Add Daily Goal</h5>
					   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						   <span aria-hidden="true">&times;</span>
					   </button>
				   </div>
				   <div class="modal-body">
					   <div class="modal-container">
						   <form id="addDailyGoalForm">
							   <label for="addDGoalName">Name</label>
							   <input id="addDGoalName" name="name" type="text" />
							   <div class="button-container">
								   <input type="submit" name="addDailyGoal" class="button button-main" value="Add Daily Goal" />
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
	   <!-- end of add daily goal modal-->

	   <!-- Add longterm goal modal -->
	<div class="modal fade" id="addLongtermGoalModal" tabindex="-1" role="dialog" aria-labelledby="addLongtermGoalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="addLongtermGoalModalLabel">Add Longterm Goal</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="modal-container">
						<form id="addLongtermGoalForm">
							<label for="addLGoalName">Name</label>
							<input id="addLGoalName" name="name" type="text" />
							<label for="addLGoalDescription">Description</label>
							<input id="addLGoalDescription" name="description" type="text" />
							<label for="addLGoalDate">Complete By</label>
							<input id="addLGoalDate" name="completeBy" type="date" />
							<div class="button-container">
								<input type="submit" name="addLongtermGoal" class="button button-main" value="Add Longterm Goal" />
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
	<!-- end of add longterm goal modal-->

	<!-- Edit  goal modal-->
	<div class="modal fade" id="editGoalModal" tabindex="-1" role="dialog" aria-labelledby="editGoalModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div id="editGoalModalContent"></div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<!--end of edit goal modal-->

	<!-- list of goals -->
      <div id="goals" class="flex-container">
         <div id="item-list">
            <h2 id="item-title">Goals</h2>
			<div id="message"></div>
			<div>
				<h3 class="heading">Daily Goals</h3>
				<button id="addDailyGoal" type="button" class="addButton" data-toggle="modal" data-target="#addDailyGoalModal"><i class="fas fa-plus"></i></button>
			</div>

			<!--List of daily goals -->
            <ul id="daily-goals-list"></ul>

            <br />
            <br />
			<div>
				<h3 class="heading">Long-term Goals</h3>
				<button id="addLongtermGoal" type="button" class="addButton" data-toggle="modal" data-target="#addLongtermGoalModal"><i class="fas fa-plus"></i></button>
			</div>

    		<!-- list of long-term goals -->
            <ul id="longterm-goals-list"></ul>

         </div>
     <!-- end of goals list -->

		 <!--Goals quote section-->
         <div id="goals-quote" class="flex-container">
            <div id="goals-quote-text">
               <h2 class="heading">Set Goals.</h2>
               <p class="quote">"Set your goals high, and don't stop till you get there."</p>
            </div>
         </div>

      </div> <!-- end of goals -->
   </main>
</div> <!-- end of page wrapper-->
<?php
   include '../footer.php';
?>
