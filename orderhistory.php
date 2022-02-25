<?php ob_start(); ?>
<?php  session_start(); ?>
<?php include('base.php') ?>

<div class="container">
<!--Set Transaction ID-->
<h3 class="text-dark text-center">Your List of items</h3>
<?php
  ob_start();
  if(isset($_SESSION['User']))
  {
    $con = mysqli_connect("localhost","root","","charusat");
    if(!$con)
    {
      die("Connection to this database failed due to" .mysqli_connect_error());
    }
    $query = "SELECT * FROM `user_indent2020` WHERE indent_id = '".$_SESSION['User']."'";
    $data = mysqli_query($con,$query);
    echo "<div class='table-responsive-md'>";
    echo "<table class='table'>";
    echo"
      <tr>
      <th class='text-center'>EmpID</th>
      <th class='text-center'>Item name</th>
      <th class='text-center'>Quantity</th>
      <th class='text-center'>Purpose</th>
      <th class='text-center'>Status</th>
      <th class='text-center'>TransactionID</th>
      <th class='text-center'>Date</th>
    </tr>";
    while($row = mysqli_fetch_array($data)) 
    {
      echo "<tr>
      ";?>
      <?php 
      if($row[11]=='Approved' || $row[11]=='Rejected')
      {
	      echo"
	        <th class='text-center'>$row[1]</th>
	        <td class='text-center'>$row[7]</td>
	        <td class='text-center'>$row[8]</td>
	        <td class='text-center'>$row[5]</td>
	        <td class='text-success text-center'>$row[11]</td>";?>
	        <?php
	        	$sql = "SELECT tran_id FROM `indent_orders` WHERE `emp_id`='$row[1]' AND `date`='$row[10]'";
	        	$r = mysqli_query($con,$sql);
	        	$dr = mysqli_fetch_array($r);
	           echo "<td class='text-center'>$dr[0]</td>";
	        ?>
	        <?php echo "
	        <td class='text-center'>$row[10]</td>";
       }
       ?>
       <?php echo "
      </tr>";
    }
    echo "</table>";
    echo "</div>";
  }
?>
</div>

<?php include('footer.php') ?>