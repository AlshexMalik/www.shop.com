<?php require_once('header.php');?>

<?php
msgauth();


?>
<div class="container ">
    <div class="row shadow mt-5 ">
        <div class="col-sm-5 d-flex justify-content-center flex-wrap align-content-center">
                <div class=" mt-4 p-5">
                    <center>
                    <h1>Newest Job 1</h1>
                    <p>karakanman lasar mtmanay ewaya</p>
                    </center>
                </div>
            </div>
            <div class="col-sm-7">
                <div id="demo" class="carousel slide" data-bs-ride="carousel">

<!-- Indicators/dots -->
                    <div class="carousel-indicators">
                      <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
                      <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
                      <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
                    </div>

<!-- The slideshow/carousel -->
                     <div class="carousel-inner">
                       <div class="carousel-item active">
                         <img src="../assets/img/t (7).jpg" alt="Los Angeles" class="d-block w-100">
                       </div>
                       <div class="carousel-item">
                         <img src="../assets/img/t (7).jpg" alt="Chicago" class="d-block w-100">
                       </div>
                       <div class="carousel-item">
                         <img src="../assets/img/t (7).jpg" alt="New York" class="d-block w-100">
                       </div>
                     </div>

<!-- Left and right controls/icons -->
                     <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                       <span class="carousel-control-prev-icon"></span>
                     </button>
                     <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                       <span class="carousel-control-next-icon"></span>
                     </button>
                     </div>
            </div>
        
    </div>
    <div class="row shadow mt-4 ">
    <div class="d-sm-none col-sm-5 d-flex justify-content-center flex-wrap align-content-center">
                <div class=" mt-4 p-5">
                    <center>
                    <h1>Newest offer 1</h1>
                    <p>karakanman lasar mtmanay ewaya</p>
                    </center>
                </div>
        </div>
            <div class="col-sm-7">
                <div id="demo" class="carousel slide" data-bs-ride="carousel">

<!-- Indicators/dots -->
                    <div class="carousel-indicators">
                      <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
                      <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
                      <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
                    </div>

<!-- The slideshow/carousel -->
                     <div class="carousel-inner">
                       <div class="carousel-item active">
                         <img src="../assets/img/t (7).jpg" alt="Los Angeles" class="d-block w-100">
                       </div>
                       <div class="carousel-item">
                         <img src="../assets/img/t (7).jpg" alt="Chicago" class="d-block w-100">
                       </div>
                       <div class="carousel-item">
                         <img src="../assets/img/t (7).jpg" alt="New York" class="d-block w-100">
                       </div>
                     </div>

<!-- Left and right controls/icons -->
                     <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                       <span class="carousel-control-prev-icon"></span>
                     </button>
                     <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                       <span class="carousel-control-next-icon"></span>
                     </button>
                     </div>
            </div>
            
            <div class="befor-sm col-sm-5 d-flex justify-content-center flex-wrap align-content-center">
                <div class=" mt-4 p-5">
                    <center>
                    <h1>Newest offer</h1>
                    <p>karakanman lasar mtmanay ewaya</p>
                    </center>
                </div>
        </div>
        
    </div>
    <center>
    <div class="row shadow mt-4 p-3">
    <?php
    for ($i=1; $i < 5 ; $i++) {
      $items = allData("SELECT * FROM `product` where category_id LIKE $i  ORDER BY `productupdate` DESC limit 1;");
      $type = findData("SELECT `category_name` FROM `category` WHERE category_id =$i; ");
      $k = $type['category_name'];
      foreach($items as $key){
         
        ?>
      <div class=" col ">
        <div class="card py-1">
          <div class="containerr">
            <img src="../assets/img/<?=$key['productimg'];?>" class="imgshow"   alt="../assets/img/t (4).jpg">
            <div class="topright"><?=$k;?></div>
          </div>
  
          <div class="card-body">
            <h5 class="card-title"><?=$key['productname'];?></h5>
            <p class="card-text card-show"><?=$key['productdetail'];?></p>
          </div>
          <a href="showdetails?show_id=<?=$key['productid'];?>" class="btn " type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#135893"  class="bi bi-eye-fill" viewBox="0 0 16 16">
      <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
      <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
    </svg></a> 
          <div class="card-footer">
            <small class="text-muted"><?=time_ago($key['productupdate']);?></small>
          </div>
        </div>
      </div>
<?php
} 
    
    }

        ?>
    </div>
    </center>
</div>


<?php require_once('footer.php');?> 