<?php
include("../../config/config.php");
include("../../includes/classes/User.php");
$list_first_name_in_city="";
$query = $_POST['query'];
// $userLoggedIn = $_POST['userLoggedIn'];

$names = explode(" ", $query);
//If query contains an underscore, assume user is searching for usernames
if(strpos($query, '_') !== false) 
	$usersReturnedQuery = mysqli_query($con, "SELECT * FROM users WHERE username LIKE '$query%' AND user_closed='no' LIMIT 8");	
	
//If there are two words, assume they are first and last names respectively
else if(count($names) == 2)
	$usersReturnedQuery = mysqli_query($con, "SELECT * FROM cities WHERE (first_name LIKE '$names[0]%' AND last_name LIKE '$names[1]%') AND user_closed='no' LIMIT 8");

//3 words search
else if(count($names) == 3){
//first_name in city
$usersReturnedQuery1 = mysqli_query($con, "SELECT * FROM users WHERE (first_name LIKE '$names[0]%' AND location LIKE '$names[2]%') AND user_closed='no' LIMIT 8");
	
//last_name in city
$usersReturnedQuery2 = mysqli_query($con, "SELECT * FROM users WHERE (last_name LIKE '$names[0]%' AND location LIKE '$names[2]%') AND user_closed='no' LIMIT 8");

//profile in city
$usersReturnedQuery3 = mysqli_query($con, "SELECT * FROM users WHERE (profile LIKE '$names[0]%' AND location LIKE '$names[2]%') AND user_closed='no' LIMIT 8");
}
//If there are four words (for interior designer), assume they are profile and location names respectively
else if(count($names) == 4)
$usersReturnedQuery = mysqli_query($con, "SELECT * FROM users WHERE (profile LIKE '$names[0]%' AND location LIKE '$names[3]%') AND user_closed='no' LIMIT 8");

//If query has one word only, search first names or last names 
else 
	$usersReturnedQuery = mysqli_query($con, "SELECT * FROM users WHERE (first_name LIKE '$names[0]%' OR last_name LIKE '$names[0]%') AND user_closed='no' LIMIT 8");


if($query != ""){

if(isset($usersReturnedQuery)){	
	while($row = mysqli_fetch_array($usersReturnedQuery)) {
		// $user = new User($con, $userLoggedIn);

		// if($row['username'] != $userLoggedIn)
		// 	$mutual_friends = $user->getMutualFriends($row['username']) . " friends in common";
		// else 
		// 	$mutual_friends = "";

		// <div class='resultDisplay'>
		// 		<a href='" . $row['username']."' style='color: #1485BD'>
		// 			<div class='liveSearchProfilePic'>
		// 				<img src='". $row['profile_pic'] ."'>
		// 			</div>	

		// 			<div class='liveSearchText'>
		// 				" . $row['first_name'] . " " . $row['last_name'] . "
		// 				<p>" . $row['username'] ."</p>	
						
		// 			</div>
		// 		</a>
		// 		</div>		
		echo "
		<a href='" . $row['username']."' style='color: #1485BD'>
		<div class='row no-gutters border-bottom'>
                                    <div class='col-2'>
                                        <img style='width:38px;' class=' rounded-circle p-1 card-img'
                                            src='". $row['profile_pic'] ."'
                                            alt=''>
                                    </div>
                                    <div class='col-10'>
                                        <div class='card-body p-2'>
                                            <p class='card-test mb-0'>" . $row['first_name']." ". $row['last_name']."</p>
                                        </div>
                                    </div>
								</div>	</a>
								
								<div class='modal fade' id='exampleModalCenter' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
  <div class='modal-dialog modal-dialog-centered' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLongTitle'>Modal title</h5>
        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>
      <div class='modal-body'>
        ...
      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
        <button type='button' class='btn btn-primary'>Save changes</button>
      </div>
    </div>
  </div>
</div>
				
				";
	}
}
	
if(isset($usersReturnedQuery1)){ 
				while($row = mysqli_fetch_array($usersReturnedQuery1)) {
								
						echo "
						<a href='" . $row['username']."' style='color: #1485BD'>
			<div class='row no-gutters border-bottom'>
										<div class='col-2'>
											<img style='width:38px;' class=' rounded-circle p-1 card-img'
												src='". $row['profile_pic'] ."'
												alt=''>
										</div>
										<div class='col-10'>
											<div class='card-body p-2'>
												<p class='card-test mb-0'>" . $row['first_name']." ". $row['last_name']."</p>
											</div>
										</div>
									</div>	</a>";

	}
}

if(isset($usersReturnedQuery2)){ 
	while($row = mysqli_fetch_array($usersReturnedQuery2)) {
					
		echo "
		<a href='" . $row['username']."' style='color: #1485BD'>
		<div class='row no-gutters border-bottom'>
                                    <div class='col-2'>
                                        <img style='width:38px;' class=' rounded-circle p-1 card-img'
                                            src='". $row['profile_pic'] ."'
                                            alt=''>
                                    </div>
                                    <div class='col-10'>
                                        <div class='card-body p-2'>
                                            <p class='card-test mb-0'>" . $row['first_name']." ". $row['last_name']."</p>
                                        </div>
                                    </div>
                                </div>	</a>
				
				";

}
}
if(isset($usersReturnedQuery3)){ 
	while($row = mysqli_fetch_array($usersReturnedQuery3)) {
					
		echo "
		<a href='" . $row['username']."' style='color: #1485BD'>
		<div class='row no-gutters border-bottom'>
                                    <div class='col-2'>
                                        <img style='width:38px;' class=' rounded-circle p-1 card-img'
                                            src='". $row['profile_pic'] ."'
                                            alt=''>
                                    </div>
                                    <div class='col-10'>
                                        <div class='card-body p-2'>
                                            <p class='card-test mb-0'>" . $row['first_name']." ". $row['last_name']."</p>
                                        </div>
                                    </div>
                                </div>	</a>
				
				";

}
}

}
?>
