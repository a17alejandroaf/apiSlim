<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Borrar un empleado</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php
        require_once('cabecera.php');

        cabecera("Borra un empleado por su ID");
    ?>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
        Empleado a borrar:
        <input type="text" name="id">
        <input type="submit" name="borrar" value="Borrar">
    </form>

    <?php
        if (isset($_GET['borrar']) && !empty($_GET['id'])) {
            $url = 'http://www.a17alejandroaf.local/api/eliminar';
            $url.= '/' . urlencode($_GET['id']);

            // Inicializamos cURL
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

            // Ejecutamos y recuperamos la respuesta
            $respuesta = curl_exec($ch);
            if (curl_errno($ch) !== 0) {
                echo "Error de cURL al conectarse con " . $url . ": " . curl_error($ch);
            } else {
                $respuesta = json_decode($respuesta);
                echo "<hr><h3>$respuesta</h3>";
            }

            // Cerramos la conexion
            curl_close($ch);
        }
    ?>
</body>
</html>
