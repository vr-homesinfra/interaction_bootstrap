<?php
include("../../config/config.php");
include("../../includes/classes/User.php");
$query = $_POST['query'];

//If query contains an underscore, assume user is searching for usernames
	$usersReturnedQuery = mysqli_query($con, "SELECT city_name FROM cities WHERE city_name LIKE '$query%' LIMIT 5");	
	// <p id='rdx-".$i."' class='card-test mb-0 city'>" . $row['city_name']." </p>
if($query != ""){
$i=1;
if(isset($usersReturnedQuery)){
    echo "<div class='card mt-0' style='max-width: 500rem;'>";	
	while($row = mysqli_fetch_array($usersReturnedQuery)) {
			
		echo "		
		                        <div class='row dropdown-item no-gutters border-bottom'>
                                    
                                    <div class='col-10'>
                                        <div class='card-body p-2'>
                                        <p id='rdx-".$i."' class='card-test mb-0 city'>" . $row['city_name']." </p>
        
                                        </div>
                                    </div>
								</div>                            		
				";
    $i++;
            }
    echo "</div>";
}
	
}
?>
