<?php
include '../Controllers/logout.php';
//Start our session
session_start();
?>
<div><?= $_SESSION['id'] ?></div>
<div><?= $_SESSION['username'] ?></div>
<div><?= $_SESSION['email'] ?></div>		

<form action="welcome.php" method="post">
<input type="submit" class="button" name="Logout" value="Logout">
</form>
