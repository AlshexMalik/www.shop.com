<?php require_once('header.php');
if(isset($_GET['Order'])){
    $id = $_GET['id'];
    $price = $_GET['price'];
    $qty = $_GET['qty'];
    $pqty = $_GET['pqty'];
      $datee = date("Y-m-d h:i:s");
      if ($pqty < $qty) {
        message("Cant added to order","danger");
      
        
      }else{
      $int_id = (int) $id;
      $int_pqty = (int) $pqty;
      $int_qty = (int) $qty;
      $newQTY = $pqty - $qty;
      
      excution("UPDATE `product` SET `productqty`='{$newQTY}' WHERE `productid`='{$int_id}'; ");
      $check = countdata("SELECT * FROM `order` WHERE `prid`= $int_id   AND `userid` = $authid");
      if($check  > 0){
        $find = findData("SELECT * FROM `order` WHERE `userid`=  $authid and  `prid`= $int_id ");
        $oldqty = $find['qty'];
        excution("UPDATE `order` SET `qty`={$oldqty} +$int_qty  where `prid`= $int_id   AND `userid` = $authid;");
        message("$oldqty  $int_qty Add to order 11","success");
        direct("allproduct");
      }else{
      excution("INSERT INTO `order`( `userid`, `datee`, `prid`, `oprice`, `qty`) VALUES ('{$authid}','{$datee}','{$id}','{$price}','{$qty}')");
      message("Add to order","success");
      direct("allproduct");
    }
      }
?>
     <div class="container shadow">
    <center>
        <div class="col m-5 p-5">
            <h1>Error Input</h1>
            <h3>Sorry Your Quantity begger Than Quantity Period</h3>
            <p>for try input click here</p>
            <a href="cart?show_id=<?=$_SESSION['test'];?>" class="btn btn-primary">TRY TO INPUT</a>
        </div>
    </center>
</div>


<?php
  }else{
?>

    <div class="container shadow">
    <center>
        <div class="col m-5 p-5">
            <h1>Error 404</h1>
            <h3>Sorry What do you want?</h3>
            </div>
    </center>
</div>
<?php


  }

?>

<div class="fixed-bottom mt-5">
  <?php require_once('footer.php');?>  
</div>