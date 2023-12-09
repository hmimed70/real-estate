<?php
$url='localhost';
$username='root';
$password='';
$conn= new mysqli($url,$username,$password,"realestate");
/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

?>
