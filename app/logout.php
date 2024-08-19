<?php require_once('header.php');?>
<?php
if(isauth()){
    unset($_SESSION['user_id']);
    message("you are logout","warning");
    direct("index");
}else {direct("index");}
?>
<?php require_once('footer.php');?>