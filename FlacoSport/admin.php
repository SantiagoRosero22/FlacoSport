<?php
  $page_title = 'Admin página de inicio';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
?>
<?php
 $c_categorie     = count_by_id('categories');
 $c_product       = count_by_id('products');
 $c_sale          = count_by_id('sales');
 $c_user          = count_by_id('users');
 $products_sold   = find_higest_saleing_product('10');
 $recent_products = find_recent_product_added('5');
 $recent_sales    = find_recent_sale_added('5')
?>
<?php include_once('layouts/header.php'); ?>

<div class="row">
   <div class="col-md-6">
     <?php echo display_msg($msg); ?>
   </div>
</div>
  <div class="row">
    <div class="col-md-3">
       <div class="panel panel-box clearfix"style='background-color:#f1ccbe; border-radius: 20px'>
         <div class="panel-icon pull-left bg-blue" style='border-radius: 20px'>
          <img src="uploads/2u.png" width="45" height="60">
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $c_user['total']; ?> </h2>
          <p class="text-muted">Usuarios</p>
        </div>
       </div>
    </div>
    <div class="col-md-3">
       <div class="panel panel-box clearfix"style='background-color:#f1ccbe; border-radius: 20px'>
         <div class="panel-icon pull-left bg-blue" style='border-radius: 20px'>
          <img src="uploads/2m.png" width="45" height="60">
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $c_categorie['total']; ?> </h2>
          <p class="text-muted">Marcas</p>
        </div>
       </div>
    </div>
    <div class="col-md-3">
       <div class="panel panel-box clearfix" style='background-color:#f1ccbe; border-radius: 20px'>
         <div class="panel-icon pull-left bg-blue" style='border-radius: 20px'>
          <img src="uploads/2p.png" width="45" height="60">
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $c_product['total']; ?> </h2>
          <p class="text-muted">Zapatos</p>
        </div>
       </div>
    </div>
    <div class="col-md-3">
       <div class="panel panel-box clearfix" style='background-color:#f1ccbe; border-radius: 20px'>
         <div class="panel-icon pull-left bg-blue" style='border-radius: 20px'>
          <img src="uploads/1.png" width="45" height="60">
        </div>
        <div class="panel-value pull-right" >
          <h2 class="margin-top"> <?php  echo $c_sale['total']; ?></h2>
          <p class="text-muted ">Ventas</p>
        </div>
       </div>
    </div>
</div>

<div class="row">
  <div class="col-md-4">
    <div class="panel panel-default" style='width: 155%; border-radius: 20px'>
      <div class="panel-heading" style='text-align: center; background-color: #7ACBEE; border-radius: 20px'>
         <strong>
           <span>Zapatos más vendidos</span>
         </strong>
       </div>
       <div class="panel-body">
         <table class="table table-striped table-bordered table-condensed">
          <thead>
           <tr>
             <th class="text-center">Nombre</th>
             <th class="text-center">Total vendido</th>
             <th class="text-center">Cantidad total</th>
           <tr>
          </thead>
          <tbody style='text-align: center'>
            <?php foreach ($products_sold as  $product_sold): ?>
              <tr>
                <td><?php echo remove_junk(first_character($product_sold['name'])); ?></td>
                <td><?php echo (int)$product_sold['totalSold']; ?></td>
                <td><?php echo (int)$product_sold['totalQty']; ?></td>
              </tr>
            <?php endforeach; ?>
          <tbody>
         </table>
       </div>
     </div>
   </div>
   
   <div class="col-md-4">
      <div class="panel panel-default" style='margin-left:55%;width: 155%;border-radius: 20px'>
        <div class="panel-heading" style='text-align: center; background-color: #7ACBEE; border-radius: 20px'>
          <strong>
            <span>ÚLTIMAS VENTAS</span>
          </strong>
        </div>
        <div class="panel-body">
          <table class="table table-striped table-bordered table-condensed">
       <thead>
         <tr>
           <th class="text-center" style="width: 50px; ">#</th>
           <th class="text-center">Producto</th>
           <th class="text-center">Fecha</th>
           <th class="text-center">Venta total</th>
         </tr>
       </thead>
       <tbody style='text-align: center'>
         <?php foreach ($recent_sales as  $recent_sale): ?>
         <tr>
           <td class="text-center"><?php echo count_id();?></td>
           <td>
            <a href="editar_venta.php?id=<?php echo (int)$recent_sale['id']; ?>">
             <?php echo remove_junk(first_character($recent_sale['name'])); ?>
           </a>
           </td>
           <td><?php echo remove_junk(ucfirst($recent_sale['date'])); ?></td>
           <td>$<?php echo remove_junk(first_character($recent_sale['price'])); ?></td>
        </tr>

       <?php endforeach; ?>
       </tbody>
     </table>
    </div>
   </div>
  </div>



<?php include_once('layouts/footer.php'); ?>
