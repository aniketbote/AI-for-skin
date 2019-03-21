<?php session_start(); 

//Rediect to Login

if(empty($_SESSION['patient_id']))
        {
        echo "<script>window.location.replace(\"https://desilabel.store/syrus/login\");</script>";
        }

//connect database
$patient_id=$_SESSION['patient_id'];
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

$fetch=mysqli_query($conn, "SELECT * FROM patient WHERE patient_id=\"$patient_id\"");
$row=mysqli_fetch_assoc($fetch);

$name=$row['name'];

?>