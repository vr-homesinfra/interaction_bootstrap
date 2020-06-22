<?php

include("includes/header.php");

if(isset($_GET['q'])) {
	$query = $_GET['q'];
}
else {
	$query = "";
}

if(isset($_GET['type'])) {
	$type = $_GET['type'];
}
else {
	$type = "name";
}
?>
<div class='container-fluid'>
    <div class='bootstrap_cards2'>
        <div class='container py-1'>
            <div class='row pb-1 mb-4'>
                <?php 
	if($query == "")
		echo "You must enter something in the search box.";
	else {
		//If query contains an underscore, assume user is searching for usernames
		if($type == "username") 
			$usersReturnedQuery = mysqli_query($con, "SELECT * FROM users WHERE username LIKE '$query%' AND user_closed='no' LIMIT 8");
		//If there are two words, assume they are first and last names respectively
		else {

			$names = explode(" ", $query);
			
//If there are three words (for architects), assume they are profile and location names respectively			
			if(count($names) == 3)
				$usersReturnedQuery = mysqli_query($con, "SELECT * FROM users WHERE (first_name LIKE '$names[0]%' AND last_name LIKE '$names[2]%') OR (profile LIKE '$names[0]%' AND location LIKE '$names[2]%') AND user_closed='no'");
			//If query has one word only, search first names or last names 
			else if(count($names) == 2)
				$usersReturnedQuery = mysqli_query($con, "SELECT * FROM users WHERE (first_name LIKE '$names[0]%' AND last_name LIKE '$names[1]%') AND user_closed='no'");
			
				//If there are four words (for interior designer), assume they are profile and location names respectively
			else if(count($names) == 4)
				$usersReturnedQuery = mysqli_query($con, "SELECT * FROM users WHERE (profile LIKE '$names[0]%' AND location LIKE '$names[3]%') AND user_closed='no'");
			else 
				$usersReturnedQuery = mysqli_query($con, "SELECT * FROM users WHERE (first_name LIKE '$names[0]%' OR last_name LIKE '$names[0]%') AND user_closed='no'");
		}

		// Check if results were found 
		if(mysqli_num_rows($usersReturnedQuery) == 0)
			echo "We can't find anyone with a " . $type . " like: " .$query;
		// else 
		// 	echo mysqli_num_rows($usersReturnedQuery) . " result(s) found: <br> <br>";


		// echo "<p id='grey'>Try searching for:</p>";
		// echo "<a href='search.php?q=" . $query ."&type=name'>Names</a>, <a href='search.php?q=" . $query ."&type=username'>Other keywords</a><br><br><hr id='search_hr'>";

		while($row = mysqli_fetch_array($usersReturnedQuery)) {
			$user_obj = new User($con, $user['username']);

			$button = "";
			$mutual_friends = "";

			if($user['username'] != $row['username']) {

				//Generate button depending on friendship status 
				// if($user_obj->isFriend($row['username']))
				// 	$button = "<input type='submit' name='" . $row['username'] . "' class='danger' value='Remove Friend'>";
				// else if($user_obj->didReceiveRequest($row['username']))
				// 	$button = "<input type='submit' name='" . $row['username'] . "' class='warning' value='Respond to request'>";
				// else if($user_obj->didSendRequest($row['username']))
				// 	$button = "<input type='submit' class='default' value='Request Sent'>";
				// else 
				// 	$button = "<input type='submit' name='" . $row['username'] . "' class='success' value='Add Friend'>";

				// $mutual_friends = $user_obj->getMutualFriends($row['username']) . " friends in common";


				//Button forms
				if(isset($_POST[$row['username']])) {

					if($user_obj->isFriend($row['username'])) {
						$user_obj->removeFriend($row['username']);
						header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
					}
					else if($user_obj->didReceiveRequest($row['username'])) {
						header("Location: requests.php");
					}
					else if($user_obj->didSendRequest($row['username'])) {

					}
					else {
						$user_obj->sendRequest($row['username']);
						header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
					}
				}
			}
			//to display the verified tick
			$blank_space="&nbsp";
			$coa_verified = $row['coa_verified'];
		if ($coa_verified=="yes") {
			$coa_stat= "<i class='fa fa-check' style='font-size: 19px;color: rgb(23,99,247);padding-left: 0px;padding-right: 0px;'>
				</i>";
			} else {
				$coa_stat= "<i class='fa fa-exclamation-circle' style='font-size: 19px;color: rgb(23,99,247);padding-left: 0px;padding-right: 0px;'>
				</i>";
		}

echo "

		<div class='col-lg-3 col-md-3 mb-4 mb-lg-0'>
			<div class='card rounded shadow-sm border-0'>
				<div class='card-body p-4'>
				<img
				src='". $row['profile_pic'] ."'
				alt='' class='img-fluid d-block mx-auto mb-3'>
				<h5> <a href='" . $row['username'] ."' class='text-dark'>" . $row['first_name'] . " " . $row['last_name'] .$blank_space.$coa_stat."</a></h5>
				<p class='small text-muted font-italic'>Lorem ipsum dolor sit amet,
					consectetur adipisicing elit.</p>
						
					<div class='text-center mt-2'>
					<a name='' id='' class='btn btn-primary' href='" . $row['username'] ."' role='button'>Visit Profile</a>
					</div>
		</div>		
	</div>
</div>

";
}	
}
?>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/script.min.js"></script>
    <script src="assets/js/rdjsfile.js"></script>
