<?php
include '../connect.php';
session_start();
if ( $_SESSION[ 'log' ] == '' ) {
  header( "location:../Login.php" );
}

?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Bayaztop</title>
 <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/style.css">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap" rel="stylesheet">

</head>
<body>

	<header>
		<a href="User-Home-page.php" class="logo"><img src="../img/bg-img/Beyaztop-logo.png" alt=" Logo"></a>

		<ul class="navbar">
			<li><a href="User-Home-page.php">Home</a></li>
    <li><a href="user-bus-schedules.php">Bus Schedules</a></li>
    <li><a href="User-Bookin-details">Booking</a></li>
    <li><a href="user-profile.php">Profile</a></li>
    <input type="hidden" name="name" value=" <?php  echo " ". $_SESSION['fname'] ."" ?>">
		</ul>

		<div class="main">
			<a href="Notifications.php"><img src="../img/Icon/icons8-notification-58.png" width="50px" height="50px"/></a>
			<div  id="menu-icon"><img src="../img/Icon/icons8-chevron-down-30.png" /></div>
		</div>
 
	</header>
 <br> <br> <br> <br> <br>
	<!--js link--->
	<script type="text/javascript" src="../js/Nav bar.js"></script>

