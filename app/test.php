<?php require_once('header.php');?>




<div class="row container p-3 mt-5  shadow">    
    <?php
   for ($i=1; $i < 5 ; $i++) {
    $items = allData("SELECT * FROM `product` where category_id LIKE $i  ORDER BY `productupdate` DESC limit 1;");
    $type = findData("SELECT * FROM `category` WHERE category_id =$i; ");
       foreach ($items as $key ) {
      echo $key['category_id'];
    }
    
  
  }
?>

</div>





