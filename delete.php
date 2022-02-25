<?php ob_start(); ?>
<?php  session_start(); ?>
<?php
	ob_start();
	$con = mysqli_connect("localhost","root","","charusat");
	if(!$con)
	{
	    die("Connection to this database failed due to" .mysqli_connect_error());
	}
	$sno = $_GET['sno'];
	if(isset($_SESSION['User']))
	{
		$sql = "delete from `user_indent2020` where sno = $sno";
		$result = mysqli_query($con,$sql);
		if($result)
		{
			$_SESSION['msg'] = "Recode deleted successfully!";
			header("location: status.php");
		}
	}
	else
	{
		$sql = "delete from `user_indent2020` where sno = $sno";
		$result = mysqli_query($con,$sql);
		if($result)
		{
			$_SESSION['msg'] = "Recode deleted successfully!";
			header("location: dashboard.php");
		}
	}
	mysqli_close($con);
	ob_end_flush();
?>