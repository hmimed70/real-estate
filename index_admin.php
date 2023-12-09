

<html>
<head>
<title>List Users</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/main.css">
<link rel="stylesheet" href="./css/style.css">
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Raleway:100,200,400,500,600" rel="stylesheet" type="text/css">

<style>
    .mydisabled { 
        position: relative;
        display: block;
        padding: .5rem .75rem;
        margin-left: -1px;
        line-height: 1.25;
        color: #6c757d;
        pointer-events: none;
        cursor: auto;
        background-color: #fff;
        border-color: #dee2e6;
      }
	  .rateee{
        font-size: 18px;
		color: #023986;
        font-weight: bold;        
      }
      .rateee:hover{
        text-decoration: none;
        
      }
    </style>
</head>
<body >
    <?php include 'header_ad.php' ?>
<div class="container" style=" margin:50px auto 10px auto ;">

<h3 class="myMSG text-center p-3">List Of Users</h3>
<table class="table table-striped table-bordered table-responsive">
<thead>
<tr>
<th style='width:10%;'>ID</th>
    <th style='width:28%;'>Full Name</th>
    <th style='width:28%;'>Email</th>
    <th style='width:25%;'>Phone</th>
    <th style='width:20%;' scope="col" colspan="2" style="text-align:center;">OPERATION</th>
</tr>
</thead>
<tbody>
<?php
include('data_base.php');

if (isset($_GET['page_no']) && $_GET['page_no']!="") {
	$page_no = $_GET['page_no'];
	} else {
		$page_no = 1;
        }

	$total_records_per_page = 5;
    $offset = ($page_no-1) * $total_records_per_page;
	$previous_page = $page_no - 1;
	$next_page = $page_no + 1;
	$adjacents = "2"; 

	$result_count = mysqli_query($conn,"SELECT COUNT(*) As total_records FROM `users`");
	$total_records = mysqli_fetch_array($result_count);
	$total_records = $total_records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
	$second_last = $total_no_of_pages - 1; // total page minus 1

	$result = mysqli_query($conn,"SELECT * FROM users ORDER BY id_user  LIMIT $offset, $total_records_per_page"); 
	while($row = mysqli_fetch_array($result)){
		echo "<tr>
			  <td>".$row['id_user']."</td>
			  <td>".$row['fullName']."</td>
		   	  <td>".$row['email']."</td>
              <td>".$row['phone']."</td>

              ";?>

              <td class="text-center" >
              <a  onclick="return confirm('Do you want block this User ?')" href="<?php echo 'handle_block.php?id=' . $row["id_user"];?>" class=" btn btn-outline-danger mr-1  p-1">
              <?php 
               if($row['blocked'] == 'true') {
                echo 'Unblock';
               } 
               else {
                echo 'Block';
               }
              ?>
            </a>    
            </td>
		   	  </tr>
              <?php         }
	       mysqli_close($conn);
    ?>

</tbody>
</table>

<div style='padding: 10px 20px 0px; border-top: dotted 1px #CCC;'>
<strong > page <?php $page_no;?> of <?php $total_no_of_pages; ?></strong>
</div>

<ul class="pagination">
	<?php // if($page_no > 1){ echo "<li><a href='?page_no=1'>First Page</a></li>"; } ?>
    
	<li <?php if($page_no <= 1){ echo "class=' page-item mydisabled'"; } ?>>
	<a <?php if($page_no > 1){ echo "class='page-link' href='?page_no=$previous_page'"; } ?>>previous</a>
	</li>
       
    <?php 
	if ($total_no_of_pages <= 10){  	 
		for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
			if ($counter == $page_no) {
		   echo "<li class=' page-item active'><a class='page-link' >$counter</a></li>";	
				}else{
           echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
				}
        }
	}
	elseif($total_no_of_pages > 10){
		
	if($page_no <= 4) {			
	 for ($counter = 1; $counter < 8; $counter++){		 
			if ($counter == $page_no) {
		   echo "<li class=' page-item active'><a>$counter</a></li>";	
				}else{
           echo "<li class='page-item'><a class='page-link'  href='?page_no=$counter'>$counter</a></li>";
				}
        }
		echo "<li class='page-item'><a>...</a></li>";
		echo "<li class='page-item'><a class='page-link' href='?page_no=$second_last'>$second_last</a></li>";
		echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
		}

	 elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {		 
		echo "<li class='page-item'><a class='page-link' href='?page_no=1'>1</a></li>";
		echo "<li class='page-item'><a class='page-link'  href='?page_no=2'>2</a></li>";
        echo "<li class='page-item'><a class='page-link' >...</a></li>";
        for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {			
           if ($counter == $page_no) {
		   echo "<li class='page-item active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?page_no=$counter'>$counter</a></li>";
				}                  
       }
       echo "<li><a>...</a></li>";
	   echo "<li><a class='page-link'  href='?page_no=$second_last'>$second_last</a></li>";
	   echo "<li><a class='page-link' href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";      
            }
		
		else {
        echo "<li><a class='page-link' href='?page_no=1'>1</a></li>";
		echo "<li><a class='page-link' href='?page_no=2'>2</a></li>";
        echo "<li><a>...</a></li>";

        for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
          if ($counter == $page_no) {
		   echo "<li class='page-link active'><a>$counter</a></li>";	
				}else{
           echo "<li><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
				}                   
                }
            }
	}
?>
    
	<li <?php if($page_no >= $total_no_of_pages){ echo "class='page-item mydisabled'"; } ?>>
	<a <?php if($page_no < $total_no_of_pages) { echo " class='page-link' href='?page_no=$next_page'"; } ?>>Next Page</a>
	</li>
    <?php if($page_no < $total_no_of_pages){
		echo "<li><a class='page-link' href='?page_no=$total_no_of_pages'> Last &rsaquo;&rsaquo;</a></li>";
		} ?>
</ul>


<br /><br />
</div>
<script src="js/jquery.slim.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/validate.js"></script>
</body>
</html>