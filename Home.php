<!doctype html>
<html><head>
 <!-- date picker -->
<meta charset="utf-8">
 	<link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
 <link rel="stylesheet" type="text/css" href="css/authenticate.css">
 
<title>Beyaztop</title>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

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
 
 
 
 <br><br>
 

  <!-- Main body section starts  -->
 <div class="homebody">
 <div class="panel">
  <div class="left">
    <h1>WELCOME</h1><br><br>
    <h2>Get your ticket online,<br>
      easy and safely.</h2>
    <br>
    <br><br>
   

   <div class="search">
      <button class="get-btn">
      <a href="Bus-Shedules.php">Get Tickets Now</a>
      </button>
    </div>

  </div>
  
     <form method="post" action="#" enctype="multipart/form-data" >
<div class="rpanal">
   <div class="right">
    <h3>Choose Your Ticket</h3>
    
    <select name="spoint" required>
              <option value="0" hidden>Select</option>
              <option value="Matara">Matara</option>
              <option value="Makubura">Makubura</option>
    </select>
    <lable>Pickup Point</lable>
    
    <select name="epoint" required>
              <option value="0" hidden>Select</option>
              <option value="Makubura">Makubura</option>
              <option value="Matara">Matara</option>
    </select>
    <lable>Departure Point</lable>
    <input type="date" id="inputdate" name="date" required>
    <lable>Departure Date</lable>
    <br>   
    <br>
    <div align="center">
      <button type="submit"  name="submit" class="search-btn">
      Find Tickets
      </button>
    </div>
  </div>
 </div>
    </form>
</div>
 </div>
 
  
<!-- footer section starts  -->
<footer class="footer">
  <div class="container1">
    <div class="row">
      <div class="footer-col">
        <h4>get help</h4>
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
          <li><a href="#">Kirula Road, Makubura 5,</a></li>
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

</body>
 <?php
if ( isset( $_POST[ 'submit' ] ) ) {
  include 'connect.php';
 $date = mysqli_real_escape_string( $connect, $_POST[ 'date' ] );
 if($_POST[ 'spoint' ]=='0'){
  echo '<script>alert("Please select pickup point");</script>';
 }
 else if( $_POST[ 'epoint' ]=='0' ){
  echo '<script>alert("Please select departure point");</script>';
 }else if($_POST[ 'epoint' ]==$_POST[ 'spoint' ]){
  echo '<script>alert("Departure point and pickup point are same");</script>';
 }
 else if(strlen( $date ) == 0 ){
  echo '<script>alert("Please select date");</script>';
 }
 else{
    session_start();
     $Spoint = mysqli_real_escape_string( $connect, $_POST[ 'spoint' ] );
     $Epoint = mysqli_real_escape_string( $connect, $_POST[ 'epoint' ] );
     $_SESSION[ 'spoint' ]=$Spoint;
     $_SESSION['epoint']=$Epoint;
     $_SESSION[ 'search' ] = '1';
  echo "<script>window.location.href='Schedule-search.php';</script>" ;
   }    
}
 ?>
  <script type="text/javascript">
    $(function(){
    var dtToday = new Date();
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
     day = '0' + day.toString();
    var maxDate = year + '-' + month + '-' + day;
    $('#inputdate').attr('min', maxDate);
});
 </script>
</html>
