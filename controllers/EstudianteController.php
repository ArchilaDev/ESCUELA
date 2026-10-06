<?php

require_once __DIR__ . '/../models/mdlEstudiante.php';

class EstudianteController
{
    private mdlEstudiante $estudiante;

    public function __construct()
    {
        $this->estudiante = new mdlEstudiante();
    }

    // GET index.php?c=estudiantes
    public function index(): void
    {
        $buscar = trim($_GET['buscar'] ?? '');

        // Listado de estudiantes
        $estudiantes = $this->estudiante->listar($buscar);

        require __DIR__ . '/../views/layout_header.php';
        require __DIR__ . '/../views/estudiantes/listado.php';
        require __DIR__ . '/../views/layout_footer.php';
    }

    // GET index.php?c=estudiantes&a=formulario[&id=5]
    public function formulario(): void
    {
        $id = (int) ($_GET['id'] ?? 0);
        $item = [
            'id_estudiante'     => 0, 
            'nombre_estudiante'   => '', 
            'apellido_estudiante' => '', 
            'email_estudiante'    => '', 
            'edad_estudiante'     => '', 
            'pais_estudiante'     => '',
            'idioma_estudiante'   => ''
        ];

        if ($id > 0) {
            $item = $this->estudiante->porId($id) ?? $item;
        }

        require __DIR__ . '/../views/layout_header.php';
        require __DIR__ . '/../views/estudiantes/formulario.php';
        require __DIR__ . '/../views/layout_footer.php';
    }

    // POST index.php?c=estudiantes&a=guardar
    public function guardar(): void
    {
        $id = (int) ($_POST['id_estudiante'] ?? 0);
        
        $d = [
            'nombre_estudiante'   => trim($_POST['nombre_estudiante'] ?? ''),
            'apellido_estudiante' => trim($_POST['apellido_estudiante'] ?? ''),
            'email_estudiante'    => trim($_POST['email_estudiante'] ?? ''),
            'edad_estudiante'     => (int) ($_POST['edad_estudiante'] ?? 0),
            'pais_estudiante'     => trim($_POST['pais_estudiante'] ?? ''),
            'idioma_estudiante'   => trim($_POST['idioma_estudiante'] ?? ''),
            'activo'              => 1
        ];

        $errores = [];

        // Validaciones
        if ($d['nombre_estudiante'] === '') {
            $errores[] = 'El nombre es obligatorio.';
        }
        
        if ($d['email_estudiante'] !== '' && !filter_var($d['email_estudiante'], FILTER_VALIDATE_EMAIL)) {
            $errores[] = 'El email introducido no es válido.';
        }

        if ($d['email_estudiante'] !== '' && $this->estudiante->emailExiste($d['email_estudiante'], $id)) {
            $errores[] = 'Ya existe un estudiante registrado con ese email.';
        }

        if ($errores) {
            mensaje(implode(' ', $errores), 'error');
            redirigir('estudiantes', 'formulario', ['id' => $id]);
        }

        if ($id > 0) {
            $this->estudiante->actualizar($id, $d);
            mensaje('Se actualizaron los datos de ' . $d['nombre_estudiante'] . '.');
        } else {
            $this->estudiante->crear($d);
            mensaje($d['nombre_estudiante'] . ' quedó registrado.');
        }

        redirigir('estudiantes');
    }
    // Cambia el estado (1 = activo, 0 = inactivo)
public function cambiarEstado(int $id, int $activo): bool
{
    $sql = "UPDATE estudiante SET activo = ? WHERE id_estudiante = ?";
    return $this->db->prepare($sql)->execute([$activo, $id]);
}

    // POST index.php?c=estudiantes&a=eliminar
    public function eliminar(): void
    {
        $id = (int) ($_POST['id'] ?? 0);
        
        // Primero desvinculamos de las inscripciones si existen
        $this->estudiante->cambiarEstadoCursos($id);

        $this->estudiante->eliminar($id)
            ? mensaje('Estudiante eliminado correctamente.')
            : mensaje('El estudiante no se pudo eliminar.', 'error');

        redirigir('estudiantes');
    }
}