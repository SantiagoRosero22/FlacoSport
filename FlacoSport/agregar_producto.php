<?php
  namespace App;
  $page_title = 'Agregar producto';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  //page_require_level(2);
  $all_categories = find_all('categories');
  $all_photo = find_all('media');
?>
<?php
 if(isset($_POST['add_product'])){
   $req_fields = array('product-title','product-categorie','product-quantity','product-talla','product-tiendas','buying-price', 'saleing-price' );
   validate_fields($req_fields);
   if(empty($errors)){
     $p_name  = remove_junk($db->escape($_POST['product-title']));
     $p_cat   = remove_junk($db->escape($_POST['product-categorie']));
     $p_qty   = remove_junk($db->escape($_POST['product-quantity']));
     $p_tll   = remove_junk($db->escape($_POST['product-talla']));
     $p_tin   = remove_junk($db->escape($_POST['product-tiendas']));
     $p_buy   = remove_junk($db->escape($_POST['buying-price']));
     $p_sale  = remove_junk($db->escape($_POST['saleing-price']));
     if (is_null($_POST['product-photo']) || $_POST['product-photo'] === "") {
       $media_id = '0';
     } else {
       $media_id = remove_junk($db->escape($_POST['product-photo']));
     }
     $date    = make_date();
     $query  = "INSERT INTO products (";
     $query .=" name,quantity,talla,tiendas,buy_price,sale_price,categorie_id,media_id,date";
     $query .=") VALUES (";
     $query .=" '{$p_name}', '{$p_qty}','{$p_tll}', '{$p_tin}', '{$p_buy}', '{$p_sale}', '{$p_cat}', '{$media_id}', '{$date}'";
     $query .=")";
     $query .=" ON DUPLICATE KEY UPDATE name='{$p_name}'";
     if($db->query($query)){
       $session->msg('s',"Producto agregado exitosamente. ");
       redirect('agregar_producto.php', false);
     } else {
       $session->msg('d',' Lo siento, registro falló.');
       redirect('product.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('agregar_producto.php',false);
   }

 }

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>
  <div class="row">
  <div class="col-md-9">
      <div class="panel panel-default" style='border-radius: 20px'>
        <div class="panel-heading" style='background-color: #7ACBEE; border-radius: 20px'>
          <strong>
            <span>Agregar producto</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="agregar_producto.php" class="clearfix">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon" style='background-color:#f1ccbe; border-radius: 20px 0px 0px 20px'>
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="product-title" placeholder="Descripción" style='background-color:#f1ccbe; border-radius: 0px 20px 20px 0px'>
               </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <select class="form-control" name="product-categorie" style='background-color:#f1ccbe; border-radius: 20px'>
                      <option value="">Selecciona una categoría</option>
                    <?php  foreach ($all_categories as $cat): ?>
                      <option value="<?php echo (int)$cat['id'] ?>">
                        <?php echo $cat['name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <select class="form-control" name="product-photo" style='background-color:#f1ccbe; border-radius: 20px'>
                      <option value="">Selecciona una imagen</option>
                    <?php  foreach ($all_photo as $photo): ?>
                      <option value="<?php echo (int)$photo['id'] ?>">
                        <?php echo $photo['file_name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <dic class="row">
                <div class="col-md-4">
                   <div class="input-group">
                     <input type="text" class="form-control" name="product-talla" placeholder="Talla"style='background-color:#f1ccbe; border-radius: 20px'>
                  </div>
                 </div>
                 <div class="col-md-4">
                   <div class="input-group">
                     <input type="text" class="form-control" name="product-tiendas" placeholder="Tiendas"style='background-color:#f1ccbe; border-radius: 20px'>
                  </div>
                 </div>
                </dic>
              </div>
              <div class="form-group">
               <div class="row">
                 <div class="col-md-4">
                   <div class="input-group">
                     <span class="input-group-addon"style='background-color:#f1ccbe; border-radius: 20px 0px 0px 20px'>
                      <i class="glyphicon glyphicon-shopping-cart"></i>
                     </span>
                     <input type="number" class="form-control" name="product-quantity" placeholder="Cantidad"style='background-color:#f1ccbe; border-radius: 0px 20px 20px 0px'>
                  </div>
                 </div>
                 <div class="col-md-4">
                   <div class="input-group">
                     <span class="input-group-addon"style='background-color:#f1ccbe; border-radius: 20px 0px 0px 20px'>
                       <i class="glyphicon glyphicon-usd"></i>
                     </span>
                     <input type="number" class="form-control" name="buying-price" placeholder="Precio de compra"style='background-color:#f1ccbe'>
                     <span class="input-group-addon" style='background-color:#f1ccbe; border-radius: 0px 20px 20px 0px'>.00</span>
                  </div>
                 </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      <span class="input-group-addon"style='background-color:#f1ccbe; border-radius: 20px 0px 0px 20px'>
                        <i class="glyphicon glyphicon-usd"></i>
                      </span>
                      <input type="number" class="form-control" name="saleing-price" placeholder="Precio de venta"style='background-color:#f1ccbe'>
                      <span class="input-group-addon" style='background-color:#f1ccbe; border-radius: 0px 20px 20px 0px'>.00</span>
                   </div>
                  </div>
               </div>
              </div>
              <button type="submit" name="add_product" class="btn btn-danger" style='width: 150px; border-radius: 20px'>Agregar producto</button>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
