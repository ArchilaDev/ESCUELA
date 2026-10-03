<?php
    class Database{
        private static ? PDO $con = null;

        //Metodos

        public static function conectar():PDO{
            //Validamos la conexion
            if(self::$con !== null){
                return self::$con;
            }

            //Ajustar los datos para conectar a la base de datos
            $host = 'localhost';
            $bs = 'proyecto_php_db';
            $user = 'root';
            $pass = '';

            try{
                self::$con = new PDO("mysql:host=$host;$dbname=$bd;charset = utf8mb4", $user, $pass); //Se accede a la propiedad statica de la clasee con :: y --> es para acceder al metodo que esta en la clase

                self::$con -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            }catch (PDOExeption $e){
                exit('No se pudo conectar a la base de datos'. $e->getMessage());

            }
            return self::$con;
        }

    }

?>