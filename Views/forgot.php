<!-- Main Login Styling taken from: https://codepen.io/khadkamhn/pen/ZGvPLo all credit belongs to Mohan Khadka -->
<?php
  $title = 'Reset Your Password';
  $style = 'dashboard.css';
  include '../header.php';
?>

<div class="login-wrap">
    <div class="login-html">
        <h1 id="login-html-title">Password Reset</h1>
				<div class="login-html-hr"></div>
        <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab"></label>
        <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab"></label>
        <div class="login-form">
            <form action="../Controllers/forgot.php" method="post">
                <div class="sign-in-htm">
                    <div class="group">
                        <label for="user" class="label">Email Address</label>
                        <input id="user" type="text" class="input" name="email">
                    </div>
                    <div class="group">
                        <input type="submit" class="button" name="reset" value="Reset">
                    </div>
                    <div class="hr"></div>
					<div id="errMsg"><?=$_SESSION['ErrorMessage']?></div>		
					<div id="successMsg"><?= $_SESSION['SuccessMessage'] ?></div>																						
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