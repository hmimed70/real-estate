<?php
//include 'data_base.php';
include_once("session.php");
if(checkSession()==false){
    header("Location: login_user.php");
}?>
<?php
include("data_base.php");
$usssr = $_SESSION['user'];
$sql= '';
if (isset($_GET['search'])) {
  $input = $_GET['search'];
  $sql = "SELECT DISTINCT h.id, h.title, h.price, h.addresse, h.type, u.phone 
   from homes h , users u  where h.user = u.id_user and u.id_user = $usssr and (
    h.title like '%$input%' or h.price like '%$input%' or h.addresse like '%$input%'
    or h.type like '%$input%'or u.phone like '%$input%' )  ";
}
else {
$sql = "SELECT h.id, h.title, h.price, h.addresse, h.type, u.phone  FROM homes h , users u 
  WHERE h.user = u.id_user and u.id_user = $usssr ORDER BY h.id";
}
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="css/style.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link href="assets/fontsawesome/css/all.css" rel="stylesheet">
  <title>REAL ESTATE</title>
</head>

<body>
  <?php include 'header.php'; ?>

  <section id="homes" class="text-center">
    <div class="container">
    <form class="col-10 mt-5 text-center" action="my_homes.php" method="get"> 
    <div class="input-group">
  <input type="search" class="form-control rounded shadow-none" placeholder="Search" name="search" aria-label="Search" aria-describedby="search-addon" />
  <input type="submit" class="btn btn-primary shadow-none" value="Search" />
  <a href="my_homes.php" type="submit" class="btn btn-warning shadow-none ml-5" value="Show All" >Show All</a>

</div>
    </form>
      <?php $count = mysqli_num_rows($result);
    ?>
      <h2 class="allhomes mt-5" > My Homes : (<?php echo $count ; ?>) </h2>
      <?php if ($result->num_rows>0) {
      while($row = $result->fetch_assoc()) {
       $idHome = $row['id'];
       $sql1 = "SELECT imgName from images where  '$idHome' = home ";
       $result1 = $conn->query($sql1);
      ?>
      <div class="card col-12 my-3" style="">
        <?php if ($result1->num_rows>0) { ?>
        <div class="row p-0">
          <?php while($row1 = $result1->fetch_assoc()) { ?>
          <img class="float-left p-2 img-card" src="./uploads/<?php echo $row1['imgName']; ?>" style="width: 33.33%"
            alt="Card image cap">
          <?php } ?>
        </div>
        <?php } 
       else {
       echo  "<h3 class='card-header'>cannot load images</h3>";
       }
       ?>
        <div class="card-details d-flex flex-column">
          <div class="header d-flex justify-content-between">
            <div class="card-details-list d-flex flex-start">
              <p class="type mr-4">
                <?php  if($row["type"] === 'Sell'){                  
                  ?>
                <i class="fa-solid fa-circle text-danger"></i> <?php echo $row["type"] ?> </p>
              <?php  }else { ?>
              <i class="fa-solid fa-circle text-warning"></i> <?php echo $row["type"] ?> </p>
              <?php } ?>
              <p class="location text-primary"> <i
                  class="fa-solid fa-location-dot mr-2"></i><?php echo $row["addresse"] ?> </p>
            </div>
            <h2 class="home-price">$ <?php echo number_format($row["price"]) ;?></h2>
            <p class="home-phone text-primary"> <i class="fa-solid fa-mobile-screen mr-2"></i>
              <?php echo $row["phone"] ?></td>
            </p>
          </div>
          <div class="home-info d-flex flex-start">
            <h4 class="home-title pb-3"> <?php echo $row["title"]?></h4>
          </div>
          <div class="row mb-3 d-flex justify-content-center">
          <a class="btn btn-secondary mr-3 w-25" href=" <?php echo 'update_home.php?id='.$row["id"]; ?>">Update</a>
            <a class="btn btn-danger mr-3 w-25" href=" <?php echo 'delete_home.php?id='.$row["id"]; ?>" 
               onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
          </div>
        </div>
      </div>
      <?php }
      }  else{ 
      mysqli_error($conn);
     } ?>
    </div>
    <a href="#" class="to-top">
      <i class="fa-solid fa-chevron-up"></i>
    </a>
  </section>


  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/smooth-scroll.js"></script>

  <script>
    var scroll = new SmoothScroll('a[href*="#"]', {
      speed: 800
    });
    const toTop = document.querySelector(".to-top");

    window.addEventListener("scroll", () => {
      if (window.pageYOffset > 100) {
        toTop.classList.add("active");
      } else {
        toTop.classList.remove("active");
      }
    })
  </script>
</body>
</html>