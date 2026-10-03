<?php
require_once __DIR__ . '/../config/conexion.php';

class mdlEstudiante {
    private PDO $db;

    public function __construct() {
        $this->db = Database::conectar();
    }

    public function listar() {
        $sql = "SELECT * FROM estudiante WHERE activo = 1 ORDER BY id_estudiante DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($id) {
        $sql = "SELECT * FROM estudiante WHERE id_estudiante = :id AND activo = 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function guardar($datos) {
        $sql = "INSERT INTO estudiante (nombre_estudiante, apellido_estudiante, email_estudiante, edad_estudiante, pais_estudiante, idioma_estudiante, activo) 
                VALUES (:nombre, :apellido, :email, :edad, :pais, :idioma, 1)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nombre', $datos['nombre_estudiante'], PDO::PARAM_STR);
        $stmt->bindParam(':apellido', $datos['apellido_estudiante'], PDO::PARAM_STR);
        $stmt->bindParam(':email', $datos['email_estudiante'], PDO::PARAM_STR);
        $stmt->bindParam(':edad', $datos['edad_estudiante'], PDO::PARAM_INT);
        $stmt->bindParam(':pais', $datos['pais_estudiante'], PDO::PARAM_STR);
        $stmt->bindParam(':idioma', $datos['idioma_estudiante'], PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function actualizar($id, $datos) {
        $sql = "UPDATE estudiante 
                SET nombre_estudiante = :nombre, apellido_estudiante = :apellido, email_estudiante = :email, edad_estudiante = :edad, pais_estudiante = :pais, idioma_estudiante = :idioma 
                WHERE id_estudiante = :id AND activo = 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $datos['nombre_estudiante'], PDO::PARAM_STR);
        $stmt->bindParam(':apellido', $datos['apellido_estudiante'], PDO::PARAM_STR);
        $stmt->bindParam(':email', $datos['email_estudiante'], PDO::PARAM_STR);
        $stmt->bindParam(':edad', $datos['edad_estudiante'], PDO::PARAM_INT);
        $stmt->bindParam(':pais', $datos['pais_estudiante'], PDO::PARAM_STR);
        $stmt->bindParam(':idioma', $datos['idioma_estudiante'], PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function eliminarLogico($id) {
        $sql = "UPDATE estudiante SET activo = 0 WHERE id_estudiante = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}