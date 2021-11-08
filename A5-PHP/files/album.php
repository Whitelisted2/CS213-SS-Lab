<!DOCTYPE html>
<html>
	<head>
		<!-- ensure that it adapts to device screen -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="albumstyle.css">
		<script src="script.js"></script>
	</head>
	<body>
		<h3 style="text-align:center;"><u>Meme Album</u></h3>
		<h4 style="text-align:center;">
    		<i> Click on an image to navigate through the Album. </i>
		</h4>
		<div class="row">
			<?php
			$dir = "images/";         // name of directory where images are stored
			if($opendir = opendir($dir)) // open directory, returns false if not valid directory
			{
				$slide=0;
				while (($file = readdir($opendir)) !==FALSE)
				{
					if ($file!="."&&$file!="..") //exclude parent directories
					{
						$slide+=1;        // increment slide, and echo image as a column element
						echo "<div class='column'>
						<img src='images/$file' height=300px onclick='openModal(); currentSlide($slide)' class='hoverShadow cursor'> 
						</div>";          // on clicking image, openModal() is called, to make myModal display style to block. (initially display: none)
					}                     // also call currentSlide() with argument $slide. 
				}
			}
			?>
		</div>
		<div id="myModal" class="modal">
			<span class="close cursor" onclick="closeModal()">&times;</span>
			<div class="modal-content"> <!-- clicking the closer X invokes closeModal() and makes it to display: none-->
				<?php
				$dir = "images/";
				if($opendir = opendir($dir)) // open directory, returns false if not valid directory
				{
					$slide = 0;
					$allfiles = glob($dir ."*"); // array of all files in the directory
					if($allfiles)                  // checks if there exists any
					{
						$total = count($allfiles); // save number of files for the number text 
					}
					while (($file = readdir($opendir)) !==FALSE)
					{
						if ($file!="."&&$file!="..")
						{
							$slide+=1;             // increment slide count for the display
							echo "<div class='mySlides'>
							<div class='numberText'> $slide / $total </div>
							<img src='images/$file' style='width:100%'>
							</div>";               // the number text and the image itself
						}
					}
				}
				?>
				<a class="prev" onclick="slideShift(-1)">&#10094;<br>PREV</a>
				<a class="next" onclick="slideShift(1)">&#10095;<br>NEXT</a>
				<!--slideShift(n) affects navigation and shifts n slides forward-->
				<div class="caption-container">
					<p id="caption"> </p>
				</div>
				<?php 
				$dir = "images/";
				if($opendir = opendir($dir)) // open directory, returns false if not valid directory
				{
					$allfiles = glob($dir ."*");
					if($allfiles)
					{
						$total = count($allfiles); // getting slide count 
					}
					echo "<a class='begin' onclick='currentSlide(1)' style='font-size: 1.5em; background-color:#e600ff; cursor:pointer;'>&#10094;&#10094;FIRST</a>
         			&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
         			&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;
         			<a class='end' onclick='currentSlide($total)' style='font-size: 1.5em; background-color:#e600ff; cursor:pointer;'>LAST&#10095;&#10095;</a>";
				}
				?>
				<?php 
				$dir = "images/";
				if ($opendir = opendir($dir)) // open directory, returns false if not valid directory
				{
					$slide = 0;
					$allfiles = glob( $dir ."*" );
					if($allfiles)
					{
						$total = count($allfiles);
					}
    				while(($file = readdir($opendir)) !==FALSE)
					{
						if ($file!="."&&$file!="..") // prevent parent directories from showing up
						{
							$slide+=1;
							echo "<div class='column'>
							<img class='demo' src='images/$file' style='width:100%' height=150px onclick='currentSlide($slide)' alt='$file'>
							</div>";
						}
   					}
				}
				?>
			</div>
		</div>
		<br>
		<br>
		<form action="upload.php" method="POST">
			<div style="text-align: center; background-color: grey; ">
  				<br><br>
  				<input type="submit" value="Click here to upload or delete images!" name="imgUpload">
  				<br><br>
			</div>
		</form>
	</body>
</html>