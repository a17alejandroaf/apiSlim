<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    $app->get('/api/empleados', function (Request $request, Response $response) {
        $db = new DB();

        $db = $db->conectar();
        $consulta = $db->prepare('SELECT * FROM empleados');

        try {
            $consulta->execute();
            $empleados = $consulta->fetchAll(PDO::FETCH_OBJ);
            $response->getBody()->write(json_encode($empleados));
        }
        catch (PDOException $e) {
            echo "<h3>" . $e->getMessage() . "</h3>";
        }
        finally {
            $db = null;
            $consulta = null;
            return $response;
        }
    });

    $app->get('/api/empleado/{id}', function (Request $request, Response $response, array $args) {
        $id = $args['id'];

        $db = new DB();

        $db = $db->conectar();
        $consulta = $db->prepare('SELECT * FROM empleados
                                    WHERE id = :id');
        $consulta->bindParam(':id', $id);

        try {
            $consulta->execute();
            $empleado = $consulta->fetchAll(PDO::FETCH_OBJ);
            if (count($empleado) > 0) {
                $response->getBody()->write(json_encode($empleado[0]));
            } else {
                $response->getBody()->write(json_encode("El empleado no existe"));
            }
        }
        catch (PDOException $e) {
            echo "<h3>" . $e->getMessage() . "</h3>";
        }
        finally {
            $db = null;
            $consulta = null;
            return $response;
        }
    });

    $app->post('/api/crear', function (Request $request, Response $response, array $args) {
        $empleado = $request->getParsedBody();

        $db = new DB();

        $db = $db->conectar();
        $consulta = $db->prepare('INSERT INTO empleados
                                    (id, nombre, direccion, telefono)
                                    VALUES (:id, :nombre, :direccion, :telefono)');
        $datos = [
            ':id' => $empleado['id'],
            ':nombre' => $empleado['nombre'],
            ':direccion' => $empleado['direccion'],
            ':telefono' => $empleado['telefono']
        ];

        try {
            $consulta->execute($datos);
            $response->getBody()->write(json_encode("Empleado creado exitosamente."));
        }
        catch (PDOException $e) {
            $response->getBody()->write(json_encode($e->getMessage()));
        }
        finally {
            $db = null;
            $consulta = null;
            return $response;
        }
    });

    $app->put('/api/actualizar/{id}', function (Request $request, Response $response, array $args) {
        $id = $args['id'];
        $empleado = $request->getParsedBody();

        $db = new DB();

        $db = $db->conectar();
        $consulta = $db->prepare('UPDATE empleados
                                    SET nombre = :nombre,
                                        direccion = :direccion,
                                        telefono = :telefono
                                    WHERE id = :id');
        $datos = [
            ':id' => $id,
            ':nombre' => $empleado['nombre'],
            ':direccion' => $empleado['direccion'],
            ':telefono' => $empleado['telefono']
        ];

        try {
            $consulta->execute($datos);
            if ($consulta->rowCount() > 0) {
                $response->getBody()->write(json_encode("Empleado actualizado exitosamente."));
            } else {
                $response->getBody()->write(json_encode("El empleado no existe."));
            }
        }
        catch (PDOException $e) {
            $response->getBody()->write(json_encode($e->getMessage()));
        }
        finally {
            $db = null;
            $consulta = null;
            return $response;
        }
    });

    $app->delete('/api/eliminar/{id}', function (Request $request, Response $response, array $args) {
        $id = $args['id'];

        $db = new DB();

        $db = $db->conectar();
        $consulta = $db->prepare('DELETE FROM empleados
                                    WHERE id = :id');
        $consulta->bindParam(':id', $id);

        try {
            $consulta->execute();
            if ($consulta->rowCount() > 0) {
                $response->getBody()->write(json_encode("El empleado ha sido eliminado."));
            } else {
                $response->getBody()->write(json_encode("El empleado no existe."));
            }
        }
        catch (PDOException $e) {
            $response->getBody()->write(json_encode($e->getMessage()));
        }
        finally {
            $db = null;
            $consulta = null;
            return $response;
        }
    });
?>
