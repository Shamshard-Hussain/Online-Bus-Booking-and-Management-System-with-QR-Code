
<style type="text/css">
/* Basic styling */
* {
 box-sizing: border-box;
 padding: 0;
 margin: 0;
  list-style: none;
    text-decoration: none;
 
}
body {
 font-family: sans-serif;
   background-color: #eaedf5;
}
 /*--navbar__*/
 header{
	position: fixed;
	width: 100%;
	top: 0;
	right: 0;
	z-index: 1000;
	display: flex;
	align-items: center;
	justify-content: space-between;
	background-color: #222327;
	padding: 8px 9%;
	transition: all .50s ease;
 border-style: solid;
  border-width: 10px;
  border-color: #eaedf5;
}
.logo{
	display: flex;
	align-items: center;
}
.logo i{
	color: #71b7e6;
	font-size: 28px;
	margin-right: 3px;
}

.navbar{
	display: flex;
}
.navbar a{
	color: #fff;
	font-size: 1.3rem;
	padding: 5px 0;
	margin: 0px 30px;
	transition: all .50s ease;
 border-style: solid;
border-bottom-color: #87CEEB;
 border-top-color: #222327;
 border-left-color: #222327;
 border-right-color: #222327;
 
}
.navbar a:hover{
	color: #71b7e6;
}
.navbar a.active{
	color: #71b7e6;
}
.main{
	display: flex;
	align-items: center;
}
.main a{
	margin-right: 25px;
	margin-left: 10px;
	color: #fff;
	font-size: 1.1rem;
	font-weight: 500;
	transition: all .50s ease;
}
.user{
	display: flex;
	align-items: center;
}
.user i{
	color: #71b7e6;
	font-size: 28px;
	margin-right: 7px;
}
.main a:hover{
	color: #71b7e6;
}
#menu-icon{
	font-size: 35px;
	color: #fff;
	cursor: pointer;
	z-index: 10001;
	display: none;
}


@media (max-width: 1280px){
	header{
		padding: 14px 2%;
		transition: .2s;
	}
	.navbar a{
		padding: 5px 0;
		margin: 0px 20px;
	}
}

@media (max-width: 1090px){
	#menu-icon{
		display: block;
	}
	.navbar{
		position: absolute;
		top: 100%;
		right: -100%;
		width: 270px;
		height: 22vh;
		background:#222327;
		display: flex;
		flex-direction: column;
		justify-content: flex-start;
		border-radius: 10px;
		transition: all .50s ease;border-style: solid;
  
	}
	.navbar a{
		display: block;
		margin: 12px 0;
		padding: 0px 25px;
		transition: all .50s ease;
  border-style: none;
	}
	.navbar a:hover{
		color: #71b7e6;
		transform: translateY(5px);
	}
	.navbar a.active{
		color: #fff;
	}
	.navbar.open{
		right: 1%;
	}
}
   .loginbtn button{
   border: none;
   font-weight: bold;
   color: #black;
	font-size: 18px;
  padding: 7px 15px;
  border-radius: 5px;
    background: #87CEEB;
 }

/*---footer---*/
.container1 {
 max-width: 1170px;
 margin: auto;
}
.row {
 display: flex;
 flex-wrap: wrap;
}
ul {
 list-style: none;
}
.footer {
 background-color: #24262b;
 padding: 70px 0;
}
.footer-col {
 width: 25%;
 padding: 0 15px;
}
.footer-col h4 {
 font-size: 18px;
 color: #ffffff;
 text-transform: capitalize;
 margin-bottom: 35px;
 font-weight: 500;
 position: relative;
}
.footer-col h4::before {
 content: '';
 position: absolute;
 left: 0;
 bottom: -10px;
 background-color: #006d6d;
 height: 2px;
 box-sizing: border-box;
 width: 50px;
}
.footer-col ul li:not(:last-child) {
 margin-bottom: 10px;
}
.footer-col ul li a {
 font-size: 16px;
 text-transform: capitalize;
 color: #ffffff;
 text-decoration: none;
 font-weight: 300;
 color: #bbbbbb;
 display: block;
 transition: all 0.3s ease;
}
.footer-col ul li a:hover {
 color: #ffffff;
 padding-left: 8px;
}
.footer-col .social-links a:hover {
 color: #24262b;
 background-color: #ffffff;
}

/*responsive*/
@media(max-width: 767px) {
.footer-col {
 width: 50%;
 margin-bottom: 30px;
}
}

@media(max-width: 574px) {
.footer-col {
 width: 100%;
}
}
 
 /*dialog-box*/
.dialog {
 background: #eaedf5;
 padding: 15px 9%;
 padding-bottom: 100px;
}
.dialog .heading {
 text-align: center;
 padding-bottom: 15px;
 color: #fff;
 text-shadow: 0 5px 10px rgba(0,0,0,.2);
 font-size: 50px;
}
.dialog .box-dialog {
 display: grid;
 grid-template-columns: repeat(auto-fit, minmax(270px, 1fr));
 gap: 15px;
}
.dialog .box-dialog .box {
 box-shadow: 0 5px 10px rgba(0,0,0,.2);
 border-radius: 5px;
 background: #E3DEDE;
 text-align: center;
 padding: 30px 20px;
}
.dialog .box-dialog .box img {
 height: 80px;
}
.dialog .box-dialog .box h3 {
 color: #444;
 font-size: 22px;
 padding: 10px 0;
}
.dialog .box-dialog .box p {
 color: #777;
 font-size: 15px;
 line-height: 1.8;
}
.dialog .box-dialog .box .btn {
 margin-top: 10px;
 display: inline-block;
 background: #006d6d;
 color: #fff;
 font-size: 17px;
 border-radius: 5px;
 padding: 8px 25px;
}
.dialog .box-dialog .box .btn:hover {
 letter-spacing: 1px;
}
.dialog .box-dialog .box:hover {
 box-shadow: 0 10px 15px rgba(0,0,0,.3);
 transform: scale(1.03);
}

@media (max-width:768px) {
.dialog {
 padding: 20px;
}
}

</style>
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
error_reporting(0);


$fname =mysqli_real_escape_string($connect, $_POST[ 'fname' ]);
$lname =mysqli_real_escape_string($connect, $_POST[ 'lname' ]);
$email = mysqli_real_escape_string($connect,$_POST[ 'email' ]);
$Phone = mysqli_real_escape_string($connect,$_POST[ 'phone' ]);
$password = mysqli_real_escape_string($connect, md5($_POST['password']) );
$Cpassword = mysqli_real_escape_string($connect,md5($_POST['cpassword']));


if ( strlen( $fname ) == 0 || strlen( $lname ) == 0 || strlen( $email ) == 0 || strlen( $Phone ) == 0 || strlen( $password ) == 0 || strlen( $Cpassword ) == 0 ) {

?><script>alert("Fields are empty");window.location.href='Login.php';</script><?php
} else if ( !preg_match( "/^[A-Za-z]+$/", $fname ) ) {
?><script>alert("Please enter valid name!");window.location.href='Login.php';</script><?php
} else if ( !preg_match( "/^[A-Za-z]+$/", $lname ) ) {
?><script>alert("Please enter valid name!");window.location.href='Login.php';</script><?php
}else if ( !preg_match( "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/", $email ) ) {
?><script>alert("Please enter valid email!");window.location.href='Login.php';</script><?php
} else if ( !preg_match( "/^[0-9]*$/", $Phone ) ) {
?><script>alert("Please enter valid phone number!");window.location.href='Login.php';</script><?php
} else if ( strlen( $password ) < 6 ) {
?><script>alert("Password is too short!");window.location.href='Login.php';</script><?php
} else if ( $password !== $Cpassword ) {
?><script>alert("Password is not matching!");window.location.href='Login.php';</script><?php
}

else {

  if ( $password == $Cpassword ) {
   $select = mysqli_query($connect, "SELECT * FROM passenger WHERE Email = '$email'");
   if(mysqli_num_rows($select)) {
    ?><script>alert("User already registered!");window.location.href='Login.php';</script><?php
    }else{
     $sql_userdatabase = "Insert into passenger(First_Name ,Last_Name,Email , Phone, password) values ('$fname' , '$lname' ,'$email' , '$Phone','$password')";

       if ( mysqli_query( $connect, $sql_userdatabase ) == true ) {
         ?>
<div class="dialog">
  <h1 class="heading"></h1>
  </br>
  </br>
  </br>
  <div class="box-dialog">
    <div class="box"><img src="img/notifications/verify-success-success-tick-icon-with-png-and-vector-format-372259.png" alt=""></br>
      </br>
      <h3>You have been sucessfully registered</h3>
      </br>
      <a href="Login.php" class="btn">Sign in!</a></br>
      </br>
    </div>
  </div>
</div>
<?php
} else {
  ?>
<div class="dialog">
  <h1 class="heading"></br>
    </br>
  </h1>
  <div class="box-dialog">
    <div class="box"><img src="img/notifications/alert-danger-error-exclamation-mark-red-icon-227724.png" alt=""></br>
      </br>
      <h3>Registration Unsuccessful</h3>
      </br>
      <p>Something went wrong</p>
      <a href="Login.php" class="btn">Register Again</a></br>
      </br>
    </div>
  </div>
</div>
<?php

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