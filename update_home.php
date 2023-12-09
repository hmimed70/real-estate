<?php
//include 'data_base.php';
include_once("session.php");
if(checkSession()==false){
    header("Location: login_user.php");
}?>

<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include 'data_base.php';
$statusMsg ="";
$result = "";

$titleErr = $addErr = $priceErr = $typeErr = $imgError = "";
$homeId = "";
$userID = $_SESSION['user'];
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM homes WHERE id='$id' and user = '$userID'  ");
    if(mysqli_num_rows($result)>0)
    {
      $data = mysqli_fetch_array($result);
      $id = $data['id'];
      $price = $data['price'];
      $addresse = $data['addresse'];
      $title = $data['title'];
      $type = $data['type'];
    }
    else {
      header('Location: my_homes.php');
    }
  }

  if (isset($_POST['submit'])) {
    $titleErr = $addErr = $priceErr = $typeErr = $imgError = "";

    $imgUploaded = true ;
  //check if number images between 1 - 3
  if(empty($_FILES['images']['tmp_name'][0]) ){
    $imgUploaded = false ; 
  }

  //check if images are in right format jpg/png/jpeg/gif
  else{
    $allowTypes = array('image/jpg','image/png','image/jpeg','image/gif');
    foreach($_FILES['images']['name'] as $key=>$val){
      $tmp_name 	= $_FILES['images']['tmp_name'][$key];
      $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
      $detected_type = finfo_file( $fileInfo, $_FILES['images']['tmp_name'][$key] );
      // $detectedType = exif_imagetype($_FILES['images']['tmp_name'][$key]);
      if(!in_array(strtolower($detected_type), $allowTypes)) {
        $imgError = "Please select only images";
      };
    }
  }

  //title must be at least 4 characters
  if (empty($_POST["title"]) || strlen($_POST['title']) < 4) {
    $titleErr = "Title is to short";
  }
   //addresse must be at least 4 characters
  if (empty($_POST["addresse"]) || strlen($_POST["addresse"]) < 4 ) {
    $addErr = "Addresse is to short";
  }

  if (empty($_POST["price"])) {
    $priceErr = "please input price";
  }

  //price max 999999

  if(empty($titleErr) && empty($priceErr) && empty($addErr) && empty($imgError)) {

  // if errors doesn't  exist
   include("data_base.php");
   $myid = mysqli_real_escape_string($conn, $_POST['id']);
   $title =  mysqli_real_escape_string($conn, $_POST['title']);
   $price = mysqli_real_escape_string($conn, $_POST['price']);
   $addresse =  mysqli_real_escape_string($conn, $_POST['addresse']);
   $type =  mysqli_real_escape_string($conn,$_POST['type']);

   $query = "UPDATE  homes set title = '$title' , addresse = '$addresse',type = '$type', price = $price where id = '$myid' ";
   
   if(mysqli_query($conn,$query)) {
          }
          else {
            echo "ERRRRRRRROOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOORRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRR";
            $statusMsg= "error something went wrong! .";
            die (mysqli_error($conn));
          } 
	// File upload configuration
    if($imgUploaded){
        $sql1 = " select * from images where home = '$myid' ";
        $result1 = $conn->query($sql1);
        while($row1 = $result1->fetch_assoc()) {
            unlink('./uploads/'.$row1['imgName']);
        }
        $sql="DELETE FROM  images  WHERE home= '$myid' ";
        $result= mysqli_query($conn,$sql) ;

        $targetDir = "uploads/";
        $images_arr = array();
        foreach($_FILES['images']['name'] as $key=>$val){
        $image_name = $_FILES['images']['name'][$key];
        $tmp_name 	= $_FILES['images']['tmp_name'][$key];
        $size 		= $_FILES['images']['size'][$key];
        $type 		= $_FILES['images']['type'][$key];
        $error 		= $_FILES['images']['error'][$key];
        // File upload path
        $fileName = basename($_FILES['images']['name'][$key]);
        $targetFilePath = $targetDir . $fileName;
    
            if(move_uploaded_file($_FILES['images']['tmp_name'][$key],$targetFilePath)){
            $query = "INSERT INTO images (imgName,home) ";
            $query.=" VALUES ('$fileName','$myid')";
            if(mysqli_query($conn,$query)) {
                $resultat = "update Succesfuly";
            }else{
                $statusMsg = "Failed to upload image";
            } 
            
            }else{
            $statusMsg = "Sorry, there was an error uploading your images.";
            }
    
        } //close foreach

    }
    header("Location: update_home.php?id=".$myid);
 //close if empty



  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet" type="text/css" >
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Add Home</title>
</head>
<body>
  <?php include 'header.php'; ?>  
<section class="home-form">
    <div class="dark-overlay">
      <div class="home-inner container">
    <div class="col-md-6  login-form-1" style="float:none;margin:auto;">
      <h3>Add New Home</h3>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
    <!--if home added display success msg -->
    <?php 
if( !empty($resultat)) {
    echo '<div class="alert alert-success alert-dismissable"  id="success-alert">';
    echo '<strong> Home updated successfully</strong>';
   echo '</div>';
}
 // if home not added display error msg  

if( !empty($statusMsg)) {
  echo '<div class="alert alert-danger alert-dismissable"  id="faild-alert">';
  echo '<strong> '. $statusMsg.'</strong>';
 echo '</div>';
}
?>
      <input type="hidden" name="id" value="<?php echo $id;?> ">
  <div class="form-group">
    <input type="text" class="form-control shadow-none" maxlength="80" id="title" value=" <?php echo $title; ?>" placeholder="Home Title" name="title" >
    <span class="error" style="color: red;"> <?php if(!empty($titleErr)) echo '* '.$titleErr;?></span>
  </div>
  <div class="form-group">
    <input type="text" class="form-control shadow-none" id="addresse" maxlength="80" value=" <?php echo $addresse; ?>" placeholder="Location" name="addresse">
    <span class="error" style="color: red;"> <?php if(!empty($addErr)) echo '* '.$addErr;?></span>
  </div>


  <div class="form-group">
    <input type="text" class="form-control shadow-none" id="price" placeholder="Price" value=" <?php echo $price; ?>" name="price">
    <span class="error" style="color: red;"> <?php if(!empty($priceErr)) echo '* '.$priceErr;?></span>
  </div>

  <div class="custom-file mb-3 mt-3">
  <input type="file"  name="images[]"  class="custom-file-input" id="imageUpload" multiple accept="image/jpg, image/jpeg, image/png, image/gif"> 
  <label class="custom-file-label" multiple for="customFile">Home images</label>
  <span class="error" style="color: red;"> <?php if(!empty($imgError)) echo '* '.$imgError;?></span>

</div>
  <label for="type" class="d-block" >Type : </label>

  <div class="form-check form-check-inline pl-3 mt-2">
  <input class="form-check-input" type="radio" name="type" id="exampleRadios1" value="Sell" <?php if($type == 'Sell') echo 'checked'; ?> checked>
  <label class="form-check-label"  for="exampleRadios1">
    Sell
  </label>
</div>
<div class="form-check form-check-inline  pl-3 ">
  <input class="form-check-input" type="radio" name="type"  <?php if($type == 'Rent') echo 'checked'; ?> id="exampleRadios2" value="Rent">
  <label class="form-check-label" for="exampleRadios2">
    Rent
  </label>
</div>
  <input type="submit" name="submit" class="btn btn-primary d-block mt-3 w-100  " value="Submit" />
</form>
</div>
</div>
</div>
</section>
<script src="js/jquery.slim.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/validate.js"></script>
</body>
</html>
?>