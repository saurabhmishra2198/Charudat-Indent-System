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
        <a class="nav-link" href="dashboard.php">Home<span class="sr-only">(current)</span></a>
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
<h3 class="text-dark text-center">UPDATE INDENTED DETAILS </h3>
<?php
	ob_start();
	$con = mysqli_connect("localhost","root","","charusat");
	if(!$con)
	{
	    die("Connection to this database failed due to" .mysqli_connect_error());
	}
	$sno = $_GET['sno'];
	if(isset($sno))
	{
		$sql = "SELECT * FROM `user_indent2020` where sno = $sno";
		$result = mysqli_query($con,$sql);

		echo "<div class='container' style='max-width: 60%; margin:auto; padding: 34px;'>";
		echo "<form action='#' method='post'>";
		while($row = mysqli_fetch_array($result))
		{
			echo "<div class='form-group'>
      			<input type='text' class='form-control' name='Iid' id='Iid' value='$row[1]' style='display: block;border:2px solid black;border-radius: 12px;outline: none;margin:2px 0px;padding: 7px;'/>
    			</div>";
			echo "<div class='form-group'>
      			<input type='text' class='form-control' name='Iname' id='Iname' value='$row[2]' style='display: block;border:2px solid black;border-radius: 12px;outline: none;margin:2px 0px;padding: 7px;'/>
    			</div>";
			echo "<div class='form-group'>
      			<input type='text' class='form-control' name='Iemail' id='Iemail' value='$row[3]' style='display: block;border:2px solid black;border-radius: 12px;outline: none;margin:2px 0px;padding: 7px;'/>
    			</div>";
			echo "<div class='form-group'>
      			<input type='text' class='form-control' name='Iphone' id='Iphone' value='$row[4]' style='display: block;border:2px solid black;border-radius: 12px;outline: none;margin:2px 0px;padding: 7px;'/>
    			</div>";
			echo "<div class='form-group'>
      			<input type='text' class='form-control' name='Idept' id='Idept' value='$row[6]' style='display: block;border:2px solid black;border-radius: 12px;outline: none;margin:2px 0px;padding: 7px;'/>
    			</div>";
			echo "<div class='form-group'>
      			<input type='text' class='form-control' name='Iitem' id='Iitem' value='$row[7]' style='display: block;border:2px solid black;border-radius: 12px;outline: none;margin:2px 0px;padding: 7px;'/>
    			</div>";
			echo "<div class='form-group'>
      			<input type='text' class='form-control' name='Iqty' id='Iqty' value='$row[8]' style='display: block;border:2px solid black;border-radius: 12px;outline: none;margin:2px 0px;padding: 7px;'/>
    			</div>";
			echo "<div class='form-group'>
      			<input type='text' class='form-control' name='Ipur' id='Ipur' value='$row[5]' style='display: block;border:2px solid black;border-radius: 12px;outline: none;margin:2px 0px;padding: 7px;'/>
    			</div>";
			echo "<div class='form-group'>
            <select id='Istatus' class='form-control' name='Istatus' style='display: block;border:2px solid black;border-radius: 12px;outline: none;margin:2px 0px;padding: 7px;' select='selected'>
            <option selected>$row[11]</option>
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
			$Iid = $_POST['Iid'];
			$Iname = $_POST['Iname'];
			$Iemail = $_POST['Iemail'];
			$Iphone = $_POST['Iphone'];
			$Idept = $_POST['Idept'];
			$Iitem = $_POST['Iitem'];
			$Iqty = $_POST['Iqty'];
			$Ipur = $_POST['Ipur'];
			$Isign = $_POST['Isign'];
			$Istatus = $_POST['Istatus'];
			$query = "UPDATE `user_indent2020` SET `indent_id`='$Iid',`indent_name`='$Iname',`indent_email`='$Iemail',`indent_phone`='$Iphone',`indent_purpose`='$Ipur',`indent_dept`='$Idept',`indent_item`='$Iitem',`indent_qty`='$Iqty',`indent_isign`='$Isign',`item_status`='$Istatus', `date`=current_timestamp() WHERE sno=$sno";
			$r = mysqli_query($con,$query);

      //Admin replay after updating the status
      $query = "SELECT * FROM `user_indent2020` WHERE indent_id = '$Iid'";
      $result = mysqli_query($con,$query);
      $count = mysqli_num_rows($result);
      //$row = mysqli_fetch_array($result);
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
        $mail->addAddress($Iemail);
        //$mail->addCC('mishrasaurabh350@gmail.com');
        $mail->Subject = $Ipur;

        // $msg is gotten from the form
        $mail->msgHTML("Hii, Ordered By '".$Iname."' and Your order status is ".$Istatus);
        $mail->AltBody = $Iname;

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
				header('location: dashboard.php');
			}
		}
	}
	ob_end_flush();
?>

</div>

<?php include('footer.php') ?>

