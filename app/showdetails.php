<?php

    require_once('header.php');

?>


<?php
if (isset($_GET['show_id'])) {

$_SESSION['show_id']  = $_GET['show_id'];
$id = $_SESSION['show_id'];

$items = findData("SELECT * FROM `product` WHERE `productid` = $id;");

$pimg = $items['productimg'];
$pname = $items['productname'];
$pdetail = $items['productdetail'];
$pprice = $items['productprice'];
$pupdate = $items['productupdate'];}
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
            <h3 class="text-center mt-5"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-currency-dollar " viewBox="0 0 16 16">
  <path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z"/>
</svg><?=$pprice  ;?></h3>
            <center class="mt-5 test">
            <?php
            if (isauth()) {
              
            if (checkalreadyexist($id)) {
                   ?>
                   <a href="allproduct?removefave=<?=$_SESSION['show_id'];?>" class="btn " type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="white"  class="bi bi-heart-fill" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
            </svg></a>
          <?php  
          }else   {?>     <a href="allproduct?addfave=<?=$_SESSION['show_id'];?>" class="btn " type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="white"  class="bi bi-heart" viewBox="0 0 16 16">
            <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
            </svg></a>
            <?php
            }
            
          
            ?>

            <a href="cart?show_id=<?=$id;?>" class="btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="white"  class="bi bi-cart" viewBox="0 0 16 16">
  <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
</svg>
         </a>
         <?php
}
         ?>
            </center>        
</div>
    </div>
</div>

<div class="fixed-bottom mt-5">
  <?php require_once('footer.php');?>  
</div>
<style>
      .test{
    background-color:#135893;
    
  }
</style>

<?php
$PO =  $_SESSION['show_id'];
if(isset($_GET['addfave'])){
  $pid = $_GET['addfave'];
  $check = countdata("SELECT * FROM `product` where productid  = $pid;");
  if($check > 0){
    if( checkalreadyexist($pid) >  0){
       message("ALREADY ADDED" ,"warning");
    }else {
      excution("INSERT INTO `fav`( `userid`, `productid`) VALUES ('{$authid}','{$pid}')");
      message("added to favorit","success");
    }

  }else {message("wrong ID" , "warning");}
  direct("showdetails?show_id=<?=$PO;?>");


}

if(isset($_GET['removefave'])){
  $pid = $_GET['removefave'];
  $check = countdata("SELECT * FROM `product` where productid  = $pid;");
  if($check > 0){  
    if( checkalreadyexist($pid) >  0){
      excution("DELETE FROM `fav` WHERE productid =$pid and userid = $authid");
      message("DELETED IN FAVORITE" ,"warning");
    }else {
      
      message("IT IS NOT YOUR FAVORITE","warning");
    }

  }else {message("wrong ID" , "warning");}
  direct("showdetails?show_id=<?=$PO;?>");


}

?>