<?php

include '../connect.php';
session_start();
if ($_SESSION['Admin_log'] == '')
{
    header("location:../Home.php");
}

//check id and LNumber set or not
if ( isset( $_GET[ 'id' ] )AND isset($_GET['Seats_Count']) AND isset( $_GET[ 'Bus_number' ] )) {
 
 // $id = $_GET[ 'id' ];
  //$Snumber = $_GET[ 'Seats_Count' ];
  //$Lumber =  $_GET[ 'Bus_number' ];


  $Snumber = mysqli_real_escape_string( $connect, $_GET[ 'Seats_Count' ] );
  $Lumber = mysqli_real_escape_string( $connect, $_GET[ 'Bus_number' ] );
 $id= mysqli_real_escape_string( $connect, $_GET[ 'id' ] );
 
 
 
 $code='Sn';
   for($i=1;$i<=$Snumber;$i++){//Genarate numbers 
    //$name='Seat'.$i;
    
    
    $Seat_name=$code.$i;
    $Bus_number=$Lumber;
    $Status="A";
    //echo $Seat_name;echo $Bus_number;
   //echo "<br>";
    
   $sql_Admin =
   "Insert into seat(Shedules_id,Bus_number,Name,Status)values ($id,'$Bus_number','$Seat_name','$Status')";  
    // "Insert into seat(Bus_number,Name,Status)values ('$Bus_number','$Seat_name','$Status')";
 
  if ( mysqli_query( $connect, $sql_Admin ) == true ) {
    echo "<script> alert('Seats add Successful!');window.location.href='add_bus_seat.php';</script>";
  } else {echo "<script> alert('Faild to add seats!');window.location.href='add_bus_seat.php';</script>";}
    
  }
 
 
}else{
  header( "location:add_bus_seat.php" );
}
