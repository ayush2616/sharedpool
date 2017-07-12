<?php
session_start();

if(isset($_SESSION['id'])!="")
{
	header("Location: home1");
}
$flagg=1;
$conn = new mysqli("localhost","id1456623_root","12345678","id1456623_sharedpool");

if ($conn->connect_error)
	{
		$flagg=2;                                        //Flag =2 for server error
	}
else
{
if(isset($_POST['login-btn']))
{
	if(isset($_SESSION['id'])!="")
	{
	header("Location: home1.php");
	}
	else
	{
	$reg = $_POST['reg-id'];
	$upass =$_POST['pass'];
	
	$reg = trim($reg);
	$upass = trim($upass);
	
	$res=$conn->query("SELECT id, uid, username,password FROM users WHERE uid='$reg'");
	$row=$res->fetch_assoc();
	
	$count = $res->num_rows;
	
	if($count == 1 && $row['password']==$upass)
	{
		$_SESSION['id'] = $row['id'];
		$_SESSION['name'] = $row['username'];
		$_SESSION['uid']= $row['uid'];
		header("Location: home1.php");
	}
	else
		$flagg=3;										//Flag=3 for wrong username/password
	}
}
}
?>

<html>
	<head>
		<title>LPU SHARED POOL | LOGIN</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
		<link rel="stylesheet" href="css/w3.css">
		<link rel="stylesheet" href="css/style1.css">
	</head>
	
	<body>
		<div id="maindiv">
			<div id="middiv">
				<div id="formdiv" class="w3-round">
					
					<form method="POST">
					<div class="w3-row darkgreen" id="formuprlayer" >
						<div class="w3-col l12 m12 s12"><img src="files/images/logo.png" width="100%"></div>
						<?php if($flagg==3 || $flagg==2) 
								{
									echo '<div class="w3-col l12 m12 s12"><h3 id="errorlog">'; 
									if($flagg==3) 
										echo 'Invalid RegNo/Password'; 
									else echo 'Server Error'; 
									
									echo '</h3></div>';
								}
						 ?>
					</div>
					<div class="form1">
					<div class="w3-row">
						<div class="w3-col paddinput"><input required class="logininp" onclick="removeErrorlog();" name="reg-id" id="regid" type="text" placeholder="Registration Number"></div>
					</div>
					<div class="w3-row">	
						<div class="w3-col paddinput"><input required class="logininp" onclick="removeErrorlog();" id="pas" name="pass" type="password" placeholder="Password"></div>
					</div>	
					<div class="w3-row">
						<div class="w3-col paddinput"><input type="submit" class="w3-round-large w3-hover-grey" name="login-btn" id="loginbtn" value="LOGIN"></div>
					</div>
					</div>
				</form>
				<div class="w3-row">
					<div class="w3-col l12 m12 s12"><h3 class="w3-center" id="signuptext">Don't have an account? <a href="#">SignUp</a></h3></div>
				</div>

				<div class="w3-row">
						<div class="w3-col darkgreen" style="min-height:35px;"></div>
				</div>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="js/loginScript.js"></script>
	</body>

</html>