<?php 
    require_once $_SERVER['DOCUMENT_ROOT'].'/web/config/Database.php';
    
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

        public function create($title, $description, $link, $iduser){
            $conex = new Database();
            $conexion = $conex->connect();
            try {
                $this->title = $title;
                $this->description = $description;
                $this->link = $link;
                $query = "INSERT INTO $this->table (title, description, link, date_create, id_user) VALUES ('$this->title', '$this->description', '$this->link', '$this->date', $iduser)";
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
                $query = "SELECT * FROM $this->table p, user u WHERE p.id_user = u.id_user";
                return $conexion->query($query)->fetchAll();
            } catch (PDOException $e) {
                exit("Error: ".$e->getMessage());
            }
        }
        
        
    }