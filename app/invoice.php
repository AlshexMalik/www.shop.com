<?php require_once('header.php');?>

<?php 
?>
<center>
<h1 class="color-primary">Insert item</h1>
<form action="invoice" method="POST">
    <?php
        if(isset($_GET['update_id'])){
            message("get data for update","warning");
            $id = $_GET['update_id'];
            $data  =  findData("SELECT* from `item` where `item_id` = $id");

            ?>
            <div class="form-group my-5 col-7"> 
            <input type="text" class="form-control" value="<?=$data['item_id'];?>" readonly  name="id"  > 
        </div>
            <div class="form-group my-5 col-7"> 
            <input type="text" class="form-control" value="<?=$data['item_name'];?>"  name="name"  > 
        </div>
        <div class="form-group my-5  col-7" >
     
            <input type="text" class="form-control" value="<?=$data['item_content'];?>" name="content" > 
        </div>
        <div class="form-group my-5 col-7">
     
            <input type="number" class="form-control" value="<?=$data['item_qty'];?>" name="qty"  > 
        </div>
        <div class="form-group my-5 col-7">
     
     <input type="number" class="form-control" name="price" value="<?=$data['item_price'];?>"  required> 
    </div>
        <div class="form-group my-5 col-7">
     
            <input type="file" class="form-control" name="img" value="<?=$data['item_img'];?>" placeholder="img"> 
        </div>
        <button type="submit" name="UP" class="btn btn-warning">update</button>
        <?php
        
    }else{

            ?>
            <div class="form-group my-5 col-7"> 
            <input type="text" class="form-control" name="name" placeholder="name"> 
        </div>
        <div class="form-group my-5  col-7" >
     
            <input type="text" class="form-control" name="content" placeholder="content"> 
        </div>
        <div class="form-group my-5 col-7">
     
            <input type="number" class="form-control" name="qty" placeholder="qty"> 
        </div>
        <div class="form-group my-5 col-7">
     
     <input type="number" class="form-control" name="price" placeholder="price" required> 
    </div>
        <div class="form-group my-5 col-7">
     
            <input type="file" class="form-control" name="img" placeholder="img"> 
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        <?php
        }
    ?>

  
</form>
</center>

<?php
if(isset($_POST['UP'])){
    $id =  $_POST['id'];
    $name =  $_POST['name'];
    $content =  $_POST['content'];
    $qty =  $_POST['qty'];
    $price =  $_POST['price'];
    $img =  $_POST['img'];
   
    $query = "UPDATE `item` SET `item_id`='{$id}',`item_name`='{$name}',`item_content`='{$content}',`item_img`='{$img}'
    ,`item_qty`='{$qty}',`item_price`='{$price}' WHERE `item_id` = $id";
    
    excution($query);
    message("well update item","success");
    direct("invoice");
}
if(isset($_POST['submit'])){  
    $name =  $_POST['name'];
    $content =  $_POST['content'];
    $qty =  $_POST['qty'];
    $price =  $_POST['price'];
    $img =  $_POST['img'];
   
    $query = "INSERT INTO `item`(`item_name`, `item_content`, `item_img`, `item_qty`, `item_price`)
     VALUES ('{$name}','{$content}','{$img}','{$qty}','{$price}')";
    
    excution($query);
    message("well added item","success");
    direct("invoice");
}
if((isset($_GET['delet_id']))){
    $id = $_GET['delet_id'];
    excution("DELETE FROM `item` WHERE `item_id` = {$id}");
    message("succes delete","danger");
}
?>


<div class="container">
<table class="table table-hover">
    <tr>
        <th>id</th>
         <th>img</th>
        <th>name</th>
        <th>content</th>
        <th>qty</th>
        <th>price</th>
        <th>action</th>
    </tr>

    <?php
        $items = allData("SELECT * FROM `item`");
        foreach($items as $key){
            ?>
            <tr>
    
<td><?=$key['item_id'];?></td>
<td><img style="max-width:50px;" src="../assets/img/<?=$key['item_img'];?>" alt=""></td>
<td><?=$key['item_name'];?></td>
<td><?=$key['item_content'];?></td>
 
<td><?=$key['item_qty'];?></td>
<td><?=$key['item_price'];?></td>
<td>
    <a href="invoice?update_id=<?=$key['item_id'];?>" class="btn btn-warning">update</a>
    <a href="invoice?delet_id=<?=$key['item_id'];?>" class="btn btn-danger">delet</a>
</td>


            </tr>
<?php
            
        }
    ?>
</table>
</div>



<?php require_once('footer.php');?>