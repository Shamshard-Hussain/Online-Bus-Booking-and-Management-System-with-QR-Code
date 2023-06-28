<?php
include( 'Admin-nav.php' );
include '../connect.php';
?>

<!-- Body section starts  -->
<div class="page">
  <div class="ProfileContainer">
    <div class="title">Add New Bus Schedules</div>
    <div class="content">
      <form action="" method="post" enctype="multipart/form-data">
        <div class="user-details">
          <div class="input-box"> <span class="details">Bus Name</span>
            <input type="text" name="Bname" placeholder="Enter name" required>
          </div>
          <div class="input-box"> <span class="details">Bus Number</span>
            <select id="Bnumber" name="Bnumber" >
              <?php
              //display Bus Number from data base
              $sql = "SELECT * FROM bus_details";
              $res = mysqli_query( $connect, $sql );
              $count = mysqli_num_rows( $res );

              if ( $count > 0 ) {

                while ( $row = mysqli_fetch_assoc( $res ) ) {
                  $id = $row[ 'Bus_id' ];
                  $Bnumber = $row[ 'licences_Number' ];
                  $Lumber = $row['Lumber'];
                  $Snumber = $row['Svalue'];
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
            <input type="time" name="STime" placeholder="Enter start time" required>
          </div>
          <div class="input-box"> <span class="details">Arrival Time to Destination</span>
            <input type="time" name="ETime" placeholder="Enter number" min="0" required>
          </div>
          <div class="input-box"> <span class="details">Departure from</span>
            <select id="inputState" name="Start" >
              <option>Makubura</option>
              <option>Matara</option>
            </select>
          </div>
          <div class="input-box"> <span class="details">Final Destination</span>
            <select id="inputState" name="End" >
              <option>Matara</option>
              <option>Makubura</option>
            </select>
          </div>
        </div>
        <div class="gender-details">
          <input type="radio" value="A" name="Status" id="dot-1" required>
          <input type="radio" value="D" name="Status" id="dot-2" required>
          <span class="gender-title">Status</span>
          <div class="category">
            <label for="dot-1"> <span class="dot one"></span> <span class="gender">Active</span> </label>
            <label for="dot-2"> <span class="dot two"></span> <span class="gender">Deactive</span> </label>
          </div>
        </div>
        <div class="button">
          <input type="submit" name="submit" value="Add">
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Body section ends  -->
<?php
if ( isset( $_POST[ 'submit' ] ) ) {
  include '../connect.php';

  $Bname = mysqli_real_escape_string( $connect, $_POST[ 'Bname' ] );
  $Bnumber = mysqli_real_escape_string( $connect, $_POST[ 'Bnumber' ] );
  $Stime = mysqli_real_escape_string( $connect, $_POST[ 'STime' ] );
  $Etime = mysqli_real_escape_string( $connect, $_POST[ 'ETime' ] );
  $Spoint = mysqli_real_escape_string( $connect, $_POST[ 'Start' ] );
  $Destination = mysqli_real_escape_string( $connect, $_POST[ 'End' ] );
  $Status = mysqli_real_escape_string( $connect, $_POST[ 'Status' ] );
 

  if ( strlen( $Bname ) == 0 || strlen( $Stime ) == 0 || strlen( $Etime ) == 0 || strlen( $Bnumber ) == 0 || strlen( $Spoint ) == 0 || strlen( $Destination ) == 0 ) {

    ?>
<script>
         alert("Fields are empty");
        </script>
<?php
} else if ( !preg_match( "/^[A-Za-z]+$/", $Bname ) ) {

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

  //checking avalable Seact count
  $sql2 = 'SELECT Seats_Count FROM bus_details WHERE licences_Number = "' . $Bnumber . '" ';

  $res2 = mysqli_query( $connect, $sql2 );

  //count rows
  $count2 = mysqli_num_rows( $res2 );

  //check items
  if ( $count2 > 0 ) {
    while ( $row2 = mysqli_fetch_assoc( $res2 ) ) {
      $Scount = $row2[ 'Seats_Count' ];
    }
  }

  $sql_Admin =
    "Insert into bus_shedules(Bus_name,Bus_number,Stat_time,End_time,Starting_point,Final_destination,Seats_Count,Status) 
           values ('$Bname' , '$Bnumber' ,'$Stime', '$Etime', '$Spoint','$Destination' ,$Scount, '$Status')";

  if ( mysqli_query( $connect, $sql_Admin ) == true ) {

   
    echo "<script> alert('Bus sheduled Successful');window.location.href='add_bus_seat.php';</script>";
  } else {
   
    ?><script>alert("Bus sheduled Faild"); </script><?php
}


}

}

 include('Admin-footer.php');?>