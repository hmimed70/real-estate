<?php
$error = '';
session_start();
$emailErr = $passErr = "";

if($_SERVER['REQUEST_METHOD'] == 'POST')
{  
 if (isset($_POST['submit'])) {

  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  }
  if (empty($_POST["password"]) || strlen($_POST["password"]) < 6 ) {
    $passErr = "password is to short";
  }
  // if not error
   if(empty($emailErr) && empty($passErr)) {
       include("data_base.php");
       $email =  mysqli_real_escape_string($conn,$_POST['email']);
       $pass =  mysqli_real_escape_string($conn,$_POST['password']);
       $pass = md5($pass);  
   
       $result = mysqli_query($conn,"SELECT * FROM users  WHERE email = '$email' and pass_user = '$pass' ");
       // if user exist in database
       if(mysqli_num_rows($result)>0)
       {
           $row = mysqli_fetch_array($result);
           //store id of user in session for verify is authenticate or not  
           $blocked = $row['blocked'];
           if($blocked=='true'){
            $error = "you are blocked from using the System ";
           }
           else {
             $_SESSION['user'] = $row['id_user'];
             // redirect user to main page
             header("Location: index_user.php");
           }
       }
       else
       { $error = "incorrect email or password ";}
   }
}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="css/style.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <title>Login User</title>
</head>

<body>
  <?php include 'header.php'; ?>
  <section class="home-form">
    <div class="dark-overlay">
      <div class="home-inner container">
        <div class="col-md-6  login-form-1" style="float:none;margin:auto;">
          <h3>Welcome To Real Estat</h3>
          <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <img src="images/home.jpg" class="img-logo mb-3" />
            <div class="form-group">
              <label for="email">Email:</label>
              <input type="email" class="form-control shadow-none" name="email" id="email" placeholder="Your Email " />
              <span class="error" style="color: red;"> <?php if(!empty($emailErr)) echo '* '.$emailErr;?></span>
            </div>
            <div class="form-group">
              <label for="password">Password:</label>
              <input type="password" name="password" id="password" class="form-control shadow-none"
                placeholder="Your Password *" value="" />
              <span class="error" style="color: red;"> <?php if(!empty($passErr))  echo '* '.$passErr;?></span>
            </div>
            <div class="form-group text-center">
              <input type="submit" name="submit" id="submitBtn" class="btnSubmit m-auto" value="Login" />
            </div>
            <div class="form-group">
              <span> you didn't have account ? <a href="signup_user.php" class="signup-link">sign up here</a>
            </div>
            <?php if(!empty($error)) {
                           echo " <div class='alert alert-danger' role='alert'> ";
                             echo $error;
                          echo "</div>";
                        
                        }
                        ?>
          </form>
        </div>
      </div>
    </div>
  </section>
  <script src="js/jquery.slim.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script>
    //focused keyboard on first input 
    $('form:not(.filter) :input:visible:enabled:first').focus();
  </script>
</body>

</html>