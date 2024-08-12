<?php
  $page_title = 'Agregar grupo';
  require_once('includes/load.php');
   page_require_level(1);
?>
<?php
  if(isset($_POST['add'])){

   $req_fields = array('group-name','group-level');
   validate_fields($req_fields);

   if(find_by_groupName($_POST['group-name']) === false ){
     $session->msg('d','<b>Error!</b> El nombre de grupo realmente existe en la base de datos');
     redirect('agregar_groupo.php', false);
   }elseif(find_by_groupLevel($_POST['group-level']) === false) {
     $session->msg('d','<b>Error!</b> El nombre de grupo realmente existe en la base de datos ');
     redirect('agregar_groupo.php', false);
   }
   if(empty($errors)){
           $name = remove_junk($db->escape($_POST['group-name']));
          $level = remove_junk($db->escape($_POST['group-level']));
         $status = remove_junk($db->escape($_POST['status']));

        $query  = "INSERT INTO user_groups (";
        $query .="group_name,group_level,group_status";
        $query .=") VALUES (";
        $query .=" '{$name}', '{$level}','{$status}'";
        $query .=")";
        if($db->query($query)){
          //sucess
          $session->msg('s',"Grupo ha sido creado! ");
          redirect('agregar_groupo.php', false);
        } else {
          //failed
          $session->msg('d','Lamentablemente no se pudo crear el grupo!');
          redirect('agregar_groupo.php', false);
        }
   } else {
     $session->msg("d", $errors);
      redirect('agregar_groupo.php',false);
   }
 }
?>
<?php include_once('layouts/header.php'); ?>




<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default" style='border-radius: 20px'>
    <div class="panel-heading clearfix" style='background-color: #7ACBEE; border-radius: 20px'>
    <div class="text-center">
       <h3>Agregar nuevo grupo de usurios</h3>
     </div>
    </div>
     <div class="panel-body">
     <div class="login-page">
     <?php echo display_msg($msg); ?>
      <form method="post" action="agregar_groupo.php" class="clearfix">
        <div class="form-group">
              <label for="name" class="control-label">Nombre del grupo</label>
              <input style='background-color:#f1ccbe; border-radius: 20px' type="name" class="form-control" name="group-name" required>
        </div>
        <div class="form-group">
              <label for="level" class="control-label">Nivel del grupo</label>
              <input style='background-color:#f1ccbe; border-radius: 20px' type="number" class="form-control" name="group-level">
        </div>
        <div class="form-group">
          <label for="status">Estado</label>
            <select class="form-control" name="status" style='background-color:#f1ccbe; border-radius: 20px'>
              <option value="1">Activo</option>
              <option value="0">Inactivo</option>
            </select>
        </div>
        <div class="form-group clearfix"  style='text-align: center'>
                <button type="submit" name="add" class="btn btn-info" style='width: 150px; border-radius: 20px'>Guardar</button>
        </div>
    </form>
</div>
     </div>
    </div>
  </div>
</div>
<?php include_once('layouts/footer.php'); ?>
