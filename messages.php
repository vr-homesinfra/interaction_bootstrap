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
<div class="container">
    <div class="row">
        <!-- Inbox Column Start -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-gray-900">Inbox</h4>
                </div>
                <div class="card-body">
                    <div class="inbox-chat">
                        
                        <div class="chat-list">
                            <!-- Chat List started -->
                            <!-- <div class='row py-2 active'>
                                <div class='col-md-2 m-auto'>
                                    <img class='img-profile p-1 rounded-circle'
                                        src='https://source.unsplash.com/QAB-WJcbgJk/40x40'>
                                </div>
                                <div class='col-md-10 m-auto'>
                                    <b>Varonika John</b> -->
                                    <?php echo $message_obj->getConvos(); ?>

                                <!-- </div>
                            </div> -->
                            <!-- Chat List end -->
                        </div>                     
                    </div>
                </div>
            </div>
            <!-- Card End -->
        </div>
        <!-- Inbox Column End -->
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-header">
                    <?php
                          // if ($user_to!="new") {
                          //   echo "<h4>You & <a href='$user_to'>".$user_to_obj->getFirstAndLastName()."</a></h4>";
                          // } 
                          
                          if (isset($_GET['u'])) {
                            $user_to=$_GET['u'];
        echo "<h4 class='text-gray-900'>You & <a href='$user_to'>".$user_to_obj->getFirstAndLastName()."</a></h4>"; 
                                      
                          }else{
                            
        $user_to=$message_obj->getMostRecentUser();
        $user_to_obj=new User($con,$user_to);
        
        echo "<h4 class='text-gray-900' >You & <a href='$user_to'>".$user_to_obj->getFirstAndLastName()."</a></h4>"; 
                            
                          }
                        ?>
                </div>
                <div class="card-body">
                    <div class="bootstrap_chat">
                        <div class="container py-1 px-4">
                            <!-- For demo purpose-->
                            <header class="text-center">
                                <h4 class="display-4 text-white"></h4>
                            </header>

                            <div class="row rounded-lg overflow-hidden border">
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
                                            <input type="text" placeholder="Type a message"
                                                aria-describedby="button-addon2"
                                                class="form-control rounded-0 border-0 py-4 bg-light"
                                                name="message_body">
                                            <div class="text-center">

                                                <input type="file" id="file" name="file">

                                                <div class="input-group-append">
                                                    <button id="button-addon2" type="submit" class="btn btn-link"
                                                        name="post_message">
                                                        <i class="fa fa-paper-plane"></i>
                                                    </button>
                                                </div>
                                            </div>
                                    </form>
                                    <!-- File Upload Script Start -->
                                    <script>
                                    $(document).ready(function() {
                                        $(document).on('change', '#file', function() {
                                            var name = document.getElementById("file").files[0].name;
                                            var form_data = new FormData();
                                            var ext = name.split('.').pop().toLowerCase();
                                            if (jQuery.inArray(ext, ['jpeg', 'png', 'jpg', 'jpeg',
                                                    'pdf',
                                                    'dwg'
                                                ]) ==
                                                -
                                                1) {
                                                alert("Invalid Image File");
                                            }
                                            var oFReader = new FileReader();
                                            oFReader.readAsDataURL(document
                                                .getElementById("file").files[0]);
                                            var f = document.getElementById("file").files[0];
                                            var fsize = f.size || f.fileSize;
                                            if (fsize > 20971520) {
                                                alert("Image File Size is very big");
                                            } else {
                                                form_data.append("file", document.getElementById('file')
                                                    .files[
                                                        0]);
                                                $.ajax({
                                                    url: "msgUploadFiles.php",
                                                    method: "POST",
                                                    data: form_data,
                                                    contentType: false,
                                                    cache: false,
                                                    processData: false,
                                                    beforeSend: function() {
                                                        $('#uploaded_imagex').html(
                                                            "<label class='text-success'>Image Uploading...</label>"
                                                        );
                                                    },
                                                    success: function(data) {
                                                        $('#uploaded_imagex').html(data);
                                                        // alert("File Uploaded");
                                                        location.reload();
                                                    }
                                                });
                                            }
                                        });
                                    });
                                    </script>
                                    <!-- File Upload Script End -->

                                    <script>
                                    var div = document.getElementById("scroll_messages");
                                    div.scrollTop = div.scrollHeight;
                                    // e.preventDefault();
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Container End -->

</div>
<!-- Footer Start -->
<footer class="bg-white sticky-footer">
    <div class="container my-auto">
        <div class="text-center my-auto copyright"><span>Copyright © HomesInfra 2020</span></div>
    </div>
</footer>
<!-- Footer End -->
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
</body>

</html>
