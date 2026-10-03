<?php
class Database {
    private static ?PDO $con = null;

    public static function conectar(): PDO {
        if (self::$con !== null) {
            return self::$con;
        }

        $host = "localhost";
        $bs   = "proyecto_php_db";
        $user = "root";
        $pass = "";

        try {
            self::$con = new PDO("mysql:host=$host;dbname=$bs;charset=utf8mb4", $user, $pass);
            self::$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            exit("No se pudo conectar a la base de datos: " . $e->getMessage());
        }

        return self::$con;
    }
}
?>