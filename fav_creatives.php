<?php
include("includes/header.php");
?>
<div class="card shadow-sm mb-3">
    <div class="card-header py-3">
        <p class="text-gray-900 m-0 font-weight-bold">Favourite Creatives</p>
    </div>
    <div class="card-body">
        <form method='post' action=''>
            <div class="text-center">

            </div>
        </form>
        <!--card body end  -->
        <div class='row pb-5 mb-4'>
            <?php 
         $post=new FavCreatives($con,$userLoggedIn);
         $post->displayFavs();
         ?>

        </div>
    </div>
</div>
</div>
<?php
include("footer.php");    
?>
</body>

</html>
