<?php ob_start(); ?>
<?php  session_start(); ?>

<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <title>Charusat | Dashboard</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark alert alert-dark">
  <a class="navbar-brand" href="dashboard.php"><img src="charusat_logo.jpg" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
    Charusat</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="dashboard.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Visite site <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="users.php">Users</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="mr-2 btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
    <!-- Button trigger modal -->
    <?php
      if(isset($_SESSION['AdminUser']))
      {
        echo "<div class='dropdown'>
        <button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
         Welcome ".$_SESSION['AdminUser']."
        </button>
        <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
          <a class='dropdown-item' href='logout.php'>Logout</a>
        </div>
        </div>";
      }
      else
      {
        
      }
    ?>
  </div>
</nav>
<hr>

<div class="container">
<h3 class="text-dark text-center">All USERS DETAILS </h3>
<?php
	ob_start();
		$con = mysqli_connect("localhost","root","","charusat");
		if(!$con)
	    {
	      die("Connection to this database failed due to" .mysqli_connect_error());
	    }
	    $query = "SELECT * FROM `user2020`";
	    $data = mysqli_query($con,$query);
	    echo "<div class='table-responsive-md'>";
	    echo "<table class='table'>";
	    echo"
	      <tr>
	      <th class='text-center'>Sno</th>
	      <th class='text-center'>EmpID</th>
	      <th class='text-center'>Name</th>
	      <th class='text-center'>Email</th>
	      <th class='text-center'>Department</th>
	      <th class='text-center'>Date</th>
	      <th colspan = 2 class='text-center'>Action</th>
	    </tr>";
	    while($row = mysqli_fetch_array($data)) 
	    {
	      echo "<tr>
	        <th class='text-center'>$row[0]</th>
	        <td class='text-center'>$row[1]</td>
	        <td class='text-center'>$row[2]</td>
	        <td class='text-center'>$row[3]</td>
	        <td class='text-center'>$row[5]</td>
	        <td class='text-center'>$row[7]</td>
	        <td class='text-center'><a href='delete.php?sno=".$row[0]."' type='button' class='btn btn-primary'>Delete</a></td>
	      </tr>";
	    }
	    echo "</table>";
	    echo "</div>";

	    mysqli_close($con);
	ob_end_flush();
?>
</div>

<?php include('footer.php') ?>
