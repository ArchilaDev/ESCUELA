<?php
require_once __DIR__ . '/../models/mdlCurso.php';
require_once __DIR__ . '/../models/mdlProfesor.php';

class CursoController {
    private $modeloCurso;
    private $modeloProfesor;

    public function __construct() {
        requerirAutenticacion();
        $this->modeloCurso = new mdlCurso();
        $this->modeloProfesor = new mdlProfesor();
    }

    public function index() {
        $cursos = $this->modeloCurso->listar();
        require_once __DIR__ . '/../views/cursos/listado.php';
    }

    public function crear() {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = [
                'nombre_curso' => trim($_POST['nombre_curso'] ?? ''),
                'genero_curso' => trim($_POST['genero_curso'] ?? ''),
                'precio_curso' => trim($_POST['precio_curso'] ?? ''),
                'descripcion_curso' => trim($_POST['descripcion_curso'] ?? ''),
                'id_profesor' => trim($_POST['id_profesor'] ?? '')
            ];

            if ($this->modeloCurso->guardar($datos)) {
                redireccionar('curso', 'index');
            } else {
                $error = 'Error al guardar el curso';
            }
        }
        require_once __DIR__ . '/../views/cursos/formulario.php';
    }

    public function editar() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            redireccionar('curso', 'index');
        }

        $curso = $this->modeloCurso->obtenerPorId($id);
        if (!$curso) {
            redireccionar('curso', 'index');
        }

        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = [
                'nombre_curso' => trim($_POST['nombre_curso'] ?? ''),
                'genero_curso' => trim($_POST['genero_curso'] ?? ''),
                'precio_curso' => trim($_POST['precio_curso'] ?? ''),
                'descripcion_curso' => trim($_POST['descripcion_curso'] ?? ''),
                'id_profesor' => trim($_POST['id_profesor'] ?? '')
            ];

            if ($this->modeloCurso->actualizar($id, $datos)) {
                redireccionar('curso', 'index');
            } else {
                $error = 'Error al actualizar el curso';
            }
        }
        require_once __DIR__ . '/../views/cursos/formulario.php';
    }

    public function eliminar() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->modeloCurso->eliminar($id);
        }
        redireccionar('curso', 'index');
    }
}