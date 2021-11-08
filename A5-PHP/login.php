<?php
$username = "eval";
$password = "eva";
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
	header("Location: album.php");
}
if(isset($_POST['username']) && isset($_POST['password'])){
	if($_POST['username'] == $username && $_POST['password'] == $password){
		$_SESSION['loggedin'] = true;
		header("Location: album.php");
	}
    else{
		echo "<h3>Incorrect Username or Password! Try Again.</h3>";
    }
}
?>