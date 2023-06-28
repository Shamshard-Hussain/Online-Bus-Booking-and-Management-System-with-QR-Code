<?php
include( 'Admin-nav.php' );
include '../connect.php';

?>

<!-- Table section starts  -->
<div id="page-wrap">
  <h1>Add Bus Seats</h1>
  <p>Always check informations mentioned below and please add seat after scheduled</p>
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
      <th>Schedules Id</th>
      <th>Bus Name</th>
      <th>Bus Number</th>
      <th>Description</th>
      <th>Schedules Status</th>
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
     <td><?php echo $Spoint;?> to <?php echo $Destination;?> at <?php echo $Stime;?></td>
     <td><?php echo $Status;?></td>
     
     
     
     <?php
     
     $sql_Search_Shedules = 'SELECT * FROM seat WHERE Shedules_id = "' . $id . '" ';
     $res3 = mysqli_query( $connect, $sql_Search_Shedules );
    //count rows
    $count3 = mysqli_num_rows( $res3 );
   //check Data
    if ( $count3 > 0 ) {
    
      ?><td><a class="btn_update"><img src="../img/Icon/check.png" width="16" height="16" alt="add" /></a></td><?php
    
     
    }else{
      ?><td>
     <a class="btn_update" href="Seats.php?id=<?php echo $id; ?>& Seats_Count=<?php echo $Scount; ?>& Bus_number=<?php echo $Bnumber; ?> ">
     <img src="../img/Icon/add-icon2.png" width="16" height="16" alt="add" /></a></td><?php
    }
     ?>
     
     
     
     
     
     
        
    </tr>
    <?php

    }

    } else {
      echo "<p>Bus Schedules not add yet.</p>";
    }

    ?>
  </table>
</div>

<!-- Table section ends  -->


<?php include('Admin-footer.php');?>