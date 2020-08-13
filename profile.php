<?php
include("includes/header.php");
?>
<div class="container-fluid">
    <?php
        if(isset($_GET['profile_username'])) {
                $username = $_GET['profile_username'];
                if (isset($_SESSION['uname'])) {
                # code...
                $_SESSION['uname']=$username;
                // print_r($check);
                unset($_SESSION["uname"]);}
                $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$username'");
                $user_array = mysqli_fetch_array($user_details_query);
                $fname=$user_array['first_name'];
                $lname=$user_array['last_name'];
                $profilePic=$user_array['profile_pic'];
                $mobile_no=$user_array['mobile_no'];
                $about_me=$user_array['about_me'];
                $coa_verified=$user_array['coa_verified'];
                $user_profile=$user_array['profile'];
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
    <div class="border-0 profile-card" style="background-color: rgba(255,255,255,0);">
        <div class="profile-back bg-white">
        </div>
        <img class="rounded-circle img-fluid border rounded profile-pic" src="<?php
            echo $profilePic;
        ?>">
        <h3 class="text-dark">
            <?php
            echo $full_name=$fname." ".$lname;
        ?>
            <?php
    if ($coa_verified=="yes") {
        echo "<i class='fa fa-check' style='font-size: 19px;color: rgb(23,99,247);padding-left: 0px;padding-right: 0px;' data-toggle='tooltip' data-placement='right' title='Verified'>
            </i>";
    } else {
        echo "<i class='fa fa-exclamation-circle' style='font-size: 19px;color: rgb(23,99,247);padding-left: 0px;padding-right: 0px;' data-toggle='tooltip' data-placement='right' title='Not Verified'>
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
                <button class=" btn btn-warning btn-sm flex-fill" type="submit" name="add_friend" style="color: rgb(0,0,0);">Add as Favourite</button>
    </div>';
    }
    ?>
        </form>
        <div class="row">
            <div class="col-md-6 mx-auto">
                <p class="text-gray-900">
                    <?php echo $about_me; ?>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mx-auto">
                <span>
                <?php                      
                $mask_number =  str_repeat("*", strlen($mobile_no)-4) . substr($mobile_no, -4);                                         
                echo $mask_number;
                ?>
                </span>
                <!-- <form id="request_mob_no"> -->
                <span>
                    <!-- <input type="hidden" class="form-control" name="" id='reqMobNoHid'
                            value='<?php echo $msg.$username?>'>

                        <a class='btn btn-primary btn-sm' role='button' name='' id='reqMobNo'
                            href='<?php echo $msg.$username?>'>Request No.</a> -->

                    <!-- <a href="<?php echo $msg.$username?>"> -->
                    <button type="button" id='reqMobNo' value='<?php echo $msg.$username?>' class="btn btn-info">Request
                        No.</button>
                    <!-- </a> -->

                </span>
                <!-- </form> -->
            </div>
        </div>
    </div>
    <div class="card shadow-sm">
        <div class="card-header py-3">
            <p class="text-gray-900 m-0 font-weight-bold">Gallery</p>
        </div>
        <div class="card-body">
            <div>
                <?php if(!$result->num_rows) { echo "No Gallery Uploaded!";} ?>
            </div>
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
                        <img class="d-block m-auto" src="<?=
					$row['filepath'];  
					?>" height="400px">
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
        <div class="text-center my-auto copyright"><span>Copyright © HomesInfra 2020 | Made with <i class='fas fa-heart'></i> for your homes.</span></div>
    </div>
</footer>
</div>
<a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
</div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
<script src="rd/assets/js/script.min.js"></script>
<script src="assets/js/rdjsfile.js"></script>
<script src="assets/js/demo.js"></script>

<script>
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})


$(document).ready(function() {
    $('#reqMobNo').on('click', function(e) {
        //Stop the form from submitting itself to the server.
        e.preventDefault();
        var reqMobNo = $('#reqMobNo').val();
        $.ajax({
            type: "POST",
            url: 'testProfile.php',
            data: {
                reqMobNo: reqMobNo
            },
            success: function(data) {
                window.location.replace(reqMobNo);
            }
        });
    });
});
</script>
</html>
