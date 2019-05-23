<?php
session_start();
require_once '../Controllers/googleLoginConfig.php';

if (isset($_SESSION['access_token']))
{
    $gClient->setAccessToken($_SESSION['access_token']);
}
else if (isset($_GET['code'])) 
{
$token = $gClient->fetchAccessTokenWithAuthCode($_GET['code']);
$_SESSION['access_token'] = $token;
}
else 
{
header('Location: ../Views/dashboard.php');
exit();
}

$oAuth = new Google_Service_Oauth2($gClient);
$userData = $oAuth->userinfo_v2_me->get();

$_SESSION['id'] = $userData['id'];
$_SESSION['email'] = $userData['email'];

header('Location: ../index.php');
?>