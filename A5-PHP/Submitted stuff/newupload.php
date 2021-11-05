<html>
<body>
<h1 style="text-align:center;"><b><u>Upload/Delete Image</u></b></h1>
<?php
$placeholder = 0;
?>
<center>
<form action="upload.php" method="POST" enctype="multipart/form-data">

	<fieldset>
	<b> File Upload </b><br>
    <input type="file" name="myfile[]" multiple><br><br>
	<!-- able to take multiple inputs. checking validity is in upload.php -->
    <input type="submit" value="Upload" name="upload" ><br><br>
	</fieldset>
	
	<fieldset>
	<b> File Deletion </b><br>
    <input type="submit" value="Delete" name="delete" style="background-color:red;">
    <input type="text" name="DeleteFile" id="DeleteFile"><br>
    <p><b>Ensure that you enter file name with its extension</b></p><br>
	</fieldset>
	
    <input type="submit" value="Go to Album" name="album"><br>
	
</form>
</center>
</body>
</html>