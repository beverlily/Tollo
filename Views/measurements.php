<?php
      $title = 'Measurements';
      $style = 'measurements.css';
      include '../header.php';
	  if($_SESSION['id'] == "")
	  {
		  header('Location: ../Views/dashboard.php');
	  }
 ?>
<div class="page-wrapper">
   <main>
	 <div id="measurements" class="content-container">
		 <h2>Measurements</h2>
		 	<!--Add measurement button-->
			 <div class="button-container">
				 <button id="add-measurement-btn" type="button" class="button button-main"> Add Measurement</button>
			 </div>

			 <!--Add measurement form -->
			 <form id="add-measurement-form" class="hidden">
				 <div class="form-row">
				    <div class="col">
					  <label for="measurement-name" class="hidden">Measurement Name</label>
				      <input type="text" id="measurement-name" name="name" class="form-control" placeholder="Measurement Name">
				    </div>
				    <div class="col">
					  <label for="current-measurement" class="hidden">Current Measurement (inches)</label>
				      <input type="number" step="0.01" id="current-measurement" name="current" class="form-control" placeholder="Current Measurement (Inches)">
				    </div>
					<div class="col">
					  <label for="goal-measurement" class="hidden">Goal Measurement (inches)</label>
					  <input type="number" step="0.01" id="goal-measurement" name="goal" class="form-control" placeholder="Goal Measurement (Inches)">
					</div>
				  </div>
				 <div class="button-container">
					 <input type="submit" name="add" class="button button-main" value="Add Measurement" />
					 <button id="cancel-add-btn" type="button" class="button">Cancel</button>
				 </div>
			 </form>

			 <!-- container for error and success messages -->
			 <div id="measurement-message"></div>

			 <!--list of user measurements-->
	 		<br />
			<ul id="measurements-list" class="list-group">

			</ul>

	 </div>
   </main>
</div>
<!-- end of page wrapper-->
<?php
   include '../footer.php';
?>
