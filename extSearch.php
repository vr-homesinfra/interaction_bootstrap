<?php
  require 'config/config.php';
  $site_url = 'http://'.$_SERVER['HTTP_HOST'].'/';
$str="";
?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>search page</title>

        <link rel="stylesheet" href="assets/css/mystyles.css">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous">
        </script>

        <!-- <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css"> -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
        <link rel="stylesheet" href="rd/assets/css/styles.min.css?h=2cfe18d2d8a32b71eadff2883706ad0e">
        <link rel="stylesheet" href="rd/assets/css/main.css">
        <link rel="stylesheet" href="assets/css/switchStyles.min.css">
    </head>

    <body>
        <nav class="navbar fixed-top navbar-dark bg-light">
            <nav class="navbar w-75 navbar-dark fixed-top bg-orange off-canvas" data-right-drawer="0" data-open-drawer="0">
                <div class="container-fluid flex-column">
                    <button class="mt-2 m-n2 mt-lg-0 btn btn-light drawer-knob" type="button" data-open="drawer"><i
                            class="fas fa-bars"></i>
                    </button>
                    <div class="d-flex justify-content-between brand-line">
                        <button class="btn btn-primary " type="button" data-dismiss="drawer">
                            <span class="sr-only">Toggle
                                Navigation </span><i class="fas fa-times"></i>

                        </button>
                        <a class="navbar-brand" href="https://homesinfra.com/">HomesInfra</a>
                    </div>
                    <ul class="nav navbar-nav flex-column drawer-menu">
                        <li role="presentation" class="nav-item">
                            <a class="nav-link active" href="#">Find Creatives</a>
                        </li>
                        <li role="presentation" class="nav-item"><a class="nav-link"
                                href="https://homesinfra.com/virtualreality/">Virtual Reality</a>
                        </li>
                        <li role="presentation" class="nav-item"><a class="nav-link"
                                href="https://homesinfra.com/homesinfra-showcase/">Showcase</a>
                        </li>
                        <li role="presentation" class="nav-item"><a class="nav-link"
                                href="https://homesinfra.com/3d-visualization-to-implementation/">3D to Reality</a>
                        </li>
                        <li role="presentation" class="nav-item"></li>
                        <li role="presentation" class="nav-item"></li>
                        <li role="presentation" class="nav-item"><a class="nav-link active"
                                href="https://homesinfra.com/about-us/">About Us</a></li>
                        <li role="presentation" class="nav-item"><a class="nav-link"
                                href="https://homesinfra.com/contact-us/">Contact Us</a></li>
                        <li role="presentation" class="nav-item"><a class="nav-link"
                                href="https://homesinfra.com/privacy-policy/">Privacy Policy</a></li>
                    </ul>
                </div>
            </nav>
            <a class="navbar-brand p-0 d-none d-md-block ml-5">
                <img width="50px;" src="rd/assets/img/logo-hi.svg" alt="">
            </a>
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active"></li>
            </ul>
            <a class=" btn btn-primary my-2 my-sm-0"
                href="http://homesinfra.com/interact/otpLogin.php">Login</a>

        </nav>
        <div class="container py-5" id="main-container">
            <div id="img-logo" class="text-center pt-5">
                <img src="rd/assets/img/logo-hi.svg" style="width: 200px;">
            </div>

            <div id="search-system" class="">

                <form method="GET" role="search" action="extSearchProfiles.php" name="search_form">

                    <!-- dropdown start-->
                    <div class="row mb-0 m-auto" style="max-width: 552px;">
                        <div class="col-12 p-0">
                            <style>
                            ::-webkit-input-placeholder {
                                /* Edge */
                                text-align: center !important;
                            }

                            :-ms-input-placeholder {
                                /* Internet Explorer */
                                text-align: center !important;
                            }

                            ::placeholder {
                                text-align: center !important;
                            }

                            </style>

                            <fieldset>
                            <p class="text-dark">Select Architect or Interior Designer :</p>
                                <div class="toggle mb-2">
                                <input type="radio" id="cond_new" name="bike_cond" checked="checked">
                                    <label title="Select Architect" class="text-center d-block cursor-pointer" for="cond_new">Architect</label>
                                    <input type="radio" id="cond_used" name="bike_cond" value="interior designer">
                                    <label title="Select Interrior Designer" class="text-center d-block cursor-pointer" for="cond_used">Interior Designer</label>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <div class="row mb-0 m-auto" style="max-width: 552px;">

                        <div class="col-12 p-0">
                            <div class="input-group px-0 px-sm-0 col-lg-12">
                                <!-- Search Input -->
                                <input type="text" class="shadow-sm form-control" placeholder="Enter City"
                                    autocomplete="off" id="search_text_input"
                                    onkeyup="getExtLiveSearchUsers(this.value)" name="city" />
                                <div class="input-group-append">
                                    <span class="input-group-text bg-success">

                                        <!-- Orange Button -->
                                        <button class="text-white btn p-0 " type="submit"><i class="fas fa-search "
                                                name="find_creatives" id="find_creatives"></i>
                                        </button>

                                        <!-- <a name="find_creative" id="" class="btn btn-primary" role="button"><i
                                                class="fas fa-search" name="find_creatives" id="find_creatives"></i></a> -->
                                    </span>
                                </div> <!-- Orange Button End -->
                            </div>
                        </div>
                        <!-- City End -->
                    </div>
                    <!-- put the selected entry from city ajax dropdown -->
                    <!-- into the textbox-->
                    <script>
                    $(document).on("click", ".city", function() {
                        var clickedBtnID = $(this).text(); // or var clickedBtnID = this.id
                        $('#search_text_input').val(clickedBtnID);
                    });
                    </script>
                    <!-- Profiles -->
                    <div class="row profiles-list">
                        <div class="col-md-6 m-auto border-0 search_results">

                            <!-- Loop from here -->

                            <!-- Loop till here -->

                        </div>
                    </div>
                </form>
            </div>
        </div> <!-- Main Container End -->
        <!-- Container for Social Icons -->
        <div class="container">

            <div class="row pt-5">
                <div class="col-lg-2 col-6 m-auto">
                    <div class="row m-auto">

                        <div class="col-4">
                            <img class="img-fluid"
                                src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/cd/Facebook_logo_%28square%29.png/480px-Facebook_logo_%28square%29.png"
                                alt="...">
                        </div>

                        <div class="col-4">
                            <img class="img-fluid"
                                src="https://lh3.googleusercontent.com/2sREY-8UpjmaLDCTztldQf6u2RGUtuyf6VT5iyX3z53JS4TdvfQlX-rNChXKgpBYMw"
                                alt="...">
                        </div>

                        <div class="col-4">
                            <img class="img-fluid"
                                src="https://lh3.googleusercontent.com/x3XxTcEYG6hYRZwnWAUfMavRfNNBl8OZweUgZDf2jUJ3qjg2p91Y8MudeXumaQLily0"
                                alt="...">
                        </div>

                    </div>
                </div>
            </div>
        </div> <!-- Container for Social Icons End -->
        <script src="assets/js/jquery-3.4.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.bundle.min.js">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
        <script src="assets/js/script.min.js"></script>
        <script src="rd/assets/js/script.min.js"></script>
        <script src="assets/js/rdjsfile.js"></script>
        <script src="assets/js/demo.js"></script>

    </body>

</html>
