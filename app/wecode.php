<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<center>
    <form action="wecode.php" method="post">
        <label for="">please input string with out dublicat</label><br>
        <input type="text" name="input"><br>
        <input  type="submit"   name="submit" value="Submit">
    </form>
    
<?php

if (isset($_POST['submit'])) {
    $string  = $_POST['input'];
    $array = str_split($string);
    $len  = strlen($string);
    $unique = array_unique($array);
    $duplicates = array_diff_assoc($array, $unique);    
    $after = implode("", $unique);    
    echo "your string :". $string ."<br>";
    echo "after remove dublicate if have : $after ";

    $string = "45";
    var_dump($string);
    $int_value = (int) $string;
    var_dump($int_value);
}?>
</center>
</body>
</html>
<style>
    *{
        padding:10px;
        margin:10px;
    }
</style>