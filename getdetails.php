<?php
		session_start();
		if(isset($_SESSION['id'])=="")
		{
  			echo 'loggedout';
		}
		else
		{$id=$_GET['q'];
		$id=substr($id, 8);
		$conn =  new mysqli("localhost","id1456623_root","12345678","id1456623_sharedpool");

		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 

		$sql="SELECT * FROM uploadedfiles WHERE fid = '$id'"; 
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$sql1='SELECT username FROM users WHERE uid = '.$row["uid"];
		$result = $conn->query($sql1);
		$row2=$result->fetch_assoc();
                $sizee=round(intval($row["size"])/(1024*1024),3);

		echo $row["ext"].'`'.$row["up_time"].'`'.$row2["username"].'`'.$sizee.'`'.$row["expiry"].'`'.$row["nod"].'`'.$row["filename"];//----------------------
		}
?>