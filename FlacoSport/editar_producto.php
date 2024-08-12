<?php
  $page_title = 'Editar producto';
  require_once('includes/load.php');
   page_require_level(2);
?>
<?php
$product = find_by_id('products',(int)$_GET['id']);
$all_categories = find_all('categories');
$all_photo = find_all('media');
if(!$product){
  $session->msg("d","Missing product id.");
  redirect('product.php');
}
?>
<?php
 if(isset($_POST['product'])){
    $req_fields = array('product-title','product-categorie','product-quantity','product-talla','product-tiendas','buying-price', 'saleing-price' );
    validate_fields($req_fields);

   if(empty($errors)){
       $p_name  = remove_junk($db->escape($_POST['product-title']));
       $p_cat   = (int)$_POST['product-categorie'];
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
       $query   = "UPDATE products SET";
       $query  .=" name ='{$p_name}', quantity ='{$p_qty}',talla ='{$p_tll}',tiendas ='{$p_tin}',";
       $query  .=" buy_price ='{$p_buy}', sale_price ='{$p_sale}', categorie_id ='{$p_cat}',media_id='{$media_id}'";
       $query  .=" WHERE id ='{$product['id']}'";
       $result = $db->query($query);
               if($result && $db->affected_rows() === 1){
                 $session->msg('s',"Producto ha sido actualizado. ");
                 redirect('product.php', false);
               } else {
                 $session->msg('d',' Lo siento, actualización falló.');
                 redirect('editar_producto.php?id='.$product['id'], false);
               }

   } else{
       $session->msg("d", $errors);
       redirect('editar_producto.php?id='.$product['id'], false);
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
      <div class="panel panel-default"style='border-radius: 20px'>
        <div class="panel-heading" style='background-color: #7ACBEE; border-radius: 20px'>
          <strong>
            <span>Editar producto</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-7">
           <form method="post" action="editar_producto.php?id=<?php echo (int)$product['id'] ?>">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"style='background-color:#f1ccbe; border-radius: 20px 0px 0px 20px'>
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input style='background-color:#f1ccbe; border-radius: 0px 20px 20px 0px'type="text" class="form-control" name="product-title" value="<?php echo remove_junk($product['name']);?>">
               </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <select style='background-color:#f1ccbe; border-radius: 20px' class="form-control" name="product-categorie">
                    <option value="">Selecciona una categoría</option>
                   <?php  foreach ($all_categories as $cat): ?>
                     <option value="<?php echo (int)$cat['id']; ?>" <?php if($product['categorie_id'] === $cat['id']): echo "selected"; endif; ?> >
                       <?php echo remove_junk($cat['name']); ?></option>
                   <?php endforeach; ?>
                 </select>
                  </div>
                  <div class="col-md-6">
                    <select style='background-color:#f1ccbe; border-radius: 20px' class="form-control" name="product-photo">
                      <option value=""> Sin imagen</option>
                      <?php  foreach ($all_photo as $photo): ?>
                        <option value="<?php echo (int)$photo['id'];?>" <?php if($product['media_id'] === $photo['id']): echo "selected"; endif; ?> >
                          <?php echo $photo['file_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                    <label for="qty">Talla</label>
                      <div class="input-group">
                        <input style='background-color:#f1ccbe; border-radius: 20px' type="text" class="form-control" name="product-talla" value="<?php echo remove_junk($product['talla']); ?>">
                      </div>
                    </div>
                 </div>
                 <div class="col-md-4">
                    <div class="form-group">
                    <label for="qty">tienda</label>
                      <div class="input-group">
                        <input style='background-color:#f1ccbe; border-radius: 20px' type="text" class="form-control" name="product-tiendas" value="<?php echo remove_junk($product['tiendas']); ?>">
                      </div>
                    </div>
                 </div>
                </div>
              </div>
              <div class="form-group">
               <div class="row">
                 <div class="col-md-4">
                  <div class="form-group">
                    <label for="qty">Cantidad</label>
                    <div class="input-group">
                      <span class="input-group-addon" style='background-color:#f1ccbe; border-radius: 20px 0px 0px 20px'>
                       <i class="glyphicon glyphicon-shopping-cart" ></i>
                      </span>
                      <input style='background-color:#f1ccbe; border-radius: 0px 20px 20px 0px' type="number" class="form-control" name="product-quantity" value="<?php echo remove_junk($product['quantity']); ?>">
                   </div>
                  </div>
                 </div>
                 <div class="col-md-4">
                  <div class="form-group">
                    <label for="qty">Precio de compra</label>
                    <div class="input-group">
                      <span class="input-group-addon" style='background-color:#f1ccbe; border-radius: 20px 0px 0px 20px'>
                        <i class="glyphicon glyphicon-usd"></i>
                      </span>
                      <input style='background-color:#f1ccbe' type="number" class="form-control" name="buying-price" value="<?php echo remove_junk($product['buy_price']);?>">
                      <span class="input-group-addon" style='background-color:#f1ccbe; border-radius: 0px 20px 20px 0px'>.00</span>
                   </div>
                  </div>
                 </div>
                  <div class="col-md-4">
                   <div class="form-group">
                     <label for="qty">Precio de venta</label>
                     <div class="input-group">
                       <span class="input-group-addon" style='background-color:#f1ccbe; border-radius: 20px 0px 0px 20px'>
                         <i class="glyphicon glyphicon-usd"></i>
                       </span>
                       <input style='background-color:#f1ccbe'type="number" class="form-control" name="saleing-price" value="<?php echo remove_junk($product['sale_price']);?>">
                       <span class="input-group-addon" style='background-color:#f1ccbe; border-radius: 0px 20px 20px 0px'>.00</span>
                    </div>
                   </div>
                  </div>
               </div>
              </div>
              <button style='width: 150px; border-radius: 20px' type="submit" name="product" class="btn btn-danger">Actualizar</button>
          </form>
         </div>
        </div>
      </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
