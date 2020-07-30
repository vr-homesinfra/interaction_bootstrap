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
        <title>Search Architects and Interior Designers</title>
        <link rel="stylesheet" href="assets/css/mystyles.css">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous">
        </script>
        <link rel="stylesheet" href="rd/assets/css/main.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
        <link rel="stylesheet" href="rd/assets/css/styles.min.css?h=2cfe18d2d8a32b71eadff2883706ad0e">
        <link rel="stylesheet" href="assets/css/switchStyles.min.css">
    </head>
    <body>
        <?php require('./includes/bs_navbar.php');?>
        <style>
        .bg-orange {
            color: white;
        }   
        </style>
        <div class="container my-5 py-5" id="main-container">
            <div id="img-logo" class="text-center pt-4">
                <img class="img-fluid d-lg-none d-sm-block w-50" src="<?php echo $logoSrc; ?>">
                <img class="img-fluid d-none d-lg-inline" style="width: 15%!important;" src="<?php echo $logoSrc; ?>">
            </div>

            <div id="search-system" class="">

                <form method="GET" role="search" action="extSearchProfiles.php" name="search_form">

                    <!-- dropdown start-->
                    <div class="row mb-0 m-auto" style="max-width: 552px;">
                        <div class="col-12 p-0">
                            <style>
                            ::-webkit-input-placeholder {
                                /* Edge */
                                color: red;
                            }

                            :-ms-input-placeholder {
                                /* Internet Explorer */
                                color: red;
                            }

                            ::placeholder {
                                text-align: center !important;
                            }

                            </style>
                            <fieldset>
                                <p class=" text-center mb-1 text-dark">Select a Professional :</p>
                                <div class="toggle m-4">
                                    <input type="radio" id="cond_new" name="profile" checked="checked"
                                        value="architect">
                                    <label title="Select Architect" class="text-center d-block cursor-pointer"
                                        for="cond_new" style="cursor: pointer!important;">Architect</label>
                                    <input type="radio" id="cond_used" name="profile" value="interior designer">
                                    <label title="Select Interior Designer" class="text-center d-block cursor-pointer"
                                        for="cond_used" style="cursor: pointer!important;">Interior Designer</label>
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
                                        <button class="text-white btn p-0 " type="submit"><i class="fas fa-search"
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
                    <div class="row drop-list">
                        <div class="col-md-6 w-100 m-auto border-0 search_results">

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

        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
 
        <script src="rd/assets/js/script.min.js"></script>
        <script src="assets/js/rdjsfile.js"></script>
        <script src="assets/js/demo.js"></script>

    </body>

</html>
