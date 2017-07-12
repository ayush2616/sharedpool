<?php
session_start();

if(isset($_SESSION['id'])=="")
{
  header("Location: index.php");
}


function short_it($filename,$limit)
{
	if(strlen($filename)>$limit)
      {
      	$filename[$limit+1]=$filename[$limit+2]=$filename[$limit+3]='.';
      		$filename=substr($filename,0,$limit+4);
      		
      }
      return $filename;
}

?>


<html>
	<head>
		<title>LPU SHARED POOL | Download and Share files</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
		<link rel="stylesheet" href="css/w3.css">
		<link rel="stylesheet" href="css/style.css">
		
	</head>
	<body class="w3-light-grey">
<!--HEADER________________________-->
<!-- Navbar -->
	<div class="w3-top">
		<ul class="w3-navbar w3-dark-grey w3-card-2 w3-left-align">
  			<li class="w3-hide-medium w3-hide-large w3-opennav w3-right">
    			<a class="w3-padding-large" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><img src="files/images/bars.png" width="25px" height="20px"></a>
  			</li>
  			<li width="20%"><a href="javascript:void(0)"  class="w3-hover-none w3-hover-text-grey w3-padding-large">HOME</a></li>
  			<li class="w3-hide-small"><a href="javascript:void(0)" class="w3-hover-none w3-hover-text-grey w3-padding-large">My Account</a></li>
  			<li class="w3-hide-small"><a href="javascript:void(0)" class="w3-hover-none w3-hover-text-grey w3-padding-large">Settings</a></li>
  			<li class="w3-hide-small"><a href="logout.php" class="w3-hover-none w3-hover-text-grey w3-padding-large">Sign Out</a></li>
		</ul>
	</div>

<!-- Navigation bar on small screens -->
<div id="mobnav" class="w3-hide w3-animate-top w3-hide-large w3-hide-medium w3-top" style="margin-top:46px">
  <ul class="w3-navbar w3-left-align w3-dark-grey">
    <li><a class="w3-padding-large" href="#">My Account</a></li>
    <li><a class="w3-padding-large" href="#">Settings</a></li>
    <li><a class="w3-padding-large" href="logout.php">Sign Out</a></li>
  </ul>
</div>
<!---HEADER_____________________-->

<div id="uploadpad">
	<div id="uploadmaindiv" class="w3-white w3-border w3-border-blue w3-round-xlarge w3-hover-border-red">
		<div class="w3-center">
			<form style="padding-top:3%" action="upload.php" method="post" enctype="multipart/form-data">
				<div class="w3-row">
    				<div id="browsebtn" class="w3-col l6 m6 s12 w3-padding-16"><div id="browsebtn-in" class=" w3-btn w3-blue"><label id="browsefakebtn">Add file<input type="file" name="fileToUpload" id="fileToUpload"></label></div></div>
    				<div class="w3-col l6 m6 s12 w3-padding-16 "><input class= "w3-btn w3-blue" type="submit" value="Upload File" name="submit"></div>
				</div>
			</form>
			<div id="prog">
			 <div style="height:5px" class="w3-progress-container w3-round">
  				<div class="w3-progressbar w3-blue w3-round-large" style="width:75%"></div>
			</div>
			</div>
		</div>
	</div>
</div>

<div id="uploadlistmain">
	
	<div  id="uploadlist" class="w3-white w3-border w3-border-blue w3-hover-border-red">
		<h2 class="w3-center">Upload List:</h2>
		<?php
			$dir = "files/uploads/";
			$flag=0;
			$audio=array('mp3','rm','wav','wma','aac');
			$video=array('webm','mkv','flv','vob','ogv','ogg','drc','mng','avi','mov','qt','wmv','yuv','asf','amv','mp4','m4p','m4v','mpg','mp2','mpeg','mpe','mpv','mpg','mpeg','m2v','m4v','svi','3gp','3g2','mxf','roq','nsv','flv','f4v','f4p','f4a','f4b');
			$image=array('jpeg','jpg','JPG','jpe','jfif','exif','tif','tiff','gif','bmp','png','ppm','pgm','pbm','pnm','webp','heif','bpg','dib');
		
			if (is_dir($dir)){
  				if ($dh = opendir($dir)){
  					$file=readdir($dh);
  					$i=0;
    				while (($file = readdir($dh)) !== false){
    					if($flag==1)
      					{	
      						$ext = pathinfo($file, PATHINFO_EXTENSION);	 //Extracting extention
                  if($ext=="php")
                    continue;		
      						if($ext=="doc")
      						{
      							$imgfile="doc.png";
      						}
      						else if($ext=="xls")
      						{
      							$imgfile="xls.png";
      						}
      						else if($ext=="txt")
      						{
      							$imgfile="txt.png";
      						}
      						else if($ext=="pdf")
      						{
      							$imgfile="pdf.png";
      						}
      						else if($ext=="ppt")
      						{
      							$imgfile="ppt.png";
      						}
      						else if($ext=="rar")
      						{
      							$imgfile="winrar.png";
      						}
      						else if($ext=="txt")
      						{
      							$imgfile="txt.png";
      						}
      						else if($ext=="zip")
      						{
      							$imgfile="zip.png";
      						}
      						else if(in_array($ext,$audio))
      						{
      							$imgfile="audio.png";
      						}
      						else if(in_array($ext,$video))
      						{
      								$imgfile="video.png";
      						}
      						else if(in_array($ext,$image))
      						{
      								$imgfile="image.png";
      						}
      						else
      							$imgfile="other.png";
                  $imgfile="files/icon/".$imgfile;
      						$filename=short_it(basename($file,'.'.$ext),17);	//Shorting it to a length and without extention
      						if($i%4==0)
								echo '<div class="padupdown"><div class="w3-row-padding">';
								echo '<div class="w3-col l3 m6 s12">
									<div class="w3-card-2 w3-medium w3-container w3-animate-opacity" style="width:100%;height:300px;">
									<img src="'.$imgfile.'" style="width:100%;height:150px">
									<p>'.$filename.'</p>
									<p>Type : '.$ext.'</p>
									<div>
									<a href="'.$dir.$file.'"><button class="w3-btn w3-blue download-btn">Download</button></a>
									</div>
									</div>
									</div>';
							if($i%4==3)
								echo '</div></div>';
								$i++;
      					}
      					else
      						$flag=1;
    				}
    				closedir($dh);
 				 }
			}
			?>
	</div>
</div>
<script type="text/javascript" src="js/script.js"></script>

	</body>
</html>