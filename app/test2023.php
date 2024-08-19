<?php

    require_once('header.php');

?>

<?php
$array2 = ['ahmed','mhammad','jamil'];
?>
<p>$array2 = ['ahmed','mhammad','jamil'];</p>

<?php
foreach($array2 as  $value){
 echo $value.'</br>';   
}
echo '<br>';
$array = [
    ['name'=> 'mhmmad' , 'age'=>55],
    ['name'=> 'mhmmad' , 'age'=>55],
    ['name'=> 'mhmmad' , 'age'=>55],
    ['name'=> 'ahmed' , 'age'=>55]
];
 ?>
<p>$array = [<br>
    ['name'=> 'mhmmad' , 'age'=>55],
<br>    ['name'=> 'mhmmad' , 'age'=>55],
    <br>['name'=> 'mhmmad' , 'age'=>55],
    <br>['name'=> 'ahmed' , 'age'=>55]
   <br> 
];</p>
 <?php

$_SESSION['s2023'] = date('d-m-Y');

echo $_SESSION['s2023']."<br>";


setcookie("user",555, time() + 3600);
echo $_COOKIE['user'] ;
?>

<div class="fixed-bottom">
<?php

require_once('footer.php');

?>
</div>