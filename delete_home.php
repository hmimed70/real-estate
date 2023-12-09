<?php
include("session.php");
if(!checkSession())
{
header("Location: login_user.php");
}
else
{
include("data_base.php");
$userID = $_SESSION['user'];
if(isset($_GET['id'])){
    
    $_SESSION['msg_type']="succes";
    $getID = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM homes WHERE id='$id' and user = '$userID'  ");
    if(mysqli_num_rows($result)>0)
   {
       $sql1 = " select * from images where home = $getID ";
       $result1 = $conn->query($sql1);
       
       while($row1 = $result1->fetch_assoc()) {
          unlink('./uploads/'.$row1['imgName']);
         }
         mysqli_query($conn, "DELETE FROM images where home= '$_GET[id]' and user = '$userID' ");
         $sql="DELETE FROM  homes  WHERE id= '$_GET[id]' ";
         $result= mysqli_query($conn,$sql) ;
         if(mysqli_num_rows($result)>0)
        if($result)
        {
           header('Location: my_homes.php');
        }
        else
        {
         die("Oops! Something went wrong. Please try again later.");
      }

   }
   else {
         header('Location: my_homes.php');
   }
   
}
else {
   header('Location: my_homes.php');
}
}
 ?>