<?php
include("includes/header.php");  
// include("includes/form_handlers/settings_handler.php");
$profile_pic = $user['profile_pic'];
$user_profile = $user['profile'];
//profile pic upload section start

if(isset($_POST['change_profile_pic_button'])){
    
	$uploadOk1 = 1;
	$imageName1 = $_FILES['fileToUpload1']['name'];
	$errorMessage = "";

	if($imageName1 != "") {
		$targetDir1 = "assets/images/profile_pics/";
		$imageName1 = $targetDir1 . uniqid() . basename($imageName1);
		$imageFileType1 = pathinfo($imageName1, PATHINFO_EXTENSION);

		if($_FILES['fileToUpload1']['size'] > 10000000) {
			$errorMessage1 = "Sorry your file is too large";
			$uploadOk1 = 0;
		}

		if(strtolower($imageFileType1) != "jpeg" && strtolower($imageFileType1) != "png" && strtolower($imageFileType1) != "jpg") {
			$errorMessage1 = "Sorry, only jpeg, jpg and png files are allowed";
			$uploadOk1 = 0;
		}
		if($uploadOk1) {
			if(move_uploaded_file($_FILES['fileToUpload1']['tmp_name'], $imageName1)) {
                //image uploaded okay
			}
			else {
				//image did not upload
                $uploadOk1 = 0;
			}
		}
	}
	if($uploadOk1) {
		//update data 
        $update_query1 = mysqli_query($con, "UPDATE users SET profile_pic='$imageName1' WHERE username='$userLoggedIn'");
        // $returned_id = mysqli_insert_id($this->con);
}
	else {
		echo "<div style='text-align:center;' class='alert alert-danger'>
				$errorMessage
			</div>";
	}
}
//gallery images upload section ends
$result=$con->query("SELECT * FROM users WHERE username='$userLoggedIn'");
$row = mysqli_fetch_array($result);
//profile pic upload section ends
?>
<div class="container-fluid">
    <h3 class="text-dark mb-4">Profile: <?php
      echo $row['profile'];  
    ?>
    </h3>
    <div class="row mb-3">
        <div class="col-lg-4">
            <div class="card mb-3">
                <div class="card-body text-center shadow">
                    <img class="rounded-circle mb-3 mt-4" src="<?php echo $row['profile_pic']; ?>" width="160"
                        height="160">
                    <div class="mb-3">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="text-center">
                                <input type="file" id="user_group_logo" class="custom-file-input" accept="image/*"
                                    name="fileToUpload1">
                                <div class="text-center">
                                    <label id="user_group_label" for="user_group_logo">
                                        <i class="fas fa-upload"></i> Upload Picture</label>

                                </div>
                                <button class="btn btn-primary mt-2" type="submit" name="change_profile_pic_button">
                                    Upload</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card shadow">

                <!-- <div class="card-body">

                </div> -->
            </div>

            <div class=" card shadow mb-4">

                <!-- <div class="card-body">


                </div> -->
            </div>
        </div>

        <?php
	if(isset($_POST['contact_settings_submit'])) {  
              
        $email=$_POST['email'];
        $office_no=$_POST['office_no'];
        $residential_address=$_POST['residential_address'];
        $office_address=$_POST['office_address'];   
        
            $query = mysqli_query($con, "UPDATE users SET email='$email', office_no='$office_no', residential_address='$residential_address',office_address='$office_address' WHERE username='$userLoggedIn'");             
        }
    
        if(isset($_POST['about_me_submit'])) {  
                  
            $coa_no=$_POST['coa_no'];
            $about_me=$_POST['about_me'];
            $instagram_id=$_POST['instagram_id'];
            $facebook_id=$_POST['facebook_id'];
            $youtube_id=$_POST['youtube_id'];   
            $linkedin_id=$_POST['linkedin_id'];   
            
                $query = mysqli_query($con, "UPDATE users SET coa_no='$coa_no',about_me='$about_me', 	instagram_id='$instagram_id', facebook_id='$facebook_id',youtube_id='$youtube_id',linkedin_id='$linkedin_id' WHERE username='$userLoggedIn'");             
            }
	?>

        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header py-3">
                    <p class="text-primary m-0 font-weight-bold">Contact Settings</p>
                </div>
                <div class="card-body">
                    <form action="" method="POST">

                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <input class="form-control" type="email" placeholder="email" name="email" value="">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Office No." name="office_no"
                                        maxlength="11">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Residential Address"
                                        name="residential_address">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Office Address"
                                        name="office_address">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-sm" type="submit"
                                name="contact_settings_submit">Save&nbsp;Settings</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card shadow">
                <div class="card-header py-3">
                    <p class="text-primary m-0 font-weight-bold">About Me</p>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="COA No." name="coa_no">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="About Me" name="about_me"
                                        rows="2"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Instagram Id."
                                        name="instagram_id">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Facebook Id."
                                        name="facebook_id">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Youtube Id." name="youtube_id">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Linkedin Id."
                                        name="linkedin_id">
                                </div>
                            </div>
                        </div>
                        <div class="form-group"><button class="btn btn-primary btn-sm" type="submit"
                                name="about_me_submit">Save&nbsp;Settings</button>
                        </div>
                    </form>
                </div>
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
</div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
</div>
<script src="assets/js/jquery-3.4.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js">
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
<script src="assets/js/script.min.js"></script>
<script src="assets/js/rdjsfile.js"></script>
</body>

</html>
