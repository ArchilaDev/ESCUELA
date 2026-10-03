<?php
require_once __DIR__ . '/../models/mdlEstudiante.php';

class EstudianteController {
    private $modeloEstudiante;

    public function __construct() {
        requerirAutenticacion();
        $this->modeloEstudiante = new mdlEstudiante();
    }

    public function index() {
        $estudiantes = $this->modeloEstudiante->listar();
        require_once __DIR__ . '/../views/estudiantes/listado.php';
    }

    public function crear() {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = [
                'nombre_estudiante' => trim($_POST['nombre_estudiante'] ?? ''),
                'apellido_estudiante' => trim($_POST['apellido_estudiante'] ?? ''),
                'email_estudiante' => trim($_POST['email_estudiante'] ?? ''),
                'edad_estudiante' => trim($_POST['edad_estudiante'] ?? ''),
                'pais_estudiante' => trim($_POST['pais_estudiante'] ?? ''),
                'idioma_estudiante' => trim($_POST['idioma_estudiante'] ?? '')
            ];

            if ($this->modeloEstudiante->guardar($datos)) {
                redireccionar('estudiante', 'index');
            } else {
                $error = 'Error al guardar el estudiante';
            }
        }
        require_once __DIR__ . '/../views/estudiantes/formulario.php';
    }

    public function editar() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            redireccionar('estudiante', 'index');
        }

        $estudiante = $this->modeloEstudiante->obtenerPorId($id);
        if (!$estudiante) {
            redireccionar('estudiante', 'index');
        }

        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = [
                'nombre_estudiante' => trim($_POST['nombre_estudiante'] ?? ''),
                'apellido_estudiante' => trim($_POST['apellido_estudiante'] ?? ''),
                'email_estudiante' => trim($_POST['email_estudiante'] ?? ''),
                'edad_estudiante' => trim($_POST['edad_estudiante'] ?? ''),
                'pais_estudiante' => trim($_POST['pais_estudiante'] ?? ''),
                'idioma_estudiante' => trim($_POST['idioma_estudiante'] ?? '')
            ];

            if ($this->modeloEstudiante->actualizar($id, $datos)) {
                redireccionar('estudiante', 'index');
            } else {
                $error = 'Error al actualizar el estudiante';
            }
        }
        require_once __DIR__ . '/../views/estudiantes/formulario.php';
    }

    public function eliminar() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->modeloEstudiante->eliminarLogico($id);
        }
        redireccionar('estudiante', 'index');
    }
}