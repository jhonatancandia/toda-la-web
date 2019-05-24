<?php 
    require_once $_SERVER['DOCUMENT_ROOT'].'/web/config/Database.php';

    class User{
        private $username;
        private $password;
        private $table = 'user';
        
        public function __construct(){
            $this->username = '';
            $this->password = '';
        }

        public function create($username, $password){
            $conex = new Database();
            $conexion = $conex->connect();
            try {
                $this->username = $username;
                $this->password = $password;
                $query = "INSERT INTO $this->table (username, password, rol_user) VALUES('$this->username', '$this->password', '2')";
                return $conexion->prepare($query)->execute();
            } catch (PDOException $e) {
                exit("Error: ".$e -> getMessage());
            }
        }

        public function validate($username, $password){
            $conex = new Database();
            $conexion = $conex->connect();
            try {
                $query = "SELECT username FROM $this->table WHERE username = '$username' AND password = '$password'";
                return $conexion->query($query)->fetchAll();
            } catch(PDOException $e){
                exit("Error: ".$e->getMessage());
            }
        }

        public function getId(){
            $conex = new Database();
            $conexion = $conex->connect();
            try {
                $query = "SELECT id_user FROM $this->table WHERE username = '$this->username' AND password = '$this->password'";
                $userid = $conexion->query($query)->fetchAll(); 
                foreach ($userid as $user) {
                    return $user['id_user'];
                }
            } catch (PDOException $e) {
                exit("Error: ".$e->getMessage());
            }
        }

        public function getIdUser($username){
            $conex = new Database();
            $conexion = $conex->connect();
            try {
                $query = "SELECT id_user FROM $this->table WHERE username = '$username'";
                $userid = $conexion->query($query)->fetchAll(); 
                foreach ($userid as $user) {
                    return $user['id_user'];
                }
            } catch (PDOException $e) {
                exit("Error: ".$e->getMessage());
            }
        }
    }