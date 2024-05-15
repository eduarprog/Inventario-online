<?php
                  //Conexion a puerto y base de datos
function conection()
{
    $host='localhost';
    $user='root';   
    $pass='';
    $db='usuarios';  // DB

    $conection=mysqli_connect($host,$user,$pass,$db);

    return $conection;
}
