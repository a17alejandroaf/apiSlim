<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Alta de empleado</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php
        require_once('cabecera.php');

        cabecera("Introduce los datos del empleado a agregar");
    ?>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <p>
            ID:<br>
            <input type="text" name="id">
        </p>
        <p>
            Nombre:<br>
            <input type="text" name="nombre">
        </p>
        <p>
            Dirección:<br>
            <input type="text" name="direccion">
        </p>
        <p>
            Teléfono:<br>
            <input type="text" name="telefono">
        </p>
        <p>
            <input type="submit" name="agregar" value="Agregar">
        </p>
    </form>

    <?php
        if (isset($_POST['agregar'])) {
            $url = 'http://www.a17alejandroaf.local/api/crear';

            $datos = array(
                'id' => $_POST['id'],
                'nombre' => $_POST['nombre'],
                'direccion' => $_POST['direccion'],
                'telefono' => $_POST['telefono']
            );

            // Inicializamos cURL
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $datos);

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
