<!doctype html>
<?php
include 'connect.php';
?>

<html>
<head>
<meta charset="utf-8">
<title>Beyaztop</title>
 
 <link rel="stylesheet" type="text/css" href="css/authenticate.css">

</head>
<body>
  <header>
		<a href="User-Home-page.php" class="logo"><img src="img/bg-img/Beyaztop-logo.png" alt=" Logo" width="130px" height="85px"></a>

		<ul class="navbar">
			<li ><a href="Home.php">Home</a></li>
     <li><a href="Bus-Shedules.php">Schedules</a></li>
    <li><a href="About.php">About</a></li>
    <li><a href="F&Q.php">F&Q</a></li>
		</ul>

		<div class="main">
			<div class="loginbtn"><button onClick="location.href='Login.php'">Sign In</button>
   <button onClick="location.href='Register.php'">Sign Up</button></div>
   
			<div  id="menu-icon"><img src="img/Icon/icons8-chevron-down-30.png" /></div>
		</div>
 
	</header>

	<!--js link--->
	<script type="text/javascript" src="js/Nav bar.js"></script>
 
<br><br><br><br><br><br><br><br>
<main> 
  <!-- login section starts  -->
 <div class="login-body">
      <div class="container">
        <div class="image"> <img src="img/bg-img/egor-litvinov-RlHI0cCNThY-unsplash.jpg"> </div>
        <div class="form-data">
            <form action="register_insert.php" method="post"  enctype="multipart/form-data">
                <h2 class="login-h2">Register</h2>
             
                <div class="box-input"> <input type="text" name="fname" placeholder="First Name" pattern="[a-z]{1,15}" title="Please enter valid name" required/> <label><i class="fas fa-user"></i></label> </div>
             
             <div class="box-input"> <input type="text" name="lname" placeholder="Last Name" pattern="[a-z]{1,15}" title="Please enter valid name" required/> <label><i class="fas fa-user"></i></label> </div>
             
             <div class="box-input"> <input type="email" name="email" placeholder="Email" pattern="[a-zA-Z0-9!#$%&amp;'*+\/=?^_`{|}~.-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*" title="Please enter valid email" required> <label><i class="fas fa-envelope"></i></label> </div>
             
             <div class="box-input"> <input type="text" name="phone" placeholder="Contact Number" maxlength="9" pattern="[+ 0-9]{9}" title="Please Enter 9 digit number without 0" required /> <label><i class="fa fa-phone"></i></label> </div>
             
             <div class="box-input"> <input type="password"  name="password" placeholder="Password" pattern=".{7,}" title="Seven or more characters" required/> <label><i class="fas fa-lock"></i></label> </div>
             
                <div class="box-input"> <input type="password" name="cpassword" placeholder="Confirm Password" pattern=".{7,}" title="Seven or more characters" required/> <label><i class="fas fa-lock"></i></label> </div> 
             <button class="form-btn">Sign up</button>
                <p class="form-p">Allready have an Account? <a href="Login.php">Sign in</a></p>
             
                <div class="social-media">
                 
                </div>
             
            </form>
        </div>
    </div>
 </div>
<br><br>
       
  <!-- login section ends  --> 
  
<!-- footer section starts  -->
<footer class="footer">
  <div class="container1">
    <div class="row">
      <div class="footer-col">
        <h4>company</h4>
        <ul>
          <li><a href="About.php">about us</a></li>
          <li><a href="https://www.sltb.lk/service.html">our services</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>get help</h4>
        <ul>
          <li><a href="F&Q.php">FAQ</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>Contact Us</h4>
        <ul>
          <li><a href="#">Sri Lanka Transport Board,</a></li>
          <li><a href="#">Head Office, No.200,</a></li>
          <li><a href="#">Kirula Road, Colombo 5,</a></li>
          <li><a href="#">Sri Lanka.</a></li>
          <li><a href="#">+94 112 581 120</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>Additional Links</h4>
        <ul>
          <li><a href="https://www.sltb.lk/vacancies.html">Vacancy</a></li>
          <li><a href="https://www.sltb.lk/Bus_fare.html">Inter bus fare</a></li>
          <li><a href="https://www.sltb.lk/network.html">Our Networks</a></li>
        </ul>
      </div>
    </div>
  </div>
  </div>
</footer>
<!-- footer section ends -->
</main>
</body>
</html>