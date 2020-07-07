<?php
class FavCreatives {
	private $user_obj;
	private $con;
    public function __construct($con, $user){
		$this->con = $con;
		$user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$user'");
		$this->user = mysqli_fetch_array($user_details_query);
	}
	// public function __construct($con, $user){
	// 	$this->con = $con;
	// 	$this->user_obj = new User($con, $user);
	// }
	
	public function displayFavs() {
		$userLoggedIn = $_SESSION['userLoggedIn'];

        $str = NULL;    
					
        $usernameComma = "," . $userLoggedIn . ",";
		if((strstr($this->user['friend_array'], $usernameComma) || $userLoggedIn == $this->user['username'])) {
			$string = rtrim($this->user['friend_array'], ',');
			$string = ltrim($string, ',');
			$delimiters =",";
            $explodes = explode($delimiters, $string);
        }
            foreach($explodes as $explode) {		
               
            $user_details_query = mysqli_query($this->con, "SELECT * FROM users WHERE username='$explode'");
            
                $row = mysqli_fetch_array($user_details_query);
					$first_name = $row['first_name'];
					$last_name = $row['last_name'];
					$profile_pic = $row['profile_pic'];
                    $user_name = $row['username'];
                    $about_me = substr($row['about_me'],0,100);
                    $coa_verified = $row['coa_verified'];
                    $msg="messages.php?u=";
                    $blank_space="&nbsp";

                    if ($coa_verified=="yes") {
                        $coa_stat= "<i class='fa fa-check' style='font-size: 19px;color: rgb(23,99,247);padding-left: 0px;padding-right: 0px;'>
                            </i>";
                        } else {
                            $coa_stat= "<i class='fa fa-exclamation-circle' style='font-size: 19px;color: rgb(23,99,247);padding-left: 0px;padding-right: 0px;'>
                            </i>";
                    }
                    
                            $str.="
                
                    <div class='col-lg-3 col-md-3 mb-4 mb-lg-0'>
                        <div class='card rounded shadow-sm border-0'>
                            <div class='card-body py-9'>
                                    <img src='". $profile_pic ."'
                                    alt='' class='img-fluid d-block mx-auto mb-3'>
                                    <h5> <a href='" . $user_name ."' class='text-dark data-toggle title=''>" . $first_name . " " . $last_name .$blank_space.$coa_stat. "</a></h5>
                                    <p class='small text-muted font-italic'>$about_me...</p>
                                    
                                    <div class='form-row'>                                
                                            <div class='col'>
                                                <div class='text-center mt-2'>
                                                    <a name='' id='blockButton' class='btn btn-primary btn-sm' href='" . $user_name ."' role='button'>Visit Profile</a>
                                                </div>
                                            </div>
                            
                                             <div class='col'> 
                                                <div class='text-center mt-2'>
                                                    <a id='blockButton' class='btn btn-sm btn-primary' href='" .$msg. $user_name ."' role='button'>Send Message</a>
                                                </div>
                                             </div>                
                                    </div>  		
                            </div>
                            </div>
                            </div>
                        ";	      
       }//foreach statement
       if ($str!=NULL) {
           echo $str;
        } else {
            echo "Kindly Search and add a Professional.";
       }
}	//function displayFavs bracket
}//class bracket
?>
