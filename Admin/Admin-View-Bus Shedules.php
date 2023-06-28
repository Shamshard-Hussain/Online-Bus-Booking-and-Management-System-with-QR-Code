<?php
include( 'Admin-nav.php' );


include '../connect.php';
?>

<!-- Table section starts  -->
<div id="page-wrap">
  <h1>Bus Schedules</h1>
  <p><p>Find all highway bus timetables from here.</p></p>
  <table>
    
   
   
    <?php
    //sql Query to get data
    $sql = "SELECT * FROM bus_shedules";
    $res = mysqli_query( $connect, $sql );
    //count Rows
    $count = mysqli_num_rows( $res );

    if ( $count > 0 ) {
     ?>
     <tr>
      <th>Bus Id</th>
      <th>Bus Name</th>
      <th>Bus Number</th>
      <th>Departure from</th>
      <th>Departure Time</th>
      <th>Final Destination</th>
      <th>Arrival Time</th>
      <th>Available Seat</th>
      <th>Status</th>
      <th>Options</th>
    </tr>
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

        ?>
    <tr>
      <td><?php echo $id;?></td>
      <td><?php echo $Bname;?></td>
      <td><?php echo $Bnumber;?></td>
      <td><?php echo $Spoint;?></td>
      <td><?php echo $Stime;?></td>
      <td><?php echo $Destination;?></td>
      <td><?php echo $Etime;?></td>
     <td><?php echo $Scount;?></td>
     <td>
     <?Php 
     if ( $Status=="A" ) {
         ?><img src="../img/Icon/on.png" width="35" height="30"/> <?php
        }else if ( $Status=="D" ){
         ?><img src="../img/Icon/off.png" width="35" height="30"/> <?php
        }
     ?>
     </td>
      <td><a class="btn_update" href="Admin-Bus Shedules-update.php?id=<?php echo $id; ?>">Update</a></td>
    </tr>
    <?php

    }

    } else {
      echo "<tr> <td colspan='7' class 'error'>Bus Schedules Details not add yet.</td></tr>";
    }

    ?>
  </table>
</div>

<!-- Table section ends  -->

<?php include('Admin-footer.php');?>