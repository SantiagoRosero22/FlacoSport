<?php
  $page_title = 'Agregar venta';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);

   //condicion para validar la existencia de una variable
  $nombreProducto = "";
  if(isset($_POST['buscar']))
  {
    //recibir la variable con lo que viene del formulario
    $nombreProducto = $_POST['nombreProducto'];
  }
?>
<?php

  if(isset($_POST['add_sale'])){
    $req_fields = array('s_id','quantity','price','total', 'date', 'talla'  );
    validate_fields($req_fields);
        if(empty($errors)){
          $p_id      = $db->escape((int)$_POST['s_id']);
          $s_qty     = $db->escape((int)$_POST['quantity']);
          $s_total   = $db->escape($_POST['total']);
          $date      = $db->escape($_POST['date']);
          $talla      = $db->escape($_POST['talla']);
          $s_date    = make_date();

          $sql  = "INSERT INTO sales (";
          $sql .= " product_id,qty,price,date,talla";
          $sql .= ") VALUES (";
          $sql .= "'{$p_id}','{$s_qty}','{$s_total}','{$s_date}','{$talla}'";
          $sql .= ")";

                if($db->query($sql)){
                  update_product_qty($s_qty,$p_id);
                  $session->msg('s',"Venta agregada ");
                  redirect('agregar_venta.php', false);
                } else {
                  $session->msg('d','Lo siento, registro falló.');
                  redirect('agregar_venta.php', false);
                }
        } else {
           $session->msg("d", $errors);
           redirect('agregar_venta.php',false);
        }
  }

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
    <form method="post" action="ajax.php" autocomplete="off" id="sug-form">
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-btn">
              <button type="submit" class="btn btn-primary" style='border-radius: 20px 0px 0px 20px'>Búsqueda</button>
            </span>
            <input type="text" id="sug_input" class="form-control" name="title"  placeholder="Buscar por el nombre del producto"style='background-color:#f1ccbe;border-radius: 0px 20px 20px 0px'>
         </div>
         <div id="result" class="list-group"></div>
        </div>
    </form>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default"style='border-radius: 20px'>
      <div class="panel-heading clearfix" style='background-color: #7ACBEE; border-radius: 20px'>
        <strong>
          <span>Agregar venta</span>
       </strong>
      </div>
      <div class="panel-body">
        <form method="post" action="agregar_venta.php">
         <table class="table table-bordered">
           <thead>
            <th> Producto </th>
            <th> Talla </th>
            <th> Precio </th>
            <th> Cantidad </th>
            <th> Total </th>
            <th> Agregado</th>
            <th> Acciones</th>
           </thead>
             <tbody  id="product_info"> </tbody>
         </table>
       </form>
      </div>
    </div>
  </div>

</div>

<?php include_once('layouts/footer.php'); ?>
