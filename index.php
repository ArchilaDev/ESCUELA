<?php
    /* Punto de entrada único (patrón front controller) 
    todas las URLS se ven así: index.php?c=controladores&a=acciones
    ejemp: index.php?c=mascotas&a=formulario&id=3
    */

    //validar si hay sesiones activas
    session_start();
    //requerir la rutas
    require_once __DIR__ . '/helpers.php';

    //Alias de URL => nombre de la clase controladora
 
    $controladores = [
        'curso' => 'CursoController',
        'profesor' => 'ProfesorController',
        'estudiante' => 'EstudianteController',
        'auth' => 'AuthController'
    ];
    //llamado a los controladores
    $controlador = $_GET['c'] ?? 'cursos';
    $accion = $_GET['a'] ?? 'index';

    //validamos comunicaciones
    if(!isset($controladores[$controlador])){
        http_response_code(404);
        exit('Página no encontrada.');
    }

    //validar la sesión todo pide sesión inicia, excepto el propio login
    if($controlador !== 'auth'){
        exigir_login();
    }

    $clase = $controladores[$controlador];
    require_once __DIR__ . "/controllers/$clase.php";

    $objeto = new $clase();

    if(!method_exists($objeto, $accion)){
        http_response_code(404);
        exit("Acción no encontrada.");
    }

    $objeto -> $accion();
?>