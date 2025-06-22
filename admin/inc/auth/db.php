<?php 

$connect = mysqli_connect("localhost","root","","villa");

if($connect){
}else{
    die("Database connection failed" . mysqli_error($connect));
}

?>