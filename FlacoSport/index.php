<?php
  ob_start();
  require_once('includes/load.php');
  if($session->isUserLoggedIn(true)) { redirect('sales.php', false);}
?>
<?php include_once('layouts/header.php'); ?>

<div id="columna1">
  <div class="login-page">
    <div class="text-center">
      <img src="uploads/2.jpg" id="img2" width="500" height="100">
      <p style='top: 20px; font-size: 14px;'>Iniciar sesión </p>
    </div>
    <?php echo display_msg($msg); ?>
    <form method="post" action="auth.php" class="clearfix">
      <div class="form-group">
        <label for="username" class="control-label" >Usario</label>
        <input type="name" class="form-control" name="username" placeholder="Usario" id="colinput" style='border-radius: 10px'>
      </div>
        <div class="form-group">
          <label for="Password" class="control-label">Contraseña</label>
          <input type="password" name= "password" class="form-control" placeholder="Contraseña" id="colinput" style='border-radius: 10px'>
        </div>
      <div lass="text-center">
        <button type="submit" class="btn btn-info  pull-right"  style='border-radius: 10px' id="bting">Entrar</button>
      </div>
    </form>
  </div>
</div>
<div id="columna2">
    <img src="uploads/lo.jpg" alt="Descripción de la Imagen 2" width="520" height="450">
</div>
<?php include_once('layouts/footer.php'); ?>
