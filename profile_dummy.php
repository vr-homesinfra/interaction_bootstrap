<div class="card shadow mb-3">
    <div class="card-header py-3">
        <p class="text-primary m-0 font-weight-bold">Profile</p>
    </div>
    <div class="card-body">
        <?php
        if(isset($_GET['profile_username'])) {
         echo   $username = $_GET['profile_username'];
            $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$username'");
            $user_array = mysqli_fetch_array($user_details_query);
            // $num_friends = (substr_count($user_array['friend_array'], ",")) - 1;
        }
        //remove friend functionality
        if (isset($_POST['remove_friend'])) {
            $user=new User ($con,$userLoggedIn);
            $user->removeFriend($username);
        }
        //add friend functionality
        if (isset($_POST['add_friend'])) {
            $add_friend_query=mysqli_query($con,"UPDATE users SET friend_array=CONCAT(friend_array,'$username,')WHERE username='$userLoggedIn'");
        }   
?>
        <form method="POST" action="<?php echo $username; ?>">
            <?php
 			$logged_in_user_obj = new User($con, $userLoggedIn); 
             if($logged_in_user_obj->isFriend($username)) {
                echo '<div class="form-group">
                <button class=" btn btn-primary  btn-sm flex-fill" type="submit" name="remove_friend">Remove as
                    Favourite</button>
            </div>';
            }else{
                echo '<div class="form-group">
                <button class=" btn btn-primary  btn-sm flex-fill" type="submit" name="add_friend">Add
            as
            Favourite</button>
    </div>';
    }
    ?>

        </form>
    </div>
</div>
</div>
