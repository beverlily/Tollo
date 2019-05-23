<?php
require_once '../Controllers/googleLoginConfig.php';
session_start();

//If the user is logged in 
if(isset($_SESSION['id']))
{
    //Unset session variables and destroy our session
    unset($_SESSION['id']);
    unset($_SESSION['username']);
    unset($_SESSION['email']);
    
    //Logout for google api login
    unset($_SESSION['access_token']);
    $gClient->revokeToken();
    
    session_destroy();
    header("location: ../index.php");
}
else
{
    header("location: ../Views/dashboard.php");
}
