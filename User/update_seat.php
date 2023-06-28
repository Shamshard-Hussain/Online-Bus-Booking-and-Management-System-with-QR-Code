<?php include('user-header.php');

include '../connect.php';
if ( isset( $_GET[ 'Tid' ] )& isset( $_GET[ 'seatCode' ] ) & isset( $_GET[ 'Schedulid' ] ) ) {
 $Schedulid=mysqli_real_escape_string( $connect,  $_GET[ 'Schedulid' ] );
 $Ticket_no=mysqli_real_escape_string( $connect,  $_GET[ 'Tid' ] );
 $Seat_No=mysqli_real_escape_string( $connect,  $_GET[ 'seatCode' ] );
 //echo $Schedulid;
 $sql_Seat_status="update seat set Status='A' Where Shedules_id=$Schedulid and Name='$Seat_No' ";
 $res = mysqli_query( $connect, $sql_Seat_status );
  if ( $res == true ) {
    ?><script>alert("Reservation cancle successfully");</script><?php
   header( "location:User-Bookin-details.php" );
  }else{
   ?><script>alert("Failed to cancle the reservation!");</script><?php
   header( "location:User-Bookin-details.php" );
  }
}else{
 header( "location:User-Bookin-details.php" );

}