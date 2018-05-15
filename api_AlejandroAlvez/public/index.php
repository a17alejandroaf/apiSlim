<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    require '../vendor/autoload.php';

    require '../src/config/DB.php';

    $config = [
        'settings' => [
            'displayErrorDetails' => true,
        ],
    ];
    $app = new \Slim\App($config);

    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write("<h1>Página de gestión API REST de la aplicación de Alejandro Alvez</h1>");

        return $response;
    });

    require '../src/rutas/empleados.php';

    $app->run();
?>
