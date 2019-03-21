<?php session_start(); 
    header('Content-Type: application/json; charset=utf-8');

//Rediect to Login

if(empty($_SESSION['patient_id']))
        {
        echo "<script>window.location.replace(\"https://desilabel.store/syrus/login.php\");</script>";
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
$c=0;
$time=array();
$message=array();
$sender=array();
$senderid=array();
$sendername=array();
$full=array();
$each=array();
$fetch=mysqli_query($conn, "SELECT * FROM message WHERE patient_id=\"$patient_id\"");
while($row=mysqli_fetch_assoc($fetch)){
    $each[2]=$row["time"];
    $each[1]=$row["message"];
    $sender[$c]=$row["sender"];
    if($sender[$c]==0){
        $senderid[$c]=$patient_id;
        $fetch2=mysqli_query($conn, "SELECT name FROM patient WHERE patient_id=\"$patient_id\"");
    }else{
        $senderid[$c]=$row["doctor_id"];
        $fetch2=mysqli_query($conn, "SELECT name FROM doctor WHERE doctor_id=\"$sender_id[$c]\"");
    }
    $row2=mysqli_fetch_array($fetch2);
    $each[0]=$row2[0];
    $full[$c]=$each;
    $c++;
    
}
$out = array();
$out[0]=$c;
$out[1]=$final;
echo json_encode($out);
?>