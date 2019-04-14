<?php
    require_once '../models/Post.php';
    session_start();

    $id = base64_decode(addslashes(strip_tags($_REQUEST['idp'])));
    $type = base64_decode(addslashes(strip_tags($_REQUEST['type'])));
    
    if(!empty($id) && !empty($type)){
        $posts = new Post();
        $cant = $posts->getCantReaction($id, $type) + 1;   
        if(count($posts->getExistReaction($_SESSION['username'], $id)) == 0){
            if($posts->updateReaction($id, $type, $cant) == true){
                header('Location: ../views/posts');
            }else{
                echo 'Ocurrio un error';
            }
        }else{
            echo 'Solo puede reaccionar una vez en cada post';
        }
        
    }