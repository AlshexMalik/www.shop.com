<?php
date_default_timezone_set('Asia/Baghdad');
 //echo time_ago('2020-05-5 09:46:00');  
 function time_ago($timestamp)  
 {  
      $time_ago = strtotime($timestamp);  
      $current_time = time();  
      $time_difference = $current_time - $time_ago;  
      $seconds = $time_difference;  
      $minutes      = round($seconds / 60 );           // value 60 is seconds  
      $hours           = round($seconds / 3600);           //value 3600 is 60 minutes * 60 sec  
      $days          = round($seconds / 86400);          //86400 = 24 * 60 * 60;  
      $weeks          = round($seconds / 604800);          // 7*24*60*60;  
      $months          = round($seconds / 2629440);     //((365+365+365+365+366)/5/12)*24*60*60  
      $years          = round($seconds / 31553280);     //(365+365+365+365+366)/5 * 24 * 60 * 60  
    if($seconds <= 59){  
        if($seconds <=5){  
            return "Just Now";
        }else {return  $seconds."secands ago";}
    }else if($minutes <=59 ){
        if ($minutes <= 1) {
            return  "just minute ago";
        }else return  $minutes."minutes ago";  
       return $minutes."minute ago";  
     }else if($hours <= 23){
        if($hours==1){  
            return "an hour ago";  
        }else{return  $hours."hours ago";}
    }else if($days <= 6){  
     if($days==1){  
       return "one day ago";  
     }else{return $days." days ago";}  
   } else if($weeks <= 4.3){  //4.3 == 52/12 
        if($weeks==1){  
       return "a week ago";  
     }else{ return "$weeks weeks ago";}  
   } else if($months <=11){  
     if($months==1){  
       return "a month ago";  
     }else{ return "$months months ago";}  
   } else if($years >= 1){
        if ($years == 1 ) {
        return "one year ago"; 
        }else{return "$years years ago";}    
        
     }  
           
   }  
  

    function direct($web){
        ob_start();
        header("location:".$web);
        exit;
    }

    function excution($sql){
        global $conn;
        return mysqli_query($conn , $sql);

    }

    function findData($sql){
        
        global $conn;
        $resalt = excution($sql);
        return mysqli_fetch_assoc($resalt) ;
    }
    
    function allData($sql){
        $data = excution($sql);
        $alldataa = [];
        while ($aa = mysqli_fetch_assoc($data)) {
            $alldataa [] = $aa;
        }
        return $alldataa;
        
    }

    function countdata($sql){
        global $conn;
        $resalt = mysqli_query($conn , $sql);
        $count = mysqli_num_rows($resalt);
        return $count;
    }

    function protect($input){
        global $conn;
        return mysqli_real_escape_string($conn,trim($input));
    }
    function message($msg ,$type){
        
        if(isset($_SESSION['message']) && isset($_SESSION['type'])){
            unset($_SESSION['message']);
            unset($_SESSION['type']);
            $_SESSION['message'] = $msg;
            $_SESSION['type'] = $type;
        }else{
            $_SESSION['type'] = $type;
            $_SESSION['message'] = $msg;
        }
    }
    function checkalreadyexist($id){
        global $authid;
       return countdata("SELECT * FROM `fav` where productid  = $id and userid = $authid;");
      }
    function msgbox(){
        if(isset($_SESSION['message']) && $_SESSION['type']){
            $message = $_SESSION['message'];
            $type = $_SESSION['type'];
            ?>
            <div class="alert alert-<?=$type;?>  text-center" role="alert">
                <?=$message;?>
            </div>
            <?php
        }

    }
   function msgauth(){
        if(!isset($_SESSION['user_id'])){
           
            ?>
            <div class="alert alert-danger  text-center" role="alert">
                not authorized
            </div>
            <?php
            
        }

    }
    function isauth(){
        if(isset($_SESSION['user_id'])){
            $acountid = $_SESSION['user_id'];
            $qury = "SELECT `user_id`, `name`, `email`, `password`, `user_creat` FROM `user` 
            WHERE `user_id`='{$acountid}'";
            $countdata = countdata($qury);
            if($countdata > 0){
                return true;
            }else{return false;}
            
        }else {return false;}
    }

    function checkauth(){
        if(isset($_SESSION['user_id'])){
            $acountid = $_SESSION['user_id'];
            $qury = "SELECT `user_id`, `name`, `email`, `password`, `user_creat` FROM `user` 
            WHERE `user_id`='{$acountid}'";
            $countdata = countdata($qury);
            if($countdata > 0){
                return $acountid;
            }else{direct("login");}

   
        }else{ 
            direct("login");
        }
    }

    function getauth(){
        $acountid = checkauth();
        $qury = "SELECT `user_id`, `name`, `email`, `password`, `user_creat` FROM `user` 
        WHERE `user_id`='{$acountid}'";
        $getdata = findData($qury);
        return $getdata;
    }
    function fetchauth(){
        if(isset($_SESSION['user_id'])){
            $acountid = $_SESSION['user_id'];
            $qury = "SELECT * FROM `user` 
            WHERE `user_id`='{$acountid}'";
            $countdata = countdata($qury);
            if($countdata > 0){
                $qury = "SELECT * FROM `user` 
                WHERE `user_id`='{$acountid}'";
                $getdata = findData($qury);
                return $getdata;
            }else{return null;}

   
        }else{ 
            return null;
        }
    }



    require_once('mail/PHPMailer.php');
    require_once('mail/SMTP.php');


    function mailer(){
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 1;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   ='alikarimqader@gmail.com';                     //SMTP username
            $mail->Password   = 'Aa-123456';                               //SMTP password
            $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom('alikarimqader@gmail.com', 'Mailer');    //Add a recipient
            $mail->addAddress('alikarimqader@gmail.com');               //Name is optional
            $mail->addReplyTo('alikarimqader@gmail.com', 'Information');
      
        
            
        
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Here is the subject';
            $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
    



 

