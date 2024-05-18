<?php
require 'conection.php';
$conection = conection();

$nombre = "";
$descripcion = "";
$cantidad_disponible = "";
$precio_unitario = "";
$fecha_adquisicion = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $cantidad_disponible = $_POST["cantidad_disponible"];
    $precio_unitario = $_POST["precio_unitario"];
    $fecha_adquisicion = $_POST["fecha_adquisicion"];


$sql = "INSERT INTO productos (nombre, descripcion, cantidad_disponible, precio_unitario, fecha_adquisicion)" .
        "VALUES ('$nombre', '$descripcion', '$cantidad_disponible', '$precio_unitario', '$fecha_adquisicion')";
        $result = $conection->query($sql);


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
    <title>Crear</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body{
            zoom: 85%;
        }
    </style>
</head>
<b>
<br><br><br><br><br><br><br><br><br><br>
<div class="container">
<div class="content">
<div class="card"  style="max-width: 18rem; text-align: center; ">
  <div class="card-body">
  <i class="fa-solid fa-layer-group fa-2x"></i>  
  <br><br>
    <form action="" method="post" >
    <label class="form-label"> Nombre</label>
    <input  name="nombre" required  class="form-control" value="<?php echo $nombre; ?>"  >
    <br>
    <<label class="form-label">Categoría</label>
    <select class="form-select" name="descripcion">
        <option value="" <?php echo isset($descripcion) && $descripcion == '' ? 'selected' : ''; ?>Categorias</option>
        <option value="Hogar" <?php echo isset($descripcion) && $descripcion == 'Hogar' ? 'selected' : ''; ?>>Hogar</option>
        <option value="Plomeria" <?php echo isset($descripcion) && $descripcion == 'Plomeria' ? 'selected' : ''; ?>>Plomería</option>
        <option value="Pinturas" <?php echo isset($descripcion) && $descripcion == 'Pinturas' ? 'selected' : ''; ?>>Pinturas</option>
        <option value="Electricos" <?php echo isset($descripcion) && $descripcion == 'Electricos' ? 'selected' : ''; ?>>Eléctricos</option>
        <option value="Construcción" <?php echo isset($descripcion) && $descripcion == 'Construcción' ? 'selected' : ''; ?>>Construcción</option>
        <option value="Bombillos" <?php echo isset($descripcion) && $descripcion == 'Bombillos' ? 'selected' : ''; ?>>Bombillos</option>
    </select>
    <br>
    <label class="form-label">  Cantidad Disponible</label>
    <input name="cantidad_disponible" type="number" required  class="form-control" value="<?php echo $cantidad_disponible; ?>" >
    <br>
    <label class="form-label"> Precio unitario</label>
    <input name="precio_unitario" type="number" required  class="form-control" value="<?php echo $precio_unitario; ?>">
    <br>
    <label class="form-label"> Fecha adquisicion</label>
    <input name="fecha_adquisicion" type="datetime-local"  required  class="form-control" value="<?php echo $fecha_adquisicion; ?>">
    <br>
    <a href="home.php" title="Volver" style="background-color: #34495E;" class="btn btn"><i class="fa-solid fa-share fa-rotate-180" style="color: #f7f7f7;"></i></a>
    <button type="submit" title="Guardar"  style="background-color: #34495E;" class="btn btn"><i class="fa-solid fa-floppy-disk" style="color: #f7f7f7;"></i></s></button>
    </form>
  </div>
</div>
</div>
</div>
</b>
</html>