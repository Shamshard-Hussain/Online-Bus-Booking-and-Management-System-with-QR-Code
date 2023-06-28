<!doctype html>
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
 
	</header><br><br><br><br><br><br><br>

	<!--js link--->
	<script type="text/javascript" src="js/Nav bar.js"></script>
    <main>
     
     <div class="FQ">
 
<div class="container2">
		<div class="contact-box">
			<div class="FQleft"></div>
			<div class="FQright">
  <form action="" method="post" enctype="multipart/form-data">
				<h2 class="fQ_h2">Contact Us</h2>
				<input type="text" class="field" name="name"  placeholder="Your Name" pattern="[a-z]{1,15}" title="Please enter valid name" required>
				<input type="email" class="field" name="email"  placeholder="Your Email" pattern="[a-zA-Z0-9!#$%&amp;'*+\/=?^_`{|}~.-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*" title="Please enter valid email"
     required>
    <input type="text" class="field" name="Pnumber" placeholder="Phone" maxlength="9" pattern="[+ 0-9]{9}" title="Please Enter 9 digit number without 0" required>
				<textarea placeholder="Message" name="feedback" class="field textarea" required></textarea>
    <input type="submit" name="submit" class="sendbtn" value="Send">
     </form>
			</div>
		</div>
	</div>
</div>
      <?php
if ( isset( $_POST[ 'submit' ] ) ) {
  include 'connect.php';

  $name = mysqli_real_escape_string( $connect, $_POST[ 'name' ] );
  $email = mysqli_real_escape_string( $connect, $_POST[ 'email' ] );
  $Pnumber = mysqli_real_escape_string( $connect, $_POST[ 'Pnumber' ] );
  $feedback = mysqli_real_escape_string( $connect, $_POST[ 'feedback' ] );

  if ( strlen( $name ) == 0 || strlen( $email ) == 0 || strlen( $feedback ) == 0 ) {

    ?>
<script>
         alert("Fields are empty!");
        </script>
<?php
} else if ( !preg_match( "/^[A-Za-z]+$/", $name ) ) {

  ?>
<script>
         alert("Please enter valid owner name!");
       </script>
<?php
} else if ( !preg_match( "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/", $email ) ) {

  ?>
<script>
         alert("Please enter valid email!");
       </script>
<?php
}else if ( !preg_match( "/^[0-9]*$/", $Pnumber ) ) {

  ?>
<script>
         alert("Please enter valid contact Number!");
       </script>
<?php
} else {

   
  /*--send Feedback--*/
   $sql_userdatabase = "Insert into feedback(Passenger_Name,Passenger_Email,Passenger_Phone,Inquries,Inquries_from) 
          values ('$name','$email' , '$Pnumber' ,'$feedback','outside')";


  if ( mysqli_query( $connect, $sql_userdatabase ) == true ) {
    echo "<script> alert('Message sent!');window.location.href='F&Q.php';</script>";
  } else {
    ?>
<script>
                alert("Faild to send Message");
              </script>
<?php
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