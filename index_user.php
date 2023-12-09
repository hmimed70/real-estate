<?php
include("data_base.php");
$sql = "SELECT h.id, h.title, h.price, h.addresse, h.type, u.phone  FROM homes h , users u 
  WHERE h.user = u.id_user ORDER BY h.id";
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
  <header id="home">
    <div class="dark-overlay-home">
      <div class="home-inner container">
        <div class="row ">
          <div class="col-md-8 col-md-offset-2 intro-text m-auto">
            <h1>find the dream home!</h1>
            <p>Find the best homes in beireut with any price you want</p>
            <a href="#homes" id="btnHome" class="btn btn-custom btn-lg btn-scroll">Check Homes</a>
          </div>
        </div>
      </div>
    </div>
  </header>

  <section id="homes" class="text-center">
    <div class="container">
      <?php $count = mysqli_num_rows($result);
    ?>
      <h2 class="allhomes"> All Homes : (<?php echo $count ; ?>) </h2>
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