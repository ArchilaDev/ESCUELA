<?php
// Llamar la conexión
require_once __DIR__ . '/../config/conexion.php';

class mdlEstudiante
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::conectar();
    }

    // Método ver datos, listar (Contando los cursos directamente desde la tabla curso)
    public function listar(string $buscar = '', string $estado = ''): array
    {
        $sql = "SELECT e.*, (SELECT COUNT(*) FROM curso c WHERE c.id_estudiante = e.id_estudiante) AS total_cursos 
                FROM estudiante e 
                WHERE 1 = 1";

        $params = [];

        // Filtración
        if ($buscar !== '') {
            $sql .= " AND (e.nombre_estudiante LIKE ? OR e.apellido_estudiante LIKE ? OR e.email_estudiante LIKE ?)";
            $comodin = '%' . $buscar . '%';
            array_push($params, $comodin, $comodin, $comodin);
        }

        if ($estado === '1' || $estado === '0') {
            $sql .= ' AND e.activo = ?';
            $params[] = $estado;
        }

        // Ordenar resultados
        $sql .= ' ORDER BY e.activo DESC, e.nombre_estudiante ASC';

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    // Búsqueda por id
    public function porId(int $id): ?array
    {
        $sql = "SELECT * FROM estudiante WHERE id_estudiante = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    // Lista corta para desplegables
    public function opciones(): array
    {
        $sql = "SELECT id_estudiante, nombre_estudiante, apellido_estudiante, activo FROM estudiante ORDER BY activo DESC, nombre_estudiante ASC";
        return $this->db->query($sql)->fetchAll();
    }

    // Búsqueda por email ignorando el id actual
    public function emailExiste(string $email, int $ignorarId = 0): bool
    {
        $sql = "SELECT id_estudiante FROM estudiante WHERE email_estudiante = ? AND id_estudiante <> ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$email, $ignorarId]);
        return (bool) $stmt->fetch();
    }

    // Método para registrar o crear datos
    public function crear(array $d): int
    {
        $sql = "INSERT INTO estudiante (nombre_estudiante, apellido_estudiante, email_estudiante, edad_estudiante, pais_estudiante, idioma_estudiante, activo) 
                VALUES (?,?,?,?,?,?,?)";
        $this->db->prepare($sql)->execute([
            $d['nombre_estudiante'],
            $d['apellido_estudiante'],
            $d['email_estudiante'],
            $d['edad_estudiante'] ?: null,
            $d['pais_estudiante'] ?: null,
            $d['idioma_estudiante'] ?: null,
            $d['activo'] ?? 1
        ]);
        return (int) $this->db->lastInsertId();
    }

    // Método para actualizar
    public function actualizar(int $id, array $d): bool
    {
        $sql = "UPDATE estudiante 
                SET nombre_estudiante = ?, apellido_estudiante = ?, email_estudiante = ?, edad_estudiante = ?, pais_estudiante = ?, idioma_estudiante = ? 
                WHERE id_estudiante = ?";
        return $this->db->prepare($sql)->execute([
            $d['nombre_estudiante'],
            $d['apellido_estudiante'],
            $d['email_estudiante'],
            $d['edad_estudiante'],
            $d['pais_estudiante'],
            $d['idioma_estudiante'],
            $id
        ]);
    }

    // Cambiar estado o inactivar cursos del estudiante si se desactiva
    public function cambiarEstadoCursos(int $estudianteId, int $activo): bool
    {
        $sql = "UPDATE curso SET activo = ? WHERE id_estudiante = ?";
        return $this->db->prepare($sql)->execute([$activo, $estudianteId]);
    }

    // Activa o desactiva la cuenta del estudiante
    public function cambiarEstado(int $id, int $activo): bool
    {
        $sql = "UPDATE estudiante SET activo = ? WHERE id_estudiante = ?";
        return $this->db->prepare($sql)->execute([$activo, $id]);
    }

    // Método para eliminar físicamente
    public function eliminar(int $id): bool
    {
        $sql = "DELETE FROM estudiante WHERE id_estudiante = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->rowCount() > 0;
    }
}