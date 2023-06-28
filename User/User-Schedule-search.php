
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<?php include('user-header.php');
date_default_timezone_set('Asia/Colombo');

$cur_time= date("H:i:s");


if ( isset( $_GET[ 'spoint' ] )AND isset($_GET['epoint'])) {
 
     $Dpoint = mysqli_real_escape_string( $connect, $_GET[ 'spoint' ] );
     $Apoint = mysqli_real_escape_string( $connect, $_GET[ 'epoint' ] );

}else{
 header( "location:User-Home-page.php" );
}

  ?>
<br>
<div id="table-page-wrap">
  <h1>Bus schedule</h1>
  <p>Find highway bus timetables from here. You can select the desired destination and make resrvation.</p>
</div>
  <?php
  //sql Query to get data
  $sql = "SELECT * FROM bus_shedules";
  $res = mysqli_query( $connect, $sql );
  //count Rows
  $count = mysqli_num_rows( $res );
  ?>
  <div class="userTable"> 
    <!-- Table section starts  -->
    <div class="header_fixed">
     <form action="" method="post" enctype="multipart/form-data">
      <table id="tblDemo">
        <thead>
          <?php
          //sql Query to get data
          $sql = "SELECT * FROM bus_shedules where Status='A' and Starting_point='$Dpoint' ";
          $res = mysqli_query( $connect, $sql );
          //count Rows
          $count = mysqli_num_rows( $res );
          if ( $count > 0 ) {
            ?>
          <tr>
            <th>Bus Name</th>
            <th>Bus Number</th>
            <th>Departure from</th>
            <th>Departure Time</th>
            <th>Final Destination</th>
            <th>Arrival Time</th>
            <th>Available Seat</th>
            <th>Options</th>
          </tr>
        </thead>
        <?php
        while ( $row = mysqli_fetch_assoc( $res ) ) {
          $id = $row[ 'Shedules_id' ];
          $Bname = $row[ 'Bus_name' ];
          $Bnumber = $row[ 'Bus_number' ];
          $Stime = $row[ 'Stat_time' ];
          $Etime = $row[ 'End_time' ];
          $Spoint = $row[ 'Starting_point' ];
          $Destination = $row[ 'Final_destination' ];
          $Scount = $row[ 'Seats_Count' ];
          $Status = $row[ 'Status' ];
         
         if($cur_time <=$Stime){?>
        <tbody id="test">
          <tr>
            <td><?php echo $Bname;?></td>
            <td><?php echo $Bnumber;?></td>
            <td><?php echo $Spoint;?></td>
            <td><?php echo $Stime;?></td>
            <td><?php echo $Destination;?></td>
            <td><?php echo $Etime;?></td>
            <?php
            $sql_Seat_Status = mysqli_query( $connect, 'SELECT COUNT(*) as seat_Count from seat where Shedules_id="' . $id . '" AND Status="A";' );
            $result = mysqli_fetch_assoc( $sql_Seat_Status );
            $seat_Count = $result[ 'seat_Count' ];

            ?><td><?php echo $seat_Count;?></td><?php
         if($seat_Count!=='0'){
          ?><td><button type="submit" name="submit">
              <a class="btn-table" href="Book_tickets.php?Shedules_id=<?php echo $id; ?>& Bus_number=<?php echo $Bnumber; ?>">Book a seat</a>
              </button></td><?php
         }else{
          ?><td>Seat unavailable</td><?php
         }?></tr>
        </tbody>
        <?php
         }else{/* echo '<td>No buses at the moment.</td>';*/}
        }
        } else {
          echo " <p class='error'>Bus Details not add yet.</p>";
        }
        ?>
      </table>
      </form>
    </div>
  </div>
  <!-- Table section ends  -->

<script>
var allTableData = document.getElementById("tblDemo");
   var totalNumbeOfRows = allTableData.rows.length;
 if(totalNumbeOfRows==1){
  alert("No buses at the moment");
  window.location.href='User-Home-page.php';

 }
</script>


<?php include('user-footer.php');?>