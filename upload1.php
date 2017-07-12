<?php
session_start();
if(!isset($_POST['submit']))
{
header('Location: home1.php');
}
$uid=$_SESSION["uid"];
$filename=$_POST["filename"];
$filename=trim($filename);
$expiry=$_POST['timespan'];
$expiry=((int)$expiry);
$target_dir = "files/uploads/";
$ext= $_FILES["fileToUpload"]["name"];
$ext= pathinfo($ext, PATHINFO_EXTENSION);
$target_file = $target_dir.$filename.'.'.$ext;
move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);

$size=filesize($target_file);

$conn = new mysqli("localhost","id1456623_root","12345678","id1456623_sharedpool");

		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
	
	$query = "insert into uploadedfiles(uid,filename,ext,expiry,size) values($uid,'$filename','$ext',$expiry,$size)";
	$conn->query($query);
header('Location: home1.php');
?>