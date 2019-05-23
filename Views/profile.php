<?php
$title = 'User Profile';
$style = 'profile.css';
include '../header.php';
if ($_SESSION['id'] == "") {
    header('Location: ../Views/dashboard.php');
}
?>
<div id="pageWrapper">
    <div class="profileHead">
        <div id="imgContainer">
            <?php
            if (isset($_SESSION['avatar'])) {
                echo "<img src='" . IMGPATH . $_SESSION['avatar'] . "'id='profileImg' alt='Default profile image'>";
            } else {
                echo "<img src='" . IMGPATH . "Default-Profile.png' id='profileImg' alt='Default profile image'>";
            }
            ?>
        </div>
        <h1 id="username"><?php
                            echo $_SESSION['username'];
                            ?></h1>

    </div>
    <div id="profileTabs">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">

            <!--Tabs go here-->
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#about" class="nav-link active" role="tab" data-toggle="tab">About</a>
                </li>
                <li>
                    <a href="#programs" class="nav-link" role="tab" data-toggle="tab">Programs</a>
                </li>

                <li>
                    <a href="#reminders" class="nav-link" role="tab" data-toggle="tab">Reminders</a>
                </li>
                <li>
                    <a href="#measurementsTab" class="nav-link" role="tab" data-toggle="tab">Measurements</a>
                </li>
                <li>
                    <a href="#journal" class="nav-link" role="tab" data-toggle="tab">Diary</a>
                </li>
                <li>
                    <a href="#workouts" class="nav-link" role="tab" data-toggle="tab">Logs</a>
                </li>

            </ul>
            <!--Content goes here-->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="about">
                    <?php
                    include 'aboutProfile.php';
                    ?>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="programs">
                    <?php
                    include '../Views/subscriptions.php';
                    ?>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="workouts">
                    <?php
                    include '../Views/previewlogs.php';
                    ?>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="measurementsTab">
					<?php
						include 'previewMeasurements.php';
					 ?>
				</div>
                <div role="tabpanel" class="tab-pane fade" id="reminders">
                    <?php
                    include 'reminderProfile.php';
                    ?>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="journal">
                    <?php
                    include 'journalProfile.php';
                    ?>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="records">tab6</div>
            </div>
        </div>
    </div>
</div>

<?php
include '../footer.php';
?>
