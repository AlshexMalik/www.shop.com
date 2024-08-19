<?php

    require_once('header.php');
unset($_SESSION['test']);
?>


<?php

if (isset($_GET['show_id'])) {
$id =  $_GET['show_id'];
$_SESSION['test'] = $id;
$items = findData("SELECT * FROM `product` WHERE `productid` = $id;");
$ppid =  $items['productid'];
$pimg = $items['productimg'];
$pname = $items['productname'];
$pqty = $items['productqty'];
$pdetail = $items['productdetail'];
$pprice = $items['productprice'];
$pupdate = $items['productupdate'];
}else{
  direct("allproduct");
}


?>

<div class="container shadow p-5 m-5">
    <div class="row m-5">
        <div class="col-md-4">
            <img src="../assets/img/<?=$pimg;?>"  class="imgshow" >
        </div>
        <div class="col-md-8">
            <h1 class="text-center mb-5"><?=$pname;?></h1>
            <p class="text-left"><span class="text-primary">ABOUT ITEM :</span> <?=$pdetail?></p>
            <p class="text-left"><span class="text-primary">LAST UPDATE :</span> <?=$pupdate?></p>
            <p class="text-left"><span class="text-primary">Quantity Period  :</span> <?=$pqty?></p>
         
            <center class=" test">
              
            <?php
            
           
if (isauth()) {

?>
<form action="error.php" method="GET">
  
<label for="">ID Product</label><input class=" form-control text-center w-50 m-2 "type="text"value="<?=$id;?>" name="id" readonly required>
<label for="">Price By $</label><input class=" form-control text-center w-50 m-2 "type="text"value="<?=$pprice;?>" name="price" readonly required>
<label for="" >Quantity Period  $</label><input class=" form-control text-center w-50 m-2 "type="text"value="<?=$pqty;?>" name="pqty" readonly required>
<label for="">Quantity</label>
<?php
$qury = "SELECT productqty FROM`product` WHERE `productqty` > 0 and productid =$ppid ;";
$chek = countdata($qury);

if($chek > 0){
  ?>
  <input class=" form-control text-center w-50 m-2 " onclick="myFunction()" id="myText"  type="number" min="1" name="qty" placeholder="QTY" required>
<?php
}else{

  ?>
<input class=" form-control text-center w-50 m-2 " onclick="myFunction()" id="myText"  type="number" min="1" name="qty" placeholder="QTY" disabled>
  <?php
}
?>



Total <label  id="demo"type="text" name="login">$0</label>


<?php
}
?>
     <br>   <input class=" btn btn-primary text-center mt-3" type="submit" name="Order" value="Order">
    </form>
            </center>        
</div>
    </div>
</div>


<style>

  .col-3{
    width :60% !important;
  }
  
</style>

 





<script>
function myFunction() {
 var x =  document.getElementById("myText").value ;
 document.getElementById("demo").innerHTML = "$" + <?=$pprice;?> * x;
}
</script>
<?php


?>
<div class="fixed-bottom mt-5">
  <?php require_once('footer.php');?>  
</div>