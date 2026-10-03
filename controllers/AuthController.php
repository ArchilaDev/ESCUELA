<?php
require_once __DIR__ . '/../models/mdlProfesor.php';

class AuthController {
    private $modeloProfesor;

    public function __construct() {
        $this->modeloProfesor = new mdlProfesor();
    }

    public function login() {
        if (estaAutenticado()) {
            redireccionar('estudiante', 'index');
        }

        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $clave = trim($_POST['clave'] ?? '');

            if (!empty($email) && !empty($clave)) {
                $profesor = $this->modeloProfesor->obtenerPorEmail($email);

                if ($profesor && password_verify($clave, $profesor['clave'])) {
                    $_SESSION['usuario'] = [
                        'id' => $profesor['id_profesor'],
                        'nombre' => $profesor['nombre_profesor'],
                        'email' => $profesor['email_profesor']
                    ];
                    redireccionar('estudiante', 'index');
                } else {
                    $error = 'Credenciales incorrectas';
                }
            } else {
                $error = 'Por favor complete todos los campos';
            }
        }

        require_once __DIR__ . '/../views/auth/login.php';
    }

    public function logout() {
        session_destroy();
        redireccionar('auth', 'login');
    }
}