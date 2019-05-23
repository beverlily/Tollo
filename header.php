<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width">
    <?php
    require_once 'config.php';
    ?>
    <title><?php
            if (isset($title)) {
                echo $title . ' | ';
            }
            ?>
        Tollo: A Fitness and Weightlifting App</title>
</head>

<body>

    <a id="skipToMain" class="hidden" href="#mainContent" tabindex="0">Skip to main content</a>
    <header id="header">



        <label for="navTog" class="nav-tog-label"><i id="burger" class="fas fa-bars toggle"></i></label>
        <a href="<?= ROOTPATH ?>index.php"><img id="siteLogo" src="<?= IMGPATH ?>be-strong-preview.png" alt="Tollo Logo" /></a>
        <h1 id="siteName" class="hidden">Tollo</h1>
        <input type='checkbox' id='navTog' class='nav-toggle'>
        <nav id="mainNav">

            <ul>

                <?php
                $menu = [
                    'Home' => ROOTPATH . 'index.php', 'Exercises' => VIEWPATH . 'exercises.php', 'Workouts' => VIEWPATH . 'workouts.php',
                    'Goals' => VIEWPATH . 'goals.php', 'Measurements' => VIEWPATH . 'measurements.php', 'Diary' => VIEWPATH . 'diarylist.php', 'Reviews' => VIEWPATH . 'reviews/publicReviews.php', 'Profile' => VIEWPATH . 'profile.php'
                ];
                foreach ($menu as $label => $file) {
                    echo "<li ><a href='$file'>$label</a></li>";
                }

                ?>

            </ul>

        </nav>
        <div>
            <?php
            //include VIEWPATH . 'notificationHeader.php';
            include 'Views\notificationHeader.php';
            ?>
        </div>
        <div id="login">

            <?php
            if (isset($_SESSION['id'])) {
                echo $_SESSION['email'] . " ";
                echo "<a href=" . ROOTPATH . "Controllers/logout.php>Logout</a>";
            } else {
                echo "<a href=" . VIEWPATH . "dashboard.php>Login</a>";
                echo "/";
                echo "<a href=" . VIEWPATH . "dashboard.php>Register</a>";
            }



            ?>
        </div>

    </header>