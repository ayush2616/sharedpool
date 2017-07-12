<?php
session_start();

if(isset($_SESSION['id'])=="")
{
  header("Location: index");
}

//----------------------------------if search is used and creating the where clause string for the query------------------------------
$searchflag=0;
if(isset($_GET["search"]))
{
	$searchflag=1;
	$s_split=explode(" ",$_GET["search"]);
	$querysuffix=" where";
	$flag4=0;
	foreach ($s_split as $j) {
		if($flag4==0)
			$flag4=1;
		else
			$querysuffix.=" or";
		$querysuffix.= " filename like '%$j%'";
	}
}

//---------------------------------Connection and result fetch from database-------------------------------------------------
$conn = new mysqli("localhost","id1456623_root","12345678","id1456623_sharedpool");

		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
	$query = "select * from uploadedfiles";
	if($searchflag==1)
		$query.=$querysuffix;
	$result=$conn->query($query);
	$n= $result->num_rows;

//----------------------------------------------------------------------------------------------------------------------------


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
		<link rel="stylesheet" href="css/stylehome.css">
	</head>
	
	<body>
		<header>																			<!--Header starts here, one main row with three colms-->
			<div class="w3-row w3-black" id="headerrow">
				<div class="w3-col l3 m3 s3">														<!--Logo col-->
					<a href="home1"><img src="logo.png" style="width:100%;height:65px"></a>
				</div>
				<div class="w3-col l7 m6 s5">														<!--Mid blank col-->
					<div id="headermidblank">
						<p id="statuslog"></p>
					</div>
				</div>

				<div class="w3-col l2 m3 s4" id="usertab">					<!--User Circle dp and tab-->
						<div id="usertabinner">
							<?php echo $_SESSION['name']; ?>
						</div>
						<div class="w3-col l2 m3 s4 w3-top" id="dropdown-content">
    						<a href="myaccount">My Account</a>
    					    <a href="logout.php">Sign Out</a>
      					</div>
				</div>
			</div>
		

		<div id="optiontabparent">																				<!--Options tab-->
			<div class="w3-row w3-light-grey" id="optiontab">
				

				<div class="w3-col l2 m2 s2 padd">														
					Sort
				</div>

				
				<div class="w3-col l4 m4 s4" id="searchboxdiv">		
				<form id="searchform" method="GET">										
					<input type="text" id="searchbox" name="search" placeholder="Search Anything">
				</form>
				</div>

				<div class="w3-col l3 m3 s3 padd">														
					Download
				</div>

				<div class="w3-col l3 m3 s3 padd">														
					<div id="uploadtab" onclick="toggleUpload();">
						Upload <img id="dropdownicon" src="dropdownicon.png" width="20px" height="20px" />
					</div>
				</div>


			</div>
		</div>
		</header>
<!---=======================================================End of Option Tab============================================================-->




<!--======================================================Start of Main Panel With Two Big colms=========================================-->
		
		<div id="mainpanel">
			<div id="innermainpanel">
				<div class="w3-row">
					<div class="w3-col l9 m9 s9 maxx-height" id="fileslist">
					<?php
						
						$dir = "files/uploads/";
						$audio=array('mp3','rm','wav','wma','aac');
						$video=array('webm','mkv','flv','vob','ogv','ogg','drc','mng','avi','mov','qt','wmv','yuv','asf','amv','mp4','m4p','m4v','mpg','mp2','mpeg','mpe','mpv','mpg','mpeg','m2v','m4v','svi','3gp','3g2','mxf','roq','nsv','flv','f4v','f4p','f4a','f4b');
						$image=array('jpeg','jpg','JPG','jpe','jfif','exif','tif','tiff','gif','bmp','png','ppm','pgm','pbm','pnm','webp','heif','bpg','dib');
						$misc=array('doc','xls','txt','pdf','ppt','rar','txt','zip');
						if (is_dir($dir)){
			  					$i=0;
    							while ($row=$result->fetch_assoc()){
      									$ext = $row['ext'];	 //Extracting extention
                  						if($ext=="php")
                    						continue;		
      									if(in_array($ext,$misc))
      									{
      										$imgfile=$ext.".png";
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
      									$filename=short_it($row['filename'],17);	//Shorting it to a length and without extention
      									if($i%4==0)
											echo '<div class="w3-row-padding">';
										
										echo '<div class="w3-col l3 m6 s12" id="cardparent">
										<div class="card" id="element-'.$row['fid'].'" onclick="selectdiv(this);" style="width:100%;">
										<img src="'.$imgfile.'" style="width:50px;height:50px">
										<p>'.$filename.'</p>
										<p>Type : '.$ext.'</p>
										<div>
										<a href="'.$dir.$row['filename'].'.'.$ext.'"><button class="w3-btn w3-blue download-btn">Open</button></a>
										</div>
										</div>
										</div>';
							
										if($i%4==3)
										echo '</div>';
										$i++;
      								}																//While loop end																			
    							if($i%4!=0)
									echo '</div>';
 								}
							?>
					</div>

					<div class="w3-col l3 m3 s3" id="propertypanelmain">
						<div id="propertypanel" class="w3-animate-bottom">
							<ul type="none">
								<center>
									<li><h3>Properties</h3></li>
									<li id="loadingimg"><img class="w3-spin" src="loading.png" width="50px" height="50px" /></li>
									<li id="fname"></li>
									<li id="ftype"></li>
									<li id="fdate"></li>
									<li id="funame"></li>
									<li id="fsize"></li>
									<li id="fexp"></li>
									<li><a id="downlink" style="text-decoration: none;" download><button class="w3-btn w3-blue download-btn" id="downbtn" style="display:none">Download</button></a>
										<a><button class="w3-btn w3-red download-btn" id="reportbtn" style="display:none">REPORT</button></a></li>
								</center>
							</ul>
					
						</div>
						<div id="uploadpanel" class="w3-animate-top">
							<ul type="none" style="margin:0px;">
								<center><li><h3 style="color:#33b6ea;"><b>Upload</b></h3></li>
								<li>
			 						<div id="proginner" class="w3-progress-container">
  										<div class="w3-progressbar" id="progbar"></div>
									</div>
								</li>
								<form method="POST" action="upload1.php" enctype="multipart/form-data">
								<li>
										<label>
											<div id="selectfilebtn">
												Select File
												<input type="file" required name="fileToUpload" id="realselectbtn">
											</div>
										</label>
								</li>
								<li><input type="text" id="inputfilename" name="filename" required placeholder="File Name"></li>
								<li>Expiry Time</li>
								<li>
									<div class="w3-row">
										<div class="w3-col l6 m6 s6"><input type="radio" name="timespan" value="6"> 6 Hrs</div>
										<div class="w3-col l6 m6 s6"><input type="radio" name="timespan" value="12"> 12 Hrs</div>
									</div>
								</li>
								<li>
									<div class="w3-row">	
										<div class="w3-col l6 m6 s6"><input type="radio" name="timespan" value="24" checked> 24 Hrs</div>
										<div class="w3-col l6 m6 s6"><input type="radio" name="timespan" value="48"> 48 Hrs</div>
									</div>		
								</li>
								<li>
									<input type="submit" value="" name="submit" id="gobtn">
								</li>
								<form>
								</center>
								
							</ul>
					
						</div>
					</div>

				</div>
			</div>
		</div>

		<script type="text/javascript" src="script.js"> </script>
	</body>
</html>