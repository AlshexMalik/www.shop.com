<?php

    require_once('header.php');

?>

<div class="container sh-re my-3">
    <div class="row row-re mb-5">
        <div class="col-sm-4 col-sm-4-re d-flex justify-content-center flex-wrap align-content-center" >
                <img class="img-re" src="../assets/img/t (4).jpg"  alt="">
        </div>
            <div class="col-sm-8 col-sm-8-re ">
                <h3 class="mb-5">Creat Account</h3>
                <center>
                    <form class="form-re" action="register.php" method="POST">
                        <input class="input-re form-control text-center" value="<?php if(isset($_SESSION['rname'])) {echo $_SESSION['rname'];}?>" type="text" name="name"  placeholder="Full_name">
                        <input class="input-re form-control text-center" value="<?php if(isset($_SESSION['remail'])) {echo $_SESSION['remail'];}?>" type="email" name="email"  placeholder="Email">
                        <input class="input-re form-control text-center" required value="<?php if(isset($_SESSION['rpass'])) {echo $_SESSION['rpass'];}?>" type="password" name="password"  placeholder="Password" minlength="8" maxlength="16">
                        <input class="input-re form-control text-center" required value="<?php if(isset($_SESSION['rpasss'])) {echo $_SESSION['rpasss'];}?>" type="password" name="confpass"  placeholder="Confirm password" minlength="8" maxlength="16">
                        <input class="input-re sub-re btn btn-primary text-center mt-3" type="submit"  name="create" value="Submit">
                    </form>
                </center>
                <p><span class="span-re">Already have acoount  <a href="login.php">log in</a></span></p>
            </div>
    </div>
</div>

<?php
if(isset($_POST['create'])){
    $name = protect($_POST['name']);
    $email =protect($_POST['email']);
    $passs = $_POST['password'];
    $confpasss = $_POST['confpass'];

    $pass =md5(protect($_POST['password']));
    $confpass =md5(protect($_POST['confpass']));
    if(empty($name)){
        $_SESSION['remail'] = "$email";
        $_SESSION['rpass'] = "$passs";
        $_SESSION['rpasss'] = "$confpasss";
        message("please input username", "warning");
        direct("register");

    }
    if(empty($email)){
        $_SESSION['rname'] = "$name";
        $_SESSION['rpass'] = "$passs";
        $_SESSION['rpasss'] = "$confpasss";
        $_SESSION['rgmail'] = "$email";
        message("please input email", "warning");
        direct("register");
    }
    if(empty($pass)){
        $_SESSION['rname'] = "$name";
        $_SESSION['rgmail'] = "$email";
        message("please input password", "warning");
        direct("register");
    }
    if(empty($confpass)){
        $_SESSION['rname'] = "$name";
        $_SESSION['rgmail'] = "$email";
        message("please input confirm password", "warning");
        direct("register");
    }
    $check = countdata("SELECT * FROM `user` WHERE `email`= '$email';");
    $check1 = countdata("SELECT * FROM `user` WHERE `name`= '$name';");
    if($check > 0){
        $_SESSION['rname'] = "$name";
        $_SESSION['rpass'] = "$passs";
        $_SESSION['rpasss'] = "$confpasss";
        message("Already have account BY YOUR EMAIL" , "danger");
        direct("register");
    }if ($check1 > 0 ) {
        $_SESSION['remail'] = "$email";
        $_SESSION['rpasss'] = "$confpasss";
        $_SESSION['rpass'] = "$passs";
        message("Already have NAME please input uniqe username" , "danger");
        direct("register");
    

    }else {
        if($pass!= $confpass){
            $_SESSION['remail'] = "$email";
            $_SESSION['rname'] = "$name";
            message("please write same pass" , "danger");
            direct("register");
        }else{
            excution("INSERT INTO `user`(`name`, `email`, `password`)
            VALUES ('{$name}','{$email}','{$pass}');");
            $_SESSION['creat_acount'] = 1;

           
            message("well done creat account","success");
            direct("index");
        }
    }
    
}
?>

<?php require_once('footer.php');?>