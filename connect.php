<?php
$con=mysqli_connect('localhost','root','','cart');
if(!$con){
    die(mysqli_error("error"+$con));
}
?>