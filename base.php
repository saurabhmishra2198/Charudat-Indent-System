<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <title>Charusat</title>
  <script type="text/javascript">
    function check(clickedid) { 
      if (document.getElementById(clickedid).checked == false) {
        return false;
      } else {
       var box= confirm("Are you sure you want to submit form?");
        if (box==true)
            return true;
        else
           document.getElementById(clickedid).checked = false;
      }
    }

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
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark alert alert-dark">
  <a class="navbar-brand" href="home.php"><img src="charusat_logo.jpg" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
    Charusat</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="status.php">Status</a>
      </li>
      <!--<li class="nav-item active">
        <a class="nav-link" href="about.php">About</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="contact.php">Contact</a>
      </li>-->
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="mr-2 btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
    <!-- Button trigger modal -->
    <?php
      if(isset($_SESSION['User']))
      {
        echo "<div class='dropdown'>
        <button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
         Welcome ".$_SESSION['User']."
        </button>
        <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
          <a class='dropdown-item' href='ProfileUpdate.php'>Profile (Update)</a>
          <a class='dropdown-item' href='orderhistory.php'>Order History</a>
          <a class='dropdown-item' href='logout.php'>Logout</a>
        </div>
        </div>";
      }
      else
      {
        echo "<button type='button' class='mr-2 btn btn-primary' data-toggle='modal' data-target='#signup'>
        Sign Up
      </button>
      <button type='button' class='mr-2 btn btn-primary' data-toggle='modal' data-target='#signin'>
        Sign In
      </button>";

      }
    ?>
  </div>
</nav>
<hr>

