<?php
session_start();
require_once '../../vendor/autoload.php';
use App\About;

$a = new About();
if (isset($_SESSION['id'])) $userId = $_SESSION['id'];

//ADD
//Note: I did not add validation for empty strings because users do not have to fill out the about
//section if they do not want to give that information
//Age only accepts a number
//All inputs are filtered
if (isset($_POST['add'])) {
	$nfullname = $_POST['newfullname'];
	$nage = $_POST['newage'];
	$ngender = $_POST['newgender'];
	$nbio = $_POST['newbio'];

	$fullname = filter_var($nfullname, FILTER_SANITIZE_STRING);
	$age = filter_var($nage, FILTER_SANITIZE_STRING);
	$gender = filter_var($ngender, FILTER_SANITIZE_STRING);
	$bio = filter_var($nbio, FILTER_SANITIZE_STRING);

	$add = $a->addUserId($userId, $fullname, $age, $gender, $bio);

	if ($add) {
		header('Location: ../../Views/profile.php');
	} else {
		echo "error";
	}
}
//getbyid
if (isset($_POST['id'])) {
	$id = $_POST['id'];
	$getid = $a->getAboutId($id);
	$aboutid = $getid->id;

	//UPDATE
	if (isset($_POST['update'])) {
		$id = $_POST['id'];
		$nfullname = $_POST['fullname'];
		$nage = $_POST['age'];
		$ngender = $_POST['gender'];
		$nbio = $_POST['bio'];

		$fullname = filter_var($nfullname, FILTER_SANITIZE_STRING);
		$age = filter_var($nage, FILTER_SANITIZE_STRING);
		$gender = filter_var($ngender, FILTER_SANITIZE_STRING);
		$bio = filter_var($nbio, FILTER_SANITIZE_STRING);

		$edit = $a->editAbout($id, $fullname, $age, $gender, $bio);
		if ($edit) {
			header('Location: ../../Views/profile.php');
		} else {
			echo "error";
		}
	}
}
