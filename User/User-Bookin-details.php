
<?php include('user-header.php');
  ?>
<br><br>
<div id="table-page-wrap">
  <h1>Resevation details</h1>
  <p></p>
</div>
  <?php
date_default_timezone_set('Asia/Colombo');
         $cur_time= date("H:i:s");
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
      <table>
        <thead>
          <?php
          //sql Query to get data
          $sql = "SELECT * FROM ticket where Passenger_Id='{$_SESSION[ 'userid' ]}' ";
          $res = mysqli_query( $connect, $sql );
          //count Rows
          $count = mysqli_num_rows( $res );
          if ( $count > 0 ) {
            ?>
          <tr>
            <th>Ticket_No</th>
            <th>Date</th>
            <th>Departure Time</th>
            <th>Route</th>
            <th>Seat id</th>
            <th>Bus_number</th>
            <th>View Ticket</th>
            <th>Cancle</th>
          </tr>
        </thead>
        <?php
        while ( $row = mysqli_fetch_assoc( $res ) ) {
         $qrcode=$row['Qr_code'];
         $Schedulid=$row['Schedul_id'];
          $Ticket_no = $row[ 'Tid' ];
          $Issue_Date = $row[ 'Issue_Date' ];
          $Bus_No = $row[ 'Bus_number' ];
          $Route = $row[ 'Route' ];
          $Seat_No = $row[ 'Seat_id' ];
         $De_Time=$row['Departure_Time'];
          ?>
        <tbody>
          <tr>
            <td>#<?php echo $Ticket_no;?></td>
            <td><?php echo $Issue_Date;?></td>
             <td><?php echo $De_Time;?></td>
           <td><?php echo $Route;?></td>
            <td><?php echo $Seat_No;?></td>
            <td><?php echo $Bus_No;?></td>
           <td><button>
              <a class="btn-table" href="View_tickets.php?U-Tid=<?php echo $Ticket_no; ?>">View</a>
              </button></td>
          
            <?php if($cur_time <=$De_Time){ 
              ?><td>
              <a class="btn_Delete" 
               href="Cancle-reservation.php?Tid=<?php echo $Ticket_no; ?>& Schedulid=<?php echo $Schedulid; ?>& seatCode=<?php echo $Seat_No;?> & QCode=<?php echo $qrcode; ?> "
               
               onclick="if (confirm('Are you sure cancle the reservation?')){return true;}
                else{event.stopPropagation(); event.preventDefault();};">
             <img src="../img/Icon/cancel.png" width="25" height="20" /></a>
           </td><?php
             }else{
           ?><td>Ticket expired</td> <?php
          }?>
          </tr></tbody>
        <?php
        }
        } else {
          echo " <p class='error'>Ticket was expired or still you haven't reserved seats yet..</p>";
        }
        ?>
      </table>
      </form>
    </div>
  </div>
  <!-- Table section ends  -->

<?php include('user-footer.php');?>