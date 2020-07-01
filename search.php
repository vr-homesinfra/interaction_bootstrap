<?php
include("includes/header.php");  

$str="in";
if(isset($_GET['profile'])&& isset($_GET['city'])) {
    $query = $_GET['profile']." ".$str." ".rtrim($_GET['city']);
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
<div class="container-fluid">
    <h3 class="text-gray-900 mb-4">
        <?php $queryDisplay = $_GET['profile']."(s)"." ".$str." ".rtrim($_GET['city']);  echo $queryDisplay = strtoupper($queryDisplay); ?></h3>
</div>
<div class="row m-3">
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
			if(count($names) == 3){
            $usersReturnedQuery = mysqli_query($con, "SELECT * FROM users WHERE (profile LIKE '$names[0]%' AND location LIKE '$names[2]%') AND user_closed='no' LIMIT 8");
            $usersReturnedQueryAdded=NULL;
            }
			// //If query has one word only, search first names or last names 
			// else if(count($names) == 2)
			// 	$usersReturnedQuery = mysqli_query($con, "SELECT * FROM users WHERE (first_name LIKE '$names[0]%' AND last_name LIKE '$names[1]%') AND user_closed='no'");
			
				//If there are four words (for interior designer), assume they are profile and location names respectively
			else if(count($names) == 4){
                $usersReturnedQuery = mysqli_query($con, "SELECT * FROM users WHERE (profile LIKE '$names[0]%' AND location LIKE '$names[3]%') AND user_closed='no'");
                //for added_profile query result
                $usersReturnedQueryAdded = mysqli_query($con, "SELECT * FROM users WHERE (added_profile LIKE '$names[0]%' AND location LIKE '$names[3]%') AND user_closed='no'");
            }
			// else 
			// 	$usersReturnedQuery = mysqli_query($con, "SELECT * FROM users WHERE (first_name LIKE '$names[0]%' OR last_name LIKE '$names[0]%') AND user_closed='no'");
		}
$read_more="...";
$msg="messages.php?u=";
		// Check if results were found 
		if(mysqli_num_rows($usersReturnedQuery) == 0)
			echo "We can't find anyone with a " . $type . " like: " .$query;
	

		while($row = mysqli_fetch_array($usersReturnedQuery)) {
			// $user_obj = new User($con, $user['username']);

			//to display the verified tick
			$blank_space="&nbsp";
			$coa_verified = $row['coa_verified'];
		if ($coa_verified=="yes") {
			$coa_stat= "<i title='Verified' class='fa fa-check' style='font-size: 19px;color: rgb(23,99,247);padding-left: 0px;padding-right: 0px;'>
				</i>";
			} else {
				$coa_stat= "<i title='Not Verified' class='fa fa-exclamation-circle' style='font-size: 19px;color: rgb(23,99,247);padding-left: 0px;padding-right: 0px;'>
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
        $extSearchUname=$row['username'];     
        $extSearchCity=rtrim($_GET['city']);     
        $extSearchProfile=rtrim($_GET['profile']);  
    
echo "
<div class='col-sm-12 col-md-4 col-lg-2 mx-4 mt-4'>
        <div class='card shadow-sm border-0 rounded'>
            <img src='". $row['profile_pic'] ."' class='w-100 card-img-top' alt='...'>
            <div class='card-body px-2 text-center'>
            <h5> <a href='" . $row['username'] ."' class='text-dark'>" . $row['first_name'] . " " . $row['last_name'] .$blank_space.$coa_stat."</a></h5>
            <p class='small text-muted font-italic'>". substr($row['about_me'],0,100) .$read_more."</p>
                <a name='' id='blockButton' class='btn btn-secondary btn-sm' href='" . $row['username'] ."' role='button'>Visit Profile</a>
                <a id='blockButton' class='btn btn-sm btn-secondary ml-2' href='" .$msg. $row['username'] ."' role='button'>Send Message</a>
        </div>
        </div>
        </div>
        ";  
        }
        }

        if(isset($usersReturnedQueryAdded)){
        while($row = mysqli_fetch_array($usersReturnedQueryAdded)) {
			// $user_obj = new User($con, $user['username']);

			//to display the verified tick
			$blank_space="&nbsp";
			$coa_verified = $row['coa_verified'];
		if ($coa_verified=="yes") {
			$coa_stat= "<i class='fa fa-check' style='font-size: 19px;color: rgb(23,99,247);padding-left: 0px;padding-right: 0px;'>
				</i>";
			} else {
				$coa_stat= "<i title='Not Verified' class='fa fa-exclamation-circle' style='font-size: 19px;color: rgb(23,99,247);padding-left: 0px;padding-right: 0px;'>
				</i>";
		}
        $extSearchUname=$row['username'];     
        $extSearchCity=rtrim($_GET['city']);     
        $extSearchProfile=rtrim($_GET['profile']);  
        
echo "
<div class='col-sm-12 col-md-4 col-lg-3 mt-4'>
        <div class='card'>
            <img src='". $row['profile_pic'] ."' class='card-img-top' alt='...'>
            <div class='card-body px-2 text-center'>
            <h5> <a href='" . $row['username'] ."' class='text-dark'>" . $row['first_name'] . " " . $row['last_name'] .$blank_space.$coa_stat."</a></h5>
            <p class='small text-muted font-italic'>". substr($row['about_me'],0,100) .$read_more."</p>
                <div class='btn-group'>
                    <a name='' id='blockButton' class='btn btn-primary btn-sm' href='" . $row[' username'] ."' role='button'>Visit
                        Profile</a>
                    <a id='blockButton' class='btn btn-sm btn-primary ml-2' href='" .$msg. $row[' username'] ."' role='button'>Send
                        Message</a>
                
                
                </div>
        </div>
        </div>
        </div>
        </div>
        ";
        }
    }
        ?>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
    integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
<script src="assets/js/script.min.js"></script>
<script src="rd/assets/js/script.min.js"></script>
<script src="assets/js/rdjsfile.js"></script>
<script src="assets/js/demo.js"></script>
    </body>

    </html>
