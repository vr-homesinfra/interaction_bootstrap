<?php  

if(isset($_POST['login_button'])) {

	$email = filter_var($_POST['login_email'], FILTER_SANITIZE_EMAIL); //sanitize email

	$_SESSION['login_email'] = $email; //Store email into session variable 
	$password = md5($_POST['login_password']); //Get password

	$check_database_query = mysqli_query($con, "SELECT * FROM users WHERE email='$email' AND password='$password'");
	$check_login_query = mysqli_num_rows($check_database_query);

	if($check_login_query == 1) {
		$row = mysqli_fetch_array($check_database_query);
		$username = $row['username'];

		$user_closed_query = mysqli_query($con, "SELECT * FROM users WHERE email='$email' AND user_closed='yes'");
		if(mysqli_num_rows($user_closed_query) == 1) {
			$reopen_account = mysqli_query($con, "UPDATE users SET user_closed='no' WHERE email='$email'");
		}
//after login,the session variable is set for the user from here
		$_SESSION['username'] = $username;
		header("Location: settings.php");
		exit();
	}
	else {
		array_push($error_array, "Email or password was incorrect<br>");
	}
}
?>
