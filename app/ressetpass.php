<?php require_once('header.php');?>

<?php

    require_once('header.php');

?>

<div class="container sh-log  my-3">
    <div class="row row-re mb-5">
        <div class="col-sm-4 d-flex justify-content-center flex-wrap align-content-center" >
                <img class="img-re" src="../assets/img/t (4).jpg"  alt="">
        </div>
            <div class="col-sm-8 ">
                <h3 class="mb-5">LogIn Account</h3>
                <center>
                    <form action="ressetpass" method="POST">
                        <input class="input-re form-control text-center" type="text" name="code" placeholder="CODE">
                        <input class="input-re form-control text-center" minlength="8" maxlength="16" type="password" name="newpass" placeholder="New password">
                        <input class="input-re btn btn-primary text-center mt-3" type="submit" name="reset" value="Reset password">
                    </form>
                </center>
                <p><span class="span-re">Already have acoount  <a href="login">log in</a></span></p>
                <p><span>if not have account<a href="Register">Sign Up</a></span></p>
            </div>
    </div>
</div>
<?php
if(isset($_POST['reset'])){
    $code = protect($_POST['code']);
    $newpass = md5(protect($_POST['newpass']));
    if(empty($code)){
        message("please input correct code", "warning");
        direct("ressetpass");
    }
    if(empty($newpass)){
        message("please input correct new password", "warning");
        direct("ressetpass");
    }else{
        echo"2";
        $qury = "SELECT * FROM `forgit` WHERE `forg_code` = {$code}";
        echo"1";
        $check = countdata("$qury");
        
        if($check > 0){
            $qury4 = "SELECT *  FROM `forgit` WHERE `forg_code` = {$code}";
            $dataemail = findData("$qury4");
            $email = $dataemail['forg_email'];
            $qury3 = "DELETE FROM `forgit` WHERE `forg_code`= $code";
            $qury2 = "UPDATE `user` SET `password`='{$newpass}' WHERE `email`='{$email}'";
            $log ="SELECT *  FROM `user` WHERE  `email`='{$email}'";
            excution("$qury2");
            excution("$qury3");
            

            $getData = findData("$log");
        $userid = $getData['user_id'];
        $username = $getData['name'];
         
        $_SESSION['user_id'] = $userid;
        $_SESSION['user_name'] = $username;
        message("wlcome","success");
        unset($_SESSION['creat_acount']);
        direct("index");








           
            
            
        }else{
            message("code not corected" , "danger");
            direct("Forgetpass");
            echo"3";
    
        }
    }




}

?>



<?php require_once('footer.php');?>





























<style>

 
span{
    color :grey;
}
form{
    margin-top: 100px;
}
.input-re{
    width :60%;
    margin-bottom: 25px;
}
.btn{
    background-color:  #135893 !important;
}
.input-re{
    border:none !important;
    border-radius: 1px solid !important;
    
    border-bottom: 1px solid  #135893 !important;
}


.col-sm-8{
    max-width:100%;
    border-radius: 60px 0px 00px 60px;
    background-color: white;
    padding-top: 50px;
    text-align: center !important;
    
}
.col-sm-4{
    max-width:100%;
    
}
.container{
    background-color: #135893;
}
.img-re{
    max-width:50%;
    border-radius: 0px 50px 0px 30px;
}
.row-re{
    height: 550px;
}

.sh-log{
  box-shadow: 1px 1px 25px 10px #E4E4E4;
}
@media screen and (max-width: 570px) {
    .col-sm-8{
        border-radius: 00px 0px 00px 00px;
    }
    .container{
        margin-top: 0px !important;
        margin-bottom: 250px !important;
    }
    img{
        padding:25px;
    }

}
</style>



<?php require_once('footer.php');?>