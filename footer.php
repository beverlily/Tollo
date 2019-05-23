<footer id="footer">

	<h2 class="hidden">Footer</h2>
	<!-- Footer -->
	<footer class="page-footer font-small indigo">

		<!-- Footer Links -->
		<div class="container">

			<!-- Grid row-->
			<div class="row text-center d-flex justify-content-center pt-5 mb-3">

				<!-- Grid column -->
				<?php
				$menu = [
					'Home' => ROOTPATH . 'index.php', 'About Us' => VIEWPATH . 'aboutus.php', 'Accounts' => VIEWPATH . 'login.php',
					'Contact' => VIEWPATH . 'contact.php', 'Workouts' => VIEWPATH . 'workouts.php'
				];
				foreach ($menu as $label => $file) {
					echo "<div class='col-md-2 mb-3'>
						<h6 class='text-uppercase font-weight-bold'>
						  <a href='$file'>$label</a>
						</h6>
					  </div>";
				}
				?>



			</div>
			<div class="row d-flex text-center justify-content-center mb-md-0 mb-4">

				<a href="<?= ROOTPATH ?>index.php"><img id="footerLogo" src="<?= IMGPATH ?>be-strong-preview.png" alt="Tollo Logo" /></a>

			</div>
			<!-- Grid row-->


			<!-- Grid row-->
			<div id="smLinks">

				<!-- Grid column -->
				<div class="col-md-12">

					<div class="row text-center d-flex justify-content-center mb-3">

						<!-- Facebook -->
						<a class="fb-ic">
							<i class="fab fa-facebook-f fa-lg white-text mr-4"> </i>
						</a>
						<!-- Twitter -->
						<a class="tw-ic">
							<i class="fab fa-twitter fa-lg white-text mr-4"> </i>
						</a>
						<!-- Google +-->
						<a class="gplus-ic">
							<i class="fab fa-google-plus-g fa-lg white-text mr-4"> </i>
						</a>
						<!--Linkedin -->
						<a class="li-ic">
							<i class="fab fa-linkedin-in fa-lg white-text mr-4"> </i>
						</a>
						<!--Instagram-->
						<a class="ins-ic">
							<i class="fab fa-instagram fa-lg white-text mr-4"> </i>
						</a>


					</div>

				</div>
				<!-- Grid column -->

			</div>
			<!-- Grid row-->

		</div>
		<!-- Footer Links -->

		<!-- Copyright -->
		<div class="footer-copyright text-center py-3">© 2019 Copyright: Tollo
		</div>
		<!-- Copyright -->

	</footer>

	</body>

	</html>