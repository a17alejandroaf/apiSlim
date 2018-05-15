<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de empleados</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php
        require_once("cabecera.php");

        cabecera("Gestión de empleados");
    ?>

    <nav>
        <ul>
            <li><a href="altaempleado.php">Nuevo empleado</a></li>
            <li><a href="buscaempleado.php">Buscar empleado</a></li>
            <li><a href="borrarempleado.php">Borrar empleado</a></li>
            <li><a href="actualizarempleado.php">Actualizar empleado</a></li>
            <li><a href="listadoempleados.php">Listado de empleados</a></li>
        </ul>
    </nav>
</body>
</html>
