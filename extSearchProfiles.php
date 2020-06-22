<?php

require 'config/config.php';
include("includes/classes/User.php");

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
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Search Listing</title>
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
        <link rel="stylesheet" href="rd/assets/css/styles.min.css?h=2cfe18d2d8a32b71eadff2883706ad0e">
    </head>

    <body>
        <nav class="navbar fixed-top navbar-light bg-light">
            <nav class="navbar navbar-light fixed-top bg-light off-canvas" data-right-drawer="0" data-open-drawer="0">
                <div class="container-fluid flex-column"><button class="mt-2 mt-lg-0 btn btn-light drawer-knob"
                        type="button" data-open="drawer"><i class="fas fa-bars"></i></button>
                    <div class="d-flex justify-content-between brand-line"><button class="btn btn-light" type="button"
                            data-dismiss="drawer"><span class="sr-only">Toggle Navigation </span><i
                                class="fas fa-times"></i></button><a class="navbar-brand"
                            href="https://homesinfra.com/">HomesInfra</a></div>
                    <ul class="nav navbar-nav flex-column drawer-menu">
                        <li role="presentation" class="nav-item"><a class="nav-link active" href="#">Find Creatives</a>
                        </li>
                        <li role="presentation" class="nav-item"><a class="nav-link"
                                href="https://homesinfra.com/virtualreality/">Virtual Reality</a></li>
                        <li role="presentation" class="nav-item"><a class="nav-link"
                                href="https://homesinfra.com/homesinfra-showcase/">Showcase</a></li>
                        <li role="presentation" class="nav-item"><a class="nav-link"
                                href="https://homesinfra.com/3d-visualization-to-implementation/">3D to Reality</a></li>
                        <li role="presentation" class="nav-item"></li>
                        <li role="presentation" class="nav-item"></li>
                    </ul>
                    <ul class="nav navbar-nav flex-column bottom-nav">
                        <li role="presentation" class="nav-item"><a class="nav-link active"
                                href="https://homesinfra.com/about-us/">About Us</a></li>
                        <li role="presentation" class="nav-item"><a class="nav-link"
                                href="https://homesinfra.com/contact-us/">Contact Us</a></li>
                        <li role="presentation" class="nav-item"><a class="nav-link"
                                href="https://homesinfra.com/privacy-policy/">Privacy Policy</a></li>
                    </ul>
                </div>
            </nav>
            <a class="navbar-brand ml-4"><img width="40px;" src="rd/assets/img/logo-hi.svg" alt=""></a>
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active"></li>
            </ul>
            <a class=" rounded-pill btn bg-orange my-2 my-sm-0" href="">Login</a>

        </nav>
        <div class="container mt-5">
            <div class="row border-right-0 border-left-0 border p-4">
                <div class="col">
                    <h2>Search Query Title</h2>
                </div>
            </div>
            <div class="row">
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
	

		while($row = mysqli_fetch_array($usersReturnedQuery)) {
			// $user_obj = new User($con, $user['username']);

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

//         <div class='col-lg-3 col-md-3 mb-4 mb-lg-0'>
//         <div class='card rounded shadow-sm border-0'>
//             <div class='card-body p-4'>
//             <img
//             src='". $row['profile_pic'] ."'
//             alt='' class='img-fluid d-block mx-auto mb-3'>
//             <h5> <a href='" . $row['username'] ."' class='text-dark'>" . $row['first_name'] . " " . $row['last_name'] .$blank_space.$coa_stat."</a></h5>
//             <p class='small text-muted font-italic'>Lorem ipsum dolor sit amet,
//                 consectetur adipisicing elit.</p>
                    
//                 <div class='text-center mt-2'>
//                 <a name='' id='' class='btn btn-primary' href='" . $row['username'] ."' role='button'>Visit Profile</a>
//                 </div>
//     </div>		
// </div>
// </div>
        
echo "
<div class='col-sm-12 col-md-4 col-lg-3 mt-4'>
        <div class='card'>
            <img src='". $row['profile_pic'] ."' class='card-img-top' alt='...'>
            <div class='card-body px-2 text-center'>
            <h5> <a href='" . $row['username'] ."' class='text-dark'>" . $row['first_name'] . " " . $row['last_name'] .$blank_space.$coa_stat."</a></h5>
            <p class='small text-muted font-italic'>". $row['about_me'] ."</p>
                <div class='btn-group'>
                    <a class=' mr-2 btn btn-primary float-left btn-sm' href='#'>Visit Profile</a>
                    <a class='btn btn-primary float-right btn-sm' href='#'>Send Message</a>
                </div>
            </div>
        </div>
    </div>
";
}	
    }
?>

            </div>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.bundle.min.js">
            </script>
            <script src="rd/assets/js/script.min.js?h=d2143303a086bde999cc9e80b9a772ce"></script>
    </body>

</html>
