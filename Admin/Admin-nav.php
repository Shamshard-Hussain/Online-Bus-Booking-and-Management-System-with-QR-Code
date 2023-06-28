<?php
session_start();
if ($_SESSION['Admin_log'] == '')
{
    header("location:../Home.php");
}?>


<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"/>
    <link rel="stylesheet" href="../css/Admins.css" />
    <title>Beyaztop</title>
  </head>
  <body>
    <div class="menu-bar">
      <h1 class="logo"><img src="../img/bg-img/Beyaztop-logo.png" alt=" Logo" width="130px" height="85px"> </h1>
      <ul>
        <li><a href="Admin-Home.php">Home</a></li>
       
       
       <li><a href="#">Passengeres<i class="fas fa-caret-down"></i></a>

            <div class="dropdown-menu">
                <ul>
                  <li><a href="Admin-user-Details.php">Accounts</a></li>
                  <li><a href="Passenge-Bookin-details.php">Resrvations</a></li>
                </ul>
              </div>
        </li>
         
       <li><a href="#">Bus<i class="fas fa-caret-down"></i></a>

            <div class="dropdown-menu">
                <ul>
                  <li><a href="Admin-Add-New-Bus">New Bus</a></li>
                  <li><a href="Admin-Bus-Details.php">Bus Info</a></li>
                 <li><a href="Admin-add-Bus-Shedule.php">Add Bus Schedules</a></li>
                  <li><a href="Admin-View-Bus Shedules">View Bus Schedules</a></li>
                </ul>
              </div>
        </li>
        <li><a href="add_bus_seat.php">Seats</a></li>
        <li><a href="Admin-Vew-Feedback.php">F&Q</a></li>
     
     </ul>
    </div>

    