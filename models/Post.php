<?php 
    require_once '../config/Database.php';
    
    class Post{
        private $title;
        private $description;
        private $link;
        private $date;
        private $table;

        public function __construct(){
            $this->title = '';
            $this->description = '';
            $this->link = '';
            $this->date = date("Y-m-d");
            $this->table = 'post';
        }

        public function create($title, $description, $link){
            $conex = new Database();
            $conexion = $conex->connect();
            try {
                $this->title = $title;
                $this->description = $description;
                $this->link = $link;
                $query = "INSERT INTO $this->table (title, description, link, date_create) VALUES ('$this->title', '$this->description', '$this->link', '$this->date')";
                return $conexion->prepare($query)->execute();
            } catch (PDOException $e) {
                exit("Error: ".$e->getMessage());
            }
        }

        public function insertUserPost($iduser, $idpost){
            $conex = new Database();
            $conexion = $conex->connect();
            try {
                $query = "INSERT INTO user_post (id_post, id_user, m_emp, m_enc, m_exc) VALUES ($idpost, $iduser, 0, 0, 0)";
                return $conexion->prepare($query)->execute();
            } catch (PDOException $e) {
                exit("Error: ".$e->getMessage());
            }
        }

        public function getIdPost(){
            $conex = new Database();
            $conexion = $conex->connect();
            try {
                $query = "SELECT id_post FROM $this->table WHERE title = '$this->title' AND description = '$this->description' AND link = '$this->link'";
                $res = $conexion->query($query)->fetchAll();
                foreach ($res as $idpost) {
                    return $idpost['id_post'];    
                }
            } catch (PDOException $e) {
                exit("Error: ".$e->getMessage());
            }
        }
        
        public function getPosts(){
            $conex = new Database();
            $conexion = $conex->connect();
            try {
                $query = "SELECT * FROM $this->table p, user u, user_post up WHERE p.id_post = up.id_post AND u.id_user = up.id_user";
                return $conexion->query($query)->fetchAll();
            } catch (PDOException $e) {
                exit("Error: ".$e->getMessage());
            }
        }
        
        public function getCantReaction($id, $type){
            $conex = new Database();
            $conexion = $conex->connect(); 
            try {
                $query = "SELECT $type FROM $this->table WHERE id_post=$id";
                $res = $conexion->query($query)->fetchAll();
                foreach ($res as $id) {
                    return $id["$type"];
                }
            } catch (PDOException $e) {
                exit("Error: ".$e->getMessage());
            }
        }
        
        /*
        public function updateReaction($id, $type, $count){
            $conex = new Database();
            $conexion = $conex->connect(); 
            try {
                $query = "UPDATE $this->table SET $type = $count WHERE id_post = $id";
                return $conexion->prepare($query)->execute();
            } catch (PDOException $e) {
                exit("Error: ".$e->getMessage());
            }
        }

        public function getExistReaction($username, $id){
            $conex = new Database();
            $conexion = $conex->connect();
            try {
                $query = "SELECT COUNT(*) FROM user u, post p WHERE u.username = '$username' AND p.id_post = $id";
                $res = $conexion->query($query)->fetchAll();
                foreach ($res as $res) {
                    return $res['COUNT(*)'];
                }
            } catch (PDOException $e) {
                exit("Error: ".$e->getMessage());
            }
        }*/
    }