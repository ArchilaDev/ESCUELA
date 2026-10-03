<?php
require_once __DIR__ . '/helpers.php';

$controlador = $_GET['c'] ?? 'estudiante';
$accion = $_GET['a'] ?? 'index';

$controladorNombre = ucfirst($controlador) . 'Controller';
$archivoControlador = __DIR__ . '/controllers/' . $controladorNombre . '.php';

if (file_exists($archivoControlador)) {
    require_once $archivoControlador;
    
    if (class_exists($controladorNombre)) {
        $instancia = new $controladorNombre();
        
        if (method_exists($instancia, $accion)) {
            $instancia->$accion();
        } else {
            echo "La acción no existe.";
        }
    } else {
        echo "La clase del controlador no existe.";
    }
} else {
    echo "El controlador no existe.";
}