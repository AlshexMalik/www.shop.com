<?php
    ob_start();
    require_once('../server/app.php');
    $getdata = fetchauth();
    if($getdata!=null){
        $authid = $getdata['user_id'];
        $authname = $getdata['name'];
        $authemail = $getdata['email']; 
        $authrole = $getdata['role'];
       
        
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web mall</title>
    <link rel="stylesheet" href="../assets/css/custom.css">
    <link rel="stylesheet" href="../assets/css/customCSS.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/fe635c0a5b.js" crossorigin="anonymous"></script>
    <script src="../assets//js/bootstrap.js" ></script>
    <script src="../assets//js/bootstrap2.js"></script>
    <script src="../assets//js/bootstrap3.js"></script>

</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark sticky-top    " style="max-width: 100%;background-color: #135893;">
    <div class="container-fluid ">
        <a class="navbar-brand" href="index"><img src="../assets/img/t (7).jpg" style="max-height: 35px;" alt=""></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mynavbar">
            <ul class="navbar-nav me-auto">
                <li class="nav-item "><a class="nav-link" href="index">HOME</a>
                <li class="nav-item "><a class="nav-link" href="computer">Computer</a>
                <li class="nav-item "><a class="nav-link" href="mobile">Mobile</a>
                <li class="nav-item "><a class="nav-link" href="elec">Electrical</a>
                <li class="nav-item "><a class="nav-link" href="system">System Security</a></li>
                <li class="nav-item "><a class="nav-link" href="allproduct">Product</a></li>
                <?php
                    if(isauth()){
                        ?>
                         
                         <li class="nav-item "><a class="nav-link" href="favorite">favorite</a></li>
                         <li class="nav-item "><a class="nav-link" href="order">Order</a></li>
                         <?php
                    }else{
                        ?>
                        <li class="nav-item "><a class="nav-link" href="about">us</a></li>
                        <?php
                    }
                    if(isauth() && $authrole == 'admin'){
                        ?>
                        <li class="nav-item "><a class="nav-link" href="product">product</a></li>
                        <?php
                    }
                ?>
                
                
                

            </ul>
            <?php
            if(isauth()){
                ?>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item "><a class="nav-link" href="profile"><span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                        </svg></span>  <?=$authname;?></a>
                    </li>
                    <li class="nav-item "><a class="nav-link" href="logout"><span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z"/>
                        <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
                        </svg></span>  logOUt</a>
                    </li>


                </ul>
                <?php 
            }else{
             ?>  
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item "><a class="nav-link" href="login"><span><svg fill="white" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                            <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                            </svg></span>  Loge In</a>
                    </li>
                    <li class="nav-item "><a class="nav-link" href="../app/register"><span><svg fill="white" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                        <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                        <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                        </svg></span>  Register</a>
                    </li>
                </ul> 
            <?php
            }

            ?>

            
        </div>
    </div>
</nav>


<?php 

    msgbox();
    //mailer();

   
?>
 

