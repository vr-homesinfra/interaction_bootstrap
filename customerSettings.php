<?php
include("includes/header.php");  
include("includes/form_handlers/settings_handler.php");
$profile_pic = $user['profile_pic'];
if (isset($_SESSION['uname'])) {
    # code...
    $check=($_SESSION['uname']);
    print_r($check);
    header("Location:https://homesinfra.com/interact/".$check);
    // header("Location:http://localhost/interaction_bootstrap/".$check);
    unset($_SESSION["uname"]);
}
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
                <div class="card-header">
                    <p class="text-gray-900 m-0 font-weight-bold">Profile Picture</p>
                </div>

<!-- Image Start -->


<div class="card-body text-center " id="uploaded_image" >
    <div class="">
        <i class=" rounded-circle img _1-yc profpic" aria-label="Rashtradeep Tripathi, profile picture" role="img" style="background:#d8dce6 url('<?php echo $row['profile_pic']; ?>') no-repeat center; width:160px; height:160px; display: inline-block;"></i>
        <div class="mb-3">
            <div class="text-center">
                <input type="file" id="file" style="width: 40px; height: 40px;" accept="image/*" name="file" value="Upload Image">
                <svg class="gb_sb" enable-background="new 0 0 24 24" focusable="false" height="40" viewBox="0 0 24 24" width="40" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M20 5h-3.17L15 3H9L7.17 5H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V7c0-1.1-.9-2-2-2zm0 14H4V7h16v12zM12 9c-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4z"></path></svg>
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
                            form_data.append("file", document.getElementById('file').files[
                                0]);
                            $.ajax({
                                url: "profileUpload.php",
                                method: "POST",
                                data: form_data,
                                contentType: false,
                                cache: false,
                                processData: false,
                                beforeSend: function() {
                                    $('#uploaded_image img').attr('src',
                                        'http://localhost/interaction_bootstrap/assets/images/icons/uploadcloud.gif'
                                    );
                                },
                                success: function(data) {
                                    // $('#uploaded_image').html(data);
                                    var rdimagepath = data;
                                    $('#uploaded_image img, #uploaded_image_header img')
                                        .attr('src', data);
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

<!-- Image End -->

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
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-label-group">
                                            <input class="form-control" type="text" placeholder="email id." id="email"
                                                value="<?php echo $user['email'];?>" autocomplete="off">
                                            <label for="email">Email address</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-label-group">
                                            <input class="form-control" type="text" placeholder="Residential Address"
                                                id="residential_address"
                                                value="<?php echo $user['residential_address'];?>" autocomplete="off">
                                            <label for="residential_address">Residential Address</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-label-group">
                                            <input class="form-control" type="text" placeholder="Office Address"
                                                id="office_address" value="<?php echo $user['office_address'];?>"
                                                autocomplete="off">
                                            <label for="office_address">Office Address</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-label-group">
                                            <input class="form-control" type="text" placeholder="Mobile Number"
                                                id="mobile_no2" maxlength="10" value="<?php echo $user['office_no'];?>"
                                                autocomplete="off">
                                            <label for="mobile_no2">Mobile Number</label>
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


</div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
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
<script src="rd/assets/js/script.min.js"></script>
<script src="assets/js/rdjsfile.js"></script>
<script src="assets/js/demo.js"></script>
<!-- outside JS  -->

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
</body>


</html>
