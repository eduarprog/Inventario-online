<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
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
    <link rel=" shorcut icon" href="img/logob2.png">
    <title>Centro de registros - Inventory</title>
    <style>
        body {
            font-family: 'Crimson Pro', serif;
            font-size: 20px;
            zoom: 75%;
            background-color: #D6DBDF;
        }

        .fijo {
            position: fixed;
            z-index: 9999;
            min-width: 100%;
        }

        .fijo ul li a {
            display: block;
            pointer-events: auto;
        }

        .d-flex {
            pointer-events: auto;
        }

        .navbar-brand {
            pointer-events: auto;
        }

        .nav-link {
            pointer-events: auto;
        }

        .container {
            text-align: center;
            /* Centra el contenido dentro del contenedor */
        }

        /* Estilos para el contenido */
        .content {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow: auto;
        }

        .aaa {
            padding: 10px;
            color: #CA0403;
            text-decoration: none;
            border: 3px solid darkred;
            background: #fff;
            box-sizing: border-box;
            opacity: 0.8;
            align-content: center;
            border-radius: 20px;
        }

        .search .search-input {
            padding: 0 54px;
            caret-color: #000;
            font-size: 23px;
            font-weight: 300;
            transition: width 0.3s linear;
            border-radius: 12px;
            border: 3px solid darkred;
        }
    </style>
</head>
<?php
require_once 'conection.php';
// Verificar si el usuario está autenticado
if (isset($_SESSION["usuario"])) {
    $user = $_SESSION["usuario"];
    // Realizar una consulta para obtener el nombre del usuario
    $conection = conection(); // Establecer la conexión

    $sql = "SELECT nombre FROM usuario WHERE user = '$user'";
    $resultado = $conection->query($sql);

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();
        $nombre = $usuario["nombre"];
    } else {
        // Si no se encuentra el usuario en la base de datos, maneja el error adecuadamente
        $nombre = "Nombre no encontrado";
    }
} else {
    // Si no hay sesión iniciada, redirigir al login
    header("Location: login.php");
    exit();
}

$por_pagina = 10;

$sql_total = "SELECT COUNT(*) AS total FROM productos";
$result_total = $conection->query($sql_total);
if ($result_total) {
    $row_total = $result_total->fetch_assoc();
    $total_registros = $row_total['total'];
    $total_paginas = ceil($total_registros / $por_pagina);
} else {
    die("Error al obtener el total de registros: " . $conection->error);
}
?>

<body>
    <div class="fijo">
        <nav class="navbar navbar-expand-lg navbar-dark bg-" style="background-color: #D6DBDF;">
            <li class="nav-link" data-bs-toggle="tooltip" data-bs-placement="top" title="Ferreteria Jotta-R">
            </li>
            <div class="container">
                <h5 style="cursor: pointer;" title="Usuario conectado"><i class="fa-solid fa-circle-user fa-xl" style="color: #00bd84;"></i> &nbsp; <?php echo $nombre ?></h5>
                <form class="d-flex" id="form2" name="form2" method="POST">
                    <div class="container mt-4">
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-9">
                                <div class="1card p-2 mt-2">
                                    <div class="d-flex justify-content-center px-5">
                                        <div class="search">
                                            <input title="Busca un producto" type="search" class="search-input" name="buscar" placeholder="¿Qué estás buscando?">
                                            <br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <li class="navbar-nav">
                    <a style="text-decoration: none;" href="logout.php" title="Salir"><i class="fa-solid fa-arrow-right-from-bracket" style="color: #e40c0c;"></i></a>
                </li>
            </div>
    </div>
    </nav>
    </div>
    <br><br><br><br>
    <div class="container">
        <div class="content">
            <table class="table">
                <thead>
                    <!-- <a href="home.php"> <i class="fa-solid fa-rotate-right"></i></a> --->
                    Total de registros: <b> &nbsp; <?php echo $total_registros ?> </>
                        <tr>
                            <th scope="col">
                                <a href="home.php" title="Actualizar"><i class="fa-solid fa-rotate-right fa-spin-pulse" style="color: #e2d008;"></i></a>
                            </th>
                        </tr>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Cantidad Disponible</th>
                            <th scope="col">Precio Unitario</th>
                            <th scope="col">Fecha de Llegada</th>
                            <th scope="col"><a title="Agregar" href="create.php"><i class="fa-solid fa-square-plus fa-lg" style="color: blue;"></i></a>&nbsp;<a title="EXCEL" href="excel.php"><i class="fa-solid fa-print fa-lg" style="color: green;"></i></a></th>
                        </tr>
                </thead>
                <tbody>
                    <?php
                    require_once 'conection.php';
                    $conection = conection();
                    $por_pagina = 10;

                    $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
                    $empieza = ($pagina - 1) * $por_pagina;

                    if (!empty($_POST['buscar'])) {
                        $buscar = $_POST['buscar'];
                        $sql = "SELECT * FROM productos WHERE nombre LIKE '%$buscar%' OR descripcion LIKE '%$buscar%' OR fecha_adquisicion LIKE '%$buscar%' OR precio_unitario LIKE '%$buscar%' OR cantidad_disponible LIKE ? LIMIT ?, ?";
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

                    while ($row =  $result->fetch_assoc()) {
                        echo "
    <tr>
                        <th scope='row'>$row[id]</th>
                        <td>$row[nombre]</td>
                        <td>$row[descripcion]</td>
                        <td>$row[cantidad_disponible]</td>
                        <td>RD$$row[precio_unitario]</td>
                        <td>$row[fecha_adquisicion]</td>
                        <td>
                            <a href='edit.php?id=$row[id]' title='Editar'><i class='fa-solid fa-pen-to-square fa-lg' style='color: #0af539;'></i></a> &nbsp;
                            <a href='delete.php?id=$row[id]' title='Eliminar'><i class='fa-solid fa-trash fa-lg' style='color: #f91010;'></i></a>
                        </td>
                    </tr>
    ";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php
        // Obtener el total de registros para la paginación
        $sql_total = "SELECT COUNT(*) AS total FROM productos";
        $result_total = $conection->query($sql_total);
        if ($result_total) {
            $row_total = $result_total->fetch_assoc();
            $total_registros = $row_total['total'];
            $total_paginas = ceil($total_registros / $por_pagina);
        } else {
            die("Error al obtener el total de registros: " . $conection->error);
        }

        // Procesar los resultados
        if (mysqli_num_rows($result) > 0) {
            while ($row = $result->fetch_assoc()) {
                echo $row['Nombre'] . "<br>";
            }
        } else {
            echo "<br>No se encontraron resultados. :/ <br>";
        }

        // Paginación
        echo "<br><center>";
        if ($pagina > 1) {
            echo "<a title='Atrás' style='margin-left: 10px' class='aa' href='home.php?pagina=" . ($pagina - 1) . "'>" . '<i class="fa-solid fa-chevron-up fa-rotate-270 fa-lx" style="color: #CA0403;"></i>' . "</a>";
        }
        echo "<a title='Pagina actual' class='aaa' style='margin-left: 10px; '> " . $pagina . " / " . $total_paginas . " </a>";
        if ($pagina < $total_paginas) {
            echo "<a title='Siguiente' class='aa' style='margin-left: 10px' href='home.php?pagina=" . ($pagina + 1) . "'>" . '<i class="fa-solid fa-chevron-up fa-rotate-90 fa-lx" style="color: #CA0403;"></i>' . "</a>";
        }
        echo "<br><br><hr><br> &copy; 2024 - Todos los derechos reservados";

        // Cerrar la declaración y la conexión
        if ($stmt) {
            $stmt->close();
        }
        $conection->close();
        ?>

</body>
</html>
