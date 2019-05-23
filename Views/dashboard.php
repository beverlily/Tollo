<!-- Main Login Styling taken from: https://codepen.io/khadkamhn/pen/ZGvPLo all credit belongs to Mohan Khadka -->
<?php
  $title = 'Dashboard';
  $style = 'dashboard.css';
  include '../header.php';
?>

<div class="login-wrap">
    <div class="login-html">
        <h1 id="login-html-title">Dashboard</h1>
				<div class="login-html-hr"></div>
        <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
        <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>
        <div class="login-form">
            <form action="../Controllers/login.php" method="post">
                <div class="sign-in-htm">
                    <div class="group">
                        <label for="user" class="label">Username</label>
                        <input id="user" type="text" class="input" name="signInUsername">
                    </div>
                    <div class="group">
                        <label for="pass" class="label">Password</label>
                        <input id="pass" type="password" class="input" data-type="password" name="signInPassword">
                    </div>
                    <div class="group">
                        <input id="check" type="checkbox" class="check" checked>
                        <label for="check"><span class="icon"></span> Keep me Signed in</label>
                    </div>
                    <div class="group">
                        <input type="submit" class="button" name="signin" value="Sign In">
                        <input type="button" class="button" onclick="window.location = '<?php echo $loginURL ?>';" id="googleSignInBtn" value="Sign In with Google">
                    </div>
                    <div class="hr"></div>
                    <div class="foot-lnk">
                        <a href="../Views/forgot.php">Forgot Password?</a>
                    </div>
										<div id="errMsg"><?=$_SESSION['ErrorMessage']?></div>		
										<div id="successMsg"><?= $_SESSION['SuccessMessage'] ?></div>																						
                </div>
            </form>
            <form action="../Controllers/addUser.php" method="post" enctype="multipart/form-data">
                <div class="sign-up-htm">
                    <div class="group">
                        <label for="user" class="label">Username</label>
                        <input id="user" type="text" class="input" name="signUpUsername">
                    </div>
                    <div class="group">
                        <label for="pass" class="label">Password</label>
                        <input id="pass" type="password" class="input" data-type="password" name="signUpPassword">
                    </div>
                    <div class="group">
                        <label for="pass" class="label">Repeat Password</label>
                        <input id="pass" type="password" class="input" data-type="password" name="signUpPasswordRepeat">
                    </div>
                    <div class="group">
                        <label for="pass" class="label">Email Address</label>
                        <input id="pass" type="text" class="input" name="signUpEmail">
                    </div>
                    <div class="avatar"><label>Select your avatar: </label><input type="file" name="avatar"
                            accept="image/*" required /></div>
                    <div class="group">
                        <input type="submit" class="button" name="signup" value="Sign Up">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
        include '../footer.php';
        $_SESSION['ErrorMessage'] = "";
        $_SESSION['SuccessMessage'] = "";

?>