<html>
<body> <!-- Page that does processing and provides result of upload -->
<form action="upload.php" method="POST">
    <input type="submit" value="Go to the Previous Page" name="previous">
</form>

<?php 

// @ since their value might be undefined, since we don't do all operations at once
@$upload=$_POST["upload"];
@$delete=$_POST["delete"];
@$album=$_POST["album"];
@$previous=$_POST["previous"];
@$next = $_POST["imgUpload"];

if($upload){                                   // when $upload gets a value that is defined and not null
	$count = count($_FILES["myfile"]["name"]); // count number of files user wants to upload
	$validTypes = array("image/jpg");
	if($count > 10){                           // should not be > 10
		echo "<h2>Too many files! Upload at-most 10 at a time! </h2> <br>";
	}
	else{
		                                       // let us traverse the files one by one using foreach
		foreach($_FILES['myfile']['tmp_name'] as $key => $value){
			                                   // look in file name for valid type, as you traverse
			if (!in_array($_FILES['myfile']['type'][$key], $validTypes)){
				echo "<h2>Only jpg format is supported!</h2> <br>";
			}                                  // error message for incorrect format of a file
			$name=$_FILES['myfile']['name'][$key];         // save full filename in $name for future use
			if($_FILES["myfile"]["size"][$key] > 200000){  // 200kB limit
				echo "<h2>File $name is >200kB, which is too large!</h2> <br>";
			}                                  // error message for exceeding file size limit
			else{
				$error = $_FILES["myfile"]["error"][$key]; // this checks for other errors. if no errors, returns 0
				if($error > 0){
					die("<h2>Error in file upload!!! Code $error.</h2> <br>");
				}                              // die() prints message before terminating script execution
				else{
					// if all is O.K., then move file to required folder.
					move_uploaded_file($_FILES['myfile']['tmp_name'][$key],"images/".$_FILES['myfile']['name'][$key]);
					echo "<h2>$name Uploaded Successfully!</h2> <br>";
				    //Give success message and loop back for next file
				}
			}
		}
	}
}

if($delete){
    $name = $_POST['DeleteFile']; // get name of file to be deleted
    $location = "images/".$name;  // location where file should exist
    if(file_exists($location)){   // check if it does
		unlink($location);        // if yes, unlink (i.e. delete file)
        echo "<h2>File $name is deleted</h2> <br>";
    }
    else{
        echo "<h2>File $name does not exist</h2> <br>";
    }
}

if($previous){                    // to go back to prev page after viewing result of upload, i.e. newupload.php
    header("Location: newupload.php");
}

if($next){                        // the button in album.php; directed to newupload.php
	header("Location: newupload.php");
}

if($album){                       // back to album
    header("Location: album.php");
}
?>

</body>
</html>