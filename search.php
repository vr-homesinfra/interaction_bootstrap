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
        <?php $queryDisplay = $_GET['profile']."(s)"." ".$str." ".rtrim($_GET['city']);  echo $queryDisplay = strtoupper($queryDisplay); ?>
    </h3>

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
		    if(date("j m") < '15 08'){
		    echo "The Listing will be Live from 15th of August on Independence Day.";
		    }else{
            echo "We can't find anyone with a " . $type . " like: " .$query;
            }
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
        $extSearchUname=$row['username'];     
        $extSearchCity=rtrim($_GET['city']);     
        $extSearchProfile=rtrim($_GET['profile']);  
    
echo "
<div class='col-sm-12 col-md-4 col-lg-3 mt-4'>
    <div class='card shadow-sm border-0 rounded'>
        <div class='card-header bg-white'>
            <div class='row'>
                <div class='col-4 '>
                    <img style='max-width:100px;' src='". $row['profile_pic'] ."' class='w-100 rounded-circle border' alt='...'>
                </div>
                <div class='col-8 m-auto'>
                    <h4 class='m-0'> <a href='" . $row['username'] ."' class='text-dark'>" . $row['first_name'] . " " . $row['last_name'] .$blank_space.$coa_stat."</a></h4>
                </div>
            </div>
        </div>
        <div class='card-body px-2 text-center'>
            <div class='row'>
                <div class='col'><p class='small text-muted font-italic'>". substr($row['about_me'],0,100) .$read_more."</p></div>
            </div>
            <div class='row'>
                <div class='col'>
                    <a name='' id='blockButton' class='btn btn-secondary btn-sm' href='" . $row['username'] ."' role='button'>Visit Profile</a>
                </div>
                <div class='col'>
                    <a id='blockButton' class='btn btn-sm btn-secondary ml-2' href='" .$msg. $row['username'] ."' role='button'>Send Message</a>
                </div>
            </div>
        </div>
    </div>
</div>
        ";  
// echo "
// <div class='col-sm-12 col-md-4 col-lg-3 mx-3 mt-4'>
//         <div class='card shadow-sm border-0 rounded'>
//             <img src='". $row['profile_pic'] ."' class='w-100 card-img-top' alt='...'>
//             <div class='card-body px-2 text-center'>
//             <h5> <a href='" . $row['username'] ."' class='text-dark'>" . $row['first_name'] . " " . $row['last_name'] .$blank_space.$coa_stat."</a></h5>
//             <p class='small text-muted font-italic'>". substr($row['about_me'],0,100) .$read_more."</p>
//                 <a name='' id='blockButton' class='btn btn-secondary btn-sm' href='" . $row['username'] ."' role='button'>Visit Profile</a>
//                 <a id='blockButton' class='btn btn-sm btn-secondary ml-2' href='" .$msg. $row['username'] ."' role='button'>Send Message</a>
//         </div>
//         </div>
//         </div>
//         ";  
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
    </div>
</div>
<footer class="bg-white mt-2 sticky-footer">
        <div class="container my-auto">
            <div class="text-center my-auto copyright"><span>Copyright © HomesInfra 2020</span></div>
        </div>
    </footer>
<a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
</div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
    integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
<script src="rd/assets/js/script.min.js"></script>
<script src="assets/js/rdjsfile.js"></script>
<script src="assets/js/demo.js">
</script>
</body>

</html>
