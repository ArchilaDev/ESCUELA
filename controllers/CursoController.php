<?php
require_once __DIR__ . '/../helpers.php';
require_once __DIR__ . '/../models/mdlCurso.php';
require_once __DIR__ . '/../models/mdlProfesor.php';

class CursoController {
    private $modeloCurso;
    private $modeloProfesor;

    public function __construct() {
        exigir_login();
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
                mensaje('Curso creado correctamente', 'exito');
                redirigir('curso', 'index');
            } else {
                $error = 'Error al guardar el curso';
            }
        }
        require_once __DIR__ . '/../views/cursos/formulario.php';
    }

    public function editar() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            redirigir('curso', 'index');
        }

        $curso = $this->modeloCurso->obtenerPorId($id);
        if (!$curso) {
            redirigir('curso', 'index');
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
                mensaje('Curso actualizado correctamente', 'exito');
                redirigir('curso', 'index');
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
            mensaje('Curso eliminado correctamente', 'exito');
        }
        redirigir('curso', 'index');
    }
}