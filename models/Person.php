<?php 
    require_once $_SERVER['DOCUMENT_ROOT'].'/web/config/Database.php';

    class Person{
        private $name;
        private $email;
        private $table = 'person';

        public function __construct(){
            $this->name = '';
            $this->email = '';
        }

        public function create($name, $email, $person_user){
            $conex = new Database();
            $conexion = $conex->connect();
            try {
                $this->name = $name;
                $this->email = $email;
                $query = "INSERT INTO $this->table (name, email, person_user) VALUES('$this->name', '$this->email', $person_user)";
                return $conexion->prepare($query)->execute();
            } catch (Exception $e) {
                exit("Error: ".$e->getMessage());
            }
            
        }
    }
