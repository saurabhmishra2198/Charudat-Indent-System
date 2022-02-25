<?php ob_start(); ?>
<?php  session_start(); ?>
<?php include('base.php') ?>

<div class="container">
<h3 class="text-dark text-center">UPDATE Item DETAILS </h3>
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
      			<input type='text' class='form-control' name='Iid' id='Iid' value='$row[1]' style='display: block;border:2px solid black;border-radius: 12px;outline: none;margin:2px 0px;padding: 7px;' required readonly/>
    			</div>";
			echo "<div class='form-group'>
      			<input type='text' class='form-control' name='Iname' id='Iname' value='$row[2]' style='display: block;border:2px solid black;border-radius: 12px;outline: none;margin:2px 0px;padding: 7px;' required readonly/>
    			</div>";
			echo "<div class='form-group'>
      			<input type='text' class='form-control' name='Iemail' id='Iemail' value='$row[3]' style='display: block;border:2px solid black;border-radius: 12px;outline: none;margin:2px 0px;padding: 7px;' required readonly/>
    			</div>";
			echo "<div class='form-group'>
      			<input type='text' class='form-control' name='Iphone' id='Phone' value='$row[4]' style='display: block;border:2px solid black;border-radius: 12px;outline: none;margin:2px 0px;padding: 7px;' onchange='myphone()' required/>
    			</div>";
			echo "<div class='form-group'>
			      <select id='Idept' class='form-control' name='Idept' style='display: block;border:2px solid black;border-radius: 12px;outline: none;margin:2px 0px;padding: 7px;'' select='selected' required/>
			        <option selected>$row[6]</option>
			        <option value='CMPICA'>CMPICA</option>
			        <option value='PDIS'>PDIS</option>
			        <option value='RPCP'>RPCP</option>
			        <option value='IIIM'>IIIM</option>
			        <option value='Depstar'>Depstar</option>
			        </select></div>";
			echo "<div class='form-group'>
      			<input type='text' class='form-control' name='Iitem' id='Iitem' value='$row[7]' style='display: block;border:2px solid black;border-radius: 12px;outline: none;margin:2px 0px;padding: 7px;' required/>
    			</div>";
			echo "<div class='form-group'>
      			<input type='text' class='form-control' name='Iqty' id='Iqty' value='$row[8]' style='display: block;border:2px solid black;border-radius: 12px;outline: none;margin:2px 0px;padding: 7px;' required/>
    			</div>";
			echo "<div class='form-group'>
      			<input type='text' class='form-control' name='Ipur' id='Ipur' value='$row[5]' style='display: block;border:2px solid black;border-radius: 12px;outline: none;margin:2px 0px;padding: 7px;' required/>
    			</div>";
			echo "<div class='form-group'>
            <input type='text' class='form-control' name='Istatus' id='Istatus' value='$row[11]' style='display: block;border:2px solid black;border-radius: 12px;outline: none;margin:2px 0px;padding: 7px;' required readonly>
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
			$Istatus = $_POST['Istatus'];
			if(preg_match("/^[0-9]{4}$/",$Iphone))
			{
				$query = "UPDATE `user_indent2020` SET `indent_id`='$Iid',`indent_name`='$Iname',`indent_email`='$Iemail',`indent_phone`='$Iphone',`indent_purpose`='$Ipur',`indent_dept`='$Idept',`indent_item`='$Iitem',`indent_qty`='$Iqty',`indent_isign`='$Isign',`item_status`='$Istatus',`date`=current_timestamp() WHERE sno=$sno";
				$r = mysqli_query($con,$query);
				if($r)
				{
	        		$_SESSION['msg'] = "Item updated successfully!";
					header('location: status.php');
				}
			    else
			    {
			      echo "<script> alert('Item not updated');</script>";
			    }
			}
			else
			{
				$_SESSION['msg'] = "Enter only 4 digit Ext.no!";
        		header('location:status.php');
			}

		}
	}
	ob_end_flush();
?>

</div>

<?php include('footer.php') ?>

