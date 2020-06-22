<?php
  include "includes/header.php";  
   $message_obj=new Message($con,$userLoggedIn);
   
   if (isset($_GET['u'])) {
     $user_to=$_GET['u'];
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
                        </div>

                        <!-- Typing area -->
                        <form action="" class="bg-light" method="POST">
                            <div class="input-group border">
                                <input type="text" placeholder="Type a message" aria-describedby="button-addon2"
                                    class="form-control rounded-0 border-0 py-4 bg-light" name="message_body">
                                <div class="input-group-append">
                                    <button id="button-addon2" type="submit" class="btn btn-link" name="post_message">
                                        <i class="fa fa-paper-plane"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
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
<script src="assets/js/jquery-3.4.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js">
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
<script src="assets/js/script.min.js"></script>
<script src="assets/js/rdjsfile.js"></script>
</body>

</html>
