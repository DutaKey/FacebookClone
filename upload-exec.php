<?php
include('config.php');





	if (!isset($_FILES['image']['tmp_name'])) {
	echo "";
	}else{
	$file=$_FILES['image']['tmp_name'];
	$image= addslashes(file_get_contents($_FILES['image']['tmp_name']));
	$image_name= addslashes($_FILES['image']['name']);
	$image_size= getimagesize($_FILES['image']['tmp_name']);

	
		if ($image_size==FALSE) {
		
			echo "That's not an image!";
			
		}else{
			
			move_uploaded_file($_FILES["image"]["tmp_name"],"photos/" . $_FILES["image"]["name"]);
			
			$location="photos/" . $_FILES["image"]["name"];
			$uloadedby=$_POST['uloadedby'];
			
			if(!$update=mysql_query("INSERT INTO photos(uploadedby, location)VALUES('$uloadedby', '$location')")) {
			
				echo mysql_error();
				
				
			}
			else{
			
			header("location: photos.php");
			exit();
			}
			}
	}


?>