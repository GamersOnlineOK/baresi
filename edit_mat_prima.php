<?php
  $page_title = 'Editar Materia Prima';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
  //Display all catgories.
 
  $categorie = find_by_id('materias_primas',(int)$_GET['id']);
  if(!$categorie){
    $session->msg("d","Missing categories id.");
    redirect('materia_prima.php');
  }
  
 
?>

<?php
if(isset($_POST['edit_cat'])){
  $req_field = array('name','partNo','quantity','buy_price','sale_price','categorie_id','location','media_id','id_proveedores','unidad_medida');
  validate_fields($req_field);
  $categorieid=$categorie['id'];
  $name = remove_junk($db->escape($_POST['name']));
  $partNo = remove_junk($db->escape($_POST['partNo']));
  $quantity = remove_junk($db->escape($_POST['quantity']));
  $buyprice = remove_junk($db->escape($_POST['buy_price']));
  $saleprice = remove_junk($db->escape($_POST['sale_price']));
  $categorie_id= remove_junk($db->escape($_POST['categorie_id']));
  $location = remove_junk($db->escape($_POST['location']));
  $media_id = remove_junk($db->escape($_POST['media_id']));
  $idproveedores = remove_junk($db->escape($_POST['id_proveedores']));
  $unidad_medida = remove_junk($db->escape($_POST['unidad_medida']));
  if(empty($errors)){
        $sql = "UPDATE materias_primas SET name='{$name}',partNo='{$partNo}',"
        . "quantity='{$quantity}',buy_price='{$buyprice}',sale_price='{$saleprice}',"
        . "categorie_id='{$categorie_id}',location='{$location}',media_id='{$media_id}',id_proveedores='{$id_proveedores}',unidad_medida='{$unidad_medida}'";
       $sql .= " WHERE id=$categorieid";
     $result = $db->query($sql);
     if($result && $db->affected_rows() === 1) {
       $session->msg("s", "Materia Prima actualizada con éxito.");
       redirect('categorie.php',false);
     } else {
       $session->msg("d", "Lo siento, actualización falló.");
       redirect('edit_sale.php',false);
     }
  } else {
    $session->msg("d", $errors);
    redirect('edit_sale.php',false);
  }
}
?>
<?php include_once('layouts/header.php'); ?>

<div class="row">
   <div class="col-md-12">
     <?php echo display_msg($msg); ?>
   </div>
   <div class="col-md-12">
     <div class="panel panel-default">
       <div class="panel-heading">
         <strong>
           <span class="glyphicon glyphicon-th"></span>
           <span>Editando <?php echo remove_junk(ucfirst($categorie['name']));?></span>
        </strong>
       </div>
       <div class="panel-body">
           
           <form method="post" action="edit_categorie.php?id=<?php echo (int)$categorie['id'];?>">
                <div class="form-group">
                <div class="row">
                                <div class="col-md-2">
                                  <div class="input-group">
                                    <span class="input-group-addon">
                                    <strong>
                                        <span>Producto</span>
                                    </strong>
                                        </span>
                                    <input type="text" class="form-control" name="name" value="<?php echo remove_junk(ucfirst($categorie['name']));?>">
                                  </div>
                                </div>
                                <div class="col-md-2">
                                  <div class="input-group">
                                    <span class="input-group-addon">
                                      <strong>
                                        <span>Codigo</span>
                                    </strong>
                                    </span>
                                    <input type="text" class="form-control" name="partNo" value="<?php echo remove_junk(ucfirst($categorie['partNo']));?>">
                                  </div>
                                </div>
                                <div class="col-md-2">
                                  <div class="input-group">
                                      <span class="input-group-addon">
                                          <strong>
                                        <span>Cantidad</span>
                                    </strong>
                                      </span>
                                    <input type="text" class="form-control" name="quantity" value="<?php echo remove_junk(ucfirst($categorie['quantity']));?>">
                                    <!--<span class="input-group-addon"></span>-->
                                  </div>
                                </div>
                                 <div class="col-md-2">
                                  <div class="input-group">
                                      <span class="input-group-addon">
                                          <strong>
                                        <span>$ Elaboración</span>
                                    </strong>
                                      </span>
                                    <input type="text" class="form-control" name="buy_price" value="<?php echo remove_junk(ucfirst($categorie['buy_price']));?>">
                                    <!--<span class="input-group-addon"></span>-->
                                  </div>
                                 </div>
                </div>
                </div>
                                    <!--separador de comulnas-->
                <div class="form-group">
                <div class="row">
                                <div class="col-md-2">
                                  <div class="input-group">
                                    <span class="input-group-addon">
                                        <strong>
                                        <span>$ Venta</span>
                                    </strong>
                                    </span>
                                    <input type="text" class="form-control" name="sale_price" value="<?php echo remove_junk(ucfirst($categorie['sale_price']));?>">
                                  </div>
                                </div>
                                <div class="col-md-2">
                                  <div class="input-group">
                                    <span class="input-group-addon">
                                      <strong>
                                        <span>$ Venta</span>
                                    </strong>
                                    </span>
                                    <input type="text" class="form-control" name="categorie_id" value="<?php echo remove_junk(ucfirst($categorie['categorie_id']));?>">
                                  </div>
                                </div>
                                <div class="col-md-2">
                                  <div class="input-group">
                                      <span class="input-group-addon">
                                          <i class="glyphicon glyphicon-th-large"></i>
                                      </span>
                                    <input type="text" class="form-control" name="location" value="<?php echo remove_junk(ucfirst($categorie['location']));?>">
                                    <!--<span class="input-group-addon"></span>-->
                                  </div>
                                </div>
                                 <div class="col-md-2">
                                  <div class="input-group">
                                      <span class="input-group-addon">
                                          <i class="glyphicon glyphicon-th-large"></i>
                                      </span>
                                    <input type="text" class="form-control" name="media_id" value="<?php echo remove_junk(ucfirst($categorie['media_id']));?>">
                                    <!--<span class="input-group-addon"></span>-->
                                  </div>
                                 </div>
                </div>
                </div>
                                    <!--separador de comulnas-->
                                    
                <div class="form-group">
                <div class="row">
                                
                                <div class="col-md-2">
                                  <div class="input-group">
                                    <span class="input-group-addon">
                                      <i class="glyphicon glyphicon-th-large"></i>
                                    </span>
                                    <input type="text" class="form-control" name="id_proveedores" value="<?php echo remove_junk(ucfirst($categorie['id_proveedores']));?>">
                                  </div>
                                </div>
                                <div class="col-md-2">
                                  <div class="input-group">
                                    <span class="input-group-addon">
                                      <i class="glyphicon glyphicon-th-large"></i>
                                    </span>
                                    <input type="text" class="form-control" name="unidad_medida" value="<?php echo remove_junk(ucfirst($categorie['unidad_medida']));?>">
                                  </div>
                                </div>
                                <div class="col-md-2 ">
                                    <button type="submit" name="edit_cat" class="btn btn-primary">Actualizar Materia Prima</button>
                                </div>
                                
                </div>
                </div>
           </form>
       </div>
     </div>
   </div>
</div>



<?php include_once('layouts/footer.php'); ?>
