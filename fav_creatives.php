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
<footer class="bg-white sticky-footer">
    <div class="container my-auto">
        <div class="text-center my-auto copyright"><span>Copyright © HomesInfra 2020</span></div>
    </div>
</footer>
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
