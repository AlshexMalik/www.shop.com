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
                    <form action="login.php" method="POST">
                        <input class="input-re form-control text-center" required value="<?php if(isset($_SESSION['lname'])) {echo $_SESSION['lname'];}?>" type="text" name="user" placeholder="Email Or Full_Name">
                        <input class="input-re form-control text-center" type="password" name="pass" placeholder="Password" required>
                        <input class="input-re btn btn-primary text-center mt-3" type="submit" name="login" value="LOGIN">
                    </form>
                </center>
                <p><span>if not have account<a href="Register">Sign Up</a></span></p>
                <p><span><a href="Forgetpass">ForgetPassword</a></span></p>
            </div>
    </div>
</div>
<?php
if(isset($_POST['login'])){
    $user = protect($_POST['user']);
    $pass =md5(protect($_POST['pass']));

    if(empty($user)){
        
        message("please input Username or Email", "warning");
        direct("login");
    }
    elseif(empty($pass)){
        message("please input Password", "warning");
        direct("login");
    }
    $auth = "SELECT * FROM `user` 
    WHERE (`name`= '{$user}' or `email` ='{$user}' ) ;";
    $authpass = "SELECT * FROM `user` 
    WHERE (`password` = '{$pass}');";
    $check = countdata("$auth");
    $check2 = countdata("$authpass");
    if($check > 0){
         
        $getData = findData("$auth");
        $userid = $getData['user_id'];
        $username = $getData['name'];
        if($check2 > 0){
        $_SESSION['user_id'] = $userid;
        $_SESSION['user_name'] = $username;
        message("Welcome","success");
        unset($_SESSION['creat_acount']);
        direct("index");
        }else{
            $_SESSION['lname'] = $user;
            message(" hello MR:". $username . " please input correct password" , "warning");
            direct("login");
        }

   
         
        
        
    }else{
        message("account not exist" , "danger");
        direct("login");

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