<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de empleados</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php
        require_once('cabecera.php');

        cabecera("Listado de todos los empleados");

        $url = 'http://www.a17alejandroaf.local/api/empleados';
        $empleados = file_get_contents($url);
        $empleados = json_decode($empleados, true);

        // Mostramos tabla con todos los empleados
        echo "<table border>";
            echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>Nombre</th>";
                echo "<th>Dirección</th>";
                echo "<th>Teléfono</th>";
            echo "</tr>";
            foreach ($empleados as $empleado) {
                echo "<tr>";
                    echo "<td>" . $empleado['id'] . "</td>";
                    echo "<td>" . $empleado['nombre'] . "</td>";
                    echo "<td>" . $empleado['direccion'] . "</td>";
                    echo "<td>" . $empleado['telefono'] . "</td>";
                echo "</tr>";
            }
        echo "</table>";
    ?>
</body>
</html>
