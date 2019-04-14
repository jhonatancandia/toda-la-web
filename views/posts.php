<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php 
        include 'layout/head.php';
    ?>
  <title>Posts - Toda la web</title>
</head>

<body>
  <!--Menu-->
  <div class="ui large menu" style="margin-bottom: 0;">
    <a class="item" href="../"><img src="../public/img/logo.png" alt="Logo" title="Index"></a>
    <a class="item" href="posts" title="Posts">Posts</a>
    <div class="right menu">
      <div class="item">
        <?php 
          if(!empty($_SESSION)){
        ?>
          <a href="../controllers/logout.php" class="ui inverted blue button">Logout</a>
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
  <!--End menu-->
  <!--Content-->
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
  <!--End search and new post button-->
  <!--Cards-->
  <div class="ui four stackable cards">
    <?php 
      require_once '../models/post.php';
      $post = new Post();
      $posts = $post->getPosts();
      foreach ($posts as $post) {
    ?>  
      <div class="ui card">
        <div class="content">
          <div class="header"><?= $post['title']; ?></div>
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
              <a href="../controllers/reaction?idp=<?= base64_encode($post['id_post']);?>&type=<?= base64_encode('m_enc');?>"><i class="left floated like icon activating element" data-content="Me encanta"
                data-position="bottom left"><?= $post['m_enc']; ?></i></a>
              <a href="../controllers/reaction?idp=<?= base64_encode($post['id_post']);?>&type=<?= base64_encode('m_exc');?>"><i class="left floated smile icon activating element" data-content="Me excita"
                data-position="bottom left"><?= $post['m_exc']; ?></i></a>
              <a href="../controllers/reaction?idp=<?= base64_encode($post['id_post']);?>&type=<?= base64_encode('m_emp');?>"><i class="left floated meh icon activating element" data-content="Me emperra" 
                data-position="bottom left"><?= $post['m_emp']; ?></i></a>
            </div>
          </div>
        <?php
          }else{
        ?>
          <div class="extra content">
            <div class="float floated author">
              <a href=""><i class="left floated like icon activating element" data-content="Me encanta"
                data-position="bottom left"><?= $post['m_enc']; ?></i></a>
              <a href=""><i class="left floated smile icon activating element" data-content="Me excita"
                data-position="bottom left"><?= $post['m_exc']; ?></i></a>
              <a href=""><i class="left floated meh icon activating element" data-content="Me emperra" 
                data-position="bottom left"><?= $post['m_emp']; ?></i></a>
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
  <!--End cards-->
  <!--Modal login-->
  <div class="ui modal" id="login">
    <i class="close icon"></i>
    <div class="ui placeholder segment" style="margin-top: 0;">
      <div class="ui two column very relaxed stackable grid">
        <div class="column">
          <div class="ui form">
            <form action="../controllers/user.php" method="POST">
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
  <!--End modal login-->
  <!--Modal register-->
  <div class="ui modal" id="registrarse">
    <i class="close icon"></i>
    <div class="ui placeholder segment" style="margin-top: 0;">
      <div class="ui one column very relaxed stackable grid">
        <div class="column">
          <div class="ui form">
            <form action="../controllers/user.php" method="POST">
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
  <!--End modal register-->
  <!--Modal new post-->
  <div class="ui modal" id="new_post">
    <i class="close icon"></i>
    <div class="ui placeholder segment" style="margin-top: 0;">
      <div class="ui one column very relaxed stackable grid">
        <div class="column">
          <div class="ui form">
            <form action="../controllers/post.php" method="POST">
              <div class="field">
                <label>Title</label>
                  <input type="text" placeholder="Title" name="title" required>
              </div>
              <div class="field">
                <label>Description</label>
                <textarea rows="2" name="description"></textarea>
              </div>
              <div class="field">
                <label>Link</label>
                  <input type="text" placeholder="Link" name="link" required>
              </div>
              <button type="submit" class="ui blue submit button" name="create_post">Register</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--End modal post-->
  <!--End content-->
  <!--Footer and Scripts-->
  <?php 
    include 'layout/footer.php';
    include 'layout/script.php';
  ?>
  <!--End footer and scripts-->
</body>

</html>