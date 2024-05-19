<?php
session_start();
if(isset($_SESSION["usuario"])) {
    header("Location: home.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/f97fcd2c02.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <title> Login</title>
    <link rel=" shorcut icon" href="img/logob2.png">
</head>
<b>
    <div class="container">
    <div class="content">
<div class="card" style="max-width: 18rem; text-align: center; ">
  <div class="card-body">
  <i class="fa-solid fa-key fa-2x rotate"></i>  
  <br><br>
  <?php if(isset($_GET["error"])) { echo "<p>Usuario o contraseña incorrectos. Inténtalo de nuevo.</p>"; } ?>
    <form action="login_check.php" method="post" >
    <label class="form-label"><i class="fa-solid fa-user fa-2xs "></i> &nbsp;  Usuario</label>
    <input name="user" id="user" required  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <br>
    <label class="form-label"><i class="fa-solid fa-lock fa-2xs "></i> &nbsp; Contraseña</label>
    <input name="contraseña" id="contraseña"  required  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <br>
    <button type="submit" title="Entrar" style="background-color: #34495E;" class="btn btn"><i class="fa-solid fa-arrow-right fa-2xs" style="color: white;"></i></button>
  </div>
</div>
</div>
</div>
</body>
</html>