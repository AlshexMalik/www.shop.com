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
                    <form action="Forgetpass" method="POST">
                        <input class="input-re form-control text-center" type="text" name="user" placeholder="Email">
                        <input class="input-re btn btn-primary text-center mt-3" type="submit" name="sentpass" value="sentpass">
                    </form>
                </center>
                <p><span class="span-re">Already have acoount  <a href="login">log in</a></span></p>
                <p><span>if not have account<a href="Register">Sign Up</a></span></p>
            </div>
    </div>
</div>
<?php 
if (isset($_POST['sentpass'])) {
    $email = protect($_POST['user']);
    if(empty($email)) {
        message('Email is Required','warning');
        direct('Forgetpass');
    }
    else {
        $checkemail = countdata(" SELECT * FROM `user` WHERE   `email` ='{$email}'  ");
        if($checkemail > 0 ){
            $code = rand(1000,9999);
            mailer("kakohama61@gmai.com","dcd","This is The Code {$code}");
            excution("DELETE FROM `forgit` WHERE  `forg_email`='{$email}' ");
            excution(" INSERT INTO `forgit`(`forg_code`, `forg_email`) VALUES ('{$code}','{$email}') ");
            direct('ressetpass');
        }
        else {
            message('Email is not Exist','warning');
            direct('Forgetpass');
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