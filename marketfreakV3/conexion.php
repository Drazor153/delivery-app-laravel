<?php
    class conexion{
        private $servidor = "localhost";
        private $usuario = "raiz";
        private $password = "localhost";
        private $baseDatos = "marketfreak";
        private $conexion;

        public function __construct(){
            try {
                $this->conexion = new PDO("mysql:host=$this->servidor;dbname=$this->baseDatos", $this->usuario, $this->password);
                $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                return "falla de conexion".$e;
            }
        }
        //Insertar/delete/actualizar
        public function ejecutar($sql){
            $this->conexion->exec($sql);
            return $this->conexion->lastInsertId();
        }
        // Consultar
        public function consultar($sql){
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->execute();
            return $sentencia->fetchAll();
        }
    }

?>
