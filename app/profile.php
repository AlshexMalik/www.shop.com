<?php

    require_once('header.php');

    if(isauth()){
?>


<div class="container sh-re my-3">
    <div class="row row-re mb-5">
        <div class="col-sm-4 col-sm-4-re d-flex justify-content-center flex-wrap align-content-center" >
                <img class="img-re" src="../assets/img/t (4).jpg"  alt="">
        </div>
            <div class="col-sm-8 col-sm-8-re ">
                <h3 class="mb-5">Update Account</h3>
                <center>
                    <form class="form-re" action="profile.php" method="POST">
                        <input class="input-re form-control text-center" type="text" value="<?=$authname;?>" name="name"  placeholder="name">
                        <input class="input-re form-control text-center" type="email" value="<?=$authemail;?>" name="email"  placeholder="Email">
                        <input class="input-re form-control text-center" type="password" required name="old"  placeholder="old password">
                        <input class="input-re form-control text-center" type="password" required name="password"  placeholder="new password" minlength="8" maxlength="16">
                        <input class="input-re sub-re btn btn-primary text-center mt-3" type="submit"  name="update" value="Submit">
                    </form>
                </center>
                <p><span class="span-re">If <a href="login.php">Forgit psssword</a>click here </span></p>
            </div>
    </div>
</div>

<?php
if(isset($_POST['update'])){

    $name = protect($_POST['name']);
    $email =protect($_POST['email']);
    $old =md5(protect($_POST['old']));
    $new =md5(protect($_POST['password']));
    if(empty($name)){
        message("please input username", "warning");
        direct("profile");
    }
    if(empty($email)){
        message("please input email", "warning");
        direct("profile");
    }
    if(empty($old)){
        message("please input old password", "warning");
        direct("profile");
    }
    if(empty($new)){
        message("please input new password", "warning");
        direct("profile");
    }
    $check = countdata("SELECT * FROM `user` WHERE `email`= '$email';");
    if($check > 0){
        if ($authemail == $email){
            $authpass = "SELECT * FROM `user` 
            WHERE (`password` = '{$old}');";
            $check2 = countdata("$authpass");
                if($check2 > 0){
            
                $qury = "UPDATE `user` SET `name`='{$name}',`email`='{$email}',`password`='{$new}' where `user_id` = $authid";
                excution("$qury");
                message("Update succesefuly" ,"success");
                direct("index");
                }else {
                message("please input correct password","warning");
                direct("profile");
                }
            
        }else{
            message("msmsmsm","warning");
            direct("index");
        }

    }else {
            $authpass = "SELECT * FROM `user` 
            WHERE (`password` = '{$old}');";
            $check2 = countdata("$authpass");
            if($check2 > 0){            
                $qury = "UPDATE `user` SET `name`='{$name}',`email`='{$email}',`password`='{$new}' where `user_id` = $authid";
                excution("$qury");
                message("Update succesefuly" ,"success");
                direct("index");
                }else {
                    message("please input correct password ","warning");
                    direct("profile");
                }
        
    }

    
    
}

    }else{
        
        ?>
        <center class="mt-5 pt-5">
            <H1 style="font-size:10em;" class="mt-5 pt-5">404 Erorr</H1>
            <h3 class="mt-5 pt-5">this file not found, please back do again</h3>
        </center>
        <?php
    }
?>

    

<?php require_once('footer.php');?>