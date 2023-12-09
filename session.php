<?php
 function checkSession()
{
    session_status() === PHP_SESSION_ACTIVE ?: session_start();
    //check if the user is authenticate
    if(isset($_SESSION['user']))
 {
    $id = $_SESSION['user'];
    include('data_base.php');
    $result = mysqli_query($conn, "SELECT * FROM users WHERE id_user='$id' ");
    if(mysqli_num_rows($result)>0) {
       $data = mysqli_fetch_array($result);
       $blocked = $data['blocked'];
       if($blocked == 'false'){
          return true;
        }
       else {
         return false ;
        }
    }
    else{
     return false ;
    }
 }
 else{
     return false ;
    }
}
?>

