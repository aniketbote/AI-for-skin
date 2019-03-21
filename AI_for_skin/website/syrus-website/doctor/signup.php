
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
    <form class="form-signin" action="enroll.php" method="post">
      <h1 class="h3 mb-3 font-weight-normal">Please Signup</h1>
      <input type="text" name="name" id="inputUser" class="form-control" placeholder="Name" required autofocus>
      <input type="text" name="username" id="inputUser" class="form-control" placeholder="Username" required>
      <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Signup</button>
      <br>
      <p>Already have an account?<a href="login.php"> Login</a></p>
    </form>
  </body>
</html>