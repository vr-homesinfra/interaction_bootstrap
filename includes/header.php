<?php
 require 'config/config.php';
 include("includes/classes/User.php");
 include("includes/classes/Post.php");
 include("includes/classes/Message.php");
 include("includes/classes/Notification.php");
 include("includes/classes/FavCreatives.php");
 
  if (isset($_SESSION['mobile_no'])|| isset(($_SESSION['userLoggedIn']))) {
	$mobile_no = $_SESSION['mobile_no'];
	$userLoggedIn = $_SESSION['userLoggedIn'];
	$user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");
	$user = mysqli_fetch_array($user_details_query);
}
else {
	header("Location: otpLogin.php");
}

?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>HomesInfra</title>
        <script src="assets/js/demo.js"></script>
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
        <link rel="stylesheet" href="assets/css/styles.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
        <link rel="stylesheet" href="assets/css/styles.min.css">
        <link rel="stylesheet" type="text/css" href="assets/css/mystyles.css">
        <link rel="stylesheet" href="assets/css/switchStyles.min.css">
    </head>

    <body id="page-top" class="">
        <div id="wrapper">
            <nav
                class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0 toggled">
                <div class="container-fluid d-flex flex-column p-0">
                    <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                        <div class="sidebar-brand-icon">
                            <i class="fa fa-home" aria-hidden="true"></i>
                        </div>
                        <div class="sidebar-brand-text mx-3"><span>HomesInfra</span></div>
                    </a>
                    <hr class="sidebar-divider my-0">
                    <ul class="nav navbar-nav text-light" id="accordionSidebar">

                        <li class="nav-item" id="editProfile" role="presentation">
                            <?php
                                
                            // $type_of_creative=$_SESSION['profile'];
                            if ($user['profile']=="Architect") {
                                echo "<a class='nav-link' href='architectSettings.php'><i class='fas fa-tachometer-alt'></i><span>Dashboard</span>
                                </a></li>";
                            }elseif ($user['profile']=="InteriorDesigner") {
                                echo "<a class='nav-link' href='interiorDesignerSettings.php'><i class='fas fa-tachometer-alt'></i><span>Dashboard</span>
                                </a></li>";
                            }else{
                                echo "<a class='nav-link' href='customerSettings.php'><i class='fas fa-tachometer-alt'></i><span>Dashboard</span>
                                </a></li>";
                            }
    ?>
                            <!-- <a class="nav-link" href=""><i class="fas fa-tachometer-alt"></i><span>Dashboard</span>
                            </a></li> -->

                        <li class="nav-item favsList" id="favList" role=" presentation"><a class="nav-link"
                                href="fav_creatives.php"><i class="fas fa-user"></i><span>Favourite Creatives</span></a>
                        </li>

                        <li class="nav-item" role="presentation">

                            <?php
                            
                        // $type_of_creative=$_SESSION['profile'];
                        if ($user['profile']=="Architect") {
                            echo "<a class='nav-link' href='project_mgmt.php'><i class='fas fa-table'></i><span>Upload/Track Poject</span>
                            </a></li>";
                        }elseif ($user['profile']=="InteriorDesigner") {
                            echo "<a class='nav-link' href='project_mgmt.php'><i class='fas fa-table'></i><span>Upload/Track Poject</span>
                            </a></li>";
                        }else{
                            echo "";
                        }
?>
                        </li>

                        <li class="nav-item" role="presentation"><a class="nav-link" href="uploadGalleryPic.php"><i
                                    class="far fa-user-circle"></i><span>Update Gallery</span></a></li>

                        <!-- <li class="nav-item" role="presentation"><a class="nav-link" href=""><i
                                    class="fas fa-user-circle"></i><span>Track Project</span></a></li> -->

                        <!-- <li class="nav-item" role="presentation"><a class="nav-link" href="forgot-password.html"><i
                                    class="fas fa-key"></i><span>Forgot Password</span></a></li> -->

                        <li class="nav-item" role="presentation"><a class="nav-link" href="messages.php"><i
                                    class="fas fa-exclamation-circle"></i><span>Interactions</span></a></li>

                        <li class="nav-item" role="presentation"><a class="nav-link active" href="logout.php"><i
                                    class="fas fa-window-maximize"></i><span>Logout</span></a></li>
                    </ul>
                    <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0"
                            id="sidebarToggle" type="button"></button></div>
                </div>
            </nav>
            <?php
              //unread messages
              $messages=new Message($con,$userLoggedIn);
              $num_messages=$messages->getUnreadNumber();  
            ?>
            <div class="d-flex flex-column" id="content-wrapper">
                <div id="content">
                    <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                        <div class="container-fluid checkTest"><button
                                class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggleTop"
                                type="button"><i class="fas fa-bars"></i></button>
                            <div class="search">

                                <form
                                    class="form-inline d-none d-sm-inline-block mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"
                                    action="search.php" method="GET" name="search_form">


                                    <div class="input-group">

                                        <!--desktop view search box  -->

                                        <fieldset style="width:300px">
                                <div class="toggle">
                                    <input type="radio" id="cond_new" name="profile" checked="checked"
                                        value="architect">
                                    <label title="Select Architect" class="p-2 text-center d-block cursor-pointer"
                                        for="cond_new">Architect</label>
                                    <input type="radio" id="cond_used" name="profile" value="interior designer">
                                    <label title="Select Interior Designer" class="p-2 text-center d-block cursor-pointer"
                                        for="cond_used">Interior Designer</label>
                                </div>

                            </fieldset>
                                        <input class="bg-light ml-2 form-control border-0 small" type="text"
                                            placeholder="Search architects in lucknow/pune..."
                                            onkeyup="getLiveSearchUsers(this.value,' <?php echo $userLoggedIn;?>')"
                                            name="q" autocomplete="off">

                                        <div class="input-group-append">
                                            <button class="btn btn-primary py-0 btn-block" type="submit"
                                                name="search_creatives_desktop" value="">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <ul class="nav navbar-nav flex-nowrap ml-auto">
                                <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link"
                                        data-toggle="dropdown" aria-expanded="false" href="#"><i class="fas fa-search">
                                        </i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right p-3 animated--grow-in" role="menu"
                                        aria-labelledby="searchDropdown">
                                        <form class="form-inline mr-auto navbar-search w-100" action="search.php"
                                            method="GET" name="search_form">

                                            <div class="row mx-auto">
                                                <div class="col-12 ">
                                                <fieldset style="width:290px">
                                <p class="text-dark">Select Architect or Interior Designer :</p>
                                <div class="toggle mb-2">
                                    <input type="radio" id="cond_new" name="profile" checked="checked"
                                        value="architect">
                                    <label title="Select Architect" class="text-center d-block cursor-pointer"
                                        for="cond_new">Architect</label>
                                    <input type="radio" id="cond_used" name="profile" value="interior designer">
                                    <label title="Select Interior Designer" class="text-center d-block cursor-pointer"
                                        for="cond_used">Interior Designer</label>
                                </div>

                            </fieldset>
                                                </div>
                                            </div>



                                            <div class="input-group">

                                                <!--mobile view search box  -->
                                                <input class="bg-light form-control border-0 small" type="text"
                                                    placeholder="Search architects in lucknow/pune..."
                                                    onkeyup="getLiveSearchUsers(this.value,'<?php echo $userLoggedIn;?>')"
                                                    name="q" autocomplete="off">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary btn-sm py-0" type="submit">
                                                        <i class="fas fa-search"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </li>
                                </a>

                                <li class="nav-item dropdown no-arrow mx-1" role="presentation">
                                    <div class="nav-item dropdown no-arrow">
                                        <a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false"
                                            href="javascript:void(0);"
                                            onclick="getDropdownData('<?php echo $userLoggedIn; ?>', 'message')">
                                            <span class="badge badge-danger badge-counter"><?php
                                              echo $num_messages;  
                                            ?></span>
                                            <i class="fas fa-envelope fa-fw"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-list dropdown-menu-right animated--grow-in dropdown_data_window"
                                            role="menu" style="height:0px; border:none;overflow-y:scroll;">
                                            <script>
                                            var userLoggedIn = '<?php echo $userLoggedIn; ?>';
                                            $(document).ready(function() {

                                                $(window).scroll(function() {
                                                    var inner_height = $('.dropdown_data_window')
                                                        .innerHeight(); //Div containing data
                                                    var scroll_top = $('dropdown_data_window')
                                                        .scrollTop();
                                                    var page = $('.dropdown_data_window').find(
                                                        '.nextPageDropdownData').val();
                                                    var noMoreData = $('.dropdown_data_window')
                                                        .find(
                                                            '.noMoreDropdownData')
                                                        .val();

                                                    if ((scroll_top + inner_height >= $(
                                                                '.dropdown_data_window')[0]
                                                            .scrollHeight) &&
                                                        noMoreData == 'false') {

                                                        var
                                                            pageName; //holds name of page to send ajax request to
                                                        var type = $('#dropdown_data_type').val();
                                                        if (type == 'notification') {
                                                            pageName =
                                                                "ajax_load_notifications.php";
                                                        }
                                                        elseif(type == 'message') {
                                                            pageName = "ajax_load_messages.php";
                                                        }
                                                        var ajaxReq = $.ajax({
                                                            url: "includes/handlers/" +
                                                                pageName,
                                                            type: "POST",
                                                            data: "page=" + page +
                                                                "&userLoggedIn=" +
                                                                userLoggedIn,
                                                            cache: false,

                                                            success: function(response) {
                                                                $('.dropdown_data_window')
                                                                    .find(
                                                                        '.nextPageDropdownData'
                                                                    )
                                                                    .remove(); //Removes current .nextpage 
                                                                $('.dropdown_data_window')
                                                                    .find(
                                                                        '.noMoreDropdownData'
                                                                    )
                                                                    .remove(); //Removes current .nextpage 

                                                                $('.dropdown_data_window')
                                                                    .append(
                                                                        response);
                                                            }
                                                        });

                                                    } //End if 

                                                    return false;

                                                }); //End (window).scroll(function())
                                            });
                                            </script>
                                        </div>

                                    </div>

                                </li>

                                <!-- <li class="nav-item dropdown no-arrow mx-1" role="presentation">
                                    <div class="nav-item dropdown no-arrow">
                                        <a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false"
                                            href="javascript:void(0);"
                                            onclick="getDropdownData('<?php echo $userLoggedIn; ?>', 'message')">
                                            <i class="fas fa-envelope fa-fw"> </i>
                                            <span class="badge badge-danger badge-counter"><?php
                                              echo $num_messages;  
                                            ?></span>
                                        </a>

                                        messages drop down
                                        <div class="dropdown-menu dropdown-menu-right dropdown-list dropdown-menu-right animated--grow- dropdown_data_window"
                                            role="menu" style="height:0px; border:none;overflow-y:scroll;">

                                        </div>

                                    </div>

                                    <div class="shadow dropdown-list dropdown-menu dropdown-menu-right"
                                        aria-labelledby="alertsDropdown">
                                    </div>
                                </li> -->
                                <div class="d-none d-sm-block topbar-divider">
                                </div>
                                <li class="nav-item dropdown no-arrow" role="presentation">
                                    <div class="nav-item dropdown no-arrow">
                                        <a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false"
                                            href="#">
                                            <span class="d-none d-lg-inline mr-2 text-gray-600 small">
                                                <?php
                                                  echo "Hello ".$user['first_name']." ".$user['last_name'];  
                                                ?></span><img class="border rounded-circle img-profile" src="<?php
                                                  echo $user['profile_pic'];  
                                                ?>"></a>
                                        <div class="dropdown-menu shadow dropdown-menu-right animated--grow-in"
                                            role="menu">
                                            <!-- <a class="dropdown-item" role="presentation" href="#"> -->
                                            <!-- <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400">
                                                </i>&nbsp;Profile</a>
                                            <a class="dropdown-item" role="presentation" href="#"><i
                                                    class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Settings</a> -->
                                            <!-- <a class="dropdown-item" role="presentation" href="#"><i
                                                    class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Activity
                                                log</a> -->
                                            <!-- <div class="dropdown-divider"></div> -->
                                            <a class="dropdown-item" role="presentation" href="logout.php"><i
                                                    class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Logout</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </nav>

                    <input type="hidden" id="dropdown_data_type" value="">
