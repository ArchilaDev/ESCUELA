<?php
//todo los controladores necesitan sus modelos
require_once __DIR__ . '/../models/mdlCurso.php';
require_once __DIR__ . '/../models/mdlProfesor.php';

//crear el controlador para el flujo del CRUD
class CursoController
{
    //Atributos o propiedades
    private mdlCurso $curso;
    private mdlProfesor $profesor;

    //Constructor que inicializa las instancias(llamados de los modelos)
    public function __construct()
    {
        $this->curso = new mdlCurso();
        $this->profesor = new mdlProfesor();
    }
    //muestra la lista principal de mascotas con opciones de busqueda y filtrado
    //GET index.php?c=cursos
    public function index(): void
    {
        $buscar = trim($_GET['buscar'] ?? '');
        
        //Obtencion del listado,filtrado mediante el modelo de cursos
        $curso = $this->curso->listar($buscar);
         //obtencion de constantes con las opciones para los selects

        $genero = mdlCurso::GENERO;
        //obtencion de constantes con las opciones para los selects

        //renderizado de las vistass con los diseños
        require __DIR__ . '/../views/layout_header.php';
        require __DIR__ . '/../views/cursos/listado.php';
        require __DIR__ . '/../views/layout_footer.php';
    }

    // GET index.php?c=mascotas&a=formulario[$id=5]
    /*
    carga el formulario para crear una nueva mascota o editar una existente.
    Ruta tipica: index.php?c=mascotas&a=formulario&id=X
    */
    public function formulario(): void
    {

    //captura el ID desde &_GET (0 si es un nuevo registro)
        $id = (int) ($_GET['id_curso'] ?? 0);
        
        // Estructura por defecto alineada a la Base de Datos para nuevos registros
        $item = [
            'nombre_curso' => trim($_POST['nombre_curso'] ?? ''),
            'genero_curso' => trim($_POST['genero_curso'] ?? ''),
            'precio_curso' => trim($_POST['precio_curso'] ?? ''),
            'descripcion_curso' => trim($_POST['descripcion_curso'] ?? ''),
            'id_profesor' => trim($_POST['id_profesor'] ?? '')
        ]; //arreglos asociativos

            //si se especifico un Id valido, intenta cargar la informacion desde la base de datos
        if ($id > 0) {
            $item = $this->curso->porId($id) ?? $item;
        }

        //carga los datos necesarios para los selectores del formulario(dropdowns)
        // Eliminado o si no , no  me daba $profesor = $this->profesor->opciones();
        

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
        $d  = [
            //mysql             datos del formulario
            'nombre_curso'          => trim($_POST['nombre_curso'] ?? ''),
            'genero_curso'          => trim($_POST['genero_curso'] ?? ''),
            'precio_curso'             => $_POST['precio_curso'] ?? '',
            'descripcion_curso'             => $_POST['descripcion_curso'] ?? '',
            //CAMBIO PARA QUE ME DE 'id_profesor'        => (int) ($_POST['id_curso'] ?? 0),
            'id_profesor' => (int) ($_SESSION['id_profesor'] ?? $_SESSION['usuario']['id_profesor'] ?? $_SESSION['usuario_id'] ?? 0),
        ];

        $errores = [];

        //validacion 1: El nombre de la mascota no debe estar vacio
        if ($d['nombre_curso'] === '') $errores[] = 'El nombre es obligatorio.';
        //validacion 2 Pertenecnia de la especie a las opciones permitidas
        if (!in_array($d['genero_curso'], mdlCurso::GENERO, true)) $errores[] = 'Elige un genero válido.';
        //Validacion 3 Pertenencia del sexo sean las que son
        if ($d['precio_curso'] === '') $errores[] = "El precio es obligatorio";
        if ($d['descripcion_curso'] === '') $errores[] = 'La descripcion no puede estar vacia';
        
        //SE ELIMINA PARA QUE DE . AI
        /*$creadorProfesor = $d['id_profesor'] > 0 ? $this->profesor->porId($d['id_profesor']) : null;
        if (!$creadorProfesor) {
            $errores[] = 'Elige un profesor de la lista.';
        } elseif (!$creadorProfesor['activo']) {
            $errores[] = 'Ese profesor está inactivo; reactívalo o elige otro.';
        }*/
        if ($d['id_profesor'] <= 0) {
        $errores[] = 'No se ha detectado una sesión de profesor válida.';
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