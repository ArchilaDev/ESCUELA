<?php
//todo los controladores necesitan sus modelos
require_once __DIR__ . '/../models/mdlCurso.php';
require_once __DIR__ . '/../models/mdlEstudiante.php';

//crear el controlador para el flujo del CRUD
class CursoController
{
    //Atributos o propiedades
    private mdlCurso $curso;
    private mdlEstudiante $estudiante;

    //Constructor que inicializa las instancias(llamados de los modelos)
    public function __construct()
    {
        $this->curso = new mdlCurso();
        $this->estudiante = new mdlEstudiante();
    }
    //muestra la lista principal de mascotas con opciones de busqueda y filtrado
    //GET index.php?c=cursos
   public function index(): void
    {
        $buscar = trim($_GET['buscar'] ?? '');
        $activo = $_GET['activo'] ?? '';

        // Se le pasan los parámetros al método listar()
        $cursos  = $this->curso->listar($buscar,$activo);
        
        //obtencion de constantes con las opciones para los selects

         //renderizado de las vistass con los diseños
        require __DIR__ . '/../views/layout_header.php';
        require __DIR__ . '/../views/cursos/listado.php';
        require __DIR__ . '/../views/layout_footer.php';
    }

    // GET index.php?c=mascotas&a=formulario[$id=5]
    /*
    carga el formulario para crear un nuevo curso o editar uno existente.
    Ruta tipica: index.php?c=cursos&a=formulario&id=X
    */
    public function formulario(): void
    {
      //captura el ID desde &_GET (0 si es un nuevo registro)
    $id = (int) ($_GET['id_curso'] ?? 0);
        
        // Estructura por defecto para nuevos registros
        $item = [
            'id_curso'          => 0,
            'nombre_curso'      => '',
            'genero_curso'      => '',
            'precio_curso'      => '',
            'descripcion_curso' => '',
            'id_estudiante'     => 0,
        ];

        // Carga información de la BD si es un id existente
        if ($id > 0) {
            $item = $this->curso->porId($id) ?? $item;
        }

        // Carga de opciones para los selectores (Estudiantes y Géneros)
        $estudiantes = $this->estudiante->opciones();

        $generos     = mdlCurso::GENEROS;
        require __DIR__ . '/../views/layout_header.php';
        require __DIR__ . '/../views/cursos/formulario.php';
        require __DIR__ . '/../views/layout_footer.php';
    }

    /*
    Procesa la insercion o actualizacion de datos enviados por formulario post.
    aplica validaciones de entrada y reglas de negocio.
    */
    
    public function guardar(): void
    {
        //Lectura del ID para determinar si es un Update ($id > 0) o create ($id == 0)
        $id = (int) ($_POST['id_curso'] ?? 0);
        //extraccion y saneamiento inicial del arreglo de datos en $_POST
       $d = [
    'nombre_curso'      => trim($_POST['nombre_curso'] ?? ''),
    'genero_curso'      => trim($_POST['genero_curso'] ?? ''),
    'precio_curso'      => $_POST['precio_curso'] ?? '',
    'descripcion_curso' => $_POST['descripcion_curso'] ?? '',
    'id_estudiante'     => (int) ($_POST['id_estudiante'] ?? 0),
    ];

        $errores = [];

        //validacion 1: El nombre del curso no debe estar vacio
        if ($d['nombre_curso'] === '') $errores[] = 'El nombre es obligatorio.';
        //validacion 2 Pertenencia a los generos a las opciones permitidas
        if (!in_array($d['genero_curso'], mdlCurso::GENEROS, true)) $errores[] = 'Elige un genero válido.';
    // Validación 3: Precio (Verifica que no esté vacío y que sea numérico válido)
    if ($d['precio_curso'] === '' || !is_numeric($d['precio_curso']) || (float)$d['precio_curso'] <= 0) {
        $errores[] = 'El precio es obligatorio y debe ser un número mayor a 0.';
    }
        if ($d['descripcion_curso'] === '') $errores[] = 'La descripcion no puede estar vacia';
            
         //validacion verificar existencia y estado del estudiante con el curso

        $dueno = $d['id_estudiante'] > 0 ? $this->estudiante->porId($d['id_estudiante']) : null;
        if (!$dueno) {
            $errores[] = 'Elige un estudiante de la lista.';
        } elseif (!$dueno['activo']) {
            $errores[] = 'Ese estudiante está inactivo; reactívalo o elige otro.';
        }
        //Manejo de errores: Si existen fallas, mostrar notificaciones y volver al formulario
        if ($errores) {
            mensaje(implode(' ', $errores), 'error'); // implode junta elementos de un arreglo mediante una cadena
            redirigir('cursos', 'formulario', ['id_curso' => $id]);
        }

        //persistencia de datos en la base de datos
        if ($id > 0) {
            //actualizacion de registro existente
            $this->curso->actualizar($id, $d);
            mensaje('Se actualizó la ficha de ' . $d['nombre_curso'] . '.');
        } else {
            //creacion de nuevo registro
            $this->curso->crear($d);
            mensaje($d['nombre_curso'] . ' quedó registrado.');
        }
        //Redirigir al contralor principal
        redirigir('cursos');
    }

    
    /*
    Actualizacion rapida del estado clinico de la mascota via POST
    */
    public function estado(): void
    {
        $id     = (int) ($_POST['id'] ?? 0);
        $estado = $_POST['estado'] ?? '';

        //Valida que el estado seleccionado este dentro de las opciones validas
        if (in_array($estado, mdlCurso::ESTADOS, true)) {
            $this->estudiante->cambiarEstado($id, $estado);
            mensaje('Estado curso actualizado.');
        }
        redirigir('cursos');
    }
    /*
      Alterna la ficha entre activa e inactiva respetando las reglas de negocio.
    */
    public function activo(): void
    {
        $id = (int) ($_POST['id'] ?? 0);
        $registro = $this->curso->porId($id);

        if ($registro) {
            //Invierte el estado actual (1 pasa a 0, 0 pasa a 1)
            $nuevoEstado = $registro['activo'] ? 0 : 1;
            //regla de negocio No se puede activar el curso 
            if ($nuevoEstado && !$registro['estudiante_activo']) {
                mensaje('Primero reactiva al estudiante ' . $registro['nombre_estudiante'] . '.', 'error');
            } else {
                $this->curso->cambiarActivo($id, $nuevoEstado);
                mensaje($nuevoEstado ? 'La ficha vuelve a estar activa.' : 'La ficha quedó inactiva.');
            }
        }
        redirigir('cursos');
    }

    public function eliminar(): void
    {
        $id = (int) ($_POST['id'] ?? 0);
        //Intenta realizar la eliminacion fisica en la base de datos
        $this->curso->eliminar($id)
            ? mensaje('Curso eliminado.')
            : mensaje('Este curso ya no está en el registro.', 'error');
        redirigir('cursos');
    }
}