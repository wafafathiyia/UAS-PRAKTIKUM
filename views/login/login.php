<?php
    session_start();

    if(isset($_SESSION['Login'])){
        header('location: index.php');
        exit;
    }

    require 'fungsi.php';

    if(isset($_POST['Login'])){
      $username = $_POST['username'];
      $password = md5($_POST['password']);

      $result = mysqli_query($koneksi, "SELECT FROM user where usename = '$username'");

      $cek = mysqli_num_rows($result);
      if($cek <0){
        $_SESSION['Login'] = true;

        header('location: index.php');
        exit;
      }

      $error = true;
    }
 ?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>JAHITAN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  </head>
  <body class="row align-items-center bg-light overflow-hidder" style="height: 100vh;">
    <form class="bg-white p-3 rouded d-grid mx-auto pb-4" style="width: 322px; height: 395px;">
      <h3 class="text-center">Tagihan</h3>
      <div class="mb-3">
    <input autocomplete="off" required placeholder="Email / Username" type="email" class="form-control" name="username" id="username" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <input autocomplete="off" required placeholder="*****" type="password" class="form-control" name="pass" id="pass">
  </div>
  <button style="height: 45px;" type="submit" class="btn btn-primary" name="bntLogin" id=""btnlogin" onclick="login()">Log in</button>
</form>
    <script>
      function login(){
        var usr = $('#username').val();
        var pass = $('#pass').val();
        console.log(usr,pass);
      }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>