<?php
require_once "../GoogleAPI/vendor/autoload.php";
//Set Google login info
$gClient = new Google_Client();
$gClient->setClientId("751688858427-atlda8r1258ok5lq034h7njm79l8qrat.apps.googleusercontent.com");
$gClient->setClientSecret("LjhGYB1fyA2wLiPb-n3PirFu");
$gClient->setApplicationName("Tollo");
$gClient->setRedirectUri("http://localhost:8080/project-no-tears/Views/googleCallback.php");
$gClient->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");
?>
