<?php
include("includes/header.php");  
// include("includes/form_handlers/settings_handler.php");
$profile_pic = $user['profile_pic'];
$user_profile = $user['profile'];
$added_profile = $user['added_profile'];

//profile pic upload section start

// if(isset($_POST['change_profile_pic_button'])){
    
// 	$uploadOk1 = 1;
// 	$imageName1 = $_FILES['fileToUpload1']['name'];
// 	$errorMessage = "";

// 	if($imageName1 != "") {
// 		$targetDir1 = "assets/images/profile_pics/";
// 		$imageName1 = $targetDir1 . uniqid() . basename($imageName1);
// 		$imageFileType1 = pathinfo($imageName1, PATHINFO_EXTENSION);

// 		if($_FILES['fileToUpload1']['size'] > 10000000) {
// 			$errorMessage1 = "Sorry your file is too large";
// 			$uploadOk1 = 0;
// 		}

// 		if(strtolower($imageFileType1) != "jpeg" && strtolower($imageFileType1) != "png" && strtolower($imageFileType1) != "jpg") {
// 			$errorMessage1 = "Sorry, only jpeg, jpg and png files are allowed";
// 			$uploadOk1 = 0;
// 		}
// 		if($uploadOk1) {
// 			if(move_uploaded_file($_FILES['fileToUpload1']['tmp_name'], $imageName1)) {
//                 //image uploaded okay
// 			}
// 			else {
// 				//image did not upload
//                 $uploadOk1 = 0;
// 			}
// 		}
// 	}
// 	if($uploadOk1) {
// 		//update data 
//         $update_query1 = mysqli_query($con, "UPDATE users SET profile_pic='$imageName1' WHERE username='$userLoggedIn'");
//         // $returned_id = mysqli_insert_id($this->con);
// }
// 	else {
// 		echo "<div style='text-align:center;' class='alert alert-danger'>
// 				$errorMessage
// 			</div>";
// 	}
// }
//gallery images upload section ends
$result=$con->query("SELECT * FROM users WHERE username='$userLoggedIn'");
$row = mysqli_fetch_array($result);
//profile pic upload section ends
?>

<div class="container-fluid">
    <h3 class="text-gray-900 mb-4">Profile: <?php echo $row['profile'];?></h3>
    <div class="row mb-3">
        <div class="col-lg-4">
            <div class="card shadow-sm mb-3">
                <div class="card-body text-center">
                    <!-- <img class="rounded-circle mb-3 mt-4" src="<?php echo $row['profile_pic']; ?>" width="160"
                        height="160"> -->
                    <span id="uploaded_image"><img class="rounded-circle mb-3 mt-4"
                            src="<?php echo $row['profile_pic']; ?>" width="160" height="160"></span>
                    <div class="mb-3">
                        <!-- <form action="architectSettings.php" method="POST" enctype="multipart/form-data"
                            name="profile_upload"> -->
                        <div class="text-center">
                            <!-- <input type="file" id="user_group_logo" class="custom-file-input" accept="image/*"
                                    name="fileToUpload1"> -->
                            <label>Select Image</label>
                            <input type="file" id="file" class="custom-file-input" accept="image/*" name="file">
                            <div class="text-center">
                                <label id="user_group_label" class="btn border-bottom-primary btn-light shadow"
                                    for="user_group_logo">
                                    <i class="fas fa-upload"></i> Select Picture</label>

                            </div>
                            <!-- <button class="btn btn-primary mt-2" type="submit" name="change_profile_pic_button"
                                value="change_profile_pic_button" id="change_profile_pic_button">
                                Upload</button> -->
                        </div>
                        <!-- </form> -->
                        <!-- ajax profile image upload  -->
                        <script>
                        $(document).ready(function() {
                            $(document).on('change', '#file', function() {
                                var name = document.getElementById("file").files[0].name;
                                var form_data = new FormData();
                                var ext = name.split('.').pop().toLowerCase();
                                if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                                    alert("Invalid Image File");
                                }
                                var oFReader = new FileReader();
                                oFReader.readAsDataURL(document.getElementById("file").files[0]);
                                var f = document.getElementById("file").files[0];
                                var fsize = f.size || f.fileSize;
                                if (fsize > 2000000) {
                                    alert("Image File Size is very big");
                                } else {
                                    form_data.append("file", document.getElementById('file').files[0]);
                                    $.ajax({
                                        url: "architectProfileUpload.php",
                                        method: "POST",
                                        data: form_data,
                                        contentType: false,
                                        cache: false,
                                        processData: false,
                                        beforeSend: function() {
                                            $('#uploaded_image').html(
                                                "<label class='text-success'>Image Uploading...</label>"
                                            );
                                        },
                                        success: function(data) {
                                            $('#uploaded_image').html(data);
                                        }
                                    });
                                }
                            });
                        });
                        </script>
                        <!-- ajax profile image upload header page pic -->
                        <script>
                        $(document).ready(function() {
                            $(document).on('change', '#file', function() {
                                var name = document.getElementById("file").files[0].name;
                                var form_data = new FormData();
                                var ext = name.split('.').pop().toLowerCase();
                                if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                                    alert("Invalid Image File");
                                }
                                var oFReader = new FileReader();
                                oFReader.readAsDataURL(document.getElementById("file").files[0]);
                                var f = document.getElementById("file").files[0];
                                var fsize = f.size || f.fileSize;
                                if (fsize > 2000000) {
                                    alert("Image File Size is very big");
                                } else {
                                    form_data.append("file", document.getElementById('file').files[0]);
                                    $.ajax({
                                        url: "architectProfileUpload.php",
                                        method: "POST",
                                        data: form_data,
                                        contentType: false,
                                        cache: false,
                                        processData: false,
                                        beforeSend: function() {
                                            $('#uploaded_image_header').html(
                                                "<label class='text-success'>Image Uploading...</label>"
                                            );
                                        },
                                        success: function(data) {
                                            $('#uploaded_image_header').html(data);
                                        }
                                    });
                                }
                            });
                        });
                        </script>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card shadow-sm mb-3">
                <div class="card-header py-3">
                    <p class="text-gray-900 m-0 font-weight-bold">Contact Settings</p>
                </div>
                <div class="card-body">
                    <form id="save_contact_settings">
                        <input type="hidden" class="form-control" name="inputName" id="isPressedContactSettings"
                            value="isPressedContactSettings">
                        <div class="form-row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-label-group">
                                    <input class="form-control" type="text" onkeyup="getExtLiveLoadLocation(this.value)"
                                        placeholder="Location" id="location" value="<?php echo $user['location'];?>"
                                        autocomplete="off">
                                    <label for="location">Location</label>
                                    <div id="profile_location"></div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-label-group">
                                    <input class="form-control" type="email" placeholder="Email" name="email" id="email"
                                        value="<?php echo $user['email'];?>" autocomplete="off">
                                    <label for="email">Email</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-label-group">
                                    <input class="form-control" type="text" placeholder="Office Number" id="office_no"
                                        value="<?php echo $user['office_no'];?>" maxlength="11" autocomplete="off">
                                    <label for="office_no">Office Number</label>
                                </div>

                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-label-group">
                                    <input class="form-control" type="text" placeholder="Residential Address"
                                        id="residential_address" value="<?php echo $user['residential_address'];?>"
                                        autocomplete="off">
                                    <label for="residential_address">Residential Address</label>
                                </div>
                            </div>
                        </div>
                        <<<<<<< HEAD <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" id="reg_as_int_des" <?php 
                            if ($added_profile == "interior") { 
                                echo "checked='checked'"; 
                                echo "value='no'";  
                            } 
                            // elseif($added_profile == "no"){
                            //     echo "value='interior'";                                    
                            //     echo "checked='unchecked'"; 
                            //     }
                                ?> />
                            <script>
                            $(document).on("click", "#profile_location .city", function() {
                                var clickedBtnID = $(this).text(); // or var clickedBtnID = this.id
                                $('#location').val(clickedBtnID);
                            });
                            </script>
                            <label class="custom-control-label" for="reg_as_int_des">Register as an Interior
                                Designer
                                also</label>
                            =======
                            <div class="form-row">
                                <div class="col-sm-12 col-md-6 order-2 order-md-1">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox mb-3">
                                            <input type="checkbox" class="custom-control-input" id="reg_as_int_des" <?php 
                                        if ($added_profile == "interior") { 
                                            echo "checked='checked'"; 
                                            echo "value='no'";  
                                        } 
                                            ?> />
                                            <script>
                                            $(document).on("click", "#profile_location .city", function() {
                                                var clickedBtnID = $(this)
                                            .text(); // or var clickedBtnID = this.id
                                                $('#location').val(clickedBtnID);
                                            });
                                            </script>
                                            <label class="custom-control-label" for="reg_as_int_des">Register as an
                                                Interior
                                                Designer also</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 order-1 order-md-2">
                                    <div class="form-label-group">
                                        <input class="form-control" type="text" placeholder="Office Address"
                                            id="office_address" value="<?php echo $user['office_address'];?>"
                                            autocomplete="off">
                                        <label for="office_address">Office Address </label>
                                    </div>
                                </div>
                                >>>>>>> ba3f53e757b9a3003605b72264a5deaf28c989fb
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <button class="btn btn-primary btn-sm mt-2" type="submit">
                                        Save Settings</button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
            <div class="card shadow-sm">
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
                                <div class="form-label-group">
                                    <input class="form-control" type="text" placeholder="COA No." id="coa_no"
                                        value="<?php echo $user['coa_no'];?>" autocomplete="off" />
                                    <label for="coa_no">COA Number</label>
                                </div>
                            </div>
                            <div class="col">
                                <<<<<<< HEAD <div class="form-group">
                                    <textarea class="form-control" placeholder="About Me" id="about_me" rows="2"><?php echo $user['about_me'];?>
                                        </textarea>
                                    =======
                                    <div class="form-label-group">
                                        <input class="form-control" placeholder="About Me" id="about_me" rows="2"
                                            value="<?php echo $user['about_me'];?>" />
                                        <label for="about_me">About Me</label>
                                        >>>>>>> ba3f53e757b9a3003605b72264a5deaf28c989fb
                                    </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-label-group">
                                    <input class="form-control" type="text" placeholder="Instagram Id."
                                        id="instagram_id" value="<?php echo $user['instagram_id'];?>"
                                        autocomplete="off" />
                                    <label for="instagram_id">Instagram Id</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-label-group">
                                    <input class="form-control" type="text" placeholder="Facebook Id." id="facebook_id"
                                        value="<?php echo $user['facebook_id'];?>" autocomplete="off" />
                                    <label for="facebook_id">Facebook Id</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-label-group">
                                    <input class="form-control" type="text" placeholder="Youtube Id." id="youtube_id"
                                        value="<?php echo $user['youtube_id'];?>" autocomplete="off" />
                                    <label for="youtube_id">Youtube Id</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-label-group">
                                    <input class="form-control" type="text" placeholder="Linkedin Id." id="linkedin_id"
                                        value="<?php echo $user['linkedin_id'];?>" autocomplete="off" />
                                    <label for="linkedin_id">Linkedin Id</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-sm" type="submit">Save Settings</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- card End -->
        </div>
    </div>
</div>
</div>

<footer class="bg-white sticky-footer">
    <div class="container my-auto">
        <div class="text-center my-auto copyright"><span>Copyright © HomesInfra 2020</span></div>
    </div>
</footer>
</div>
<a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
</div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
    integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
<script src="assets/js/script.min.js"></script>
<script src="rd/assets/js/script.min.js"></script>
<script src="assets/js/rdjsfile.js"></script>
<script src="assets/js/demo.js"></script>
<!-- contact settings section -->
<script>
$(document).ready(function() {
    $('#save_contact_settings').on('submit', function(e) {
        //Stop the form from submitting itself to the server.
        e.preventDefault();
        var isPressedContactSettings = $('#isPressedContactSettings').val();
        var location = $('#location').val();
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
                location: location,
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
