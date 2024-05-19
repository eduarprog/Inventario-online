<?php
require 'conection.php';
$conection = conection();

if (isset($_GET["id"]) ){
    $id = $_GET["id"];

$sql = "DELETE FROM productos WHERE id=$id";
$conection->query($sql);

header("location: home.php");
exit;

}

