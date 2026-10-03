<?php
require_once __DIR__ . '/../config/conexion.php';

class mdlCurso {
    private $db;

    public function __construct() {
        $this->db = Conexion::conectar();
    }

    public function listar() {
        $sql = "SELECT c.*, p.nombre_profesor, p.apellido_profesor 
                FROM curso c 
                LEFT JOIN profesor p ON c.id_profesor = p.id_profesor 
                ORDER BY c.id_curso DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($id) {
        $sql = "SELECT * FROM curso WHERE id_curso = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function guardar($datos) {
        $sql = "INSERT INTO curso (nombre_curso, genero_curso, precio_curso, descripcion_curso, id_profesor) 
                VALUES (:nombre, :genero, :precio, :descripcion, :id_profesor)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nombre', $datos['nombre_curso'], PDO::PARAM_STR);
        $stmt->bindParam(':genero', $datos['genero_curso'], PDO::PARAM_STR);
        $stmt->bindParam(':precio', $datos['precio_curso'], PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $datos['descripcion_curso'], PDO::PARAM_STR);
        $stmt->bindParam(':id_profesor', $datos['id_profesor'], PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function actualizar($id, $datos) {
        $sql = "UPDATE curso 
                SET nombre_curso = :nombre, genero_curso = :genero, precio_curso = :precio, descripcion_curso = :descripcion, id_profesor = :id_profesor 
                WHERE id_curso = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $datos['nombre_curso'], PDO::PARAM_STR);
        $stmt->bindParam(':genero', $datos['genero_curso'], PDO::PARAM_STR);
        $stmt->bindParam(':precio', $datos['precio_curso'], PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $datos['descripcion_curso'], PDO::PARAM_STR);
        $stmt->bindParam(':id_profesor', $datos['id_profesor'], PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function eliminar($id) {
        $sql = "DELETE FROM curso WHERE id_curso = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}