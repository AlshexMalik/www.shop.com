
<?php require_once('header.php');?>
    
<center>
<div class="row container p-3 mt-5  shadow">    
    <?php
        $items = allData("SELECT * FROM `product`   ORDER BY `productupdate` DESC;");
        $count = 0;
        $counter = findData("SELECT count(`productid`) AS aa FROM `product`;  ");
       
        $datta = $counter['aa'];
        ?>
        <h6>ALL PRODUCT :: <b><?=$datta;?></b></h6>
        <?php
        foreach($items as $key){
            $count++; 
            $k = $key['productid'];

            ?>

<div class="col-lg-3 col-md-4 col-sm-6 my-2">
        <div class="card py-1">
          <div class="containerr">
            <img src="../assets/img/<?=$key['productimg'];?>"  class="imgshow" >         
          </div>
          <div class="card-body">
            <h5 class="card-title "><?=$key['productname'];?></h5>
            <p class="card-text card-show"><?=$key['productdetail'];?></p>
            <div ><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-currency-dollar" viewBox="0 0 16 16">
  <path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z"/>
</svg><?=$key['productprice'];?></div> 
          </div>
            <div class="mb-3 test">
            <?php
            if (isauth()) {?>
                           <a href="cart?show_id=<?=$key['productid'];?>" class="btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white"  class="bi bi-cart" viewBox="0 0 16 16">
  <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
</svg>
           </a><?php
            if (checkalreadyexist($k)) {
                   ?>
                   <a href="allproduct?removefave=<?=$key['productid'];?>" class="btn " type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white"  class="bi bi-heart-fill" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
            </svg></a>
          <?php  
          }else   {?>     <a href="allproduct?addfave=<?=$key['productid'];?>" class="btn " type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white"  class="bi bi-heart" viewBox="0 0 16 16">
            <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
            </svg></a>           

            <?php
            }
            
          }
            ?>

<!-- 
            <a href="allproduct?removecart=<?=$key['productid'];?>" class="btn" type="submit">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white"  class="bi bi-cart-check-fill" viewBox="0 0 16 16">
  <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm-1.646-7.646-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L8 8.293l2.646-2.647a.5.5 0 0 1 .708.708z"/>
</svg>
            </a> -->
        <a href="showdetails?show_id=<?=$key['productid'];?>" class="btn " type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white"  class="bi bi-eye-fill" viewBox="0 0 16 16">
  <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
  <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
</svg></a> 
          </div>
            <div class="card-footer">
            <small class="text-muted"><?=time_ago($key['productupdate']);?></small>
          </div>
        </div>
</div>

 <?php
    }  
 
?>

</div>



</center>
<?php



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
  direct("allproduct");


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
  direct("allproduct");


}

?>




<style>
  .test{
    background-color:#135893;
    
  }
</style>




<?php require_once('footer.php');?>