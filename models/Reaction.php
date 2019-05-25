<?php 
    require_once $_SERVER['DOCUMENT_ROOT'].'/web/config/Database.php';

    class Reaction{
        private $table;

        public function __construct(){
            $this->table = 'reaction';
        }

        public function getCantReaction($id_post, $type){
            $conex = new Database();
            $conexion = $conex->connect();
            try {
                $query = "SELECT SUM($type) FROM $this->table r, post p WHERE p.id_post = r.id_post AND p.id_post = $id_post";
                $reactions = $conexion->query($query)->fetchAll();
                foreach ($reactions as $reaction) {
                    return $reaction['SUM('.$type.')'];
                }
            } catch (PDOException $e) {
                exit("Error: ".$e->getMessage());
            }
        }

        public function findReactionUser($id_post, $id_user){
            $conex = new Database();
            $conexion = $conex->connect();
            try {
                $query = "SELECT * FROM $this->table p, reaction r, user u WHERE p.id_post = r.id_post AND u.id_user = p.id_user AND p.id_post = $id_post AND u.id_user = $id_user";
                return $conexion->query($query)->fetchAll();
            } catch (PDOException $e) {
                exit("Error: ".$e->getMessage());
            }
        }

        public function create($id_user, $id_post, $type){
            $conex = new Database();
            $conexion = $conex->connect();
            try {
                $query = "INSERT INTO $this->table (id_user, id_post, $type) VALUES($id_user, $id_post, 1)";
                return $conexion->prepare($query)->execute();
            } catch (PDOException $e) {
                exit("Error: ".$e->getMessage());
            }
        }
    }
    
