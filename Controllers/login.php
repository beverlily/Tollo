<?php
//Start our session
session_start();
require_once '../vendor/autoload.php';
require_once '../Controllers/googleLoginConfig.php';
use App\Database;
use App\User;

// Google API access token, if user logged in then redirect to index
if(!isset($_SESSION['access_token']))
{
    header('Location: ../index.php');
}
//Google login
$loginURL = $gClient->createAuthUrl();

$_SESSION['ErrorMessage'] = '';

//Instantiate our db
$db = Database::getDb();
$c = "";

//If the login button was pressed on Views/dashboard.php
if (isset($_POST['signin']))
{
    //Instantiate user class
    $u = new User();

    //Set username variable to username retrieved from form
    $username = ($_POST['signInUsername']);

    //Run our existing user function and put results into variable c
    $c = $u->checkExistingUser($username, $db);

    //If the count of rows retrieved from the query is 0
    if(count($c) == 0)
    {
        //User doesn't exist
        $_SESSION['ErrorMessage'] = "User does not exist";
        header('Location: ../Views/dashboard.php');
    }
    else
    {
        //Set user variable to information retrieved from database
        $userInfo = $u->getUser($username, $db);
        $user = $userInfo;

        //Check if our sign in password is the same as our stored password
        if(password_verify($_POST['signInPassword'], $user['password']))
        {
            $_SESSION['id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['avatar'] = $user['avatar'];

            header("location: ../index.php");
        }
        else
        {
            $_SESSION['ErrorMessage'] = "Wrong username or password";
            header('Location: ../Views/dashboard.php');
        }
    }

}
