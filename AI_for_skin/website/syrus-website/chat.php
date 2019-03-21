<?php session_start(); 

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
$fetch=mysqli_query($conn, "SELECT * FROM message WHERE patient_id=\"$patient_id\"");
while($row=mysqli_fetch_assoc($fetch)){
    $time[$c]=$row["time"];
    $message[$c]=$row["message"];
    $sender[$c]=$row["sender"];
    if($sender[$c]==0){
        $senderid[$c]=$patient_id;
        $fetch2=mysqli_query($conn, "SELECT name FROM patient WHERE patient_id=\"$patient_id\"");
    }else{
        $senderid[$c]=$row["doctor_id"];
        $fetch2=mysqli_query($conn, "SELECT name FROM doctor WHERE doctor_id=\"$sender_id[$c]\"");
    }
    $row2=mysqli_fetch_array($fetch2);
    $sendername[$c]=$row2[0];
    $c++;
}
?><!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Chat</title>

    <!--<link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sign-in/">-->

    <!-- Bootstrap core CSS -->
    <link href="bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Custom styles for this template -->
  </head>

  <body>
      <div class="row" id="topbox" style="width:100%;height:10%;padding:10px">
          <div class="col-lg-12  h1 mb-3 font-weight-bold">Messages</div></div>
    <div class="row" id="middlebox" style="overflow:auto;margin:10px;height:400px;">
        <?php
            $i=0;
            while($i<=$c){
    			        echo "<div id='witem' style='width:100%'><div><h3><b>$sendername[$i]</b></h3></div><div><h4>$message[$i]</h4></div><div><h5 style='color:grey'>$time[$i]</h5></div></div><hr style='width:100%'> <br>";
        				$i++;
    			    }
        ?>
    </div>
      <div class="row" id="bottombox" style="width:100%;height:10%;padding:10px">
      <div class="col-lg-9"><input type="text" name="message" id="inputUser" class="form-control" placeholder="Enter Message" required autofocus></div>
      <div class="col-lg-2"><button class="btn btn-lg btn-primary btn-block" onclick="enterdata()">Enter</button></div>
      <div class="col-lg-1"></div>
    
    </div>
    
    <script>
        function enterdata(){
            var messagetext = document.getElementById("inputUser").value;
            $.ajax({
                type:"POST",
                url:'chatinput.php',
                dataType:'json',
                data:{message:messagetext},
                success: function(obj){
                    document.getElementById("middlebox").innerHTML += "<div id='witem' style='width:100%'><div><h3><b>"+obj[0]+"</b></h3></div><div><h4>"+obj[1]+"</h4></div><div><h5 style='color:grey'>"+obj[2]+"</h5></div></div><hr style='width:100%'> <br>";
                    down();
                }
            });
        }
        
    </script>
    <script>
        var myvar;
        window.setInterval(redraw, 1000);
    </script>
    <script>
        function redraw(){
            var patid = <?php echo $patient_id; ?>;
            $.ajax({
               type:"POST",
               url:'chatinfo.php',
               dataType:'json',
               data:{pid:patid},
               success: function{obj}{
                   var i;
                   document.getElementById("middlebox").innerHTML ="";
                   for(i=0;i<obj[0];i++){
                    document.getElementById("middlebox").innerHTML += "<div id='witem' style='width:100%'><div><h3><b>"+obj[1][i][0]+"</b></h3></div><div><h4>"+obj[1][i][1]+"</h4></div><div><h5 style='color:grey'>"+obj[1][i][2]+"</h5></div></div><hr style='width:100%'> <br>";}
                    
               }
            });
        }
    </script>
    <script>
        window.onload=function() {
             var objDiv = document.getElementById("middlebox");
             objDiv.scrollTop = objDiv.scrollHeight;
        }
        function down(){
             var objDiv = document.getElementById("middlebox");
             objDiv.scrollTop = objDiv.scrollHeight;
        }
    </script>
    
  </body>
</html>