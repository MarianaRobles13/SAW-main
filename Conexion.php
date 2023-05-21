<?php
    $servidor="localhost";
    $usuario="root";
    $password="lizbeth/MYSQL1/";
    $base="bdcupcake";

    $conexion=mysqli_connect("$servidor", "$usuario", "$password") or die();
    mysqli_query($conexion, "SET NAMES 'utf8'");
    $base=mysqli_select_db($conexion, $base);


    class Database{

        private $host;
        private $db;
        private $usuario;
        private $password;
        private $charset;

        public function __construct(){
            $this->host = 'localhost';
            $this->db = 'bdcupcake';
            $this->usuario = 'root';
            $this->password = 'lizbeth/MYSQL1/';
            $this->charset = 'utf8mb4';
        }

        function connect(){
            try{
                $connection = "mysql:host=" . $this->host . ";dbname=" . $this->db . ";charset=" . $this->charset;
                $options = [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ];
            
                $pdo = new PDO($connection, $this->usuario, $this->password, $options);
    
                return $pdo;
            }catch(PDOException $e){
                print_r('Error connection: ' . $e->getMessage());
            }
        }

    }
?>