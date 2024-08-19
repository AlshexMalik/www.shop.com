<?php require_once("header.php");?>

<?php  

if(isauth() && $authrole == 'admin'){
    

?>
<div class="container shadow p-5 mt-5">
    <div class="row m-2 p-2 rounded">
        <div class="col-12">
            <a href="?add" class="btn btn-primary float-start">ADD PODUCT</a>
            <a href="?search"  class="btn btn-warning float-end ">SEARCH PODUCT</a>
        </div>

    <?php



        if (isset($_GET['update_id'])) {
            $id = $_GET['update_id'];
            $data = findData("SELECT * FROM `product` WHERE `productid` = $id");


            ?>
                   
            <div class="col-6 mx-auto">
            <form class="" action="product" method="post">
            <div class="form-group">
                    <label>product ID</label>
                    <input type="text" placeholder="product ID" name="id" value="<?=$data['productid'];?>" class="form-control disabled my-2 text-center rounded ">
                </div>
                    
            <div class="form-group">
                    <label>Category  </label>
                    <select class="form-select my-2 text-center rounded" value="<?=$data['productcategory'];?>" name="category" aria-label="Default select example">
                        <option value="1">Computer</option>
                        <option value="2"> Mobile</option>
                        <option value="3">Electrical</option>
                        <option value="4">Security System</option>     
                    </select>
                </div>
                <div class="form-group">
                    <label>product Name</label>
                    <input type="text" placeholder="product name" name="name" value="<?=$data['productname'];?>" class="form-control my-2 text-center rounded ">
                </div>
                <div class="form-group">
                    <label>product Deatail</label>
                    <input type="text" placeholder="Detail" name="det" value="<?=$data['productdetail'];?>" class="form-control my-2 text-center rounded ">
                </div>
                <div class="form-group">
                    <label>product price</label>
                    <input type="number" min="0"  placeholder="product price" name="price" value="<?=$data['productprice'];?>" class="form-control my-2  text-center rounded ">
                </div>
                <div class="form-group">
                    <label>product QYT</label>
                    <input type="number" min="0" placeholder="product QTY" name="qty" value="<?=$data['productqty'];?>" class="form-control my-2  text-center rounded ">
                </div>
                <div class="form-group">
                    <label>Please select img</label>
                        <input type="file" placeholder="img" name="img" required value="<?=$data['productimg'];?>" class="form-control my-2  rounded ">
                    </div>

                <div class="form-group mx-auto col-sm-8">
                    <input type="submit" name="update" class="form-control btn btn-warning" value="Update">
                </div>
                
            </form>
        </div>
        
        <?php
        }if (isset($_GET['search']) || isset($_POST['search'])) {
            ?>


            
            <div class="col-6 mx-auto">
            <form action="product.php" method="POST">

            <input list="browsers" name="datalist"   class="form-control my-2 text-center rounded ">
                <datalist id="browsers">
                    <?php
                        $vlist = allData("SELECT productname as nn FROM `product`; ");
                        foreach ($vlist as $key ) {
                            ?>
                            
                            <option value="<?=$key['nn'];?>">
                    
                    <?php
                        }
                    ?>
                </datalist>
                <div class="form-group mx-auto col-sm-8">
                    <input type="submit" name="search" class="form-control btn btn-primary mt-3" value="Search">
                </div>
            </form>
            </div>
            <?php

        }
        
        else if (!isset($_GET['update_id'])) {
          
        
            ?>
            <div class="col-6 mx-auto">
            <form action="product" method="POST">
                
            <div class="form-group">
                    <label>Category  </label>
                    <select class="form-select my-2 text-center rounded" required name="category" aria-label="Default select example">
                        <option value="1">Computer</option>
                        <option value="2"> Mobile</option>
                        <option value="3">Electrical</option>
                        <option value="4">Security System</option>     
                    </select>
                </div>
                <div class="form-group">
                    <label>product Name</label>
                    <input type="text" placeholder="product name" name="name" required class="form-control my-2 text-center rounded ">
                </div>
                <div class="form-group">
                    <label>product Deatail</label>
                    <input type="text" placeholder="Detail" name="det" required class="form-control my-2 text-center rounded ">
                </div>
                <div class="form-group">
                    <label>product price</label>
                    <input type="number" min="0"  placeholder="product price" required name="price" class="form-control my-2  text-center rounded ">
                </div>
                <div class="form-group">
                    <label>product QYT</label>
                    <input type="number" min="0" placeholder="product QTY" name="qty" required class="form-control my-2  text-center rounded ">
                </div>
                <div class="form-group">
                    <label>Please select img</label>
                        <input type="file" placeholder="img" name="img" required class="form-control my-2  rounded ">
                    </div>
                    <div class="form-group col-8 mx-auto">
                
                         <input type="submit" name="add" required class="my-2  form-control btn btn-success" value="ADD">
                    
                    </div>
                   
               
            </form>
        </div>
        <?php
        }

?>
        
    </div>
</div>


<?php
    
    if(isset($_POST['add'])){  
        $name = protect($_POST['name']);
        $detail =  protect($_POST['det']);
        $price =  protect($_POST['price']);
        $qty =  protect($_POST['qty']);
        $category =  protect($_POST['category']);
        $img = protect($_POST['img']);
       
        $query = "INSERT INTO `product`( `productname`,`productimg`, `productdetail`, `productprice`, `productqty`, `category_id`)
         VALUES ('{$name}','{$img}','{$detail}','{$price}','{$qty}','{$category}')";
        
        excution($query);
        message("well added item","success");
        direct("product");
    }    
    if(isset($_POST['update'])){  
        $id = protect($_POST['id']);
        $name =  protect($_POST['name']);
        $detail =  protect($_POST['det']);
        $price =  protect($_POST['price']);
        $qty =  protect($_POST['qty']);
        $category =  protect($_POST['category']);
        $img = protect($_POST['img']);
        $check = countdata("SELECT * FROM `product` WHERE `productid`=$id");
        if ($check > 0) {
            $query = "UPDATE `product` SET `productimg`='{$img}',`productname`='{$name}',`productdetail`='{$detail}',
            `productprice`='{$price}',`productqty`='{$qty}',`category_id`='{$category}' WHERE `productid` = $id";
            excution($query);
            message("well apdate item","success");
            direct("product");
        }else {
            message("PLEASE SHARK","warning");
            direct("product");
        }
    }    
}
?>
 <div class="container p-5 mt-5  shadow">
<div class="table-responsive">
    <?php
    if (isset($_POST['search'])) {
?>

<table class="table table-hover text-center">
 <tr>
        <th scope="col">id</th>
        <th scope="col">product_id</th>
        <th scope="col">img</th>
        <th scope="col">name</th>
        <th scope="col">content</th>
        <th scope="col">qty</th>
        <th scope="col">price</th>
        <th scope="col">ago</th>
        <?php
        if (isauth() && $authrole == 'admin') {
            ?>
            
        <th scope="col">category ID</th>
        <th scope="col">product add</th>
        <th scope="col">product update</th>
        <th scope="col" >action</th>
        <?php
        }

        ?>
    </tr>
    
    <?php
        $search = protect($_POST['datalist']);
        $items = allData("SELECT * FROM `product` where productname LIKE '%$search%';");
        $counter = findData("SELECT count(`productid`) AS aa FROM `product` ;  ");
        $datta = $counter['aa'];
        $count = 0;
        ?>
        <h6>ALL PRODUCT :: <b><?=$datta;?></b></h6>
        <?php
        foreach($items as $key){
            $count++; 
            ?>
<tr scope="row">    
    <td><b><?=$count;?></b></td>
    <td><?=$key['productid'];?></td>
    <td><img style="max-width:50px;" src="../assets/img/<?=$key['productimg'];?>" alt=""></td>
    <td><?=$key['productname'];?></td>
    <td><?=$key['productdetail'];?></td>
    <td><?=$key['productqty'];?></td>
    <td><?=$key['productprice'];?></td>
    <td><?=$key['productprice'];?></td>
    <td><?=time_ago($key['productupdate']);?></td>
    <?php if (isauth() && $authrole == 'admin') {
        ?>
<td><?=$key['category_id'];?></td>
<td><?=$key['productadd'];?></td>
<td><?=$key['productupdate'];?></td>
<td class="">
    <a href="product?update_id=<?=$key['productid'];?>" class="m-1 btn btn-sm btn-warning">UPDATE</a>
<a href="product?delet_id=<?=$key['productid'];?>" class="m-1 btn btn-sm btn-danger">DELETE</a>
</td>
 <?php
}  } 
?>
  </tr>
</table>


<?php
   }else{
    ?>
 <table class="table table-hover text-center">
 <tr>
        <th scope="col">id</th>
        <?php
        if (isauth() && $authrole == 'admin') {
            ?>
        <th scope="col">product_id</th>
        <?php
        }
        ?>
        <th scope="col">img</th>
        <th scope="col">name</th>
        <th scope="col">content</th>
        <th scope="col">qty</th>
        <th scope="col">price</th>
        <th scope="col">ago</th>
        <?php
        if (isauth() && $authrole == 'admin') {
            ?>
            
        <th scope="col">category ID</th>
        <th scope="col">product add</th>
        <th scope="col">product update</th>
        <th scope="col" >action</th>
        <?php
        }

        ?>
    </tr>
    
    <?php
        $items = allData("SELECT * FROM `product` ORDER BY `product`.`productadd` DESC ");
        $count = 0;
        $counter = findData("SELECT count(`productid`) AS aa FROM `product` ;  ");
        $datta = $counter['aa'];
        ?>
        <h6>ALL PRODUCT :: <b><?=$datta;?></b></h6>
        <?php
        foreach($items as $key){
            $count++; 
            ?>
            <tr scope="row">
    
<td><b><?=$count;?></b></td>
<?php if (isauth() && $authrole == 'admin') {
    ?>
    <td><?=$key['productid'];?></td>
    <?php
}
    ?>

<td><img style="max-width:50px;" src="../assets/img/<?=$key['productimg'];?>" alt=""></td>
<td><?=$key['productname'];?></td>
<td><?=$key['productdetail'];?></td>
<td><?=$key['productqty'];?></td>
<td><?=$key['productprice'];?></td>
<td><?=time_ago($key['productupdate']);?></td>
<?php if (isauth() && $authrole == 'admin') {
 ?>
 
<td><?=$key['category_id'];?></td>
<td><?=$key['productadd'];?></td>
<td><?=$key['productupdate'];?></td>

<td class="">
    <a href="product?update_id=<?=$key['productid'];?>" class="m-1 btn btn-sm btn-warning">UPDATE</a>
    <a href="product?delet_id=<?=$key['productid'];?>" class="m-1 btn btn-sm btn-danger">DELETE</a>
</td>

 
 <?php
  
}
?>

    </tr>

<?php
     }    
     if (isset($_GET['delet_id'])) {
        $id = protect($_GET['delet_id']);
        $check = countdata("SELECT * FROM `product` WHERE `productid`=$id");
        if($check > 0) {
        excution("DELETE  FROM `product` WHERE `productid`=$id");
        message("succes delete","danger");
        direct("product");
        }else {
            message("PLEASE SHARK","warning");
            direct("product");
            
        }

        
    }
    $_SESSION['productcount'] = $count;
    ?>
    </table><?php
}
    ?>

    
    </div>    
</div>

<?php require_once("footer.php")?>
