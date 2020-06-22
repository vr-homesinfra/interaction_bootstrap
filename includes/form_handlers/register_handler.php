<?php
   //Declaring variables to prevent errors
$fname = ""; //First name
$lname = ""; //Last name
$user_profile="";//dropdown values
$city="";
$em = ""; //email
$em2 = ""; //email 2
$password = ""; //password
$password2 = ""; //password 2  
$date = ""; //Sign up date 
$error_array = array(); //Holds error messages

if(isset($_POST['register_button'])){

	//Registration form values

	//First name
	$fname = strip_tags($_POST['reg_fname']); //Remove html tags
	$fname = str_replace(' ', '', $fname); //remove spaces
	$fname = ucfirst(strtolower($fname)); //Uppercase first letter
	$_SESSION['reg_fname'] = $fname; //Stores first name into session variable

	//Last name
	$lname = strip_tags($_POST['reg_lname']); //Remove html tags
	$lname = str_replace(' ', '', $lname); //remove spaces
	$lname = ucfirst(strtolower($lname)); //Uppercase first letter
	$_SESSION['reg_lname'] = $lname; //Stores last name into session variable

	//user profile dropdown
	$user_profile = strip_tags($_POST['user_profile']); //Remove html tags
	$user_profile = str_replace(' ', '', $user_profile); //remove spaces
	$user_profile = ucfirst(strtolower($user_profile)); //Uppercase first letter
	$_SESSION['user_profile'] = $user_profile; //Stores user_profile into session variable

	//city
	$city = strip_tags($_POST['reg_city']); //Remove html tags
	$city = str_replace(' ', '', $city); //remove spaces
	$city = ucfirst(strtolower($city)); //Uppercase first letter
	$_SESSION['reg_city'] = $city; //Stores last name into session variable
		
	//email
	$em = strip_tags($_POST['reg_email']); //Remove html tags
	$em = str_replace(' ', '', $em); //remove spaces
	$em = ucfirst(strtolower($em)); //Uppercase first letter
	$_SESSION['reg_email'] = $em; //Stores email into session variable

	//email 2
	$em2 = strip_tags($_POST['reg_email2']); //Remove html tags
	$em2 = str_replace(' ', '', $em2); //remove spaces
	$em2 = ucfirst(strtolower($em2)); //Uppercase first letter
	$_SESSION['reg_email2'] = $em2; //Stores email2 into session variable

	//Password
	$password = strip_tags($_POST['reg_password']); //Remove html tags
	$password2 = strip_tags($_POST['reg_password2']); //Remove html tags

    $date = date("Y-m-d"); //Current date
    
    if ($em==$em2) {
        //check if email is in valid format
        if (filter_var($em,FILTER_VALIDATE_EMAIL)) {
            $em=filter_var($em,FILTER_VALIDATE_EMAIL);
            //check if email already exists
            $e_check=mysqli_query($con,"SELECT email from users WHERE email='$em'");
            //count the number of rows returned
            $num_rows=mysqli_num_rows($e_check);
            if($num_rows>0){
                array_push($error_array,"email already in use<br>");
            }
        }else{
            array_push($error_array,"Invalid format<br>");
        }
    } else {
        array_push($error_array, "Emails do not match<br>");
    }
    
    if (strlen($fname)>25|| strlen($fname)<2) {
        array_push($error_array,"Your first name must be between 2 & 25 characters<br>");
    }
    if (strlen($lname)>25||strlen($lname)<2) {
        array_push($error_array, "Your last name must be between 2 & 25 characters<br>");
    }
    if ($password!=$password2) {
        array_push($error_array, "Your passwords do not match<br>");
    } else {
        if (preg_match('/[^A-Za-z0-9]/',$password)) {
            array_push($error_array, 'Your password can contain only alphabets & numbers<br>');
        }
    }
    if(strlen($password)>30||strlen($password)<5){
        array_push($error_array, "Your password must be between 5 and 30 characters<br>");
    }    
    //check username
    if (empty($error_array)) {
        $password = md5($password); //Encrypt password before sending to database

		//Generate username by concatenating first name and last name
        $username = strtolower($fname . "_" . $lname);
        
		$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
		$i = 0; 
		//if username exists add number to username
		while(mysqli_num_rows($check_username_query) != 0) {
			$i++; //Add 1 to i
			$username = $username . "_" . $i;
			$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
		}

        $rand=rand(1,16);
        switch ($rand) {
            case 1:
                $profile_pic="assets/images/profile_pics/defaults/head_alizarin.png.";
            break;
            case 2:
                $profile_pic="assets/images/profile_pics/defaults/head_amethyst.png.";
            break;
            case 3:
                $profile_pic="assets/images/profile_pics/defaults/head_belize_hole.png.";
            break;
            case 4:
                $profile_pic="assets/images/profile_pics/defaults/head_carrot.png.";
            break;
            case 5:
                $profile_pic="assets/images/profile_pics/defaults/head_deep_blue.png.";
            break;
            case 6:
                $profile_pic="assets/images/profile_pics/defaults/head_emerald.png.";
            break;
            case 7:
                $profile_pic="assets/images/profile_pics/defaults/head_green_sea.png.";
            break;
            case 8:
                $profile_pic="assets/images/profile_pics/defaults/head_nephritis.png.";
            break;
            case 9:
                $profile_pic="assets/images/profile_pics/defaults/head_pete_river.png.";
            break;
            case 10:
                $profile_pic="assets/images/profile_pics/defaults/head_pomegranate_.png.";
            break;
            case 11:
                $profile_pic="assets/images/profile_pics/defaults/head_pumpkin.png.";
            break;
            case 12:
                $profile_pic="assets/images/profile_pics/defaults/head_red.png.";
            break;
            case 13:
                $profile_pic="assets/images/profile_pics/defaults/head_sun_flower.png.";
            break;
            case 14:
                $profile_pic="assets/images/profile_pics/defaults/head_turquoise.png.";
            break;
            case 15:
                $profile_pic="assets/images/profile_pics/defaults/head_wet_asphalt.png.";
            break;
            case 16:
                $profile_pic="assets/images/profile_pics/defaults/head_wisteria.png.";
            break;
            default:
            $profile_pic="assets/images/profile_pics/defaults/head_carrot.png.";
        }
        $query = mysqli_query($con, "INSERT INTO users VALUES ('', '$fname', '$lname','$user_profile','$city', '$username', '$em', '$password', '$date', '$profile_pic', '0', '0', 'no', ',')");
        
        array_push($error_array, "<span style='color: #14C800;'>You're all set! Go ahead and login!</span><br>");
        
        //Clear session variables 
        $_SESSION['reg_fname'] = "";
        $_SESSION['reg_lname'] = "";
        $_SESSION['reg_email'] = "";
        $_SESSION['reg_email2'] = "";
        $_SESSION['reg_city'] = "";
    } 
}  
?>
