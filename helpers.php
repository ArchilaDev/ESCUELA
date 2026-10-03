<?php
    //Funciones cortas que usan los controladores y las vistas

    //Escapa texto para imprimirlo de forma segura dentro del html
    function h($texto){
        return htmlspecialchars($texto ?? '', ENT_QUOTES, 'UTF-8');
    }

    //Contruye una URL interna, ej: url('mascotas','formulario', ['id' => 3])
    function url(string $controlador, string $accion = 'index', array $extra = []): string{
        $partes = array_merge(['c' => $controlador, 'a' => $accion], $extra);
        return 'index.php?' . http_build_query($partes);
    }

    //redigir a una ruta construida y detener el script (patrón Post/Redirect/Get).
    function redirigir(string $controlador, string $accion = 'index', array $extra = []): void{
        header('Location: ' . url($controlador, $accion, $extra));
        exit;
    }

    //corta el script si no hay sesiones iniciadas
    function exigir_login(): void{
        if(empty($_SESSION['usuario_id'])){
            redirigir('auth', 'index');
        }
    }

    //Guarda un mensaje para mostrarlo una sola vez en la próxima página.
    function mensaje(string $texto, string $tipo = 'exito'): void{
        $_SESSION['mensaje'] = $texto;
        $_SESSION['mensaje_tipo'] = $tipo;
    }
?>