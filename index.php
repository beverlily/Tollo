<?php
   $style = 'index.css';
   include 'header.php';
   $_SESSION['ErrorMessage'] = "";
   $_SESSION['SuccessMessage'] = "";
   $_SESSION['DiaryErrorMessage'] = "";
   $_SESSION['ReviewErrorMessage'] = "";
?>
<!-- Main Graphic -->
<div id="indexBanner" class="flexContainer">
   <div id="bannerText" class="pageWrapper">
      Stay fit. <br />
      Make goals. <br />
      Change your life. <br />
      <span class="highlight">Start Tollo today.</span>
   </div>
</div>
<!-- Welcome To Tollo Section -->
<main id="mainContent">
   <div class="pageWrapper wrapper">
      <div id="welcomeSection" class="flexContainer">
         <div id="welcome">
            <h2 class="title">Welcome to Tollo.</h2>
            <div id="welcomeText">
               <p>
				  Tollo is a fitness application for weight-lifting, strength-training, and fitness.
				  Most applications are either solely about set programs and exercises, or are otherwise devoted calorie-counting apps.
				  With Tollo, you are given more power to upload and manage your exercises and chart your progress.
				  Tollo will structure and enhance your success, and allow you to save routines and note your progress.
				  <br />
				  <br />
				  Start living healthier. Join Tollo today!
               </p>
            </div>
            <br />
            <div class="buttonContainer">
               <a id="startTollo" href="<?= VIEWPATH ?>dashboard.php" class="button buttonMain">Start Tollo</a>
            </div>
         </div>
         <div id="welcomeImg">
            <img class="largePic" src="<?= IMGPATH ?>jogging.jpg" alt="A person jogging in the city">
         </div>
      </div>
   </div>
   <div class="divider"></div>
   <!--Features Section-->
   <div id="featuresSection">
      <h2 class="hidden">Features</h2>
      <div id="features" class="flexContainer pageWrapper">
         <div id="trackWorkouts" class="feature flexContainer">
            <h3>Track workouts.</h3>
            <div class="featureImgandText">
               <img src="<?= IMGPATH ?>1.jpg" alt="A person jogging on a treadmill">
               <div class="featureImgText">
                  <p>Easily track your workouts and set routines. With Tollo you can become your own personal trainer.</p>
               </div>
            </div>
         </div>
         <div id="setGoals" class="feature flexContainer">
            <h3>Set goals.</h3>
            <div class="featureImgandText">
               <img src="<?= IMGPATH ?>8.jpg" alt="A person lifting weights">
               <div class="featureImgText">
                  <p>Set daily goals, long-term goals and keep track of your progress.</p>
               </div>
            </div>
         </div>
         <div id="trackJournal" class="feature flexContainer">
            <h3>Journal.</h3>
            <div class="featureImgandText">
               <img src="<?= IMGPATH ?>goal.jpg" alt="A person running through a forest">
               <div class="featureImgText">
                  <p>Track your thoughts, feelings and results in Tollo. With our diary feature, you can log what you're feeling.</p>
               </div>
            </div>
         </div>
      </div>
   </div>
</main>
<?php
   include 'footer.php';
?>
