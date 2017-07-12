
<?php
session_start();
if(!isset($_POST['submit']))
{
header('Location: home.php');
}
$target_dir = "files/uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
 if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        //$_SESSION['upload_flag']=1;
    } else {
        //$_SESSION['upload_flag']=2;
        }
        header('Location: home.php');
?> 
