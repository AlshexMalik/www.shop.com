<?php require_once('header.php');?>

<?php 

 if(isauth()){
   if(isset($_GET['p_qty'])){
    $_SESSION['p_qty'] = $_GET['p_qty'];
    
   }
   if (isset($_GET['update_id'])) {
      $id = $_GET['update_id'];
      $data = findData("SELECT * FROM `orders` WHERE `productid` = $id and user_id = $authid");
    

      ?>
             
      <div class="col-6 mx-auto my-5">
      <form class="" action="order" method="POST">
      <div class="form-group">
              <label>product ID</label>
              <input type="text" placeholder="product ID" name="id" value="<?=$data['productid'];?>" class="form-control disabled my-2 text-center rounded " readonly>
          </div>
          <div class="form-group">
              <label>product Name</label>
              <input type="text" readonly placeholder="product name" name="name" value="<?=$data['productname'];?>" class="form-control my-2 text-center rounded ">
          </div>
          <div class="form-group">
              <label>product Deatail</label>
              <input type="text" readonly placeholder="Detail" name="det" value="<?=$data['productdetail'];?>" class="form-control my-2 text-center rounded ">
          </div>
          <div class="form-group">
              <label>product price</label>
              <input type="number" min="0" readonly  placeholder="product price" name="price" value="<?=$data['productprice'];?>" class="form-control my-2  text-center rounded ">
          </div>
          <div class="form-group">
              <label>product QYT</label>
              <input type="number" required placeholder="product QTY" name="qty" min="1"  class="form-control my-2  text-center rounded ">
          </div>
          <div class="form-group mx-auto col-sm-8">
              <input type="submit" name="update_t" class="form-control btn btn-warning" value="Update">
          </div>
          
      </form>
  </div>
  
  <?php
  }
    $qury = "SELECT `name`,`datee`,`email`,`phone`,`productimg`,`productname`,`productdetail`, productid ,productprice, SUM(qty) as qty,productprice*qty as total from( select * from `orders` WHERE user_id = $authid )as x  GROUP by productid;";
    $cloud = allData("$qury");
    $counter = findData("SELECT sum(`qty`) AS aa FROM `orders` WHERE user_id = $authid ;  ");
    $datta = $counter['aa'];
    $count = 0;

?>
<center>
<div class="container p-5 my-5  shadow order">
<div class="table-responsive">
<h6>ALL ITEM :: <b><?=$datta?></b></h6>
<table class="table table-hover text-center">
 <tr>
        <th scope="col">#</th>
        <th scope="col">Product_ID</th>
        <th scope="col">IMG</th>
        <th scope="col">Name</th>
        <th scope="col">Content</th>
        <th scope="col">QTY</th>
        <th scope="col">Price $</th>
        <th scope="col">Total_Price $</th>
        <th scope="col">DATE</th>
        <th scope="col" >action</th>
    </tr>
        
        <?php
        foreach($cloud as $key){
            $count++; 
            ?>
            <tr scope="row">
    
<td><b><?=$count;?></b></td>
<td><?=$key['productid'];?></td>
<td><img style="max-width:50px;" src="../assets/img/<?=$key['productimg'];?>" alt=""></td>
<td><?=$key['productname'];?></td>
<td><?=$key['productdetail'];?></td>
<td><?=$key['qty'];?></td>
<td><?=$key['productprice'];?></td>
<td><?=$key['total'];?></td>
<td><?=time_ago($key['datee']);?></td>
<td>
    <a href="order?update_id=<?=$key['productid'];?>&p_qty=<?=$key['qty'];?>" class="m-1 btn btn-sm btn-warning">UPDATE</a>
    <a href="order?delet_id=<?=$key['productid'];?>&qty=<?=$key['qty'];?>" class="m-1 btn btn-sm btn-danger">DELETE</a>
</td>
 <?php  
}
?>
    </tr>

<?php
         
     if (isset($_GET['delet_id'])) {
        $id = protect($_GET['delet_id']);
        $qty = protect($_GET['qty']);
       
        $check = countdata("SELECT * FROM `order` WHERE `prid`=$id");
        if($check > 0) {

        excution("DELETE  FROM `order` WHERE `prid`=$id and userid = $authid");
        excution("UPDATE `product` SET `productqty`= `productqty`+ $qty  WHERE`productid`= $id ");
        message("var_dump($qty) succes delete","danger");
        direct("order");
        }else {
            message("PLEASE SHARK","warning");
            direct("order");
            
        } 
    }
    if(isset($_POST['update_t'])){  
      $id = protect($_POST['id']);
      $data = findData("SELECT * FROM `product` WHERE `product`.`productid` = $id; ");
      $qty  =$data['productqty'];
      $old_qty =  $_SESSION['p_qty'];
      $new_qty =  ($_POST['qty']);
      if($old_qty >= $new_qty){
         $new = $old_qty - $new_qty;         
         excution("UPDATE `order` SET `qty`='{$new_qty}' WHERE `prid` = $id and userid=$authid");
         excution("UPDATE `product` SET `productqty`= `productqty`+ $new  WHERE`productid`= $id ");
         message(" succes update","success");
         direct("order");
      }else{
         $new = $new_qty - $old_qty;
         if($new <= $qty){
            $qty =  $qty - $new;
            excution("UPDATE `order` SET `qty`='{$new_qty}' WHERE `prid` = $id and userid=$authid");
            excution("UPDATE `product` SET `productqty`= $qty  WHERE`productid`= $id ");
            message(" succes update","success");
            direct("order");
    
         }
         message("do not succes Update","danger");
         direct("order");
      }
        
     
   
  } 
    $_SESSION['productcount'] = $count;
    ?>
    </table>
    <button class="btn btn-primary px-3 py-1 mb-5" onClick="window.print()">Print this page</button>
    <?php

    ?>

    
    </div>    
</div>
</center>


<?php

   }else{
    direct("allproduct");
 }

?>

<div class="fixed-bottom">
  <?php require_once('footer.php');?>  
</div>



<style>
  .order{
    margin-bottom:150px !important;
 }
</style>