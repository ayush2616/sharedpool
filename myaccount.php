<?php
session_start();

if(isset($_SESSION['id'])=="")
{
  header("Location: index.php");
}
$conn =  new mysqli("localhost","id1456623_root","12345678","id1456623_sharedpool");

		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
	$query = "select * from uploadedfiles where uid=".$_SESSION['uid'];
	$result=$conn->query($query);
	$n= $result->num_rows;

?>
<html>
	<head>
		<title>LPU SHARED POOL | Download and Share files</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
		<link rel="stylesheet" href="css/w3.css">
		<link rel="stylesheet" href="css/styleaccount.css">
	</head>
	
	<body>
		<header>																			<!--Header starts here, one main row with three colms-->
			<div class="w3-row w3-black" id="headerrow">
				<div class="w3-col l3 m3 s3">														<!--Logo col-->
					<a href="home1.php"><img src="logo.png" style="width:100%;height:65px"></a>
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
    						<a href="#">My Account</a>
    					    <a href="logout.php">Sign Out</a>
      					</div>
				</div>
			</div>
		</header>
		<div id="mainpanel">
			<div class="w3-row innermainpanel">
				<div class="w3-col l4 m6 s12" id="infopanel" >
						<div style="background-color: #f1f1f1;border-radius: 10px;">
								<li type="none" class="lipadd"><span class="black-bold">Registration Number: </span><span class="blue-italic" id="uname"><?php echo $_SESSION['uid'];?></span></li>
								<li type="none" class="lipadd"><span class="black-bold">Name: </span><span class="blue-italic" id="uname"><?php echo $_SESSION['name'];?></span></li>
								<li type="none" class="lipadd"><span class="black-bold">No. of uploads: </span><span class="blue-italic" id="uname"><?php echo $n;?></span></li>
								<li type="none" class="lipadd"><span class="black-bold">No. of Downloads: </span><span class="blue-italic" id="uname">DUMMY</span></li>
						
						</div>
				</div>
				<div class="w3-col l8 m6 s12" id="uploadhistorypanel">
					<center><legend><b>Your Uploads</b></legend></center>
					<table class="w3-table-all">
    					
      						<tr style="background-color:#33b6ea">
      						    <th>File Name</th>
  						        <th>Upload Time</th>
   						       	<th>Time Left</th>
   						       	<th><center>Delete</center></th>
   						    </tr>
    					<?php
								$i=0;
								$curr_time=date("Y-m-d H:i:s");
			  					if($n==0)
			  						{
			  							echo '<tr>
      											<td colspan="4">You have 0 uploads.You can upload files from home.</td>
    											</tr>';
    								}
    								else
			  							while ($row=$result->fetch_assoc()) 
			  							{	
			  								$fname=$row['filename'];
			  								$up_time=$row['up_time'];
			  								$exp_hours=$row['expiry'];
			  								$t=strtotime($up_time);
			  								$exp_time = date("Y-m-d H:i:s", strtotime('+'.$exp_hours.' hours',$t));
			  								$left_time=strtotime($exp_time)-$t;
			  								$ttt=gmdate("H:i:s",$left_time);
			  								echo '<tr>
      												<td>'.$fname.'</td>
      												<td>'.$up_time.'</td>
      												<td>'.$ttt.'</td>
      												<td><center><b>X</b></center></td>
    											</tr>';
    										$i++;
    									}
    					?>
 					</table>
				</div>
			</div>
		</div>
	</body>
	</html>