<?php
require_once __DIR__ . '/../config/conexion.php';

class mdlProfesor {
    private $db;

    public function __construct() {
        $this->db = Conexion::conectar();
    }

    public function obtenerPorEmail($email) {
        $sql = "SELECT * FROM profesor WHERE email_profesor = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}