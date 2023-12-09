<?php
session_start();
$emailErr = $passErr = $nameErr = $passConfirmErr = $phoneErr = "";

if($_SERVER['REQUEST_METHOD'] == 'POST')
{  
 if (isset($_POST['submit'])) {

    //validate inputs
    if(!preg_match ("/^[a-z A-z]*$/", $_POST['fullname'])) {
        $nameErr = "please input fullname in correct format";
    }
  if (empty($_POST["fullname"]) || strlen($_POST['fullname']) < 4  ) {
    $nameErr = "Name is to short";
  }
  
  if (empty($_POST["email"]) || strlen($_POST['email']) > 40 ) {
    $emailErr = "Email is required";
  }
  if (empty($_POST["password"]) || strlen($_POST["password"]) < 6 ) {
    $passErr = "password is to short";
  }
  if($_POST["password"] !== $_POST["confirmpassword"]){
      $passConfirmErr = "Password did not match ";
  }
  if (strlen($_POST["phone"]) >12 || $_POST['phone'] < 6) {
     $phoneErr = "Please put a valide phone number";
   }
   //if not empty inputs insert to database
   if(empty($emailErr) && empty($passErr) && empty($passConfirmErr) && empty($phoneErr) && empty($nameErr)) {
    include("data_base.php");
    $name =  mysqli_real_escape_string($conn,$_POST['fullname']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = strtolower($_POST['email']);
    $email =  mysqli_real_escape_string($conn,$email);
    $pass =  mysqli_real_escape_string($conn,$_POST['password']);
    //hash password
    $pass = md5($pass);  
    $check_email = mysqli_query($conn, "SELECT email FROM users where email = '$email' ");
    if(mysqli_num_rows($check_email) > 0){
     $emailErr = "Email already exist" ;
    }
    //if email not exist create the user account
    if(empty($emailErr)) {
        $query = "INSERT INTO users (fullName,email,pass_user,phone, blocked) ";
        $query.=" VALUES ('$name','$email','$pass','$phone', 'false')";
        if(mysqli_query($conn,$query)) {
            $id_user = mysqli_insert_id($conn);
            $_SESSION['user'] = $id_user;
            
            header("Location: index_user.php");
           }
           else die (mysqli_error($conn));
        } 
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
    <title>Register</title>
</head>

<body>
    <?php include 'header.php'; ?>
    <section class="home-form">
        <div class="dark-overlay">
            <div class="home-inner container">
                <div class="col-md-12 login-form-1 " style="float:none;margin:auto;">
                    <h3>Sign up</h3>
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                        <?php if(!empty($error)) {
                           echo " <div class='alert alert-danger' role='alert'> ";
                             echo $error;
                          echo "</div>";
                        }
                        ?>
                        <div class="row">
                            <div class="col-md-6 pr-3">
                                <div class="form-group">
                                    <label for="fullname">Full Name:</label>
                                    <input type="text" class="form-control shadow-none" name="fullname"
                                        placeholder="Your Name " maxlength="50" />
                                    <span class="error m-0" style="color: red;">
                                        <?php if(!empty($nameErr)) echo '* '.$nameErr;?></span>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control shadow-none" name="email"
                                        placeholder="Your Email " maxlength="40" />
                                    <span class="error m-0" style="color: red;">
                                        <?php if(!empty($emailErr)) echo '* '.$emailErr;?></span>

                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone :</label>
                                    <input type="number" class="form-control shadow-none" max name="phone"
                                        placeholder="Your phone " />
                                    <span class="error m-0" style="color: red;">
                                        <?php if(!empty($phoneErr)) echo '* '.$phoneErr;?></span>

                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Password:</label>
                                    <input type="password" name="password" class="form-control shadow-none"
                                        maxlength="30" placeholder="Your Password " />
                                    <span class="error m-0" style="color: red;">
                                        <?php if(!empty($passErr)) echo '* '.$passErr;?></span>

                                </div>
                                <div class="form-group">
                                    <label for="confirmpassword">Confirm password:</label>
                                    <input type="password" name="confirmpassword" maxlength="30"
                                        class="form-control shadow-none" placeholder="confirm password" />
                                    <span class="error m-0" style="color: red;">
                                        <?php if(!empty($passConfirmErr)) echo '* '.$passConfirmErr;?></span>

                                </div>

                                <div class="form-group text-center">
                                    <input type="submit" name="submit" class="btnSubmit p-2 mt-md-4 "
                                        value="Register" />
                                </div>
                            </div>
                            <div class="form-group ">
                                <span> Already have account ? <a href="login.php" class="signup-link">login here</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script src="js/jquery.slim.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script>
        $('form:not(.filter) :input:visible:enabled:first').focus();
    </script>
</body>

</html>