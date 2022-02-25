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
<h3 class="text-dark text-center">UPDATE INDENTED STATUS </h3>
<!--message show-->
<?php
  if(isset($_SESSION['msg']))
  {
    echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
    ".$_SESSION['msg']."
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
    </button>
    </div>";
  }
  else
  {
  	echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
    If you want to update something please click on update!
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
    </button>
    </div>";
  }
?>
<!--Status update-->
<?php
	ob_start();
	$con = mysqli_connect("localhost","root","","charusat");
	if(!$con)
	{
	    die("Connection to this database failed due to" .mysqli_connect_error());
	}	
	if(isset($_GET['sno']))
	{
		$sno = $_GET['sno'];
		$sql = "SELECT item_status FROM `user_indent2020` where sno = $sno";
		$result = mysqli_query($con,$sql);

		echo "<div class='container' style='max-width: 60%; margin:auto; padding: 34px;'>";
		echo "<form action='#' method='post'>";
		while($row = mysqli_fetch_array($result))
		{
			echo "<div class='form-group'>
            <select id='Istatus' class='form-control' name='Istatus' style='display: block;border:2px solid black;border-radius: 12px;outline: none;margin:2px 0px;padding: 7px;' select='selected' required>
            <option selected>".$row['item_status']."</option>
            <option value='Approved'>Approved</option>
            <option value='In progress'>In progress</option>
            <option value='Rejected'>Rejected</option>
            <option value='Delivered'>Delivered</option>
            </select>
    			</div>";
			
			echo "<center>
    			<button type='submit' name='update' id='update' class='btn btn-primary'>update</button>
  				</center>";
		}
		echo "</form>";
		echo "</div>";

		if(isset($_POST['update']))
		{
			$Istatus = $_POST['Istatus'];
			echo $Istatus;
			$query = "UPDATE `user_indent2020` SET `item_status`='$Istatus' WHERE sno=$sno";
			$r = mysqli_query($con,$query);

	      	//Admin replay after updating the status
	      	$query = "SELECT * FROM `user_indent2020` WHERE sno = $sno";
	      	$result = mysqli_query($con,$query);
	      	$count = mysqli_num_rows($result);
	      	$row = mysqli_fetch_array($result);
	      	if($count>0)
	      	{

	        
	        require 'PHPMailer/PHPMailerAutoload.php';
	      
	        //Create a new PHPMailer instance
	        $mail = new PHPMailer;   
	        $mail->isSMTP();
	        // change this to 0 if the site is going live
	        $mail->SMTPDebug = 0;
	        $mail->Debugoutput = 'html';
	        $mail->Host = 'ssl://smtp.gmail.com';
	        $mail->Port = 465;
	        $mail->SMTPSecure = 'ssl';
	        $mail->SMTPSecure = 'tls';

	        //use SMTP authentication
	        $mail->SMTPAuth = true;

	        //Username to use for SMTP authentication
	        $mail->Username = "rajvi0504215@gmail.com";
	        $mail->Password = "fywpebsnbvslbmvj";
	        $mail->setFrom("rajvi0504215@gmail.com", 'saurabh');
	       // $mail->addReplyTo($_POST['email'], 'Somebody');
	        $mail->addAddress($row['indent_email']);
	        //$mail->addCC('mishrasaurabh350@gmail.com');
	        $mail->Subject = $row['indent_purpose'];

	        // $msg is gotten from the form
	        $mail->msgHTML("Hii, Ordered By '".$row['indent_name']."' and Your order status is ".$Istatus);
	        $mail->AltBody = $row['indent_name'];

	        if (!$mail->send())
	        {
	          echo "We are extremely sorry to inform you that your message
	            could not be delivered,please try again.";
	        } 
	        else
	        {
	          echo "<script>alert('Your order was successfully delivered,you would be contacted shortly.');</script>";
	        }  
	      	}
	      	else
	      	{
	        	echo "<script>alert('Email not found');</script>";
	      	}
			if($r)
			{
				$_SESSION['msg'] = "Status updated successfully!";
				header('location: dashboard.php');
			}
			else
			{
				echo "<script>alert('Status not updated!');</script>";
			}
		}
	}
	ob_end_flush();
?>
<h3 class="text-dark text-center">All INDENTED DETAILS </h3>
<?php
	ob_start();
		$con = mysqli_connect("localhost","root","","charusat");
		if(!$con)
	    {
	      die("Connection to this database failed due to" .mysqli_connect_error());
	    }
	    $query = "SELECT * FROM `user_indent2020`";
	    $data = mysqli_query($con,$query);

	    echo "<table border='1'>";
	    echo"
	      <tr>
	      <th class='text-center'>ID</th>
	      <th class='text-center'>Name</th>
	      <th class='text-center'>Email</th>
	      <th class='text-center'>Phone</th>
	      <th class='text-center'>Department</th>
	      <th class='text-center'>Item name</th>
	      <th class='text-center'>Quantity</th>
	      <th class='text-center'>Purpose</th>
	      <th class='text-center'>Status</th>
	      <th class='text-center'>Date</th>
	      <th colspan = 2 class='text-center'>Action</th>
	    </tr>";
	    while($row = mysqli_fetch_array($data)) 
	    {
	      echo "<tr>
	        <th class='text-center'>$row[1]</th>
	        <td class='text-center'>$row[2]</td>
	        <td class='text-center'>$row[3]</td>
	        <td class='text-center'>$row[4]</td>
	        <td class='text-center'>$row[6]</td>
	        <td class='text-center'>$row[7]</td>
	        <td class='text-center'>$row[8]</td>
	        <td class='text-center'>$row[5]</td>
	        <td class='text-success'>$row[11]</td>
            <td class='text-center'>$row[10]</td>
	        <td class='text-center'><a href='dashboard.php?sno=".$row[0]."' type='button' class='btn btn-primary'>Update</a></td>
	        <td class='text-center'><a href='delete.php?sno=".$row[0]."' type='button' class='btn btn-primary'>Delete</a></td>
	      </tr>";
	    }
	    echo "</table>";

	    mysqli_close($con);
	ob_end_flush();
?>
</div>

<?php include('footer.php') ?>