<!DOCTYPE html>
<html>
<head>
<!-- ensure that it adapts to device screen -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body{
	/* body attributes */
	font-family: Verdana, sans-serif;
}

*{
	/* to adjust sizing of album image grid */
	box-sizing: border-box;
}

.row > .column {
	/* for the columns within a row */
	padding: 15px 8px;
}

.row:after{
	/* clear floating after the row is done */
	content: "";
	display: table;
	clear: both;
}

.column{
	/* column floats on left of available space taking up 25% of the space */
	float: left;
	width: 25%;
}

/* Modal (background) */
.modal{
	display: none;       /* doesn't appear by default */
	position: fixed;     /* stay fixed in place */
	z-index: 1;          /* shows up on top of any other content on the webpage*/
	padding-top: 100px;  /* location of box */
	left: 0;
	top: 0;
	width: 100%;         /* takes up whole screen space */
	height: 100%;
	overflow: auto;      /* allow scroll if reqd */
	background-color: #0ad2ff; 
}

/* Modal Content Attributes */
.modal-content{
	position: relative;
	background-color: #0ad2ff;
	margin: auto;
	padding: 0;
	width: 50%;
	max-width: 1100px;
}

/* The Close Button at the top right */
.close{
	color: black;
	position: absolute;
	top: 15px;
	right: 30px;
	font-size: 40px;
}

.close:hover, /* how the close button looks when hovered upon, and when clicked*/
.close:focus{
	color: #ff0a64;
	cursor: pointer; /* change the cursor to the pointing hand */
}

/* Next & previous buttons */
.prev,
.next{
	cursor: pointer; /* change the cursor to the pointing hand */
	position: absolute;
	top: 50%;
	width: auto;
	padding: 16px;
	margin-top: -50px;
	border-radius: 0 3px 3px 0;
	color: #21fff8;
	font-size: 20px;
	font-weight: bold;
	transition: 0.5s ease-out;
}

/* move the "next" button all the way to the right */
.next{
	right: 0;
	border-radius: 3px 0 0 3px;
}

/* On hover, add translucent background */
.prev:hover,
.next:hover{
	background-color: #ff2121;
}

/* Image number text (1/7, 2/7 ,...) */
.numberText{
	color: #c4fffd;
	background-color: black; /* to ensure you can read it */
	font-size: 15px;
	padding: 8px 8px;
	position: absolute;
	top: 0;
}

.caption-container{
	/* the caption containing box. pretty self-explanatory */
	background-color: #880dbd;
	padding: 2px 10px;
	color: #85caff; /* spent some time at the google color picker for all the colors */
}

.demo{
	/* unselected image opacity */
	opacity: 0.5;
	cursor: pointer;
}

.active, /* image opacity is 1 if active (selected) or hovered upon */
.demo:hover{
	opacity: 1;
	cursor: pointer;
}

img.hoverShadow{
	transition: 0.2s; /* s p e e d */
}

.hoverShadow:hover{
	/* multiple colors in the hover-shadow because why not */
	box-shadow: 0 4px 8px 0 #ff0000, 0 6px 20px 0 #001aff;
}
</style>
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
<script>
function openModal()
{
	document.getElementById("myModal").style.display = "block";
}
  
function closeModal()
{
    document.getElementById("myModal").style.display = "none";
}
  
var slideIndex = 1;
showSlides(slideIndex);

// for the navigation controls
function slideShift(n)
{
	showSlides(slideIndex += n);
}

// for slide that is being shown
function currentSlide(n)
{
    showSlides(slideIndex = n);
}
  
function showSlides(n)
{
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("demo");
    var captionText = document.getElementById("caption");
    if (n > slides.length){
		slideIndex = 1; // move back to beginning
	}
	if (n < 1){
		slideIndex = slides.length; // go to that position
	}
    for (i = 0; i < slides.length; i++){
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++){
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";
    dots[slideIndex-1].className += " active"; 
    captionText.innerHTML = dots[slideIndex-1].alt; // use caption as alt text as well
}
</script>
</body>
</html>