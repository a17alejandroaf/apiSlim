<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Búsqueda de empleado</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php
        require_once('cabecera.php');

        cabecera("Busca un empleado por su ID");
    ?>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
        Empleado a buscar:
        <input type="text" name="id">
        <input type="submit" name="buscar" value="Buscar">
    </form>

    <?php
        if (!empty($_GET['id'])) {
            $url = 'http://www.a17alejandroaf.local/api/empleado';
            $url.= '/' . urlencode($_GET['id']);

            $respuesta = file_get_contents($url);
            $respuesta = json_decode($respuesta, true);

            if (is_array($respuesta)) {
                // Mostramos lista con los datos del empleado
                echo "<hr>";
                echo "<h2>Empleado con ID: " . $respuesta['id'] . "</h2>";
                echo "<ul>";
                    echo "<li><strong>Nombre:</strong> " . $respuesta['nombre'] . "</li>";
                    echo "<li><strong>Dirección:</strong> " . $respuesta['direccion'] . "</li>";
                    echo "<li><strong>Teléfono:</strong> " . $respuesta['telefono'] . "</li>";
                echo "</ul>";
            } else {
                echo "<hr><h3>$respuesta</h3>";
            }
        }
    ?>
</body>
</html>
