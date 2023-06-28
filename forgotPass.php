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
			<li ><a href="Home.php"> Home </a></li>
     <li><a href="Bus-Shedules.php"> Schedules </a></li>
    <li><a href="About.php"> About </a></li>
    <li><a href="F&Q.php"> F&Q</a></li>
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
            <form action="" method="post"  enctype="multipart/form-data">
                <h2 class="login-h2">Reset Password </h2>
                <div class="box-input"> <input type="email" name="email" placeholder="Enter Email" pattern="[a-zA-Z0-9!#$%&amp;'*+\/=?^_`{|}~.-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*" title="Please enter valid email" required> <label><i class="fas fa-user"></i></label> </div>
             
                <div class="box-input"> <input type="password" name="password" placeholder="Enter New Password" pattern=".{7,}" title="Seven or more characters" required> 
                 <label><i class="fas fa-lock"></i></label> </div> 
             
                 <div class="box-input"> <input type="password" name="cpassword" placeholder="Confirm Password" pattern=".{7,}" title="Seven or more characters" required> 
                 <label><i class="fas fa-lock"></i></label> </div> 
                <button class="form-btn" type="submit" name="submit">Reset</button>
                <p class="form-p">Already have an Account? <a href="Login.php">Sign In</a></p>
                           
                <div class="social-media">
                 
                </div>
             
            </form>
        </div>
    </div>
 </div>
  <!-- login section ends  --> 
  <br><br>
 <?php
 if ( isset( $_POST[ 'submit' ] ) ) {
 $email = mysqli_real_escape_string($connect,$_POST[ 'email' ]);
 $password = mysqli_real_escape_string($connect, md5($_POST['password']) );
 $Cpassword = mysqli_real_escape_string($connect,md5($_POST['cpassword']));
 
 if ( strlen( $email ) == 0 || strlen( $password ) == 0 || strlen( $Cpassword ) == 0 ) {

?><script>alert("Fields are empty");</script><?php
} else if ( !preg_match( "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/", $email ) ) {
?><script>alert("Please enter valid email!");</script><?php
} else if ( strlen( $password ) < 6 ) {
?><script>alert("Password is too short!");</script><?php
} else if ( $password !== $Cpassword ) {
?><script>alert("Password is not matching!");</script><?php
}else{
  $select = mysqli_query($connect, "SELECT * FROM passenger WHERE Email = '$email'");
   if(!mysqli_num_rows($select)) {
   
     $select2 = mysqli_query($connect, "SELECT * FROM admin WHERE Email = '$email'");
    if(!mysqli_num_rows($select2)) {
    ?><script>alert("User didn't found!");</script><?php
    } else {
      $sql = "update admin set password='$password' Where Email='$email' ";
      $res = mysqli_query( $connect, $sql );
      if ( $res == true ) {
        ?><script>alert("Password reset successful");window.location.href='Login.php';</script><?php
      }else {
      ?><script>alert("Failed to reset password");</script><?php
      }
   }
    } else {
      $sql = "update passenger set password='$password' Where Email='$email' ";
      $res = mysqli_query( $connect, $sql );
      if ( $res == true ) {
        ?><script>alert("Password reset successful");window.location.href='Login.php';</script><?php
      }else {
      ?><script>alert("Failed to reset password");</script><?php
      }
   }
 }
}
 ?>
 

 
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