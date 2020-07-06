<?php
  include "includes/header.php";  
   $message_obj=new Message($con,$userLoggedIn);
   
   if (isset($_GET['u'])) {
     $user_to=$_GET['u'];
     $_SESSION['user_to']=$user_to;
   }else{
     $user_to=$message_obj->getMostRecentUser();
    
     if ($user_to=false) {
       $user_to="new";
      }    
    } 
    
    if ($user_to!="new") {
      $user_to_obj=new User($con,$user_to);
    }
    
    $imageName="";
    $image_name_orig="";
    if (isset($_POST['post_message'])) {
      if(isset($_POST['message_body'])){
        if (isset($_GET['u'])) {
            $user_to=$_GET['u'];
            $body=mysqli_real_escape_string($con,$_POST['message_body']);
              $date=date("Y-m-d H:i:s");
              $message_obj->sendMessage($user_to,$body,$date, $imageName,$image_name_orig);
          }else{              
              $body=mysqli_real_escape_string($con,$_POST['message_body']);
              $date=date("Y-m-d H:i:s");
              $user_to=$message_obj->getMostRecentUser();
              $message_obj->sendMessage($user_to,$body,$date, $imageName,$image_name_orig);
            }
          }
    }

    $result=$con->query("SELECT image FROM messages WHERE user_from='$userLoggedIn'");
$row = mysqli_fetch_array($result);
?>
<!-- profile pic & details
<div class="container-fluid">
    <div class="row row-cols-2 mb-3">

        send messages to user

        <div class="col col-lg-12">
            <div class="card mb-3">
                <div class="card-body text-center shadow">
                    <form action="" method="POST">
                        <div class="form-row">
                            <div class='col'>
                                <?php
 
    echo "
        <div class='form-group'>
        <input class='form-control' type='text' placeholder='search associates' name='search_friends'>
        </div>
        </div>
        ";  
?>
                    </form>
                </div>
            </div>
        </div>
    </div> -->

<div class="card mb-3">
    <div class="card-header py-3">
        <p class="text-primary m-0 font-weight-bold">
            <?php
                  // if ($user_to!="new") {
                  //   echo "<h4>You & <a href='$user_to'>".$user_to_obj->getFirstAndLastName()."</a></h4>";
                  // } 
                  
                  if (isset($_GET['u'])) {
                    $user_to=$_GET['u'];
echo "<h4>You & <a href='$user_to'>".$user_to_obj->getFirstAndLastName()."</a></h4>"; 
                              
                  }else{
                    
$user_to=$message_obj->getMostRecentUser();
$user_to_obj=new User($con,$user_to);

echo "<h4>You & <a href='$user_to'>".$user_to_obj->getFirstAndLastName()."</a></h4>"; 
                    
                  }
                ?>
        </p>
    </div>

    <div class="card-body">
        <div class="bootstrap_chat">
            <div class="container py-1 px-4">
                <!-- For demo purpose-->
                <header class="text-center">
                    <h4 class="display-4 text-white"></h4>
                </header>

                <div class="row rounded-lg overflow-hidden border">
                    <!-- Users box-->
                    <!-- <div class="col-5 px-0">
                        <div class="bg-white">

                            <div class="bg-gray px-4 py-2 bg-light">
                                <p class="h5 mb-0 py-1">Recent</p>
                            </div>

                            <div class="messages-box">
                                <div class="list-group rounded-0">
                                    <?php
                                    
  echo $message_obj->getConvos();  
?>
                                </div>
                            </div>
                        </div>
                    </div> -->

                    <!-- Chat Box-->
                    <div class="col-12 px-0">
                        <div class="px-2 py-5 chat-box bg-white" id="scroll_messages">
                            <?php
                            if (isset($_GET['u'])) {
                              $user_to=$_GET['u'];
                                      echo $message_obj->getMessages($user_to);  
                            }else{
                                $user_to=$message_obj->getMostRecentUser();
                                echo $message_obj->getMessages($user_to);                                
                                 }
                        ?>
                            <!-- <span id="uploaded_image">
                                <img class="rounded-circle mb-3 mt-4" src="<?php echo $row['image']; ?>" width="160"
                                    height="160">
                            </span> -->
                        </div>

                        <!-- Typing area -->
                        <form action="" class="bg-light" method="POST">
                            <div class="input-group border">
                                <input type="text" placeholder="Type a message" aria-describedby="button-addon2"
                                    class="form-control rounded-0 border-0 py-4 bg-light" name="message_body">
                                <div class="text-center">

                                    <input type="file" id="file" accept="image/*" name="file">

                                    <div class="input-group-append">
                                        <button id="button-addon2" type="submit" class="btn btn-link"
                                            name="post_message">
                                            <i class="fa fa-paper-plane"></i>
                                        </button>
                                    </div>
                                </div>
                        </form>
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
                                        url: "msgUploadFiles.php",
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
                        <script>
                        var div = document.getElementById("scroll_messages");
                        div.scrollTop = div.scrollHeight;
                        e.preventDefault();
                        </script>
                    </div>
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

</html>
