<?php
//Attempting to get forgot password page to work but unfortunately not sending email need more time to debug
session_start();
require_once '../vendor/autoload.php';
use App\Database;
use App\User;

//Instantiate our db
$db = Database::getDb();
$c = "";

if (isset($_POST['reset']))
{
        //Instantiate user class
        $u = new User();
        if($_POST['email'] == "")
        {
            $_SESSION['ErrorMessage'] = "Email cannot be blank";
            header('Location: ../Views/forgot.php');
        }
        elseif(!filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL))
        {
            $_SESSION['ErrorMessage'] = "Please enter a valid email";
            header('Location: ../Views/forgot.php');
        }
        else
        {
            $email = $_POST['email'];

            $c = $u->checkExistingEmail($email, $db);

            //If the count of rows retrieved from the query is 0
            if(count($c) == 0)
            {
                //User doesn't exist
                $_SESSION['ErrorMessage'] = "Email does not exist";
                header('Location: ../Views/forgot.php');
            }
            else
            {
                $userInfo = $u->getUserByEmail($email, $db);
                $user = $userInfo;

                $email = $user['email'];
                $username = $user['username'];

                $_SESSION['SuccessMessage'] = "Please check your email " . $email . " for a confirmation link to complete your passowrd reset.";

                //Send registration confirmation link 
                $to = $email;
                $subject = "Password Reset Link (Tollo)";
                $message = '
                Hello '. $username .',

                You have requested a password reset.

                Please click this link to reset your password:

                http://localhost:8080/project-no-tears/Views/reset.php?email='.$email;

                $headers = array("From: Tollo@tollo.com",
                "Reply-To: Tollo@tollo.com",
                "X-Mailer: PHP/" . PHP_VERSION
                );

                mail($to, $subject, $message, $headers);
                header("location: ../Views/forgot.php");
            }
        }

}

?>