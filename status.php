<?php ob_start(); ?>
<?php  session_start(); ?>
<?php include('base.php') ?>

<?php
  ob_start();
  if(isset($_POST['submit']))
  {
    $con = mysqli_connect("localhost","root","","charusat");
    if(!$con)
    {
      die("Connection to this database failed due to" .mysqli_connect_error());
    }
    if(isset($_SESSION['User']))
    {
      if(!empty($_POST['remember']))
      {
        $Iname = $_POST['Iname'];
        $Iemail = $_POST['Iemail'];
        $Iphone = $_POST['Iphone'];
        $Ipurpose = $_POST['Ipurpose'];
        $Idept = $_POST['Idept'];
        $Istatus = "Pending";
        $Item = count($_POST['item']);
        $file_name = $_FILES['Isign']['name'];
        $file_type = $_FILES['Isign']['type'];
        $file_size = $_FILES['Isign']['size'];
        $file_tmp_Loc = $_FILES['Isign']['tmp_name'];
        $file_store = "UploadSign/".$file_name;

        move_uploaded_file($file_tmp_Loc,$file_store);

        if($Item > 0)
        {
          for ($i=0; $i < $Item; $i++) 
          { 
            if(trim($_POST['item'][$i] != ''))
            {
              $sql = "INSERT INTO `user_indent2020` (`indent_id`, `indent_name`, `indent_email`, `indent_phone`, `indent_purpose`, `indent_dept`, `indent_item`, `indent_qty`, `indent_isign`, `date`,`item_status`) VALUES ('".$_SESSION['User']."', '$Iname', '$Iemail', '$Iphone', '$Ipurpose', '$Idept', '".mysqli_real_escape_string($con, $_POST["item"][$i])."', '".mysqli_real_escape_string($con, $_POST["qty"][$i])."', '$file_name',current_timestamp(),'$Istatus')";
              mysqli_query($con,$sql);
            }
          }

          $_SESSION['msg'] = "Data Inserted successfull!";
          //Order id genreate
          $query = "INSERT INTO `indent_orders`(`emp_id`, `tran_id`, `date`) VALUES ('".$_SESSION['User']."','".uniqid()."',current_timestamp())";
          mysqli_query($con,$query);

          //PHP mail User to Admin
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
          $mail->addCC('mishrasaurabh350@gmail.com');
          $mail->Subject = $Ipurpose;

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
          //echo "<script> alert('Please enter Item & Quantity')</script>";
          $_SESSION['msg'] = "Please enter Item & Quantity!";
        }
      }
      else
      {
        $_SESSION['msg'] = "Please checked the checkbox!";
        header("location: home.php");
      }
    }
    else
    {
      $_SESSION['msg'] = "Please login then send form!";
      header("location: index.php");
    }
    mysqli_close($con);
  }
  ob_end_flush();
?>

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
?>


<div class="container">
<!--Set Transaction ID-->
<h3 class="text-dark text-center">Your List of items and Your Last Transaction ID - 
<?php
  ob_start();
  if(isset($_SESSION['User']))
  {
    $con = mysqli_connect("localhost","root","","charusat");
    if(!$con)
    {
      die("Connection to this database failed due to" .mysqli_connect_error());
    }
    $query = "SELECT * FROM `indent_orders` WHERE `emp_id`='".$_SESSION['User']."'";
    $data = mysqli_query($con,$query);
    $row_fast = mysqli_fetch_array($data);
    mysqli_data_seek($data, (mysqli_num_rows($data)-1));
    if($row_last = mysqli_fetch_array($data))
    {
        echo $row_last['tran_id'];
    }
  }
?>
</h3>
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
      <th class='text-center'>Date</th>
      <th class='text-center' colspan =2>Action</th>
    </tr>";
    while($row = mysqli_fetch_array($data)) 
    {
      echo "<tr>
        <th class='text-center'>$row[1]</th>
        <td class='text-center'>$row[7]</td>
        <td class='text-center'>$row[8]</td>
        <td class='text-center'>$row[5]</td>
        <td class='text-success text-center'>$row[11]</td>
        <td class='text-center'>$row[10]</td>
        ";?>
        <?php
          if($row[11]=='Approved' || $row[11]=='Rejected' ||$row[11]=='Delivered' )
          {
            echo "<td class='text-center'><a href='update.php?sno=".$row[0]."' type='button' class='btn btn-primary disabled' >Update</a></td>
              <td class='text-center'><a href='delete.php?sno=".$row[0]."' type='button' class='btn btn-primary disabled'>Delete</a></td>
            ";
          }
          else
          {
            echo "<td class='text-center'><a href='update.php?sno=".$row[0]."' type='button' class='btn btn-primary'>Update</a></td>
                <td class='text-center'><a href='delete.php?sno=".$row[0]."' type='button' class='btn btn-primary'>Delete</a></td>
            ";
          }
        ?>
        <?php echo"
      </tr>";
    }
    echo "</table>";
    echo "</div>";
  }
?>
</div>

<?php include('footer.php') ?>