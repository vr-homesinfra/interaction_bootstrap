<?php
include("includes/header.php");
//project file upload section start

if(isset($_POST['upload_project_file'])) {

	$uploadOk2 = 1;
	$imageName2 = $_FILES['fileToUpload2']['name'];
	$errorMessage2 = "";
	$image_name_orig2="";
	
	if($imageName2 != "") {
		$targetDir2 = "assets/projectFiles/";
		 $image_name_orig2=basename($imageName2); 
		 $imageName2 = $targetDir2 . uniqid() . basename($imageName2);
		 $imageFileType2 = pathinfo($imageName2, PATHINFO_EXTENSION);

		if($_FILES['fileToUpload2']['size'] > 10000000) {
			$errorMessage2 = "Sorry your file is too large";
			$uploadOk2 = 0;
		}

		if(strtolower($imageFileType2) != "jpeg" && strtolower($imageFileType2) != "png" && strtolower($imageFileType2) != "jpg" && strtolower($imageFileType2) != "dwg" && strtolower($imageFileType2) != "dwf" && strtolower($imageFileType2) != "zip" && strtolower($imageFileType2) != "rar") {
			$errorMessage2 = "Sorry, only jpeg, jpg and png,dwg,rar,zip files are allowed";
			$uploadOk2 = 0;
		}

		if($uploadOk2) {
			if(move_uploaded_file($_FILES['fileToUpload2']['tmp_name'], $imageName2)) {
                //image uploaded okay
			}
			else {
				//image did not upload
				$uploadOk2 = 0;
			}
		}
	}
	if($uploadOk2) {
		$date = date("Y-m-d H:i:s");
        
        $insert_query1 = mysqli_query($con, "INSERT INTO fileupload VALUES('','$image_name_orig2', 'application/octet-stream','File Transfer', 'attachment','0','must-revalidate', 'public', '50', '$userLoggedIn','','$date', '', '', '$date', '0', '0', '0','$imageName2')");
	}
	else {
		echo "<div style='text-align:center;' class='alert alert-danger'>
				$errorMessage2
			</div>";
	}
}
//project file upload section ends
?>

<div class="card shadow mb-3">
    <div class="card-header py-1">
        <p class="text-primary m-0 font-weight-bold">Upload a Project</p>
    </div>
    <div class="card-body">

        <form action="" method="post" enctype="multipart/form-data">
            <div>
                <input type="file" id="user_group_logo" class="custom-file-input" name="fileToUpload2">
                <div class="text-center">
                    <label id="user_group_label" for="user_group_logo"><i class="fas fa-upload"></i>&nbsp;Choose a
                        file...</label>
                </div>
                <div class="text-center mt-2">
                    <button class="btn btn-primary" type="submit" name="upload_project_file">Upload</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="text-primary font-weight-bold m-0">Track Projects</h6>
    </div>
    <div class="card-body scroll">
        <?php                       
   $stmt=$db->prepare("SELECT * FROM fileupload WHERE uploaded_by='$userLoggedIn' ORDER BY id DESC ");  
   $stmt->execute();
   while($row=$stmt->fetch()){       
       ?>
        <h4 class="small font-weight-bold">
            <?php
                        echo "Filename:";
                        echo $row['filename']; 
                        echo "  ";
                        echo "Uploaded on:";
                        echo $row['uploaded_on']; 
                            ?>
        </h4>

        <div class="progress progress-sm mb-3" style="height: 15px;">

            <div class="progress-bar bg-success" aria-valuemin="0" aria-valuemax="40" style="width: <?php 
                                        echo $row['sketchup_status'].'%'
                                        ?>;">sketchup
            </div>

            <div class="progress-bar bg-warning" aria-valuemin="0" aria-valuemax="40" style="width: <?php 
                                        echo $row['lumion_status'].'%'
                                        ?>;">lumion
            </div>

            <div class="progress-bar bg-primary" aria-valuemin="0" aria-valuemax="20" style="width: <?php 
                                        echo $row['vr_status'].'%'
                                        ?>;">vr
            </div>

        </div>
        <?php
   }  
?>

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
