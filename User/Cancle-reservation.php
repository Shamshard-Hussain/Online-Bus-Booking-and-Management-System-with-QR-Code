<?php include('user-header.php');
 $userid=$_SESSION[ 'userid' ];

include '../connect.php';

if ( isset( $_GET[ 'Tid' ] )& isset( $_GET[ 'seatCode' ] ) & isset( $_GET[ 'Schedulid' ] ) & isset( $_GET[ 'QCode' ] ) ) {
 $qrcode=mysqli_real_escape_string( $connect,  $_GET[ 'QCode' ] );
 $Schedulid=mysqli_real_escape_string( $connect,  $_GET[ 'Schedulid' ] );
 $Ticket_no=mysqli_real_escape_string( $connect,  $_GET[ 'Tid' ] );
 $Seat_No=mysqli_real_escape_string( $connect,  $_GET[ 'seatCode' ] );

 if($qrcode !="")
   {
   $path="../qrcode/temp/".$qrcode;
   //emove Qrimage
   $remove=unlink($path);
    if($remove==false)
     {
     ?><script>alert("Failed to cancle the reservation!");</script><?php
       header( "location:User-Bookin-details.php" );
     }
  }
   $sql = "DELETE FROM ticket WHERE Tid='$Ticket_no'";
   $res = mysqli_query( $connect, $sql );
  if ( $res == true ) {
   $sql_notify = "Insert into notifications(UserID,Notifications,Type,status) 
           values ($userid , 'You have successfully cancled the reservation and you will refound the 95% of ticket price.Thank you!' ,'Booking Cancellation Confirmed','unread')";

        if ( mysqli_query( $connect, $sql_notify ) == true ) {
          ?>
    <script>window.location.href='update_seat.php?Tid=<?php echo $Ticket_no; ?>&Schedulid=<?php echo $Schedulid; ?>&seatCode=<?php echo $Seat_No; ?>';</script>
   <?php
        }
  }else{
   ?><script>alert("Failed to cancle the reservation!");</script><?php
   header( "location:User-Bookin-details.php" );
  }
}else{
 header( "location:User-Bookin-details.php" );
}