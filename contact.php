<?php ob_start(); ?>
<?php  session_start(); ?>
<?php include('base.php') ?>
<div class="container-fluid">
  <div class="container">
  <div class="row">
    <div class="col-md-8">
      <h3 class="text-center">Contact Us</h3>
      <form>
        <div class="form-group">
        <label for="name">Enter Your Name</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Full Name">
        </div>
        <div class="form-group">
        <label for="email">Enter Your Email</label>
        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Email">
        </div>
        <div class="form-group">
        <label for="phone">Enter Your Phone</label>
        <input type="phone" class="form-control" id="exampleFormControlInput1" placeholder="Phone Number">
        </div>        

        <div class="form-group">
        <label for="exampleFormControlTextarea1">Message</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
      </form>
    </div>
    <div class="col-md-4">
      <h3 class="text-center">Contact Information</h3>
      <div class="jumbotron jumbotron-fluid">
        <div class="container">
        <h5 class="display-6">Email: example@gmail.com</h5>
        <h5 class="display-6">Phone: xxxxxxxx</h5>
        </div>
      </div>
    </div>
  </div>
  </div>
</div>
<?php include('footer.php') ?>