<?php session_start(); 

//Rediect to Login

if(empty($_SESSION['doctor_id']))
        {
        echo "<script>window.location.replace(\"https://desilabel.store/syrus/doctor/login.php\");</script>";
        }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Login</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link href="bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="login.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <form class="form-signin" action="upload.php" method="post">
      <h1 class="h3 mb-3 font-weight-normal">Please Fill Info</h1>
      <input type="text" name="field1" id="inputUser" class="form-control" placeholder="Form Field 1">
      <br>
    <p class="mb-3 font-weight-bold" style="text-align:left">Select image to upload:<input class="btn btn-lg btn-block" type="file" name="fileToUpload" id="fileToUpload" autofocus></p>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Submit Data</button>
    </form>
  </body>
</html>
