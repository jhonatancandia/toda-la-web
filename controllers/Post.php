<?php
    session_start();
    
    require_once '../models/Post.php';
    require_once '../models/User.php';

    /* Para crear post */
    if(isset($_POST['create_post'])){
        $title = addslashes(strip_tags($_POST['title']));
        $description = addslashes(strip_tags($_POST['description']));
        $link = addslashes(strip_tags($_POST['link']));

        registrar($title, $description, $link);
    }

    function registrar($title, $description, $link){
        try {
            if(!empty($title) && !empty($description) && !empty($link)){
                $post = new Post();
                $user = new User();
                if($post->create($title, $description, $link) == true){
                    if($post->insertUserPost($user->getIdUser($_SESSION['username']), $post->getIdPost()) == true){
                        header('Location: ../views/posts');
                    }
                    else{
                        echo 'No se registro el post, por parte de user post';
                    }
                }
                else
                    echo 'Ocurrio un error';
            }else
                echo 'Falta algun dato';
        } catch (Exception $e) {
            exit("Error: ".$e->getMessage());
        }
    }
    /*Fin para crear post */