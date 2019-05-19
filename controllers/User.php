<?php
    require_once '../models/User.php';
    require_once '../models/Person.php';
    
    session_start();

    /* -- Boton iniciar, del index -- */
    if(isset($_POST["iniciar"])){
        $username = addslashes(strip_tags($_POST['username']));
        $password = addslashes(strip_tags($_POST['password'])); 
        
        logearse($username, $password);
    }

    function logearse($username, $password){
        try{
            if(!empty($username) && !empty($password)){
                $user = new User();
                $usuario = $user->validate($username, md5($password));
                if(count($usuario) > 0){
                    $_SESSION['username'] = $username;
                    $_SESSION['password'] = $password;
                    header('Location: ../views/posts');
                }else{
                    header('Location: ../');
                }
            }else{
                header('Location: ../index?res='.md5('falta_datos'));
            }
        }catch(Exception $e){
            exit("Error: ".$e->getMessage());
        }
    }
    
    /* -- Boton registrarse, del index -- */
    if(!empty($_REQUEST)){
        if($_REQUEST['registrar'] == "ok"){
            $nombre = addslashes(strip_tags($_POST['nombre']));
            $correo = addslashes(strip_tags($_POST['correo']));
            $n_usuario = addslashes(strip_tags($_POST['n_usuario']));
            $n_contraseña = addslashes(strip_tags($_POST['n_contrasena'])); 

            registrar($nombre, $correo, $n_usuario, $n_contraseña);
        }    
    }

    function registrar($nombre, $correo, $n_usuario, $n_contraseña){
        try{
            if(!empty($nombre) && !empty($correo) && !empty($n_usuario) && !empty($n_contraseña)){
                $user = new User();
                $person = new Person();
                if($user->create($n_usuario, md5($n_contraseña)) == true){
                    $id_user = $user->getId();
                    if($person->create($nombre, $correo, $id_user) == true){
                        echo 'Cuenta creada exitosamente';
                    }else{
                        echo 'Ocurrio un error al momento de crear la cuenta, porfavor vuelva a intentarlo';
                    }
                }else{ 
                    echo 'Existe el mismo nombre de usuario';
                }
            }else{
                echo 'Falta un dato (nombre, apellido, correo, nombre usuario, contrasenha)';
            }
        }catch(Exception $e){
            exit("Error: ".$e->getMessage());
        }
    }

