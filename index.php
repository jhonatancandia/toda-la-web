<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Toda la web esta AQUI!</title>
  <link rel="stylesheet" type="text/css" href="public/css/semantic/semantic.min.css">
  <link rel="stylesheet" type="text/css" href="public/css/style.css">
  <link rel="shortcut icon" href="public/img/logo.png" type="image/x-icon">
</head>

<body>
  <main id="principal">
    <!--Menu-->
    <div class="ui large menu" style="margin-bottom: 0;">
      <a class="item" href=""><img src="public/img/logo.png" alt="Logo" title="Index"></a>
      <a class="item" href="views/posts" title="Posts">Posts</a>
      <div class="right menu">
        <div class="item">
          <?php 
            if(!empty($_SESSION)){
          ?>   
            <a href="controllers/logout.php" class="ui inverted blue button">Logout</a>
          <?php
            }else{
          ?>
            <div class="ui inverted blue button" id="login_button">Login</div>
          <?php
            }
          ?>
        </div>
      </div>
    </div>
    <!--End Menu-->
    <!--Main image-->
    <img class="ui fluid image" src="public/img/fondo1.jpg">
    <!--End Main image-->
    <!--Modal login-->
    <div class="ui modal" id="login">
      <i class="close icon"></i>
      <div class="ui placeholder segment" style="margin-top: 0;">
        <div class="ui two column very relaxed stackable grid">
          <div class="column">
            <div class="ui form">
              <form action="controllers/user.php" method="POST">
                <div class="field">
                  <label>Username</label>
                  <div class="ui left icon input">
                    <input type="text" placeholder="Username" name="username" required>
                    <i class="user icon"></i>
                  </div>
                </div>
                <div class="field">
                  <label>Password</label>
                  <div class="ui left icon input">
                    <input type="password" placeholder="Password" name="password" required>
                    <i class="lock icon"></i>
                  </div>
                </div>
                <button class="ui blue submit button" type="submit" name="iniciar">Login</button>
              </form>
            </div>
          </div>
          <div class="middle aligned column">
            <div class="ui big icon button" id="register_button">
              <i class="save icon"></i>
              Register
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--End Modal login-->
    <!--Modal register-->
    <div class="ui modal" id="registrarse" style="width: 350px;">
      <i class="close icon"></i>
      <div class="ui placeholder segment" style="margin-top: 0;">
        <div class="ui one column very relaxed stackable grid">
          <div class="column">
            <div class="ui form">
              <form action="controllers/user.php" method="POST">
                <div class="field">
                  <label>Name(s)</label>
                  <div class="ui left icon input">
                    <input type="text" placeholder="Name(s)" name="nombre" required>
                    <i class="user icon"></i>
                  </div>
                </div>
                <div class="field">
                  <label>E-mail</label>
                  <div class="ui left icon input">
                    <input type="email" placeholder="E-mail" name="correo" required>
                    <i class="internet explorer icon"></i>
                  </div>
                </div>
                <div class="field">
                  <label>Username</label>
                  <div class="ui left icon input">
                    <input type="text" placeholder="Username" name="n_usuario" required>
                    <i class="user icon"></i>
                  </div>
                </div>
                <div class="field">
                  <label>Password</label>
                  <div class="ui left icon input">
                    <input type="password" placeholder="Password" name="n_contraseña" required>
                    <i class="lock icon"></i>
                  </div>
                </div>
                <button type="submit" class="ui blue submit button" name="registrarse">Registrarse</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--End Modal register-->
    <!--Footer-->
    <hr>
    <div class="ui section divider"></div>
    <div class="ui center aligned container">
      <img src="public/img/logo.png" class="ui centered mini image">
      <div class="ui horizontal small divided link list">
        Todos los derechos reservados 2019
      </div>
      <br>
    </div>
  </main>
  <!--End Footer-->
  <!--Loader-->
  <div class="ui segment" id="loader">
    <div class="ui active inverted dimmer">
      <div class="ui large text loader"><strong>Loading...</strong></div>
    </div>
    <p></p>
    <p></p>
    <p></p>
  </div>
  <!--End Loader-->
  <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
    crossorigin="anonymous"></script>
  <script src="public/css/semantic/semantic.min.js"></script>
  <script src="public/js/app.js"></script>
  <script>
    $(window).load(loader());
  </script>
</body>

</html>