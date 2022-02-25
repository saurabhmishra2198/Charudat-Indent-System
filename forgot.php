<?php ob_start(); ?>
<?php  session_start(); ?>
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
      $mail->msgHTML("Hii, Your password link is http://localhost/casestudy/resetpass.php?pass=".$row['emp_password']);
      $mail->AltBody = $row['emp_password'];

      if (!$mail->send())
      {
        echo "We are extremely sorry to inform you that your message
          could not be delivered,please try again.";
      } 
      else
      {
        $_SESSION['msg']= "Your message was successfully delivered,you would be contacted shortly.";
        header('location:index.php');
      }  
    }
    else
    {
      echo "<script>alert('Email not found');</script>";
    }
  }
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
<form class="form-signin" action="#" method="post">
  <img class="mb-4" src="charusat_logo.jpg" alt="" width="72" height="72">
  <h1 class="h3 mb-3 font-weight-normal">Forgot Password</h1>
  <?php
    if(isset($_SESSION['msg']))
    {
      echo "<p class='text-danger'>".$_SESSION['msg']."</p>";
    }
    else
    {
        
    }
  ?>
  <label for="uname" class="sr-only">Employee email</label>
  <input type="email" name="passforgot" id="passforgot" placeholder="Enter employee email" class="form-control" required>

  <button class="btn btn-lg btn-primary btn-block" type="submit" name="forgot" style="margin-top: 18px;">Forgot password</button>
  <p class="mt-5 mb-3 text-muted">&copy; Charusat 2020-2021</p>
</form>
</body>
</html>
