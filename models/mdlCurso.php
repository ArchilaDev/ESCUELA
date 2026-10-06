<?php
require_once __DIR__ . '/../config/conexion.php';

class mdlCurso {
    private PDO $db;

    public const GENERO = ['Programacion', 'Modelado', 'Otro'];
    

    public function __construct() {
        $this->db = Database::conectar();
    }

    public function listar(string $buscar = '', string $genero = ''): array {
        $sql = "SELECT c.*, p.nombre_profesor, p.apellido_profesor 
                FROM curso c 
                LEFT JOIN profesor p ON c.id_profesor = p.id_profesor 
                WHERE 1=1";

        $params = [];

        if ($buscar !== '') {
            $sql .= " AND (c.nombre_curso LIKE ? OR c.genero_curso LIKE ? OR p.nombre_profesor LIKE ?)";
            $comodin = '%' . $buscar . '%';
            array_push($params, $comodin, $comodin, $comodin);
        }

        if (in_array($genero, self::GENERO, true)) {
            $sql .= " AND c.genero_curso = ?";
            $params[] = $genero;
        }


        $sql .= ' ORDER BY c.nombre_curso DESC, c.id_curso DESC';

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params); // Corregido: Sin corchetes extra
        return $stmt->fetchAll();
    }

    public function porId(int $id): ?array {
        $sql = "SELECT c.*, p.nombre_profesor, p.apellido_profesor 
                FROM curso c 
                JOIN profesor p ON p.id_profesor = c.id_profesor 
                WHERE c.id_curso = ?";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    public function crear(array $d): int {
        $sql = "INSERT INTO curso( nombre_curso, genero_curso,precio_curso,descripcion_curso, id_profesor) 
                VALUES (?,?,?,?,?)";
        $this->db->prepare($sql)->execute($this->parametros($d));
        return (int) $this->db->lastInsertId();
    }

    public function actualizar(int $id, array $d): bool {
        $sql = "UPDATE curso
                SET nombre_curso = ?, genero_curso = ?, precio_curso = ?, descripcion_curso = ?, id_profesor = ?
                WHERE id_curso = ?";
        return $this->db->prepare($sql)->execute([...$this->parametros($d), $id]);
    }

    public function cambiarEstado(int $id, string $genero): bool {
        $sql = "UPDATE curso SET genero_curso = ? WHERE id_curso = ?";
        return $this->db->prepare($sql)->execute([$genero, $id]);
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
            $d['genero_curso'],
            $d['precio_curso'] ?: null,
            $d['descripcion_curso'] ?: null,
            (int) $d['id_profesor'],

        ];
    }
}
