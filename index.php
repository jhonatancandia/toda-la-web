<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php 
        include 'views/layout/head.php';
    ?>
  <title>Posts - Toda la web</title>
</head>

<body>
  <!--Menu-->
  <div class="ui large menu" style="margin-bottom: 0;">
    <a class="item" href=""><img src="public/img/logo.png" alt="Logo" title="Index"></a>
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
  <!--Search and new post button-->
  <div class="ui two stackable cards">
    <div class="column post">
      <div class="ui right aligned category search">
        <div class="ui icon input">
          <input id="search" class="prompt" type="text" placeholder="Search post...">
          <i class="search icon"></i>
        </div>
        <div class="results"></div>
      </div>
    </div>
    <div class="column post">
      <?php 
        if(!empty($_SESSION)){
      ?>  
          <button class="ui fluid primary button" type="button" id="create_button_yes">Create post</button>
      <?php
        }else{
      ?>
          <button class="ui fluid primary button" type="button" id="create_button_not">Create post</button>
      <?php
        }
      ?>
    </div>
  </div>
  <!--Cards-->
  <div class="ui four stackable cards">
    <?php 
      require_once 'models/post.php';
      $post = new Post();
      $posts = $post->getPosts();
      foreach ($posts as $post) {
    ?>  
      <div class="ui card">
        <div class="content">
          <div class="header text-center"><?= $post['title']; ?></div>
          <div class="meta">
            <br>
            <span class="left floated time"><?= 'Creado por '.$post['username'].' el '.$post['date_create']; ?></span>
            <br>
          </div>
          <div class="description">
            <p><strong><?= $post['description']; ?></strong></p>
          </div>
          <div class="extra content">
            <div class="float floated author">
              <div class="description">
                <a href="<?= $post['link']; ?>" target="_blank"><?= $post['link']; ?></a>
              </div>
            </div>
          </div>
        </div>
        <?php 
          if(!empty($_SESSION)){
        ?>
          <div class="extra content">
            <div class="float floated author">
              <a href="controllers/reaction?idp=<?= base64_encode($post['id_post']);?>&type=<?= base64_encode('m_enc');?>"><i class="left floated like icon activating element" data-content="Me encanta"
                data-position="bottom left">0</i></a>
              <a href="controllers/reaction?idp=<?= base64_encode($post['id_post']);?>&type=<?= base64_encode('m_emp');?>"><i class="left floated meh icon activating element" data-content="Me emperra" 
                data-position="bottom left">0</i></a>
            </div>
          </div>
        <?php
          }else{
        ?>
          <div class="extra content">
            <div class="float floated author">
              <a href=""><i class="left floated like icon activating element" data-content="Me encanta"
                data-position="bottom left">0</i></a>
              <a href=""><i class="left floated meh icon activating element" data-content="Me emperra" 
                data-position="bottom left">0</i></a>
            </div>
          </div>
        <?php
          }
        ?>
      </div>
    <?php 
      }
    ?>
  </div>
  <!--Modal login-->
  <div class="ui modal" id="login">
    <i class="close icon"></i>
    <div class="ui placeholder segment" style="margin-top: 0;">
      <div class="ui two column very relaxed stackable grid">
        <div class="column">
          <div class="ui form">
            <form method="POST" id="login-form">
              <div class="field-n">
                <label>Username</label>
                <div class="ui left icon input mt-10">
                  <input type="text" placeholder="Username" name="username" id="user" required>
                  <i class="user icon"></i>
                </div>
              </div>
              <div class="field-n">
                <label>Password</label>
                <div class="ui left icon input mt-10">
                  <input type="password" placeholder="Password" name="password" id="pass" required>
                  <i class="lock icon"></i>
                </div>
              </div>
              <div class="mt-10" id="verificate_login"></div>
              <button class="ui blue submit button" id="login_in" type="button">Login</button>
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
  <!--Modal register-->
  <div class="ui modal" id="registrarse">
    <i class="close icon"></i>
    <div class="ui placeholder segment" style="margin-top: 0;">
      <div class="ui one column very relaxed stackable grid">
        <div class="column">
          <div class="ui form">
            <form method="POST" id="form">
              <div class="field-n">
                <label for="nombre">Nombre(s)</label>
                <div class="ui left icon input mt-10">
                  <input type="text" placeholder="Name(s)" name="nombre" id="nombre" required>
                  <i class="user icon"></i>
                </div>
              </div>
              <div class="field-n">
                <label for="nombre">Correo</label>
                <div class="ui left icon input mt-10">
                  <input type="email" placeholder="E-mail" name="correo" id="correo" required>
                  <i class="envelope square icon"></i>
                </div>
              </div>
              <div class="field-n">
                <label for="nombre">Username</label>
                <div class="ui left icon input mt-10">
                  <input type="text" placeholder="Username" name="n_usuario" id="username" required>
                  <i class="user icon"></i>
                </div>
              </div>
              <div class="field-n">
                <label for="nombre">Password</label>
                <div class="ui left icon input mt-10">
                  <input type="password" placeholder="Password" name="n_contrasena" id="password" required>
                  <i class="lock icon"></i>
                </div>
              </div>
              <div class="mt-10" id="verificate_register"></div>
              <div class="mt-10">
                <button type="button" class="fluid ui button primary" id="registrar_usuario">Registrarse</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--Modal new post-->
  <div class="ui modal" id="new_post">
    <i class="close icon"></i>
    <div class="ui placeholder segment" style="margin-top: 0;">
      <div class="ui one column very relaxed stackable grid">
        <div class="column">
          <div class="ui form">
            <form method="POST" id="form-post">
              <div class="field-n">
                <label>Title</label>
                <div class="ui left icon input mt-10">
                  <input type="text" placeholder="Title" id="title" name="title" required>
                  <i class="edit outline icon"></i>
                </div>  
              </div>
              <div class="field-n">
                <label>Description</label>
                <div class="ui left icon input mt-10">
                <input type="text" placeholder="Description" id="description" name="description" required>
                  <i class="edit outline icon"></i>
                </div>
              </div>
              <div class="field-n">
                <label>Link</label>
                <div class="ui left icon input mt-10">
                  <input type="text" placeholder="Link" id="link" name="link" required>
                  <i class="edit outline icon"></i>
                </div>  
              </div>
              <div class="mt-10" id="verificate_post"></div>
              <div class="mt-10">
                <button type="button" class="ui blue submit button" id="create_post" name="create_post">Register</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--Footer and Scripts-->
  <?php 
    include 'views/layout/footer.php';
    include 'views/layout/script.php';
  ?>
</body>

</html>