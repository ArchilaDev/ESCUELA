<?php
require_once __DIR__ . '/../config/conexion.php';

class mdlCurso {
    private PDO $db;

    public const GENEROS = ['Programación', 'Modelado', 'Otro'];
    /*
    public const ESTADOS = ['Activo', 'Inactivo', 'Pendiente'];
¨*/
    public function __construct() {
        $this->db = Database::conectar();
    }

    public function listar(string $buscar = '', string $activo = ''): array {
        $sql = "SELECT c.*, e.nombre_estudiante AS nombre_estudiante, e.activo AS estudiante_activo 
                FROM curso c 
                JOIN estudiante e ON e.id_estudiante = c.id_estudiante 
                WHERE 1 = 1";

        $params = [];

        if ($buscar !== '') {
            $sql .= " AND (c.nombre_curso LIKE ? OR c.genero_curso LIKE ? OR e.nombre_estudiante LIKE ?)";
            $comodin = '%' . $buscar . '%';
            array_push($params, $comodin, $comodin, $comodin);
        }

        
        if($activo === '1' || $activo === '0'){
            $sql .= ' AND c.activo = ?';
            $params[] = $activo; 
        }
        $sql .= ' ORDER BY c.activo DESC, c.id_curso DESC';

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function porId(int $id): ?array {
        $sql = "SELECT c.*, e.nombre_estudiante as nombre_estudiante, e.activo as estudiante_activo
                FROM curso c 
                JOIN estudiante e ON e.id_estudiante = c.id_estudiante 
                WHERE c.id_curso = ?";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    public function crear(array $d): int {
        $sql = "INSERT INTO curso( nombre_curso, genero_curso, precio_curso, descripcion_curso,id_estudiante) 
                VALUES (?, ?, ?, ?, ?)";
        $this->db->prepare($sql)->execute($this->parametros($d));
        return (int) $this->db->lastInsertId();
    }

    public function actualizar(int $id, array $d): bool {
        $sql = "UPDATE curso 
                SET nombre_curso = ?, genero_curso = ?, precio_curso = ?, descripcion_curso = ?,
                id_estudiante = ?
                WHERE id_curso = ?";
        return $this->db->prepare($sql)->execute([...$this->parametros($d), $id]);
    }
    
    //no funcionara porque borre estado..en la bse de datos
    public function cambiarEstado(int $id,string $estado):bool{
        $sql = 'UPDATE curso SET estado =  ? WHERE id_curso = ?';
        return $this->db->prepare($sql)->execute([$estado, $id]);
    }
        

    public function cambiarActivo(int $id, int $activo): bool{
        $sql = "UPDATE curso SET activo = ? WHERE id_curso = ?";
        return $this->db->prepare($sql)->execute([$activo, $id]);
    }
    public function eliminar(int $id): bool {
        $sql = "DELETE FROM curso WHERE id_curso = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->rowCount() > 0;
    }

    private function parametros(array $d): array {
        return [
            $d['nombre_curso'],
            $d['genero_curso'] ?: null,
            ($d['precio_curso'] !== '' && $d['precio_curso'] !== null) ? $d['precio_curso'] : 0,   
             $d['descripcion_curso'] ?: null,
            (int) $d['id_estudiante'],
        ];
    }
}