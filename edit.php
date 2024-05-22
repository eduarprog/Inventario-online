<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit();
}

require 'conection.php';
$conection = conection();

$id = "";
$nombre = "";
$descripcion = "";
$cantidad_disponible = "";
$precio_unitario = "";
$fecha_adquisicion = "";


if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (!isset($_GET["id"])) {
        header("location: home.php");
        exit;
    }

    $id = $_GET["id"];

    $sql = "SELECT * FROM productos WHERE id=$id";
    $result = $conection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: home.php");
    }

    $nombre = $row["nombre"];
    $descripcion = $row["descripcion"];
    $cantidad_disponible = $row["cantidad_disponible"];
    $precio_unitario = $row["precio_unitario"];
    $fecha_adquisicion = $row["fecha_adquisicion"];
} else {

    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $cantidad_disponible = $_POST["cantidad_disponible"];
    $precio_unitario = $_POST["precio_unitario"];
    $fecha_adquisicion = $_POST["fecha_adquisicion"];

    $sql = "UPDATE productos " .
        "SET nombre = '$nombre', descripcion = '$descripcion', cantidad_disponible = '$cantidad_disponible', precio_unitario = '$precio_unitario', fecha_adquisicion = '$fecha_adquisicion' " .
        "WHERE id = $id";


    $result = $conection->query($sql);

    header("location: home.php");
    exit;
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
    <title>Editar registro - Inventory</title>
    <link rel=" shorcut icon" href="img/logob2.png">
    <style>
        body {
            zoom: 85%;
            background-color:  #D6DBDF;
        }
    </style>
</head>
<body>
    <br><br>
    <div class="container">
                    <i class="fa-solid fa-layer-group fa-2x"></i>
                    <br><br>
                    <form action="" method="post">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <label class="form-label"> <b>Nombre</b></label>
                        <input name="nombre" required class="form-control" value="<?php echo $nombre; ?>">
                        <br>
                        <label class="form-label"><b>Categoría</b></label>
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
                        <label class="form-label"><b>Cantidad Disponible</b></label>
                        <input name="cantidad_disponible" type="number" required class="form-control" value="<?php echo $cantidad_disponible; ?>">
                        <br>
                        <label class="form-label"><b>Precio Unitario</b></label>
                        <input name="precio_unitario" type="number" required class="form-control" value="<?php echo $precio_unitario; ?>">
                        <br>
                        <label class="form-label"><b>Fecha de Llegada</b></label>
                        <input name="fecha_adquisicion" type="datetime-local" required class="form-control" value="<?php echo date('Y-m-d\TH:i', strtotime($fecha_adquisicion)); ?>">
                        <br>
                        <a href="home.php" title="Volver" style="background-color: #34495E;" class="btn btn"><i class="fa-solid fa-share fa-rotate-180" style="color: #f7f7f7;"></i></a>
                        <button type="submit" title="Guardar" style="background-color: #34495E;" class="btn btn"><i class="fa-solid fa-floppy-disk" style="color: #f7f7f7;"></i></s></button>
                    </form>
                </div>
            </div>
        </div>
</body>
</html>
