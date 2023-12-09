<?php
 function checkSession()
{
    session_status() === PHP_SESSION_ACTIVE ?: session_start();
    //check if the user is authenticate
    if(isset($_SESSION['admin']))
 {
     return true ;
 }
 else{
     return false ;
 }
}
?>