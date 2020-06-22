<?php
include("includes/header.php");

if(isset($_POST['post_button'])){
	$post = new Post($con, $userLoggedIn);
	$post->submitPost($_POST['post_text'], 'none');
}

?>
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-lg-3">
            <div class="card mb-3">
                <div class="card-body text-center shadow">
                    <img class="rounded-circle mb-3 mt-4" src="<?php echo $user['profile_pic']; ?>" width="160"
                        height="160">
                    <div class="text-center">
                        <a href="<?php echo $userLoggedIn; ?>">
                            <?php 
			                echo $user['first_name'] . " " . $user['last_name'];
			                ?>
                        </a>
                        <br>
                        <?php
                        echo "Posts: " . $user['num_posts']. "<br>"; 
			            echo "Likes: " . $user['num_likes'];
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="row">
                <div class="col">
                    <div class="card shadow mb-3">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold">NewsFeed</p>
                        </div>
                        <div class="card-body">
                            <div class="col-12">
                                <form method="POST" action="index.php">
                                    <div class="form-group">
                                        <textarea class="form-control" name="post_text">
                                        </textarea>
                                        <hr>
                                        <button class=" btn btn-primary btn-block btn-sm flex-fill" type="submit"
                                            name="post_button">Post</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <hr>

                        <div class="posts_area">
                            <?php 
                            $post=new Post($con,$userLoggedIn);
                            $post->loadPostsFriends();
                            ?>
                            <!-- <img id="loading" src="assets/images/icons/loading.gif"> -->

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
<script>
var userLoggedIn = '<?php echo $userLoggedIn; ?>';
$(document).ready(function() {

    $('#loading').show();

    //Original ajax request for loading first posts 
    $.ajax({
        url: "includes/handlers/ajax_load_posts.php",
        type: "POST",
        data: "page=1&userLoggedIn=" + userLoggedIn,
        cache: false,

        success: function(data) {
            $('#loading').hide();
            $('.posts_area').html(data);
        }
    });

    $(window).scroll(function() {
        var height = $('.posts_area').height(); //Div containing posts
        var scroll_top = $(this).scrollTop();
        var page = $('.posts_area').find('.nextPage').val();
        var noMorePosts = $('.posts_area').find('.noMorePosts').val();

        if ((document.body.scrollHeight == document.body.scrollTop +
                window.innerHeight) &&
            noMorePosts == 'false') {
            $('#loading').show();

            var ajaxReq = $.ajax({
                url: "includes/handlers/ajax_load_posts.php",
                type: "POST",
                data: "page=" + page + "&userLoggedIn=" +
                    userLoggedIn,
                cache: false,

                success: function(response) {
                    $('.posts_area').find('.nextPage')
                        .remove(); //Removes current .nextpage 
                    $('.posts_area').find('.noMorePosts')
                        .remove(); //Removes current .nextpage 

                    $('#loading').hide();
                    $('.posts_area').append(response);
                }
            });

        } //End if 

        return false;

    }); //End (window).scroll(function())
});
</script>
<footer class="bg-white sticky-footer">
    <div class="container my-auto">
        <div class="text-center my-auto copyright"><span>Copyright © HomesInfra 2020</span></div>

    </div>
</footer>
</div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a></div>
<script src="assets/js/jquery-3.4.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js">
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
<script src="assets/js/script.min.js"></script>
<script src="assets/js/rdjsfile.js"></script>
</body>

</html>
