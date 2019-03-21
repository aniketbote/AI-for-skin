<?php
$servername = "localhost";
$username = "u480118261_dish";
$password = "hellodata";
$dbname = "u480118261_syrus";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) 
{
    die("Connection failed: " . mysqli_connect_error());
}

//fetch values 
$name=$_POST['name'];
$username=$_POST['username'];
$password=$_POST['password'];
$query="INSERT INTO `patient`(`name`,`username`,`password`) VALUES ('".$name."','".$username."','".$password."')";
$fetch=mysqli_query($conn,$query);
echo "<script>window.location.replace(\"https://desilabel.store/syrus/login.php\");</script>";   

?>