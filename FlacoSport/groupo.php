<?php
  $page_title = 'Lista de grupos';
  require_once('includes/load.php');
   page_require_level(1);
  $all_groups = find_all('user_groups');
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
    <div class="panel-heading clearfix" style='background-color: #7ACBEE; border-radius: 20px'>
      <strong>
        <span>Grupos</span>
     </strong>
       <a href="agregar_groupo.php" class="btn btn-info pull-right btn-sm" style='background-color: #7351ed; border-radius: 20px'> Agregar grupo</a>
    </div>
     <div class="panel-body">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th class="text-center" style="width: 50px;">#</th>
            <th>Nombre del grupo</th>
            <th class="text-center" style="width: 20%;">Nivel del grupo</th>
            <th class="text-center" style="width: 15%;">Estado</th>
            <th class="text-center" style="width: 25%;">Acciones</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach($all_groups as $a_group): ?>
          <tr>
           <td class="text-center"><?php echo count_id();?></td>
           <td><?php echo remove_junk(ucwords($a_group['group_name']))?></td>
           <td class="text-center">
             <?php echo remove_junk(ucwords($a_group['group_level']))?>
           </td>
           <td class="text-center">
           <?php if($a_group['group_status'] === '1'): ?>
            <span style='border-radius: 20px' class="label label-success"><?php echo "Activo"; ?></span>
          <?php else: ?>
            <span style='border-radius: 20px' class="label label-danger"><?php echo "Inactivo"; ?></span>
          <?php endif;?>
           </td>
           <td class="text-center">
             <div class="btn-group">
                <a href="editar_grupo.php?id=<?php echo (int)$a_group['id'];?>" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Editar" style='margin-right:10px; border-radius: 20px'>
                  Editar
               </a>
                <a href="eliminar_grupo.php?id=<?php echo (int)$a_group['id'];?>" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Eliminar"style=' border-radius: 20px'>
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
