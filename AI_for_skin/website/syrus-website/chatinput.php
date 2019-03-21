<?php
    session_start();
    header('Content-Type: application/json; charset=utf-8');
    $servername = "localhost";
    $username = "u480118261_dish";
    $password = "hellodata";
    $dbname = "u480118261_syrus";
    
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    if (!$conn) 
    {
        die("Connection failed: " . mysqli_connect_error());
    }

    $message=$_POST['message'];
    $pid=$_SESSION['patient_id'];
    $sql = "SELECT name FROM patient WHERE patient_id=$pid";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);
    $name = $row[0];
    $date = DateTime::createFromFormat('Y-m-d', '2019-02-22')->setTime(0, 0);
    $timestamp= $date->format('d M Y g:i:s a');

    $sql = "INSERT INTO `message`(`patient_id`,`time`,`message`,`sender`) VALUES ($pid,'$timestamp','$message',0)";
    $result = mysqli_query($conn,$sql);
    $squid=array();
    $squid[0]=$name;
    $squid[1]=$message;
    $squid[2]=$timestamp;
    
    echo json_encode($squid);
?>