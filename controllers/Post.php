<?php
    session_start();
    
    require_once '../models/Post.php';
    require_once '../models/User.php';

    /* Para crear post */
    if(!empty($_REQUEST)){
        if($_REQUEST['peticion'] == "registrar"){
            $title = addslashes(strip_tags($_POST['title']));
            $description = addslashes(strip_tags($_POST['description']));
            $link = addslashes(strip_tags($_POST['link']));

            registrar($title, $description, $link);
        }
    }

    function registrar($title, $description, $link){
        try {
            if(!empty($title) && !empty($description) && !empty($link)){
                $post = new Post();
                $user = new User();
                if($post->create($title, $description, $link, $user->getIdUser($_SESSION['username']))){
                    echo 'correcto';
                }
                else{
                    echo 'Ocurrio un error, porfavor vuelva a intentarlo';
                }
            }else{
                echo 'Falta algun dato, porfavor vuelva a intentarlo';
            }
        } catch (Exception $e) {
            exit("Error: ".$e->getMessage());
        }
    }
    /*Fin para crear post */