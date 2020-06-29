<?php
include("includes/header.php");  
include("includes/form_handlers/settings_handler.php");
$profile_pic = $user['profile_pic'];
if (isset($_SESSION['uname'])) {
    # code...
    $check=($_SESSION['uname']);
    print_r($check);
    header('Location:http://localhost/interaction_bootstrap/'.$check);
    unset($_SESSION["uname"]);
}
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
        $_SESSION['upload_status']=$uploadOk1;

}
	else {
		echo "<div style='text-align:center;' class='alert alert-danger'>
				$errorMessage
			</div>";
	}
}
//profile pic upload section ends
$result=$con->query("SELECT * FROM users WHERE username='$userLoggedIn'");
$row = mysqli_fetch_array($result);
?>
<div class="container-fluid">
    <h3 class="text-gray-900 mb-4">Profile: <?php
           echo $row['profile'];    
    ?></h3>
    <div class="row mb-3">
        <div class="col-lg-4">
            <div class="card shadow-sm mb-3">
                <div class="card-body text-center">
                    <img class="rounded-circle mb-3 mt-4" src="<?php echo $row['profile_pic']; ?>" width="160"
                        height="160">
                    <div class="mb-3">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="text-center">
                                <input type="file" id="user_group_logo" class="custom-file-input" accept="image/*"
                                    name="fileToUpload1">
                                <div class="text-center">
                                    <label id="user_group_label" class="btn border-bottom-primary btn-light shadow"
                                        for="user_group_logo">
                                        <i class="fas fa-upload"></i>Upload Picture</label>
                                </div>
                                <button class="btn btn-primary mt-2" type="submit" name="change_profile_pic_button">
                                    Upload</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">

            <div class="row">
                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-header py-3">
                            <p class="text-gray-900 m-0 font-weight-bold">Contact Settings</p>
                        </div>
                        <div class="card-body">
                            <form id="customer_settings">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="inputName" id="customer_is_pressed"
                                        value="customer_is_pressed">
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group">
                                            <input class="form-control" type="text" placeholder="email id." id="email"
                                                value="<?php echo $user['email'];?>" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <input class="form-control" type="text" placeholder="Residential Address"
                                                id="residential_address"
                                                value="<?php echo $user['residential_address'];?>" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group">
                                            <input class="form-control" type="text" placeholder="Office Address"
                                                id="office_address" value="<?php echo $user['office_address'];?>"
                                                autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <input class="form-control" type="text" placeholder="Mobile No. 2"
                                                id="mobile_no2" maxlength="10" value="<?php echo $user['office_no'];?>"
                                                autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-sm" type="submit">Save Settings</button>
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
<script src="https://code.jquery.com/jquery-3.5.1.min.js " crossorigin="anonymous"></script>
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
<script>
$(document).ready(function() {
    $('#customer_settings').on('submit', function(e) {
        //Stop the form from submitting itself to the server.
        e.preventDefault();
        var customer_is_pressed = $('#customer_is_pressed').val();
        var email = $('#email').val();
        var residential_address = $('#residential_address').val();
        var office_address = $('#office_address').val();
        var mobile_no2 = $('#mobile_no2').val();
        $.ajax({
            type: "POST",
            url: 'customerSettingsSubmit.php',
            data: {
                customer_is_pressed: customer_is_pressed,
                email: email,
                residential_address: residential_address,
                office_address: office_address,
                mobile_no2: mobile_no2
            },
            success: function(data) {
                alert("updated successfully");
            }
        });
    });
});
</script>

</html>
