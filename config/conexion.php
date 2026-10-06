<?php
    //Conexion unica a MySQL. Se usa asi: Database::conectar()
    class Database{
        //atributos
        private static ? PDO $con = null;

        //métodos
        public static function conectar(): PDO{
            //validación de la conexión
            if(self::$con !== null){
                return self::$con;
            }

            //ajustar o configurar la conexion 
            $host = "localhost";
            $bd = "proyecto_php_db";
            $user = "root";
            $pass = "";

            try{
                self::$con = new PDO("mysql:host=$host;dbname=$bd;charset=utf8mb4", $user, $pass);
                self::$con -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $e){
                exit("No se pudo conectar a la base de datos: " . $e -> getMessage());
            }

            return self::$con;
        }
    }
?>