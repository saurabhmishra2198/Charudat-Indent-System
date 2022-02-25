<?php
session_start();

if($_SESSION['User'])
{
	session_unset();
	session_destroy();
	header("location: index.php");
}
else
{
	session_unset();
	session_destroy();
	header("location: admin.php");
}
exit();

?>