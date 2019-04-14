<?php
    class Database{
        private $user;
        private $password;
        private $database;
        private $host;
        private $type;
        private $conexion;

        public function __construct(){
            $this->user = 'root';
            $this->password = '';
            $this->database = 'web';
            $this->host = 'localhost';
            $this->type = 'mysql';
            $this->conexion = '';
        }

        public function connect(){
            try{
                $string = ''.$this->type.':host='.$this->host.';dbname='.$this->database;
                $conexion = new PDO($string, $this->user, $this->password);
                return $conexion;
            }catch(PDOException $e){
                exit("Error: ".$e->getMessage());
            }
        }

        public function desconnect(){
            $this->conexion = null;
        }
    }
    