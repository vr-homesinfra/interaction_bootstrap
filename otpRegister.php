<?php
require "config/config.php";

$fname = ""; //First name
$lname = ""; //Last name
$user_profile="";//dropdown values
$mobile_no="";
$otpValue="";
$success="";
$API_Response_json="";
$recvd_otp = "";
$agent = "";
$rand = "";
$otp_success="";
$otp_failure="";
?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Register - HomesInfra</title>
        <link rel="stylesheet" href="rd/assets/css/main.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Actor">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
        <link rel="stylesheet" href="assets/css/styles.min.css">
    </head>

    <body class="">
        <nav class="navbar shadow navbar-light bg-light static-top">
            <div class="container">
                <a class="navbar-brand" href="#"><img
                        src="https://homesinfra.com/wp-content/uploads/2019/06/logo-hi.svg" width="60"
                        alt="homesinfra logo"></a>
                <a class="btn btn-primary " href="./otpLogin.php">Sign In</a>
            </div>
        </nav>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-9 col-lg-12 col-xl-10 offset-lg-0">
                    <div class="card border  o-hidden border my-5">
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col-lg-6 d-none d-lg-flex">
                                    <div class="flex-grow-1 bg-login-image"
                                        style="background-image: url(&quot;assets/img/dogs/chuttersnap-WkIm3eZJLr0-unsplash.jpg&quot;);">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="p-4">
                                        <div class="text-center">
                                            <h4 class="text-gray-900 mb-4">Create an Account</h4>
                                        </div>

                                        <?php
                                    if (isset($_POST['send_otp'])){                               
                                        
                                        $mobile_no = strip_tags($_POST['register_mobile_no']); 
                                        //Remove html tags
                                        $mobile_no = str_replace(' ', '', $mobile_no); 
                                        //remove spaces
                                        $_SESSION['mobile_no'] = $mobile_no;
                                        
                                        //check for duplicate mobile no. start
        $check_database_query = mysqli_query($con, "SELECT mobile_no FROM users WHERE mobile_no='$mobile_no'");
        $check_login_query = mysqli_num_rows($check_database_query);
        
    if($check_login_query == 1) {
            $row = mysqli_fetch_array($check_database_query);
            $mobile_no = $row['mobile_no'];
            echo "the number is already registered";
    }
                                        //check for duplicate mobile no. end
    if($check_login_query !=1) {
                                        
                                        $user_profile = strip_tags($_POST['user_profile']); 
                                        //Remove html tags
                                        $user_profile = str_replace(' ', '', $user_profile); 
                                        //remove spaces
                                        $_SESSION['user_profile'] = $user_profile; 
                                        //Stores user_profile into session variable
                                        
                                        //First name
                            $fname = strip_tags($_POST['reg_fname']); //Remove html tags
                            $fname = str_replace(' ', '', $fname); //remove spaces
                            $fname = ucfirst(strtolower($fname)); //Uppercase first letter
                            $_SESSION['reg_fname'] = $fname; //Stores first name into session variable

                            //Last name
                            $lname = strip_tags($_POST['reg_lname']); //Remove html tags
                            $lname = str_replace(' ', '', $lname); //remove spaces
                            $lname = ucfirst(strtolower($lname)); //Uppercase first letter
                            $_SESSION['reg_lname'] = $lname; //Stores last name into session variable
                                        
                            $SentTo=$mobile_no; ### Customer's phone number in International number format ( with leading + sign)

                            #### 2Factor Credentials
                            $YourAPIKey='c296cc1f-af95-11ea-9fa5-0200cd936042';
                            
                            ### Sending OTP to Customer's Number
                            $agent= 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';
                            $url = "https://2factor.in/API/V1/$YourAPIKey/SMS/$SentTo/AUTOGEN"; 
                            $ch = curl_init(); 
                            curl_setopt($ch, CURLOPT_URL,$url); 
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($ch, CURLOPT_USERAGENT, $agent);
                            $Response= curl_exec($ch); 
                            curl_close($ch);
                            ### Store OTP Session Id In Session Variable ( to be used in Verify step)
                            $Response_json=json_decode($Response,false);
                            $_SESSION['OTPSessionId']=$Response_json->Details;
                            $otp_success="OTP sent successfully";                                  
    }
                                }
                                if ( $otpValue <> '') ### OTP value entered by user
                                {
                                    ### Check if OTP is matching or not
                                    $OTPSessionId=$_REQUEST['OTPSessionId'];
                                    #$API_Response_json=json_decode(file_get_contents("https://2factor.in/API/V1/$YourAPIKey/SMS/VERIFY3/$SentTo/$verify_otp"),false);
                                    
                                        ### Check if OTP is matching
                                        if ( $VerificationStatus =='OTP Matched')
                                        {
                                        
                                        echo "Congratulations you  has been verified. ";
                                            die();
                                            
                                        }
                                        else
                                        {
                                            echo "Sorry, OTP entered was incorrect. Please enter correct OTP";
                                            die();
                                        }                                   
                                }
                                
                                if (isset($_POST['verify_otp'])){
                                   $recvd_otp= $_POST['recvd_otp'];
                                    $YourAPIKey='c296cc1f-af95-11ea-9fa5-0200cd936042';
                                    #$API_Response_json=json_decode(file_get_contents("https://2factor.in/API/V1/$YourAPIKey/SMS/VERIFY3/$SentTo/$verify_otp"),false);
                                    $mobile_no=$_SESSION['mobile_no'];
                                    $url = "https://2factor.in/API/V1/$YourAPIKey/SMS/VERIFY3/$mobile_no/$recvd_otp"; 
                                   #echo $VerificationStatus= $API_Response_json->Details;
                                    // echo $url;
                                    $ch = curl_init(); 
                                    curl_setopt($ch, CURLOPT_URL,$url); 
                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                    curl_setopt($ch, CURLOPT_USERAGENT, $agent);
                                    $Response= curl_exec($ch); 
                                    curl_close($ch);

                ### Parse API Response to check if OTP matched or mismatched
                    $Response_json=json_decode($Response,false);
                    if ( $Response_json->Details =='OTP Matched'){                 
                   
                                            //random assignment of template profile pic
                                            $rand=rand(1,16);
                                            switch ($rand) {
                                                case 1:
                                                    $profile_pic="assets/images/profile_pics/defaults/head_alizarin.png";
                                                break;
                                                case 2:
                                                    $profile_pic="assets/images/profile_pics/defaults/head_amethyst.png";
                                                break;
                                                case 3:
                                                    $profile_pic="assets/images/profile_pics/defaults/head_belize_hole.png";
                                                break;
                                                case 4:
                                                    $profile_pic="assets/images/profile_pics/defaults/head_carrot.png";
                                                break;
                                                case 5:
                                                    $profile_pic="assets/images/profile_pics/defaults/head_deep_blue.png";
                                                break;
                                                case 6:
                                                    $profile_pic="assets/images/profile_pics/defaults/head_emerald.png";
                                                break;
                                                case 7:
                                                    $profile_pic="assets/images/profile_pics/defaults/head_green_sea.png";
                                                break;
                                                case 8:
                                                    $profile_pic="assets/images/profile_pics/defaults/head_nephritis.png";
                                                break;
                                                case 9:
                                                    $profile_pic="assets/images/profile_pics/defaults/head_pete_river.png";
                                                break;
                                                case 10:
                                                    $profile_pic="assets/images/profile_pics/defaults/head_pomegranate.png";
                                                break;
                                                case 11:
                                                    $profile_pic="assets/images/profile_pics/defaults/head_pumpkin.png";
                                                break;
                                                case 12:
                                                    $profile_pic="assets/images/profile_pics/defaults/head_red.png";
                                                break;
                                                case 13:
                                                    $profile_pic="assets/images/profile_pics/defaults/head_sun_flower.png";
                                                break;
                                                case 14:
                                                    $profile_pic="assets/images/profile_pics/defaults/head_turquoise.png";
                                                break;
                                                case 15:
                                                    $profile_pic="assets/images/profile_pics/defaults/head_wet_asphalt.png";
                                                break;
                                                case 16:
                                                    $profile_pic="assets/images/profile_pics/defaults/head_wisteria.png";
                                                break;
                                                default:
                                                $profile_pic="assets/images/profile_pics/defaults/head_carrot.png";
                                            }
                //Generate username by concatenating first name and last name
                $fname=$_SESSION['reg_fname'];
                $lname=$_SESSION['reg_lname'];

                $username = strtolower($fname . "_" . $lname);
                //check for duplicate username
                $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
                $i = 0; 
                //if username exists add number to username
                while(mysqli_num_rows($check_username_query) != 0) {
                    $i++; //Add 1 to i
                    $username = $username . "_" . $i;
                    $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
                }
                echo "Congrats,your mobile is registered & verified";
                    $date = date("Y-m-d"); //Current date
                    $user_profile=$_SESSION['user_profile'];//from dropdown 
                    $mobile_no=$_SESSION['mobile_no'];
                    $fname=$_SESSION['reg_fname'];
                    $lname=$_SESSION['reg_lname'];
                //start doing everything from here eg. db works
                $query = mysqli_query($con, "INSERT INTO users VALUES ('','$fname','$lname','$user_profile','','','$username','','','$date','$profile_pic','','','no','','$mobile_no','','','','','','','','','','no','')");
                 
                header("Location: otpLogin.php");

                
            }else{                
                $otp_failure="Enter correct OTP";

            }
        }
            
                                   #echo $VerificationStatus= $API_Response_json->Details;
                                       
        // $_SESSION['reg_fname'] = "";
        // $_SESSION['reg_lname'] = "";
        // $_SESSION['user_profile'] = "";
        // $_SESSION['register_mobile_no'] = "";                                                       
                                   ?>
                                        <form class="user" method="POST" action="otpRegister.php">
                                            <div class="form-group">
                                                <select class=" border rounded form-control custom-select"
                                                    id="profile_dropdown-1" name="user_profile">
                                                    <option value="choose profile" selected="">Choose Profile</option>
                                                    <option value="customer">Customer</option>
                                                    <option value="architect">Architect</option>
                                                    <option value="interior">Interior Designer</option>
                                                </select>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-sm-6 mb-3  mb-sm-0">
                                                    <input class="form-control  form-control-user" type="text"
                                                        autocomplete="off" id="textboxFirstName"
                                                        placeholder="First Name" name="reg_fname" value="<?php
                                                if (isset($_SESSION['reg_fname'])) {
                                                    echo $_SESSION['reg_fname'];  
                                                }
                                                ?>">

                                                </div>
                                                <div class="col-sm-6">
                                                    <input class="form-control  form-control-user" type="text"
                                                        id="textboxLastName" placeholder="Last Name" name="reg_lname"
                                                        autocomplete="off" value="<?php
                                                  if(isset($_SESSION['reg_lname']))  {
                                                      echo $_SESSION['reg_lname'];
                                                  }
                                                ?>">

                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <!--enter valid mobile no. textbox  -->
                                                <input class="form-control  form-control-user" type="text"
                                                    id="exampleInputPassword" placeholder="Enter valid mobile no."
                                                    name="register_mobile_no" minlength="10" maxlength="10"
                                                    autocomplete="off" value="<?php
                                                  if(isset($_SESSION['mobile_no']))  {
                                                      echo $_SESSION['mobile_no'];
                                                  }
                                                ?>">
                                            </div>
                                            <!--send otp to entered mobile no. button  -->
                                            <button class="  btn btn-primary bg-gradient-primary btn-block btn-user"
                                                type="submit" name="send_otp">Send OTP</button>
                                            <div id="otp_sent" class="text-center">
                                                <?php
                                                echo $otp_success;  
                                                    ?>
                                            </div>
                                            <script>
                                            var fade_out = function() {
                                                $("#otp_sent").fadeOut().empty();
                                            }

                                            setTimeout(fade_out, 3000);
                                            </script>
                                            <hr>
                                            <div id="verify_sent_otp" class="text-center">
                                                <?php
                                                echo $otp_failure;
                                                ?>
                                            </div>
                                            <script>
                                            var fade_out = function() {
                                                $("#verify_sent_otp").fadeOut().empty();
                                            }
                                            setTimeout(fade_out, 3000);
                                            </script>
                                            <div class="form-group">
                                                <input class="form-control  form-control-user" type="text"
                                                    autocomplete="off" id="exampleInputPassword"
                                                    placeholder="Enter received OTP" name="recvd_otp" minlength="6"
                                                    maxlength="6" autocomplete="off">
                                            </div>
                                            <button class="btn  btn-outline-primary btn-block btn-user" type="submit"
                                                name="verify_otp">Verify</button>

                                            <hr>
                                        </form>
                                        <div class="text-center">
                                            <a class="small" href="otpLogin.php">Already have an
                                                Account ? Login</a>
                                        </div>
                                    </div>
                                </div>
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
 
        <script src="assets/js/rdjsfile.js"></script>
    </body>

</html>
