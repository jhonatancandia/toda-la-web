<?php
    require_once '../models/Reaction.php';
    session_start();

    $id = base64_decode(addslashes(strip_tags($_REQUEST['idp'])));
    $type = base64_decode(addslashes(strip_tags($_REQUEST['type'])));
    
    if(!empty($id) && !empty($type)){
        registerReaction($id, $type);
    }else{
        echo 'Debe ingresar todos los datos';
    }

    function registerReaction($id, $type){
        $reaction = new Reaction();
        if(count($reaction->findReactionUser($id, $_SESSION['id'])) == 0){
            if($reaction->create($_SESSION['id'], $id, $type)){
                header('Location: ../');
            }else{
                echo 'Ocurrio un error, porfavor vuelva a intentarlo';
            }
        }else{
            echo 'Solo puede reaccionar una sola vez en cada post';
        }
    }