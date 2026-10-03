<?php
require_once __DIR__ . '/../models/mdlProfesor.php';

//objeto
class AuthController{
    //atributos
    private mdlProfesor $usuario;

    //constructor
    public function __construct()
    {
      //instanciar el modelo
      $this -> usuario = new mdlProfesor();
    }

    //GET index.php?c=auth -> formulario del login
    public function index():void{
        if(!empty($_SESSION['usuario_id'])){
            redirigir('estudiantes');
        }
        $error = '';
        //llamar la vista
        require __DIR__ . '/../views/auth/login.php';
    }

    //método para ingresar
    public function ingresar():void{
        //capturar la información
        $usuario = trim($_POST['txtUsuario'] ?? '');
        $clave = $_POST['txtClave'] ?? '';

        //vamos a validar 
        $registro = $usuario !== '' ? $this->usuario->porUsuario($usuario) : null;

        if(!$registro || !password_verify($clave, $registro['clave'])){
            $error = 'Usuario o contraseña incorrectos.';
            require __DIR__ . '/../views/auth/login.php';
            return;
        }

        session_regenerate_id(true);
        $_SESSION['usuario_id'] = (int) $registro['id_profesor'];
        $_SESSION['usuario_nombre'] = $registro['nombre_profesor'];
        redirigir('estudiantes');
    }

    //método para salir
    public function salir():void{
        $_SESSION = [];
        session_destroy();
        redirigir('auth');
    }
}
?>