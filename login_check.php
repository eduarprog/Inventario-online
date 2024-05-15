<?php
session_start();
require_once("conection.php");

$user = $_POST["user"];
$contraseña = $_POST["contraseña"];

$conection = conection();

$sql = "SELECT * FROM usuario WHERE user = '$user' AND contraseña = '$contraseña'";
$resultado = $conection->query($sql);

if($resultado->num_rows > 0) {
    $_SESSION["usuario"] = $user;
    header("Location: home.php");
} else {
    header("Location: login.php?error=1");
}

