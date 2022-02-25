<?php ob_start(); ?>
<?php  session_start(); ?>
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
    $Phone = $_POST['Phone'];
    $dept = $_POST['dept'];
    $epass = $_POST['epass1'];
    $epass2 = $_POST['epass2'];
    

    if(preg_match("/^[0-9]{4}$/",$Phone))
    {
      $existquery = "SELECT * FROM `user2020` WHERE eid='$eid'";
      $result  =mysqli_query($con,$existquery);
      //$numExistRows = mysqli_num_rows($result);
      
      if(!$result || mysqli_num_rows($result) == 0){
        $exists=false;
      }
      else
      {
        $exists=true;
      }

      if(($epass == $epass2) && $exists==false)
      {
        $hass = password_hash($epass, PASSWORD_DEFAULT);
        $query = "INSERT INTO `user2020`(`emp_id`, `emp_name`, `emp_email`,`emp_exno`,`emp_dept`,`emp_password`, `date`)VALUES('$eid', '$ename', '$email','$Phone','$dept','$hass', current_timestamp())";

        if($con->query($query) == true)
        {
          $insert = true;
          $_SESSION['msg'] = "User Created Success & Please Login!";
          header('location:index.php');
        }
        else
        {
          $_SESSION['msg'] = "Password do not match or Username already exists.";
          header('location:signup.php');
        }
      }
      else
      {
        $_SESSION['msg'] = "Password do not match or Username already exists.";
        header('location:signup.php');
      }
    }
    else
    {
        $_SESSION['msg'] = "Enter only 4 digit Ext.no!";
        header('location:signup.php');
    }
    $con->close();
  }
  ob_end_flush();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Jekyll v4.1.1">
  <title>Charusat</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/sign-in/">

    <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

  <!-- JS, Popper.js, and jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
      <!-- Favicons -->
  <link rel="apple-touch-icon" href="/docs/4.5/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
  <link rel="icon" href="/docs/4.5/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
  <link rel="icon" href="/docs/4.5/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
  <link rel="manifest" href="/docs/4.5/assets/img/favicons/manifest.json">
  <link rel="mask-icon" href="/docs/4.5/assets/img/favicons/safari-pinned-tab.svg" color="#563d7c">
  <link rel="icon" href="/docs/4.5/assets/img/favicons/favicon.ico">
  <meta name="msapplication-config" content="/docs/4.5/assets/img/favicons/browserconfig.xml">
  <meta name="theme-color" content="#563d7c">


      <style>
        .bd-placeholder-img {
          font-size: 1.125rem;
          text-anchor: middle;
          -webkit-user-select: none;
          -moz-user-select: none;
          -ms-user-select: none;
          user-select: none;
        }

        @media (min-width: 768px) {
          .bd-placeholder-img-lg {
            font-size: 3.5rem;
          }
        }
      </style>
      <!-- Custom styles for this template -->
    <link rel="stylesheet" type="text/css" href="signin.css">
    
</head>
<body class="text-center">
<script type="text/javascript">
  function myphone()
  {
    var num = document.getElementById("Phone").value;
    if(isNaN(num))
    {
      alert("Only number are allowed in Ext.No!");
    }
    if(num.length<4)
    {
      alert("Ext.No must be 4 digit!");
    }
    if(num.length>4)
    {
      alert("Ext.No must be 4 digit!");
    }
  }
</script>
<form class="form-signin" action="#" method="post">
  <img class="mb-4" src="charusat_logo.jpg" alt="" width="72" height="72">
  <h1 class="h3 mb-3 font-weight-normal">User Register</h1>
  <?php
  if(isset($_SESSION['msg']))
  {
    echo "<p class='text-danger'>".$_SESSION['msg']."</p>";
  }
  else
  {
    echo "<p class='text-danger'>Welcome to Charusat Unversity</p>";
  }
  ?>
  <input type="text" name="eid" id="eid" placeholder="Enter employee id" class="form-control" style="margin-top: 4px;" required>
  <input type="text" name="ename" id="ename" placeholder="Enter employee name" class="form-control" style="margin-top: 4px;" required>
        
  <input type="email" name="email" id="email" placeholder="Enter employee email" class="form-control" style="margin-top: 4px;" required>
        
  <input type="text" name="Phone" id="Phone" placeholder="Enter employee Ext.No" class="form-control" style="margin-top: 4px;" onchange="myphone()" required>
  <select id="dept" class="form-control" name="dept" select="selected" style="margin-top: 4px;" required>
  <option selected>Select Your Department</option>
  <option value="CMPICA">CMPICA</option>
  <option value="PDIS">PDIS</option>
  <option value="RPCP">RPCP</option>
  <option value="IIIM">IIIM</option>
  <option value="Depstar">Depstar</option>
  </select>

  <input type="password" name="epass1" id="epass1" placeholder="Enter your password" class="form-control" style="margin-top: 4px;" required>      
  <input type="password" name="epass2" id="epass2" placeholder="Confirm password" class="form-control" style="margin-top: 4px;" required>
  <button class="btn btn-lg btn-primary btn-block" type="insertdata" name="insertdata">Sign up</button>
  <p class="mt-3 mb-2 text-muted"><a href="index.php">Sign in </a></p>
  <p class="mt-5 mb-3 text-muted">&copy; Charusat- 2020-2021</p>
</form>
</body>
</html>
