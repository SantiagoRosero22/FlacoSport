<?php
  $page_title = 'Lista de usuarios';
  require_once('includes/load.php');
?>
<?php
// Checkin What level user has permission to view this page
 page_require_level(1);
//pull out all user form database
 $all_users = find_all_user();
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
   <div class="col-md-12">
     <?php echo display_msg($msg); ?>
   </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default" style='border-radius: 20px'>
      <div class="panel-heading clearfix"style='background-color: #7ACBEE; border-radius: 20px'>
        <strong>
          <span>Usuarios</span>
       </strong>
         <a href="agregar_usuario.php" class="btn btn-info pull-right" style='background-color: #7351ed; border-radius: 20px'>Agregar usuario</a>
      </div>
     <div class="panel-body">
      <table class="table table-bordered table-striped" style='border-radius: 20px'>
        <thead>
          <tr>
            <th class="text-center" style="width: 45px;">#</th>
            <th>Nombre </th>
            <th>Usuario</th>
            <th class="text-center" style="width: 15%;">Rol de usuario</th>
            <th class="text-center" style="width: 10%;">Estado</th>
            <th style="width: 20%;">Último login</th>
            <th class="text-center" style="width: 20%;">Acciones</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach($all_users as $a_user): ?>
          <tr>
           <td class="text-center"><?php echo count_id();?></td>
           <td><?php echo remove_junk(ucwords($a_user['name']))?></td>
           <td><?php echo remove_junk(ucwords($a_user['username']))?></td>
           <td class="text-center"><?php echo remove_junk(ucwords($a_user['group_name']))?></td>
           <td class="text-center">
           <?php if($a_user['status'] === '1'): ?>
            <span  style='border-radius: 20px'class="label label-success"><?php echo "Activo"; ?></span>
          <?php else: ?>
            <span style='border-radius: 20px' class="label label-danger"><?php echo "Inactivo"; ?></span>
          <?php endif;?>
           </td>
           <td><?php echo read_date($a_user['last_login'])?></td>
           <td class="text-center">
             <div class="btn-group">
                <a href="editar_usuario.php?id=<?php echo (int)$a_user['id'];?>" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Editar" style='margin-right:10px; border-radius: 20px'>
                Editar
               </a>
                <a href="eliminar_usuario.php?id=<?php echo (int)$a_user['id'];?>" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Eliminar"style='border-radius: 20px'>
                Eliminar
                </a>
                </div>
           </td>
          </tr>
        <?php endforeach;?>
       </tbody>
     </table>
     </div>
    </div>
  </div>
</div>
  <?php include_once('layouts/footer.php'); ?>
