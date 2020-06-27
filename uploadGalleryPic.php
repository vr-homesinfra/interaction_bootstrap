<?php
include("includes/header.php");
//gallery images upload section starts
if(isset($_POST['gallery_image_upload'])) {

	$uploadOk3 = 1;
	$imageName3 = $_FILES['fileToUpload3']['name'];
	$errorMessage3 = "";
	$image_name_orig3="";
	
	if($imageName3 != "") {
		$targetDir3 = "assets/gallery_pics/";
		 $image_name_orig3=basename($imageName3); 
		 $imageName3 = $targetDir3 . uniqid() . basename($imageName3);
		 $imageFileType3 = pathinfo($imageName3, PATHINFO_EXTENSION);

		if($_FILES['fileToUpload3']['size'] > 10000000) {
			$errorMessage3 = "Sorry your file is too large";
			$uploadOk3 = 0;
		}

		if(strtolower($imageFileType3) != "jpeg" && strtolower($imageFileType3) != "png" && strtolower($imageFileType3) != "jpg") {
			$errorMessage3 = "Sorry, only jpeg, jpg and png files are allowed";
			$uploadOk3 = 0;
		}

		if($uploadOk3) {
			if(move_uploaded_file($_FILES['fileToUpload3']['tmp_name'], $imageName3)) {
                //image uploaded okay
			}
			else {
				//image did not upload
                $uploadOk3 = 0;
                $errorMessage3 = "file did not upload";
			}
		}
	}
	if($uploadOk3) {
		$date = date("Y-m-d H:i:s");
        $insert_query2 = mysqli_query($con, "INSERT INTO creative_gallery VALUES('','$image_name_orig3', 'application/octet-stream','File Transfer', 'attachment','0','must-revalidate', 'public', '50', '$userLoggedIn','$date','$imageName3')");
	}
	else {
		echo "<div style='text-align:center;' class='alert alert-danger'>
				$errorMessage3
			</div>";
	}
}
//gallery images upload section ends
$result=$con->query("SELECT * FROM creative_gallery WHERE uploaded_by='$userLoggedIn' ORDER BY id DESC");
?>

<div class="card shadow-sm mx-3 mb-3">
	<div class="card-header py-3">
		<p class="text-gray-900 m-0 font-weight-bold">Upload an image</p>
	</div>
	<div class="card-body">
		<form method='post' action='' enctype='multipart/form-data'>
			<div class=" text-center">
				<input type="file" id="user_group_logo" class="custom-file-input" accept="image/*" name="fileToUpload3">
				<div class="text-center btn border-bottom-primary btn-light shadow">
					<label id="user_group_label" class="mb-0" for="user_group_logo">
						<i class="fas fa-upload"></i> Choose an Image</label>
				</div>
				<div class="text-center mt-3">
					<button class="btn btn-primary" type="submit" name="gallery_image_upload">Upload</button>
				</div>
			</div>
		</form>
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
