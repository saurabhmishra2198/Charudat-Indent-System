<?php ob_start(); ?>
<?php  session_start(); ?>
<?php include('base.php') ?>
<!--Update user profile-->

<div class="container">
<h3 class="text-dark text-center">UPDATE USER PROFILE DETAILS </h3>
<?php
	ob_start();
	$con = mysqli_connect("localhost","root","","charusat");
	if(!$con)
	{
	    die("Connection to this database failed due to" .mysqli_connect_error());
	}
	$empid = $_SESSION['User'];
	if(isset($empid))
	{
		$sql = "SELECT * FROM `user2020` where emp_id = $empid";
		$result = mysqli_query($con,$sql);

		echo "<div class='container' style='max-width: 60%; margin:auto; padding: 34px;'>";
		echo "<form action='#' method='post'>";
		while($row = mysqli_fetch_array($result))
		{
			echo "<div class='form-group'>
      			<input type='text' class='form-control' name='Iid' id='Iid' value='$row[1]' style='display: block;border:2px solid black;border-radius: 12px;outline: none;margin:2px 0px;padding: 7px;' required readonly/>
    			</div>";
			echo "<div class='form-group'>
      			<input type='text' class='form-control' name='Iname' id='Iname' value='$row[2]' style='display: block;border:2px solid black;border-radius: 12px;outline: none;margin:2px 0px;padding: 7px;' required />
    			</div>";
			echo "<div class='form-group'>
      			<input type='text' class='form-control' name='Iemail' id='Iemail' value='$row[3]' style='display: block;border:2px solid black;border-radius: 12px;outline: none;margin:2px 0px;padding: 7px;' required/>
    			</div>";
    		echo "<div class='form-group'>
      			<input type='text' class='form-control' name='Iphone' id='Phone' value='$row[4]' style='display: block;border:2px solid black;border-radius: 12px;outline: none;margin:2px 0px;padding: 7px;' onchange='myphone()' required/>
    			</div>";
			echo "<div class='form-group'>
			      <select id='Idept' class='form-control' name='Idept' style='display: block;border:2px solid black;border-radius: 12px;outline: none;margin:2px 0px;padding: 7px;'' select='selected' required/>
			        <option selected>$row[5]</option>
			        <option value='CMPICA'>CMPICA</option>
			        <option value='PDIS'>PDIS</option>
			        <option value='RPCP'>RPCP</option>
			        <option value='IIIM'>IIIM</option>
			        <option value='Depstar'>Depstar</option>
			        </select></div>";
			echo "<center>
    			<button type='submit' name='update' id='update' class='btn btn-primary'>update</button>
  				</center>";
		}
		echo "</form>";
		echo "</div>";

		if(isset($_POST['update']))
		{
			$Iname = $_POST['Iname'];
			$Iemail = $_POST['Iemail'];
			$Iphone = $_POST['Iphone'];
			$Idept = $_POST['Idept'];
			if(preg_match("/^[0-9]{4}$/",$Iphone))
			{
				$query = "UPDATE `user2020` SET `emp_name`='$Iname',`emp_email`='$Iemail',`emp_exno`='$Iphone',`emp_dept`='$Idept',`date`=current_timestamp() WHERE emp_id=$empid";
				$result= mysqli_query($con,$query);
				if($result)
				{
					$_SESSION['name'] = $Iname;
		            $_SESSION['email'] = $Iemail;
		            $_SESSION['phone'] = $Iphone;
					$_SESSION['msg'] = "Profile Updated successfully!";
					header('location: home.php');
				}
				else
				{
					$_SESSION['msg'] = "Profile not Updated! Try again!";
					header('location: ProfileUpdate.php');
				}
			}
			else
			{
				$_SESSION['msg'] = "Enter only 4 digit Ext.no!";
        		header('location:home.php');
			}
		}
	}
	ob_end_flush();
?>

</div>

<?php include('footer.php') ?>