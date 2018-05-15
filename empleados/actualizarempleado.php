<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualización de empleado</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php
        require_once('cabecera.php');

        cabecera("Busca el empleado a actualizar por su ID");
    ?>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
        Empleado a actualizar:
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
                // Mostramos formulario con los datos del empleado para actualizar
                echo "<hr>";
                echo "<form action='{$_SERVER['PHP_SELF']}' method='POST'>
                        <p>
                            ID:<br>
                            <input type='text' value='{$respuesta['id']}' disabled>
                        </p>
                        <p>
                            Nombre:<br>
                            <input type='text' name='nombre' value='{$respuesta['nombre']}'>
                        </p>
                        <p>
                            Dirección:<br>
                            <input type='text' name='direccion' value='{$respuesta['direccion']}'>
                        </p>
                        <p>
                            Teléfono:<br>
                            <input type='text' name='telefono' value='{$respuesta['telefono']}'>
                        </p>
                        <p>
                            <input type='submit' name='actualizar' value='Actualizar'>
                            <input type='hidden' name='id' value='{$respuesta['id']}'
                        </p>
                    </form>";
            } else {
                echo "<hr><h3>$respuesta</h3>";
            }
        }

        if (isset($_POST['actualizar'])) {
            $url = 'http://www.a17alejandroaf.local/api/actualizar';
            $url.= '/' . urlencode($_POST['id']);

            $datos = array(
                'nombre' => $_POST['nombre'],
                'direccion' => $_POST['direccion'],
                'telefono' => $_POST['telefono']
            );

            // Inicializamos cURL
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($datos));

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
