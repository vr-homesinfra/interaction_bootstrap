<?php
include("includes/header.php");
//gallery images upload section starts

//gallery images upload section ends
$result=$con->query("SELECT * FROM creative_gallery WHERE uploaded_by='$userLoggedIn' ORDER BY id DESC");
?>

<div class="card shadow-sm mx-3 mb-3">
    <div class="card-header py-3">
        <p class="text-gray-900 m-0 font-weight-bold">Upload an image</p>
    </div>
    <div class="card-body">
        <div class=" text-center">
            <input type="file" id="file" accept="image/*" name="file" value="Post Gallery">
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
                            url: "galleryUpload.php",
                            method: "POST",
                            data: form_data,
                            contentType: false,
                            cache: false,
                            processData: false,
                            beforeSend: function() {
                                $('#uploaded_image img').attr('src',
                                    'http://localhost/interaction_bootstrap/assets/images/icons/uploadcloud.gif'
                                );
                            },
                            success: function(data) {
                                // $('#uploaded_image').html(data);
                                // var rdimagepath = data;
                                // $('#uploaded_image img, #uploaded_image_header img')
                                //     .attr('src', data);
                            }
                        });
                    }
                });
            });
            </script>

        </div>
        <!--card body end  -->
    </div>
</div>
<div class="card mx-3 mb-3 shadow-sm">
    <div class="card-header py-3">
        <p class="text-gray-900 m-0 font-weight-bold">Profile Gallery</p>
    </div>
    <!--php driven carousel  -->
    <div class="card-body">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <?php
				  $i=0;
				  foreach ($result as $row) {
					  $actives='';
					  if ($i==0) {
						  $actives="active";
					  }
				?>
                <li data-target="#carouselExampleIndicators" data-slide-to="<?=
				  $i;  
				?>" class="<?=
				  $actives;  
				?>"></li>
                <?php
				$i++;
			}
				?>
            </ol>
            <div class="carousel-inner">
                <?php
				  $i=0;
				  foreach ($result as $row) {
					  $actives='';
					  if ($i==0) {
						  $actives="active";
					  }				    
				?>
                <div class="carousel-item <?=
				  $actives;  
				?>">
                    <img class="d-block w-100" src="<?=
					  $row['filepath'];  
					?>" width="100%" height="400px">
                </div>
                <?php
				$i++;
				  }				  
				?>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <!--card body end  -->
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
