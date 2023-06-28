<?php
include( 'Admin-nav.php' );


include '../connect.php';


if ( isset( $_GET[ 'id' ] ) ) {
  $Shedules_id = $_GET[ 'id' ];
  $sql2 = "SELECT * FROM bus_shedules WHERE Shedules_id=$Shedules_id";
  $res2 = mysqli_query( $connect, $sql2 );
  $row2 = mysqli_fetch_assoc( $res2 );
  $Bname = $row2[ 'Bus_name' ];
  $Bnumber = $row2[ 'Bus_number' ];
  $Stime = $row2[ 'Stat_time' ];
  $Etime = $row2[ 'End_time' ];
  $Spoint = $row2[ 'Starting_point' ];
  $Destination = $row2[ 'Final_destination' ];
  $Status = $row2[ 'Status' ];
} else {
  ?>
              <script>
                alert("Update Faild,Form is not submited");
              </script>
<?php
           header( "location:Admin-View-Bus Shedules.php" );
} 

?>



<!-- Body section starts  -->
<div class="page">
  <div class="ProfileContainer">
    <div class="title">Update Bus Shedules</div>
    <div class="content">
      <form action="" method="post" enctype="multipart/form-data">
        <div class="user-details">
         
         
         
          <div class="input-box"> <span class="details">Bus Name</span>
            <input type="text" name="Bname" value="<?php echo $Bname;?>" placeholder="Enter name" required>
          </div>
          <div class="input-box"> <span class="details">Bus Number</span>
            <select id="Bnumber" name="Bnumber" >
             <option value="<?php echo $Bnumber; ?>"><?php echo $Bnumber; ?></option>
              <?php
              //display Bus Number from data base
              $sql = "SELECT * FROM bus_details";
              $res = mysqli_query( $connect, $sql );
              $count = mysqli_num_rows( $res );

              if ( $count > 0 ) {

                while ( $row = mysqli_fetch_assoc( $res ) ) {
                  $Bnumber = $row[ 'licences_Number' ];
                  ?>
              <option value="<?php echo $Bnumber; ?>"><?php echo $Bnumber; ?></option>
              <?php
              }

              } else {
                ?>
              <option value="0">Bus Number not found</option>
              <?php
              }
              ?>
            </select>
          </div>
          <div class="input-box"> <span class="details">Departure Time</span>
            <input type="time" name="STime" value="<?php echo $Stime;?>" placeholder="Enter start time" required>
          </div>
          <div class="input-box"> <span class="details">Arrival Time to Destination</span>
            <input type="time" name="ETime" value="<?php echo $Etime;?>" placeholder="Enter number" min="0" required>
          </div>
          <div class="input-box"> <span class="details">Departure from</span>
            <select id="inputState" name="Start" >
              <option><?php echo $Spoint; ?></option>
             
             <?php
             if($row2[ 'Starting_point' ]=="Makubura"){
              ?>
              <option>Matara</option>
              <?PHP
             }else if($row2[ 'Starting_point' ]=="Matara"){
              ?>
              <option>Makubura</option>
              <?PHP
             }
             
             ?>
             
            </select>
          </div>
         
          <div class="input-box"> <span class="details">Final Destination</span>
            <select id="inputState" name="End" >
              <option><?php echo $Destination; ?></option>
              
             <?php
             if($row2[ 'Final_destination' ]=="Makubura"){
              ?>
              <option>Matara</option>
              <?PHP
             } else if($row2[ 'Final_destination' ]=="Matara"){
              ?>
              <option>Makubura</option>
              <?PHP
             }
             
             ?>
            </select>
           
           
          </div>
        </div>
        <div class="gender-details">
          <input type="radio" value="A"name="Status" id="dot-1" <?=$row2['Status']=="A" ? "checked" : ""?> required>
          <input type="radio" value="D" name="Status" id="dot-2" <?=$row2['Status']=="D" ? "checked" : ""?> required>
          <span class="gender-title">Status</span>
          <div class="category">
            <label for="dot-1"> <span class="dot one"></span> <span class="gender">Active</span> </label>
            <label for="dot-2"> <span class="dot two"></span> <span class="gender">Deactive</span> </label>
          </div>
        </div>
        <div class="button">
          <input type="submit" name="submit" value="Update">
        </div>
      </form>
    </div>
  </div>
</div>
<?php
if ( isset( $_POST[ 'submit' ] ) ) {

 
  $BName = mysqli_real_escape_string( $connect, $_POST[ 'Bname' ] );
  $BNumber = mysqli_real_escape_string( $connect, $_POST[ 'Bnumber' ] );
  $Stime = mysqli_real_escape_string( $connect, $_POST[ 'STime' ] );
  $Etime = mysqli_real_escape_string( $connect, $_POST[ 'ETime' ] );
  $Spoint = mysqli_real_escape_string( $connect, $_POST[ 'Start' ] );
  $Destination = mysqli_real_escape_string( $connect, $_POST[ 'End' ] );
  $Status = mysqli_real_escape_string( $connect, $_POST[ 'Status' ] );

  if ( strlen( $BName ) == 0 || strlen( $Stime ) == 0 || strlen( $Etime ) == 0 || strlen( $BNumber ) == 0 || strlen( $Spoint ) == 0 || strlen( $Destination ) == 0 ) {

    ?>
<script>
         alert("Fields are empty");
        </script>
<?php
} else if ( !preg_match( "/^[A-Za-z]+$/", $BName ) ) {

  ?>
<script>
         alert("Please enter valid name");
       </script>
<?php
} else if ( $Spoint == $Destination ) {
  ?>
<script>
         alert("Selected source and destination are same , Please refill the details");
       </script>
<?php
} else {

  if ( $Status == 'D' ) {

    $sql_notify = "SELECT * FROM ticket WHERE Schedul_id=$Shedules_id ";
    $req = mysqli_query( $connect, $sql_notify );
    //count Rows
    $count3 = mysqli_num_rows( $req );

    if ( $count3 > 0 ) {

      while ( $row3 = mysqli_fetch_assoc( $req ) ) {
        $passenger = $row3[ 'Passenger_Id' ];
        $qrcode = $row3[ 'Qr_code'];
       
     mysqli_query($connect, "Update seat set Status='A' where Shedules_id=$Shedules_id");
       
           $sql_Admin = "Insert into notifications(UserID,Notifications,Type,status) 
           values ('$passenger' , 'For an unavoidable reason,the bus you reserved seats on is not running today.sory for the inconvenience','Unfortunately' ,'unread')";

        if ( mysqli_query( $connect, $sql_Admin ) == true ) {
         $path="../qrcode/temp/".$qrcode;
         $remove=unlink($path);//emove Qrimage
        }
      }

    }


 
   $sql = "DELETE FROM ticket WHERE Schedul_id=$Shedules_id";
   $res = mysqli_query( $connect, $sql );
 
     if ( $res != true ) {
     echo'<script>alert("Failed to cancle the reservations!");</script>';
     }  

  }


  $sql_bus_info = "Update bus_shedules set
     Bus_name='$BName',
     Bus_number='$BNumber',
     Stat_time='$Stime',
     End_time='$Etime',
     Starting_point='$Spoint',
     Final_destination='$Destination',
     Status= '$Status'
     where Shedules_id=$Shedules_id";


     if ( mysqli_query( $connect, $sql_bus_info ) == true ) {
    echo "<script> alert('Update Successful');window.location.href='Admin-View-Bus Shedules.php';</script>";
     } else {
     echo'<script>alert("Update Faild!");</script>';
     }


  }
}

include( 'Admin-footer.php' );
?>
