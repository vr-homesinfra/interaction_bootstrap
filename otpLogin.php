<?php
require "config/config.php";

$userLoggedIn="";
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

if (isset($_SESSION['uname'])) {
    # code...
    $check=($_SESSION['uname']);
    // print_r($check);
}
?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Login - HomesInfra</title>
        <link rel="stylesheet" href="rd/assets/css/main.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Actor">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
        <link rel="stylesheet" href="assets/css/styles.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js " crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
            integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
        </script>
    </head>

    <body>
        <nav class="navbar shadow navbar-light bg-light static-top">
            <div class="container">
                <a class="navbar-brand" href="#"><img
                        src="<?php echo $logoSrc; ?>" width="60"
                        alt="homesinfra logo"></a>
                <a class="btn btn-primary " href="./otpRegister.php">Sign Up</a>
            </div>
        </nav>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-9 col-lg-12 col-xl-10 offset-lg-0">
                    <div class="card o-hidden border my-5">
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col-lg-6 d-none d-lg-flex">
                                    <div class="flex-grow-1 bg-login-image"
                                        style="background-image: url(&quot;assets/img/dogs/chuttersnap-WkIm3eZJLr0-unsplash.jpg&quot;);">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="p-4 p-md-5">
                                        <div class="text-center">
                                            <h4 class="text-gray-900 mb-4">Welcome to HomesInfra</h4>
                                        </div>
                                        <?php
                                    if (isset($_POST['send_otp'])){ 
                                        // $textlocal = new Textlocal('false','false',API_KEY);
                                        
                                        $mobile_no = strip_tags($_POST['enter_mobile_no']); //Remove html tags
                                        $mobile_no = str_replace(' ', '', $mobile_no); //remove spaces
                                        $_SESSION['mobile_no'] = $mobile_no;  
                                        
                                        $check_database_query = mysqli_query($con, "SELECT * FROM users WHERE mobile_no='$mobile_no'");
                                        $check_login_query = mysqli_num_rows($check_database_query);
                                        
                                    if($check_login_query == 1) {
                                        
                            $YourAPIKey='c296cc1f-af95-11ea-9fa5-0200cd936042';
                                        
                            $SentTo=$mobile_no; ### Customer's phone number in International number format ( with leading + sign)
                                            
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
                                }else{
                            // header("Location: otpRegister.php"); 
                            echo "
                            <!-- Modal -->
                            <div class='modal fade' id='exampleModalCenter' tabindex='-1' role='dialog'>
                            <div class='modal-dialog modal-dialog-centered' role='document'>
                              <div class='modal-content'> 
                                <div class='modal-header'>
                                  <h5 class='modal-title text-gray-900' id='exampleModalLongTitle'>New User</h5>
                                  <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                  </button>
                                </div>
                                <div class='modal-body'>
                                The number you have entered is not registered.
                                Kindly Register!
                                </div>
                                <div class='modal-footer'>
                                  <!-- <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button> -->
                                  <a href='./otpRegister.php' class='btn btn-primary bg-gradient-primary'>Register Now</a>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- Modal End -->   
                                    <script>$('#exampleModalCenter').modal();</script>
                                      
                            ";                                   
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
    $recvd_otp=$_POST['recvd_otp'];

    $YourAPIKey='c296cc1f-af95-11ea-9fa5-0200cd936042';
    #$API_Response_json=json_decode(file_get_contents("https://2factor.in/API/V1/$YourAPIKey/SMS/VERIFY3/$SentTo/$verify_otp"),false);
    $mobile_no=$_SESSION['mobile_no'];
    $url = "https://2factor.in/API/V1/$YourAPIKey/SMS/VERIFY3/$mobile_no/$recvd_otp"; 
    #echo $VerificationStatus= $API_Response_json->Details;
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL,$url); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, $agent);
    $Response= curl_exec($ch); 
    curl_close($ch);

    ### Parse API Response to check if OTP matched or mismatched
    $Response_json=json_decode($Response,false);
    if ( $Response_json->Details =='OTP Matched'){
        
    $mobile_no=$_SESSION['mobile_no'];
                                            
            $check_database_query = mysqli_query($con, "SELECT * FROM users WHERE mobile_no='$mobile_no'");
            $check_login_query = mysqli_num_rows($check_database_query);
            
        if($check_login_query == 1) {
            $row = mysqli_fetch_array($check_database_query);
            $mobile_no = $row['mobile_no'];    
            $userLoggedIn=$row['username'];
	        $user_profile = $_row['profile'];

     //after login,the session variable is set for the user from here
            $_SESSION['mobile_no'] = $mobile_no;
            $_SESSION['userLoggedIn'] = $userLoggedIn;
            $_SESSION['user_profile'] = $user_profile;
            
            //profile based redirection
            if (isset($_SESSION['mobile_no'])|| isset(($_SESSION['userLoggedIn']))) {
                
                $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");
                $user = mysqli_fetch_array($user_details_query);
                $profile= $user['profile'];
                    if ($profile=="architect") {
                    header("Location: architectSettings.php");
                    exit();  
                    }elseif ($profile=="interior") {
                        header("Location: interiorDesignerSettings.php");
                        exit(); 
                    }else {
                        header("Location: customerSettings.php");
                        exit();
                    }                
            }           
        }   
                }else{
                $otp_failure="Enter correct OTP";
            }   
            }                  
                ?>
                                        <form class="user" method="POST" action="otpLogin.php">
                                            <div class="form-group">
                                                <!-- enter mobile no. for checking db & otp -->
                                                <input class="form-control form-control-user text-center"
                                                    id="exampleInputPassword"
                                                    placeholder="Enter registered mobile number" name="enter_mobile_no"
                                                    minlength="10" maxlength="10" autocomplete="off" type="text">
                                            </div>
                                            <!--send otp button -->
                                            <button class="btn btn-outline-primary btn-block btn-user" type="submit"
                                                name="send_otp">Send OTP</button>
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
                                            <div class="form-group">
                                                <!--enter otp received  on mobile -->
                                                <input class="form-control form-control-user text-center"
                                                    id="exampleInputPassword" placeholder="Enter received OTP"
                                                    name="recvd_otp" minlength="5" maxlength="6" autocomplete="off"
                                                    type="text">
                                            </div>
                                            <!-- validate mobile no. in db & otp -->
                                            <!-- & then redirect to profile page -->
                                            <button class="btn btn-primary bg-gradient-primary btn-block btn-user"
                                                type="submit" name="verify_otp">Verify & Login</button>
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
                                            <hr>
                                        </form>
                                        <div class="text-center text-secondary">
                                            <a class="" href="otpRegister.php">Visiting first
                                                time? Create an
                                                Account!</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
            integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
        </script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
        <script src="rd/assets/js/script.min.js"></script>
        <script src="assets/js/rdjsfile.js"></script>
        <script src="assets/js/demo.js"></script>
    </body>

</html>
