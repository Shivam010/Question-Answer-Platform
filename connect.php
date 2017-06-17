<?php
    $server = "localhost";
    $user = "root";
    $password = "dell";
    $db = "project";

    $conn = mysqli_connect($server,$user,$password,$db);
    if(!$conn){
        die("Connection Failed ". mysqli_connect_error());
    }
?>

