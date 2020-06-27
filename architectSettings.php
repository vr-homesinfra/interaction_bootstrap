<?php
include("includes/header.php");  
// include("includes/form_handlers/settings_handler.php");
$profile_pic = $user['profile_pic'];
$user_profile = $user['profile'];
 $added_profile = $user['added_profile'];

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
    <h3 class="text-gray-900 mb-4">Profile: <?php echo $row['profile'];?></h3>
    <div class="row mb-3">
        <div class="col-lg-4">
            <div class="card mb-3">
                <div class="card-body text-center shadow">
                    <img class="rounded-circle mb-3 mt-4" src="<?php echo $row['profile_pic']; ?>" width="160"
                        height="160">
                    <div class="mb-3">
                        <form action="architectSettings.php" method="POST" enctype="multipart/form-data"
                            name="profile_upload">
                            <div class="text-center">
                                <input type="file" id="user_group_logo" class="custom-file-input" accept="image/*"
                                    name="fileToUpload1">
                                <div class="text-center">
                                    <label id="user_group_label" class="btn border-bottom-primary btn-light shadow"
                                        for="user_group_logo">
                                        <i class="fas fa-upload"></i> Upload Picture</label>

                                </div>
                                <button class="btn btn-primary mt-2" type="submit" name="change_profile_pic_button"
                                    value="change_profile_pic_button" id="change_profile_pic_button">
                                    Upload</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card shadow mb-3">
                <div class="card-header py-3">
                    <p class="text-gray-900 m-0 font-weight-bold">Contact Settings</p>
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="col">
                            <form id="save_contact_settings">

                                <input type="hidden" class="form-control" name="inputName" id="isPressedContactSettings"
                                    value="isPressedContactSettings">

                                <div class="form-group">
                                    <input class="form-control" type="email" placeholder="Email" name="email" id="email"
                                        value="<?php echo $user['email'];?>" autocomplete="off">
                                </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="Office Number" id="office_no"
                                    value="<?php echo $user['office_no'];?>" maxlength="11" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="Residential Address"
                                    id="residential_address" value="<?php echo $user['residential_address'];?>"
                                    autocomplete="off">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="Office Address" id="office_address"
                                    value="<?php echo $user['office_address'];?>" autocomplete="off">
                            </div>
                        </div>
                    </div>

                    <div class="custom-control custom-checkbox mb-3">
                        <input type="checkbox" class="custom-control-input" id="reg_as_int_des" <?php 
                            if ($added_profile == "interior") { 
                                echo "checked='checked'"; 
                                echo "value='no'";  
                            } 
                            // elseif($added_profile == "no"){
                            //     echo "value='interior'";                                    
                            //     echo "checked='unchecked'"; 
                            //     }
                                ?>>
                        <label class="custom-control-label" for="reg_as_int_des">Register as an Interior Designer
                            also</label>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-sm mt-2" type="submit">
                            Save Settings</button>
                    </div>
                </div>
            </div>

            </form>
            <div class="card shadow">
                <div class="card-header py-3">
                    <p class="text-gray-900 m-0 font-weight-bold">About Me</p>
                </div>
                <div class="card-body">
                    <form id="about_me_settings">

                        <div class="form-group">
                            <input type="hidden" class="form-control" name="inputName" id="isPressed" value="is_pressed"
                                autocomplete="off">
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="COA No." id="coa_no"
                                        value="<?php echo $user['coa_no'];?>" autocomplete="off" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="About Me" id="about_me"
                                        rows="2"><?php echo $user['about_me'];?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Instagram Id."
                                        id="instagram_id" value="<?php echo $user['instagram_id'];?>"
                                        autocomplete="off" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Facebook Id." id="facebook_id"
                                        value="<?php echo $user['facebook_id'];?>" autocomplete="off" />
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Youtube Id." id="youtube_id"
                                        value="<?php echo $user['youtube_id'];?>" autocomplete="off" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Linkedin Id." id="linkedin_id"
                                        value="<?php echo $user['linkedin_id'];?>" autocomplete="off" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-sm" type="submit">Save&nbsp;Settings</button>
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

<!-- contact settings section -->
<script>
$(document).ready(function() {
    $('#save_contact_settings').on('submit', function(e) {
        //Stop the form from submitting itself to the server.
        e.preventDefault();
        var isPressedContactSettings = $('#isPressedContactSettings').val();
        var email = $('#email').val();
        var office_no = $('#office_no').val();
        var residential_address = $('#residential_address').val();
        var office_address = $('#office_address').val();
        var reg_as_int_des = $('#reg_as_int_des').val();

        $.ajax({
            type: "POST",
            url: 'architectSettingsSubmit.php',
            data: {
                isPressedContactSettings: isPressedContactSettings,
                email: email,
                office_no: office_no,
                residential_address: residential_address,
                office_address: office_address,
                reg_as_int_des: reg_as_int_des
            },
            success: function(data) {
                alert("updated successfully");
            }
        });
    });
});
</script>
<!-- about me section -->
<script>
$(document).ready(function() {
    $('#about_me_settings').on('submit', function(e) {
        //Stop the form from submitting itself to the server.
        e.preventDefault();
        var isPressed = $('#isPressed').val();
        var coa_no = $('#coa_no').val();
        var about_me = $('#about_me').val();
        var instagram_id = $('#instagram_id').val();
        var facebook_id = $('#facebook_id').val();
        var youtube_id = $('#youtube_id').val();
        var linkedin_id = $('#linkedin_id').val();

        $.ajax({
            type: "POST",
            url: 'architectSettingsSubmit.php',
            data: {
                isPressed: isPressed,
                coa_no: coa_no,
                about_me: about_me,
                instagram_id: instagram_id,
                facebook_id: facebook_id,
                youtube_id: youtube_id,
                linkedin_id: linkedin_id
            },
            success: function(data) {

                alert("updated successfully");
            }
        });
    });
});
</script>

</body>

</html>
