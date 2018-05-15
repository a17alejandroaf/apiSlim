<?php
    class DB {
        public function conectar() {
            $servidor = "localhost";
            $usuario = "root";
            $password = "";
            $db = "api_db";

            try {
                $conexion = new PDO("mysql:host=$servidor;dbname=$db;charset=utf8", $usuario, $password);
                $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch (PDOException $e) {
                echo "Fallo al conectar: " . $e->getMessage();
            }

            return $conexion;
        }
    }
?>
