<?php
    function cabecera($titulo) {
        echo "<header>";
            echo "<h1>$titulo</h1>";
            if ($titulo != "Gestión de empleados")
                echo "<p><a href='index.php'>Volver al inicio</a></p>";
        echo "</header>";
    }
?>
