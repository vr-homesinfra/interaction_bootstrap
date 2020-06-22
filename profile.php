<?php
include("includes/header.php");

?>
<div class="container-fluid">
    <?php
        if(isset($_GET['profile_username'])) {
              $username = $_GET['profile_username'];
               $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$username'");
               $user_array = mysqli_fetch_array($user_details_query);
               $fname=$user_array['first_name'];
               $lname=$user_array['last_name'];
               $profilePic=$user_array['profile_pic'];
               $mobile_no=$user_array['mobile_no'];
               $about_me=$user_array['about_me'];
               $coa_verified=$user_array['coa_verified'];
               $msg="messages.php?u=";

           }  
           //for gallery
           $result=$con->query("SELECT * FROM creative_gallery WHERE uploaded_by='$username' ORDER BY id DESC");
           //remove friend functionality
        if (isset($_POST['remove_friend'])) {
            $user=new User ($con,$userLoggedIn);
            $user->removeFriend($username);
        }
        //add friend functionality
        if (isset($_POST['add_friend'])) {
            $add_friend_query=mysqli_query($con,"UPDATE users SET friend_array=CONCAT(friend_array,'$username,')WHERE username='$userLoggedIn'");
        }
    ?>
    <div class="border-white profile-card" style="background-color: rgba(255,255,255,0);">
        <div class="profile-back" style="background-color: rgb(238,140,69);">
        </div>
        <img class="rounded-circle img-fluid border rounded profile-pic" src="<?php
          echo $profilePic;
        ?>">
        <h3 class="profile-name" style="background-color: rgb(238,140,69);">
            <?php
            echo $full_name=$fname." ".$lname;
        ?>
            <?php
    if ($coa_verified=="yes") {
        echo "<i class='fa fa-check' style='font-size: 19px;color: rgb(23,99,247);padding-left: 0px;padding-right: 0px;'>
            </i>";
    } else {
        echo "<i class='fa fa-exclamation-circle' style='font-size: 19px;color: rgb(23,99,247);padding-left: 0px;padding-right: 0px;'>
            </i>";
    }
?>

        </h3>
        <form method="POST" action="<?php echo $username; ?>">

            <?php
 			$logged_in_user_obj = new User($con, $userLoggedIn); 
             if($logged_in_user_obj->isFriend($username)) {
                echo '<div class="form-group">
                <button class=" btn btn-warning  btn-sm flex-fill" type="submit" name="remove_friend" style="color: rgb(0,0,0);line-height: 18px;">Remove as
                    Favourite</button>
            </div>';
            }else{
                echo '<div class="form-group">
                <button class=" btn btn-warning  btn-sm flex-fill" type="submit" name="add_friend" style="color: rgb(0,0,0);line-height: 18px;">Add
            as
            Favourite</button>
    </div>';
    }
    ?>

        </form>

        <p class="profile-bio"><?php
            echo $about_me;
        ?>&nbsp;
        </p>
        <ul class="list-group">
            <li class="list-group-item list-group-item-primary" style="background-color: rgb(255,255,255);">
                <i class="fa fa-volume-control-phone" style="font-size: 22px;">
                </i>
                <span>&nbsp;
                    <?php                      
                        $mask_number =  str_repeat("*", strlen($mobile_no)-4) . substr($mobile_no, -4);                                         
                    echo $mask_number;    
                    ?>
                </span>
                <span>&nbsp; &nbsp;<?php
                    echo " <a name='' id='' class='btn btn-primary btn-sm' href='" .$msg. $username ."' role='button'>Request No. </a>";
                ?>
                </span>
            </li>
        </ul>
    </div>
    <div class="card shadow">
        <div class="card-header py-3">
            <p class="text-primary m-0 font-weight-bold">Gallery</p>
        </div>
        <div class="card-body">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <?php
				  $i=0;
				  foreach ($result as $row) {
					  $actives='';
					  if ($i==0) {
						  $actives="active";
					  }
				?>
                    <li data-target="#carouselExampleIndicators" data-slide-to="<?=
				  $i;  
				?>" class="<?=
				  $actives;  
				?>"></li>
                    <?php
				$i++;
			}
				?>
                </ol>
                <div class="carousel-inner">
                    <?php
				  $i=0;
				  foreach ($result as $row) {
					  $actives='';
					  if ($i==0) {
						  $actives="active";
					  }				    
				?>
                    <div class="carousel-item <?=
				  $actives;  
				?>">
                        <img class="d-block w-100" src="<?=
					  $row['filepath'];  
					?>" width="100%" height="400px">
                    </div>
                    <?php
				$i++;
				  }				  
				?>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
</div>
</div>

<footer class="bg-white sticky-footer">
    <div class="container my-auto">
        <div class="text-center my-auto copyright"><span>Copyright © HomesInfra 2020</span></div>
    </div>
</footer>
</div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a></div>
<script src="assets/js/jquery-3.4.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js">
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
<script src="assets/js/script.min.js"></script>
<script src="assets/js/rdjsfile.js"></script>

</html>
