<?php
require_once __DIR__ . '/../config/conexion.php';

class mdlUsuario {
    private PDO $db;

    public function __construct() {
        $this->db = Database::conectar();
    }

    public function porUsuario(string $usuario) {
      // Introduzca el ID de usuario para que $SESSION funcione fuera
        $sql = "SELECT id_profesor, nombre_profesor, apellido_profesor, clave FROM profesor WHERE usuario = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$usuario]);
        return $stmt->fetch() ?: null;
    }
}
?>