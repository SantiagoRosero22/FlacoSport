<?php
  $page_title = 'Lista de imagenes';
  require_once('includes/load.php');
  page_require_level(2);
?>
<?php $media_files = find_all('media');?>
<?php
  if(isset($_POST['submit'])) {
  $photo = new Media();
  $photo->upload($_FILES['file_upload']);
    if($photo->process_media()){
        $session->msg('s','Imagen subida al servidor.');
        redirect('imagen.php');
    } else{
      $session->msg('d',join($photo->errors));
      redirect('imagen.php');
    }

  }

?>
<?php include_once('layouts/header.php'); ?>
     <div class="row">
        <div class="col-md-6">
          <?php echo display_msg($msg); ?>
        </div>

      <div class="col-md-12">
        <div class="panel panel-default" style='border-radius: 20px'>
          <div class="panel-heading clearfix" style='background-color: #7ACBEE; border-radius: 20px'>
            <span class="glyphicon glyphicon-camera"></span>
            <span>Lista de imagenes</span>
            <div class="pull-right">
              <form class="form-inline" action="imagen.php" method="POST" enctype="multipart/form-data">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-btn">
                    <input type="file" name="file_upload" multiple="multiple" class="btn btn-primary btn-file" style='background: #f9f9f9; border-radius: 20px 0px 0px 20px'/>
                 </span>

                 <button type="submit" name="submit" class="btn btn-default" style='background-color: #5353bc; border-radius: 0px 20px 20px 0px'>Subir</button>
               </div>
              </div>
             </form>
            </div>
          </div>
          <div class="panel-body">
            <table class="table">
              <thead>
                <tr>
                  <th class="text-center" style="width: 50px;">#</th>
                  <th class="text-center">Imagen</th>
                  <th class="text-center">Descripción</th>
                  <th class="text-center" style="width: 20%;">Tipo</th>
                  <th class="text-center" style="width: 50px;">Acciones</th>
                </tr>
              </thead>
                <tbody>
                <?php foreach ($media_files as $media_file): ?>
                <tr class="list-inline">
                 <td class="text-center"><?php echo count_id();?></td>
                  <td class="text-center">
                      <img src="uploads/products/<?php echo $media_file['file_name'];?>" class="img-thumbnail" />
                  </td>
                <td class="text-center">
                  <?php echo $media_file['file_name'];?>
                </td>
                <td class="text-center">
                  <?php echo $media_file['file_type'];?>
                </td>
                <td class="text-center">
                  <a href="eliminar_imagen.php?id=<?php echo (int) $media_file['id'];?>" class="btn btn-danger btn-xs"  title="Eliminar"style='border-radius: 20px'>
                  Eliminar                  
                </a>
                </td>
               </tr>
              <?php endforeach;?>
            </tbody>
          </div>
        </div>
      </div>
</div>


<?php include_once('layouts/footer.php'); ?>
