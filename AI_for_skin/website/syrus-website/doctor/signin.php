<?php session_start(); 

//Rediect to Login

/*if(empty($_SESSION['doctor_id']))
        {
        echo "<script>window.location.replace(\"https://desilabel.store/syrus/login\");</script>";
        }
*/
//connect database
//$doctor_id=$_SESSION['doctor_id'];
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
$fetch=mysqli_query($conn, "SELECT * FROM doctor WHERE username='".$_POST['username']."'");
$row=mysqli_fetch_assoc($fetch);

$doctor_id=$row['doctor_id'];
$name=$row['name'];
$username=$row['username'];
$password=$row['password'];

if($password==$_POST['password']){
 $_SESSION['doctor_id']=$doctor_id;   
 echo "<script>window.location.replace(\"https://desilabel.store/syrus/doctor/entry.php\");</script>";   
}else{
 echo "<script>window.location.replace(\"https://desilabel.store/syrus/doctor/login.php\");</script>";   
}
?>