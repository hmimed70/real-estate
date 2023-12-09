<?php
//include 'data_base.php';
include_once("session_ad.php");
if(checkSession()==false){
    header("Location: login_admin.php");
}?>

<?php

include 'data_base.php';
$statusMsg ="";
$result = "";

$titleErr = $addErr = $priceErr = $typeErr = $imgError = "";
$homeId = "";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM users WHERE id_user='$id' ");
    if($result)
    {
      $data = mysqli_fetch_array($result);
      $blocked = $data['blocked'];
      $sql = '';
      if($blocked == 'true') {
        $sql = "UPDATE users set blocked = 'false' where id_user = '$id' ";
      }
      else {
        $sql = "UPDATE users set blocked = 'true' where id_user = '$id' ";
      }
      mysqli_query($conn, $sql);

    }
    }
    header("Location: index_admin.php");

    ?>