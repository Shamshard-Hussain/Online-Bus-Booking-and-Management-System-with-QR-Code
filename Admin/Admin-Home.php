<?php
session_start();
if ($_SESSION['Admin_log'] == '')
{
    header("location:../Home.php");
}
?>
<html lang="en">
<head>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="../css/Admin-Home.css">
<title>Beyaztop</title>
</head>
<body>
<div class="wrapper">
  <div class="section">
    <div class="top_navbar">
      <div class="hamburger"> <a href="#"> <i class="fas fa-bars"></i> </a> 
<!--Navigation Bar-->
      </div>
      <!--Navigation Bar-->
    </div>
   
   
    <!--Body section-->
    <div class="dialog">
      <h1 class="heading"></h1>
      <div class="box-dialog">
       
        <div class="box"> <img src="../img/Admin-Home/icons8-traveler-100.png" alt="">
          <h3>Passengers Details</h3>
          <p>View Passengers account details</p>
          <a href="Admin-user-Details.php" class="btn">Click Here</a> </div>
       
        <div class="box"> <img src="../img/Admin-Home/reserve.png" alt="">
          <h3>Booking Details</h3>
          <p>View Passengers resarvations</p>
          <a href="Passenge-Bookin-details.php" class="btn">Click Here</a> </div>
       
        <div class="box"> <img src="../img/Admin-Home/icons8-bus-100.png" alt="">
          <h3>Add New Bus</h3>
          <p>Add new bus to database</p>
          <a href="Admin-Add-New-Bus.php" class="btn">Click Here</a> </div>
       
        <div class="box"> <img src="../img/Admin-Home/icons8-contact-details-100.png" alt="">
          <h3>Bus Details</h3>
          <p>View update and delete bus details</p>
          <a href="Admin-Bus-Details.php" class="btn">Click Here</a> </div>
       
       <div class="box"> <img src="../img/Admin-Home/schedule.png" alt="">
          <h3>Add New Schedules</h3>
          <p>Add new bus schedules</p>
          <a href="Admin-add-Bus-Shedule.php" class="btn">Click Here</a> </div>
       
        <div class="box"> <img src="../img/Admin-Home/icons8-view-schedule-100.png" alt="">
          <h3>View Schedules</h3>
          <p>View ,update and deactivate bus schedules</p>
          <a href="Admin-View-Bus Shedules.php" class="btn">Click Here</a> </div>
       
        <div class="box"> <img src="../img/Admin-Home/icons8-seat-100.png" alt="">
          <h3>Add Seats</h3>
          <p>Add bus seats</p>
          <a href="add_bus_seat.php" class="btn">Click Here</a> </div>
     
     <div class="box"> <img src="../img/Admin-Home/feedback.png" alt="">
          <h3>F&Q</h3>
          <p>View feedbacks and inquire </p>
          <a href="Admin-Vew-Feedback.php" class="btn">Click Here</a> </div>
      </div>
     
    </div>
  </div>
 
 
 
 
  <div class="sidebar">
    <div class="profile"> <img src="../img/bg-img/Beyaztop-logo.png" alt="profile_picture">
      <h3>Admin Panel</h3>
      <p></p>
    </div>
    <ul>
      <li> <a href="#" class="active"> <span class="item">Home</span> </a> </li>
      <li> <a href="Admin-user-Details.php">  <span class="item">Pasenger Details</span> </a> </li>
      <li> <a href="Passenge-Bookin-details.php"> <span class="item">Booking Details</span> </a> </li>
      <li> <a href="Admin-Add-New-Bus.php">  <span class="item">Add New Bus</span> </a> </li>
      <li> <a href="Admin-Bus-Details.php"> <span class="item">Bus Details</span> </a> </li>
      <li> <a href="Admin-add-Bus-Shedule.php"> <span class="item">Add Schedules</span> </a> </li>
      <li> <a href="Admin-View-Bus Shedules.php">  <span class="item">View Schedules</span> </a> </li>
      <li> <a href="add_bus_seat.php"> <span class="item">Add Seats</span> </a> </li>
      <li> <a href="Admin-Vew-Feedback.php">  <span class="item">F&Q</span> </a> </li>
      <li> <a onclick="if (confirm('Log Out?')){return true;}
                else{event.stopPropagation(); event.preventDefault();};"  href="Admin-logout.php">  <span class="item">Log-out</span> </a> </li>
    </ul>
  </div>
</div>
<script>
       var hamburger = document.querySelector(".hamburger");
	hamburger.addEventListener("click", function(){
		document.querySelector("body").classList.toggle("active");
	})
  </script>
</body>
</html>