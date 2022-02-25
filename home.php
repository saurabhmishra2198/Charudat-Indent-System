<?php ob_start(); ?>
<?php  session_start(); ?>
<?php include('base.php') ?>
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
<img src="charusat_back.jpg" alt="charusat" style="width: 100%;position: absolute;z-index: -1;opacity: 0.5;">

<div class="container" style="max-width: 60%; margin:auto; padding: 34px;">
  <h1 class="text-center"><i>Welcome to Charotar University</i></h1>
  <p class="submitmsg text-center text-success">Thank you for Visiting Charusat.  </p>
  <form action="status.php" method="post" enctype="multipart/form-data" name="add_item" id="add_item">
    <div class="form-group">
      <?php
      if(isset($_SESSION['name']))
      {
        echo "<label for='name' style='font-size: 22px;font-style: italic;'>Name of Indenter</label>
        <input type='text' class='form-control' name='Iname' id='Iname' value='".$_SESSION['name']."' placeholder='Name' style='display: block;border:2px solid black;border-radius: 12px;outline: none;margin:2px 0px;padding: 7px;' required readonly>";
      }
      else
      {
        echo "<label for='name' style='font-size: 22px;font-style: italic;'>Name of Indenter</label>
        <input type='text' class='form-control' name='Iname' id='Iname' placeholder='Name' style='display: block;border:2px solid black;border-radius: 12px;outline: none;margin:2px 0px;padding: 7px;'>";
      }
      ?>
    </div>
    <div class="form-row">
    <div class="form-group col-md-6">
      <?php
      if(isset($_SESSION['email']))
      {
        echo "<label for='email' style='font-size: 22px;font-style: italic;'>Email:</label>
        <input type='email' class='form-control' name='Iemail' id='Iemail' value='".$_SESSION['email']."' placeholder='Email' style='display: block;border:2px solid black;border-radius: 12px;outline: none;margin:2px 0px;padding: 7px;' required readonly>";
      }
      else
      {
        echo "<label for='email' style='font-size: 22px;font-style: italic;'>Email:</label>
        <input type='email' class='form-control' name='Iemail' id='Iemail' placeholder='Email' style='display: block;border:2px solid black;border-radius: 12px;outline: none;margin:2px 0px;padding: 7px;'>";
      }
      ?>
    </div>
    <div class="form-group col-md-6">
      <?php
      if(isset($_SESSION['phone']))
      {
        echo "<label for='Phone' style='font-size: 22px;font-style: italic;'>Ext. no:</label>
        <input type='phone' class='form-control' name='Iphone' id='Iphone' value='".$_SESSION['phone']."' placeholder='Phone' style='display: block;border:2px solid black;border-radius: 12px;outline: none;margin:2px 0px;padding: 7px;' readonly required>";
      }
      else
      {
        echo "<label for='Phone' style='font-size: 22px;font-style: italic;'>Ext. no:</label>
        <input type='phone' class='form-control' name='Iphone' id='Iphone' placeholder='Phone' style='display: block;border:2px solid black;border-radius: 12px;outline: none;margin:2px 0px;padding: 7px;' required>";
      }
      ?>
    </div>
    </div>
    <div class="form-row">
    <div class="form-group col-md-6">
      <label for="Purpose" style="font-size: 22px;font-style: italic;">Purpose:</label>
        <input type="text" class="form-control" name="Ipurpose" id="Ipurpose" placeholder="Purpose" style="display: block;border:2px solid black;border-radius: 12px;outline: none;margin:2px 0px;padding: 7px;" required>
    </div>
    <div class="form-group col-md-6">
      <label for="Department" style="font-size: 22px;font-style: italic;">Department:</label>
      <select id="Idept" class="form-control" name="Idept" style="display: block;border:2px solid black;border-radius: 12px;outline: none;margin:2px 0px;padding: 7px;" select="selected" required>
        <option selected>Select Your Department</option>
        <option value="CMPICA">CMPICA</option>
        <option value="PDIS">PDIS</option>
        <option value="RPCP">RPCP</option>
        <option value="IIIM">IIIM</option>
        <option value="Depstar">Depstar</option>
        </select>
    </div>
    </div>
    <div class="form-row" id="dynamic_field">
    <div class="form-group col-md-6">
      <label for="item" style="font-size: 22px;font-style: italic;">Item Name</label>
      <input type="text" class="form-control" name="item[]" placeholder="Item Name" style="display: block;border:2px solid black;border-radius: 12px;outline: none;margin:2px 0px;padding: 7px;" required>
    </div>
    <div class="form-group col-md-4">
      <label for="Quantity" style="font-size: 22px;font-style: italic;">Quantity</label>
      <input type="number" class="form-control" name="qty[]" id="Quantity" placeholder="Quantity" style="display: block;border:2px solid black;border-radius: 12px;outline: none;margin:2px 0px;padding: 7px;" required>
    </div>
    <div class="form-group col-md-2">
      <button type="button" name="add" id="add" class="btn btn-secondary" style="margin-top:41px;">Add Item</button>
    </div>
  </div>
  <div class="form-row">
  <div class="form-group col-md-4">
    <label for="Prepared" style="font-size: 22px;font-style: italic;text-align: center;">Sign Prepared By</label>
    <input type="file" class="form-control-file" name="Isign" id="Isign" style="display: block;border:2px solid black;border-radius: 12px;outline: none;margin:2px 0px;padding: 7px;" required>
  </div>
  </div>
  <div class="form-group">
      <center><div class="form-check">
        <input type="checkbox" class="form-check-input" id="remember" name="remember" onchange="check('remember')">
        <label class="form-check-label" for="dropdownCheck">
          Remember
        </label>
      </div></center>
  </div>
  <center>
    <button type="submit" name="submit" id="submit" class="btn btn-secondary">Submit</button>
  </center>
  </form>
</div>

<!-- Sign Up Modal -->
<?php
  ob_start();
  $insert = false;
  if(isset($_POST['insertdata']))
  {
    $con = mysqli_connect("localhost","root","","charusat");
    if(!$con){
      die("Connection to this database failed due to" .mysqli_connect_error());
    }
    $eid = $_POST['eid'];
    $ename = $_POST['ename'];
    $email = $_POST['email'];
    $dept = $_POST['dept'];
    $epass = $_POST['epass1'];
    $epass2 = $_POST['epass2'];

    $existquery = "SELECT * FROM `user2020` WHERE eid='$eid'";
    $result  =mysqli_query($con,$existquery);
    $numExistRows = mysqli_num_rows($result);
    
    if($numExistRows > 0)
    {
      $exists=true;
    }
    else
    {
      $exists=false;
    }

    if(($epass == $epass2) && $exists==false)
    {
      $hass = password_hash($epass, PASSWORD_DEFAULT);
      $query = "INSERT INTO `user2020`(`emp_id`, `emp_name`, `emp_email`,`emp_dept`,`emp_password`, `date`)VALUES('$eid', '$ename', '$email','$dept','$hass', current_timestamp())";

      if($con->query($query) == true)
      {
        $insert = true;
        $_SESSION['msg'] = "User Created Success & Please Login!";
        header('location:index.php');
      }
      else
      {
        //echo "ERROR: $sql <br> $con->error";
        //echo '<script> alert("Password do not match or Username already exists.");</script>';
        $_SESSION['msg'] = "Password do not match or Username already exists.";
        header('location:index.php');
      }
    }
    $con->close();
  }
  ob_end_flush();
?>
<div class="modal fade" id="signup" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Sign Up Here</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="index.php" method="post">
      <div class="modal-body">
        <input type="text" name="eid" id="eid" placeholder="Enter employee id" class="form-control" required>
        <br>
        <input type="text" name="ename" id="ename" placeholder="Enter employee name" class="form-control" required>
        <br>
        <input type="email" name="email" id="email" placeholder="Enter employee email" class="form-control" required>
        <br>
        <select id="dept" class="form-control" name="dept" select="selected" required>
          <option selected>Select Your Department</option>
          <option value="CMPICA">CMPICA</option>
          <option value="PDIS">PDIS</option>
          <option value="RPCP">RPCP</option>
          <option value="IIIM">IIIM</option>
          <option value="Depstar">Depstar</option>
        </select>
        <br>
        <input type="password" name="epass1" id="epass1" placeholder="Enter your password" class="form-control" required>
        <br>
        <input type="password" name="epass2" id="epass2" placeholder="Conform password" class="form-control" required>
      </div>
      <div class="modal-footer">
        <button type="submit" name="insertdata" class="btn btn-primary">Sign Up</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Sign In Modal -->
<?php
  ob_start();
  if(isset($_POST['getuser']))
  {
      $con = mysqli_connect("localhost","root","","charusat");

      if(!$con){
        die("Connection to this database failed due to" .mysqli_connect_error());
      }

      $username = $_POST['emplogin'];
      $password = $_POST['epass'];
      $query = "SELECT * FROM `user2020` WHERE emp_id = '$username'";
      $result = mysqli_query($con, $query);
      $num = mysqli_num_rows($result);
      if($num ==1)
      {
        while($row=mysqli_fetch_assoc($result))
        {
          if(password_verify($password, $row['emp_password']))
          {
            $_SESSION['User'] = $username;
            $_SESSION['name'] = $row['emp_name'];
            $_SESSION['email'] = $row['emp_email'];
            $_SESSION['msg'] = "Login Success!";
            header("location: index.php");
          }
          else
          {
            $_SESSION['msg'] = "Please enter correct username and password!";
            header("location: index.php");
          }
        }
      }
      else
      {
        //echo '<script> alert("Please enter correct username and password");</script>';
        $_SESSION['msg'] = "Please enter correct username and password!";
        header("location: index.php");
      }
      mysqli_close($con);
  }
  ob_end_flush();
?>
<div class="modal fade" id="signin" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Sign In Here</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="index.php" method="POST">
      <div class="modal-body">
        <input type="text" name="emplogin" id="emplogin" placeholder="Enter employee id" class="form-control" required>
        <br>
        <input type="password" name="epass" id="epass" placeholder="Enter your password" class="form-control" required>
      </div>
      <div class="modal-footer">
        <button type='button' class='mr-2 btn btn-primary' data-toggle='modal' data-target='#forgot'>
        Forgot password
      </button>
        <button type="submit" name="getuser" class="btn btn-primary">Sign In</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!--Forgot password model-->
<?php
  ob_start();
  if(isset($_POST['forgot']))
  {

    $con = mysqli_connect("localhost","root","","charusat");
    if(!$con)
    {
      die("Connection to this database failed due to" .mysqli_connect_error());
    }
    $email = $_POST['passforgot'];
    $query = "SELECT * FROM `user2020` WHERE `emp_email`='$email'";
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
      $mail->addAddress($email);
      $mail->Subject = 'Forgot-password';

      // $msg is gotten from the form
      $mail->msgHTML("Hii, Your password is ".$row['emp_password']);
      $mail->AltBody = $row['emp_password'];

      if (!$mail->send())
      {
        echo "We are extremely sorry to inform you that your message
          could not be delivered,please try again.";
      } 
      else
      {
        echo "Your message was successfully delivered,you would be contacted shortly.";
      }  
    }
    else
    {
      echo "<script>alert('Email not found');</script>";
    }
  }
?>
<div class="modal fade" id="forgot" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Forgot Password Here</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="index.php" method="post">
      <div class="modal-body">
        <input type="email" name="passforgot" id="passforgot" placeholder="Enter employee email" class="form-control" required>
      </div>
      <div class="modal-footer">
        <button type="submit" name="forgot" class="btn btn-primary">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>

<?php include('footer.php') ?>

<script>  
 $(document).ready(function(){  
      var i=1;  
      $('#add').click(function(){  
           i++;  
           $('#dynamic_field').append(' <div class="form-row" id="row'+i+'"><div class="form-group col-md-6"><label for="item" style="font-size: 22px;font-style: italic;">Item Name</label><input type="text" class="form-control" name="item[]" placeholder="Item Name" style="display: block;border:2px solid black;border-radius: 12px;outline: none;margin:2px 0px;padding: 7px;"></div><div class="form-group col-md-4"><label for="Quantity" style="font-size: 22px;font-style: italic;">Quantity</label><input type="number" class="form-control" name="qty[]" id="Quantity" placeholder="Quantity" style="display: block;border:2px solid black;border-radius: 12px;outline: none;margin:2px 0px;padding: 7px;"></div><div class="form-group col-md-2"><button type="button" name="add" id="'+i+'" class="btn btn-danger btn_remove" style="margin-top:41px;">X</button></div></div>');
      });  
      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  
      $('#submit').click(function(){            
           $.ajax({  
                url:"index.php",  
                method:"POST",  
                data:$('#add_name').serialize(),  
                success:function(data)  
                {  
                     alert(data);  
                     $('#add_name')[0].reset();  
                }  
           });  
      });  
 });  
 </script>