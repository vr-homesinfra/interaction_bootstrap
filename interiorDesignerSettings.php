<?php
include("includes/header.php");  
include("includes/form_handlers/settings_handler.php");
$profile_pic = $user['profile_pic'];


//profile pic upload section start


//profile pic upload section ends
$result=$con->query("SELECT * FROM users WHERE username='$userLoggedIn'");
$row = mysqli_fetch_array($result);
?>
<div class="container-fluid">
    <h3 class="text-gray-900 mb-4">Profile: <?php
                
                if ($row['profile']=="interior") {
                    echo "Interior Designer";
                }    
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

                    <div class="card shadow-sm mb-3">
                        <div class="card-header py-3">
                            <p class="text-gray-900 m-0 font-weight-bold">Contact Settings</p>
                        </div>
                        <div class="card-body">
                            <form id="save_contact_settings">

                                <input type="hidden" class="form-control" name="inputName" id="isPressedContactSettings"
                                    value="isPressedContactSettings">

                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-label-group">
                                            <input class="form-control" type="text" placeholder="Location" id="location"
                                                value="<?php echo $user['location'];?>" autocomplete="off">
                                            <label for="location">Location</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-label-group">
                                            <input class="form-control" type="email" placeholder="Email" name="email"
                                                id="email" value="<?php echo $user['email'];?>" autocomplete="off">
                                            <label for="email">Email</label>
                                        </div>

                                    </div>

                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-label-group">
                                            <input class="form-control" type="text" placeholder="Office Number"
                                                id="office_no" value="<?php echo $user['office_no'];?>" maxlength="11"
                                                autocomplete="off">
                                            <label for="office_no">Office Number</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-label-group">
                                            <input class="form-control" type="text" placeholder="Residential Address"
                                                id="residential_address"
                                                value="<?php echo $user['residential_address'];?>" autocomplete="off">
                                            <label for="residential_address">Residential Address</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-label-group">
                                            <input class="form-control" type="text" placeholder="Office Address"
                                                id="office_address" value="<?php echo $user['office_address'];?>"
                                                autocomplete="off">
                                            <label for="office_address">Office Address</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-sm mt-2" type="submit">
                                        Save Settings</button>
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
                                    <input type="hidden" class="form-control" name="inputName" id="isPressed"
                                        value="is_pressed" autocomplete="off">
                                </div>

                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-label-group">
                                            <input class="form-control" placeholder="About Me" id="about_me" rows="2"
                                                value="<?php echo $user['about_me'];?>" />
                                            <label for="about_me">About Me</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-label-group">
                                            <input class="form-control" type="text" placeholder="Instagram Id."
                                                id="instagram_id" value="<?php echo $user['instagram_id'];?>"
                                                autocomplete="off" />
                                            <label for="office_address">Office Address</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-label-group">
                                            <input class="form-control" type="text" placeholder="Facebook Id."
                                                id="facebook_id" value="<?php echo $user['facebook_id'];?>"
                                                autocomplete="off" />
                                            <label for="facebook_id">Facebook ID</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-label-group">
                                            <input class="form-control" type="text" placeholder="Youtube Id."
                                                id="youtube_id" value="<?php echo $user['youtube_id'];?>"
                                                autocomplete="off" />
                                            <label for="youtube_id">Youtube ID</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-label-group">
                                            <input class="form-control" type="text" placeholder="Linkedin Id."
                                                id="linkedin_id" value="<?php echo $user['linkedin_id'];?>"
                                                autocomplete="off" />
                                            <label for="linkedin_id">LinkedIn ID</label>
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

    <?php
include("footer.php");    
?>

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
                url: 'interiorDesignerSettingsSubmit.php',
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
