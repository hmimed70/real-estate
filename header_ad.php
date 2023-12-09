<?php
//include 'data_base.php';
include_once("session_ad.php");
if(checkSession()==false){
header('Location: login_admin.php');
}?>
<nav class="navbar navbar-expand-md bg-dark navbar-dark  fixed-top" id="main-nav">
    <div class="container">
      <h3><span class="blue">Real</span> Estate</h3>
      <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav m-auto ">
          <?php
          //include 'data_base.php';
          include_once("session_ad.php");
           if(checkSession()){   
        ?>
             <li class="nav-item">
            <a href="index_admin.php" class="nav-link nav-link-item">Home Page</a>
          </li>
          <?php } ?>
    
        </ul>
        <ul class="navbar-nav">
        <?php
          //include 'data_base.php';
          include_once("session_ad.php");
           if(checkSession()){   
        ?>
          <li class="nav-item  float-right">
            <a href="logout_admin.php" class="nav-link nav-link-item">Logout </a>
          </li>
       
          <?php } else { ?>
             
            <li class=" nav-item float-right">
            <a href="login_admin.php" class="nav-link nav-link-item">Login</a>
          </li>
          <li class="nav-item ml-md-3 float-right">
            <a href="signup_admin.php" class="nav-link nav-link-item">Sign up</a>
          </li>
        <?php  } ?>
       </ul>
      </div>
    </div>
  </nav>