
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
</body>
<?php
include 'connect.php';
$email =mysqli_real_escape_string($connect, $_POST[ 'email' ]);
$password = mysqli_real_escape_string($connect, md5($_POST['password']) );

if($email==''){
 header( "location:login.php" );
}
$sql_userdatabase = "Select * from passenger where email = '$email' and password='$password' ";
$result_userdatabase = mysqli_query( $connect, $sql_userdatabase );

$sql_Admindatabase = "Select * from admin where email = '$email' and password='$password' ";
$result_Admindatabase = mysqli_query( $connect, $sql_Admindatabase );

if ( mysqli_num_rows( $result_userdatabase ) <= 0 & mysqli_num_rows( $result_Admindatabase ) <= 0 ) {
  ?>
<div class="dialog"></br>
  <h1 class="heading">Something went wrong</h1>
  </br>
  </br>
  </br>
  <div class="box-dialog">
    <div class="box"><img src="img/notifications/alert-danger-error-exclamation-mark-red-icon-227724.png" alt=""></br>
      </br>
      <h3>Your login credentials are invalid</h3>
      </br>
      <a href="Login.php" class="btn">Sign in again</a></br>
      </br>
    </div>
  </div>
</div>
<?php
} else {
  $row_userdatabase = mysqli_fetch_array( $result_userdatabase );
 $row_admindatabase = mysqli_fetch_array( $result_Admindatabase );

  if ( $row_userdatabase== true ) {
    header( "location:User/User-Home-Page.php" );
    session_start();
    $_SESSION[ 'email' ] = $email;
    $_SESSION[ 'fname' ] = $row_userdatabase[ 'First_Name' ];
    $_SESSION[ 'lname' ] = $row_userdatabase[ 'Last_Name' ];
    $_SESSION[ 'userid' ] = $row_userdatabase[ 'UserID' ];
    $_SESSION[ 'phone' ] = $row_userdatabase[ 'Phone' ];
    $_SESSION[ 'Joined_on' ] = $row_userdatabase[ 'Joined_on' ];
    $_SESSION[ 'log' ] = '1';
  }
    else if ( $row_admindatabase== true ) {
    header( "location:Admin/Admin-Home.php" );
    session_start();
    $_SESSION[ 'A_email' ] = $email;
    $_SESSION[ 'A_name' ] = $row_admindatabase[ 'First_Name' ];
    $_SESSION[ 'A_lname' ] = $row_admindatabase[ 'Last_Name' ];
    $_SESSION[ 'A_userid' ] = $row_admindatabase[ 'UserID' ];
    $_SESSION[ 'Admin_log' ] = '1';
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