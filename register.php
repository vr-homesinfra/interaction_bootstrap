<?php
require "config/config.php";
require "includes/form_handlers/register_handler.php";
?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Register - HomesInfra</title>
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link rel="stylesheet" href="assets/css/styles.min.css">
    </head>

    <body class="bg-gradient-primary">
        <div class="container">
            <div class="card shadow-lg o-hidden border-0 my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-5 d-none d-lg-flex">
                            <div class="flex-grow-1 bg-register-image"
                                style="background-image: url(&quot;assets/img/dogs/chuttersnap-WkIm3eZJLr0-unsplash.jpg&quot;);">
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="p-5">
                                <div class="text-center">
                                    <h4 class="text-dark mb-4">Create an Account!</h4>
                                </div>
                                <form class="user" action="register.php" method="POST">
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input class="form-control form-control-user" type="text"
                                                id="textboxFirstName" placeholder="First Name" name="reg_fname" value="<?php
                                                if (isset($_SESSION['reg_fname'])) {
                                                    echo $_SESSION['reg_fname'];  
                                                }
                                                ?>" required>
                                            <?php
                                                if (in_array("Your first name must be between 2 & 25 characters<br>",$error_array)) {
                                                    echo "Your first name must be between 2 & 25 characters<br>";
                                                }    
                                                ?>
                                        </div>
                                        <div class="col-sm-6">
                                            <input class="form-control form-control-user" type="text"
                                                id="textboxLastName" placeholder="Last Name" name="reg_lname" value="<?php
                                                  if(isset($_SESSION['reg_lname']))  {
                                                      echo $_SESSION['reg_lname'];
                                                  }
                                                ?>" required>
                                            <?php
                                                if (in_array("Your last name must be between 2 & 25 characters<br>",$error_array)) {
                                                    echo "Your last name must be between 2 & 25 characters<br>";
                                                }    
                                                ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <select class="border rounded form-control custom-select"
                                                name="user_profile" id="profile_dropdown">
                                                <option value="" selected="">please select</option>
                                                <option value="customer">Customer</option>
                                                <option value="architect">Architect</option>
                                                <option value="interior">Interior Designer</option>
                                            </select></div>
                                        <div class="col-sm-6">
                                            <input class="form-control form-control-user" type="text" id="textbox"
                                                placeholder="City" name="reg_city" value="<?php
                                                  if(isset($_SESSION['reg_city'])){
                                                      echo $_SESSION['reg_city'];
                                                  }  
                                                ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input class="form-control form-control-user" type="text" id="email1"
                                                placeholder="Email" name="reg_email" value="<?php
                                                  if(isset($_SESSION['reg_email'])){
                                                      echo $_SESSION['reg_email'];
                                                  }  
                                                ?>" required>

                                        </div>
                                        <div class="col-sm-6">
                                            <input class="form-control form-control-user" type="text" id="email2"
                                                placeholder="Confirm Email" name="reg_email2" value="<?php
                                                  if(isset($_SESSION['reg_email2'])){
                                                      echo $_SESSION['reg_email2'];
                                                  }  
                                                ?>" required>
                                            <?php
                                                if (in_array("email already in use<br>",$error_array)) {
                                                    echo "email already in use<br>";
                                                }    
                                                
                                                else if (in_array("Invalid format<br>",$error_array)) {
                                                    echo "Invalid format<br>";
                                                }    
                                                
                                                else if (in_array("Emails do not match<br>",$error_array)) {
                                                    echo "Emails do not match<br>";
                                                }    
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input class="form-control form-control-user" type="password"
                                                id="textboxPassword" placeholder="Password" name="reg_password" value="<?php
                                                  if(isset($_SESSION['reg_password'])){
                                                      echo $_SESSION['reg_password'];
                                                  }  
                                                ?>" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <input class="form-control form-control-user" type="password"
                                                id="textboxConfirmPassword" placeholder="Confirm Password"
                                                name="reg_password2" value="<?php
                                                  if(isset($_SESSION['reg_password2'])){
                                                      echo $_SESSION['reg_password2'];
                                                  }  
                                                ?>" required>
                                            <?php
                                                if (in_array("Your passwords do not match<br>",$error_array)) {
                                                    echo "Your passwords do not match<br>";
                                                }    
                                                
                                                else if (in_array("Your password can contain only alphabets & numbers<br>",$error_array)) {
                                                    echo "Your password can contain only alphabets & numbers<br>";
                                                }    
                                                
                                                else if (in_array("Your password must be between 5 and 30 characters<br>",$error_array)) {
                                                    echo "Your password must be between 5 and 30 characters<br>";
                                                }    
                                            ?>
                                        </div>
                                    </div>
                                    <input name="register_button" class="btn btn-primary btn-block text-white btn-user"
                                        type="submit" value="Register Account">
                                    <!-- register success message -->
                                    <?php 
                                    if(in_array("<span style='color: #14C800;'>You're all set! Go ahead and login!</span><br>", $error_array)) echo "<center><span style='color: #14C800;'>You're all set! Go ahead and login!</span><br></center>"; ?>

                                    <!-- <hr>
                                    <a class="btn btn-primary btn-block text-white btn-google btn-user" role="button"><i
                                            class="fab fa-google"></i>&nbsp; Register with Google</a><a
                                        class="btn btn-primary btn-block text-white btn-facebook btn-user"
                                        role="button"><i class="fab fa-facebook-f"></i>&nbsp; Register with
                                        Facebook
                                    </a> -->
                                    <hr>
                                </form>
                                <div class="text-center"><a class="small" href="forgot-password.html">Forgot
                                        Password?</a></div>
                                <div class="text-center"><a class="small" href="login.php">Already have an account?
                                        Login!</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
