<?php
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename= archivo.xls");


require 'conection.php';
$conection = conection();
$por_pagina = 2;

$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
$empieza = ($pagina - 1) * $por_pagina;

if (!empty($_POST['buscar'])) {
    $buscar = $_POST['buscar'];
    $sql = "SELECT * FROM productos WHERE nombre LIKE ? LIMIT ?, ?";
    $stmt = $conection->prepare($sql);
    $buscar_param = '%' . $buscar . '%';
    $stmt->bind_param("sii", $buscar_param, $empieza, $por_pagina);
} else {
    $sql = "SELECT * FROM productos LIMIT ?, ?";
    $stmt = $conection->prepare($sql);
    $stmt->bind_param("ii", $empieza, $por_pagina);
}

$stmt->execute();
$result = $stmt->get_result();

while($fila=$row =  $result->fetch_assoc()){
echo "        #                  Nombre                  Descripcion                      Cantidad Disponible                        Precio Unitario                           Fecha de Adquisicion
           $row[id]             $row[nombre]                 $row[descripcion]                                            $row[cantidad_disponible]                                                              $row[precio_unitario]                                                $row[fecha_adquisicion]        
           ";
}

           





