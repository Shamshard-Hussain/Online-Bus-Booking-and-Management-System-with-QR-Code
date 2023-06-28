<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <script src="https://code.jquery.com/jquery-latest.js"></script>

  <script type="text/javascript">
$(document).ready(function(){
 $('.click').click(function(){
  var text="";
  $('.click:checked').each(function(){
   text+=$(this).val()+',';
  });
  text=text.substring(0,text.length-1);
  $('#seat_name').val(text);
  var count=$("[type='checkbox']:checked").length;
  $('#count').val($("[type='checkbox']:checked").length*200);
 });
});

 </script>

<?php include('user-header.php');

include '../connect.php';

if ( isset( $_GET[ 'Shedules_id' ] ) ) {
 
 $_SESSION[ 'Shedules_id' ]=mysqli_real_escape_string( $connect,  $_GET[ 'Shedules_id' ] );
 
$sql = "SELECT * FROM bus_shedules where Shedules_id='{$_SESSION[ 'Shedules_id' ]}'";
          $res = mysqli_query( $connect, $sql );
          //count Rows
          $count = mysqli_num_rows( $res );
          if ( $count > 0 ) {
           
            while ( $row = mysqli_fetch_assoc( $res ) ) {
             
          $Bus_number=$row['Bus_number'];
          $Bname = $row[ 'Bus_name' ]; 
          $Stime = $row[ 'Stat_time' ];
          $Etime = $row[ 'End_time' ];
          $Spoint = $row[ 'Starting_point' ];
          $Destination = $row[ 'Final_destination' ];
          $Scount = $row[ 'Seats_Count' ];
          $Status = $row[ 'Status' ];
            }
          }      
?>
<div class="booking-container">
  <div class="form">
    <div class="Booking-info">
      <h3 class="title">Seat Map</h3>
      <div class="seat_info">
        <ul class="showcase">
          <li>
            <div class="seat"></div>
            <small>Available</small> </li>
          <li>
            <div class="seat sold"></div>
            <small>Reserveed</small> </li>
        </ul>
      </div>
      <div class="container3">
       
        <div class="row" id="multiselect-drop">
         <?php 
          $sql1 = "SELECT * FROM seat where Shedules_id={$_SESSION[ 'Shedules_id' ]} LIMIT 0,4 ";
          $res1 = mysqli_query( $connect, $sql1 );
          $count1 = mysqli_num_rows( $res1 );

              if ( $count1 > 0 ) {
                  while ( $row1 = mysqli_fetch_assoc( $res1 ) ) {
                  $Seat_data1 = $row1[ 'Name' ];
                  $Status1 = $row1['Status'];
                 
                  if($Status1=="A"){
                    ?>
                   
                     <div class="seat">
                     <input type="checkbox" name="groupid" id="Seat1" class="click" value="'<?php echo $Seat_data1; ?>'"/><br><?php echo $Seat_data1; ?></div>
                 
         
                    <?Php
                   }else{
                     ?>
                     <div class="seat sold"><br><?php echo $Seat_data1; ?></div>
                     <?Php
                   }
                  }
               }
         ?>
        </div> 
          <div class="row" id="multiselect-drop">
         <?php 
          $sql2 = "SELECT * FROM seat where Shedules_id={$_SESSION[ 'Shedules_id' ]} LIMIT 4,4 ";
          $res2 = mysqli_query( $connect, $sql2 );
          $count2 = mysqli_num_rows( $res2 );

              if ( $count2 > 0 ) {
                  while ( $row2= mysqli_fetch_assoc( $res2 ) ) {
                  $Seat_data2 = $row2[ 'Name' ];
                  $Status2 = $row2['Status'];
                 
                  if($Status2=="A"){
                    ?>
                    <div class="seat">
                     <input type="checkbox" name="groupid" class="click" value="'<?php echo $Seat_data2; ?>'"/><br><?php echo $Seat_data2; ?></div>
                    <?Php
                   }else{
                     ?>
                     <div class="seat sold"><br><?php echo $Seat_data2; ?></div>
                     <?Php
                   }
                  }
               }
         ?>
        </div>
       
          <div class="row" id="multiselect-drop">
         <?php 
          $sql3 = "SELECT * FROM seat where Shedules_id={$_SESSION[ 'Shedules_id' ]} LIMIT 8,4 ";
          $res3 = mysqli_query( $connect, $sql3 );
          $count3 = mysqli_num_rows( $res3 );

              if ( $count3 > 0 ) {
                  while ( $row3= mysqli_fetch_assoc( $res3 ) ) {
                  $Seat_data3 = $row3[ 'Name' ];
                  $Status3 = $row3['Status'];
                 
                  if($Status3=="A"){
                    ?>
                    <div class="seat">
                     <input type="checkbox" name="groupid" class="click" value="'<?php echo $Seat_data3; ?>'"/><br><?php echo $Seat_data3; ?></div>
                    <?Php
                   }else{
                     ?>
                     <div class="seat sold"><br><?php echo $Seat_data3; ?></div>
                     <?Php
                   }
                  }
               }
         ?>
        </div>
       
          <div class="row" id="multiselect-drop">
         <?php 
          $sql4 = "SELECT * FROM seat where Shedules_id={$_SESSION[ 'Shedules_id' ]} LIMIT 12,4 ";
          $res4 = mysqli_query( $connect, $sql4 );
          $count4 = mysqli_num_rows( $res4 );

              if ( $count2 > 0 ) {
                  while ( $row4= mysqli_fetch_assoc( $res4 ) ) {
                  $Seat_data4 = $row4[ 'Name' ];
                  $Status4 = $row4['Status'];
                 
                  if($Status4=="A"){
                    ?>
                    <div class="seat"><input type="checkbox" name="groupid" class="click" value="'<?php echo $Seat_data4; ?>'"/><br><?php echo $Seat_data4; ?></div>
                    <?Php
                   }else{
                     ?>
                     <div class="seat sold"><br><?php echo $Seat_data4; ?></div>
                     <?Php
                   }
                  }
               }
         ?>
        </div>
       
          <div class="row" id="multiselect-drop">
         <?php 
          $sql5 = "SELECT * FROM seat where Shedules_id={$_SESSION[ 'Shedules_id' ]} LIMIT 16,4 ";
          $res5 = mysqli_query( $connect, $sql5 );
          $count5 = mysqli_num_rows( $res5 );

              if ( $count5 > 0 ) {
                  while ( $row5= mysqli_fetch_assoc( $res5 ) ) {
                  $Seat_data5 = $row5[ 'Name' ];
                  $Status5 = $row5['Status'];
                 
                  if($Status5=="A"){
                    ?>
                    <div class="seat"><input type="checkbox" name="groupid" class="click" value="'<?php echo $Seat_data5; ?>'"/><br><?php echo $Seat_data5; ?></div>
                    <?Php
                   }else{
                     ?>
                     <div class="seat sold"><br><?php echo $Seat_data5; ?></div>
                     <?Php
                   }
                  }
               }
         ?>
        </div>
       
          <div class="row" id="multiselect-drop">
         <?php 
          $sql6 = "SELECT * FROM seat where Shedules_id={$_SESSION[ 'Shedules_id' ]} LIMIT 20,4 ";
          $res6 = mysqli_query( $connect, $sql6 );
          $count6 = mysqli_num_rows( $res6 );

              if ( $count6 > 0 ) {
                  while ( $row6= mysqli_fetch_assoc( $res6 ) ) {
                  $Seat_data6 = $row6[ 'Name' ];
                  $Status6 = $row6['Status'];
                 
                  if($Status6=="A"){
                    ?>
                    <div class="seat"><input type="checkbox" name="groupid" class="click" value="'<?php echo $Seat_data6; ?>'"/><br><?php echo $Seat_data6; ?></div>
                    <?Php
                   }else{
                     ?>
                     <div class="seat sold"><br><?php echo $Seat_data6; ?></div>
                     <?Php
                   }
                  }
               }
         ?>
        </div>
       
          <div class="row" id="multiselect-drop">
         <?php 
          $sql7 = "SELECT * FROM seat where Shedules_id={$_SESSION[ 'Shedules_id' ]} LIMIT 24,4 ";
          $res7 = mysqli_query( $connect, $sql7 );
          $count7 = mysqli_num_rows( $res7 );

              if ( $count7 > 0 ) {
                  while ( $row7= mysqli_fetch_assoc( $res7 ) ) {
                  $Seat_data7 = $row7[ 'Name' ];
                  $Status7 = $row7['Status'];
                 
                  if($Status7=="A"){
                    ?>
                    <div class="seat"><input type="checkbox" name="groupid" class="click" value="'<?php echo $Seat_data7; ?>'"/><br><?php echo $Seat_data7; ?></div>
                    <?Php
                   }else{
                     ?>
                     <div class="seat sold"><br><?php echo $Seat_data7; ?></div>
                     <?Php
                   }
                  }
               }
         ?>
        </div>
          <div class="row" id="multiselect-drop">
         <?php 
          $sql8 = "SELECT * FROM seat where Shedules_id={$_SESSION[ 'Shedules_id' ]} LIMIT 28,4 ";
          $res8 = mysqli_query( $connect, $sql8 );
          $count8 = mysqli_num_rows( $res8 );

              if ( $count8 > 0 ) {
                  while ( $row8= mysqli_fetch_assoc( $res8 ) ) {
                  $Seat_data8 = $row8[ 'Name' ];
                  $Status8 = $row8['Status'];
                 
                  if($Status8=="A"){
                    ?>
                    <div class="seat"><input type="checkbox" name="groupid" class="click" value="'<?php echo $Seat_data8; ?>'"/><br><?php echo $Seat_data8; ?></div>
                    <?Php
                   }else{
                     ?>
                     <div class="seat sold"><br><?php echo $Seat_data8; ?></div>
                     <?Php
                   }
                  }
               }
         ?>
        </div>
          <div class="row" id="multiselect-drop">
         <?php 
          $sql9 = "SELECT * FROM seat where Shedules_id={$_SESSION[ 'Shedules_id' ]} LIMIT 32,4 ";
          $res9 = mysqli_query( $connect, $sql9 );
          $count9 = mysqli_num_rows( $res9 );

              if ( $count9 > 0 ) {
                  while ( $row9= mysqli_fetch_assoc( $res9 ) ) {
                  $Seat_data9 = $row9[ 'Name' ];
                  $Status9 = $row9['Status'];

                 
                  if($Status9=="A"){
                    ?>
                    <div class="seat"><input type="checkbox" name="groupid" class="click" value="'<?php echo $Seat_data9; ?>'"/><br><?php echo $Seat_data9; ?></div>
                    <?Php
                   }else{
                     ?>
                     <div class="seat sold"><br><?php echo $Seat_data9; ?></div>
                     <?Php
                   }
                  }
               }
         ?>
        </div>
          <div class="row" id="multiselect-drop">
         <?php 
          $sql10 = "SELECT * FROM seat where Shedules_id={$_SESSION[ 'Shedules_id' ]} LIMIT 36,4 ";
          $res10 = mysqli_query( $connect, $sql10 );
          $count10 = mysqli_num_rows( $res10 );

              if ( $count10 > 0 ) {
                  while ( $row10= mysqli_fetch_assoc( $res10 ) ) {
                  $Seat_data10 = $row10[ 'Name' ];
                  $Status10 = $row10['Status'];
                 
                  if($Status10=="A"){
                    ?>
                    <div class="seat"><input type="checkbox" name="groupid" class="click" value="'<?php echo $Seat_data10; ?>'"/><br><?php echo $Seat_data10; ?></div>
                    <?Php
                   }else{
                     ?>
                     <div class="seat sold"><br><?php echo $Seat_data10; ?></div>
                     <?Php
                   }
                  }
               }
         ?>
        </div>
          <div class="row" id="multiselect-drop">
         <?php 
          $sql11 = "SELECT * FROM seat where Shedules_id={$_SESSION[ 'Shedules_id' ]} LIMIT 40,4 ";
          $res11 = mysqli_query( $connect, $sql11 );
          $count11 = mysqli_num_rows( $res11 );

              if ( $count11 > 0 ) {
                  while ( $row11= mysqli_fetch_assoc( $res11 ) ) {
                  $Seat_data11 = $row11[ 'Name' ];
                  $Status11 = $row11['Status'];
                 
                  if($Status11=="A"){
                    ?>
                    <div class="seat"><input type="checkbox" name="groupid" class="click" value="'<?php echo $Seat_data11; ?>'"/><br><?php echo $Seat_data11; ?></div>
                    <?Php
                   }else{
                     ?>
                     <div class="seat sold"><br><?php echo $Seat_data11; ?></div>
                     <?Php
                   }
                  }
               }
         ?>
        </div>
      </div>
    </div>
   
    <script>/*if checked box ckecked seat color change to green*/
   $(":checkbox").on("change",function(){
    $(this).parent().toggleClass("selected",this.checked);
   });
  </script>
   
    <div class="Booking-form"> 
      
      <!-- This is main Form Area Start ++ -->
      <div class="bf-container"> 
        
        <!-- Main form Body Start -->
        <div class="bf-body"> 
          
          <!-- Form haed -->
          <div class="bf-head">
            <h3 class="title">Booking Form</h3>
            <p class="bf-p">|-Lets start To booking Now-|</p>
          </div>
          <!-- Form haed --> 
          
          <!-- Form Body Box -->
          <form class="bf-body-box bf-form" action="#" method="post" enctype="multipart/form-data" >
            <div class="bf-row">
              <div class="bf-col-6">
                <p>Departure from</p>
                <input class="bf-input" type="text" value="<?php echo $Spoint;?>" name="Departure_from"  placeholder="Departure from" disabled>
              </div>
             
              <div class="bf-col-6">
                <p>Final Destination</p>
                <input class="bf-input" type="text" value="<?php echo $Destination;?>" name="Final_Destination" placeholder="Final Destination" disabled>
              </div>
             
            </div>
            <div class="bf-row">
             <div class="bf-col-6">
                <p>Departure Time</p>
                <input class="bf-input" type="time" value="<?php echo $Stime ;?>" name="time" id="time" disabled >
              </div>
             
              <div class="bf-col-6">
                <p>Date</p>
               <input class="bf-input" type="date" id="inputdate" name="date" value="<?php echo date("m/d/Y");?>" required>
              </div>
            </div>
           
           <div class="bf-row">
              <div class="bf-col-6">
                <p>Bus Number</p>
                <input class="bf-input" value="<?php echo $Bus_number;?>" type="text" name="Bnumber" id="Bnumber" placeholder="Bus Number" disabled >
              </div>
            
              <div class="bf-col-6">
                <p>Total Ticket Price (Rs)</p>
                <input class="bf-input"  type="text" id="count" name="price" placeholder="Price" readonly >
              </div>          
            
            </div>
           
           <div class="bf-row">
                  <div class="bf-col-7">
                <p>Selected Seats</p>
                <input class="bf-input" type="text" name="Seat" id="seat_name" placeholder="Click Seat" readonly >
              </div>      
            
            </div> 

            <div class="bf-row">
              <div class="bf-col-3">
                <input class="bf-btn" type="submit" name="submit" value="Confirm">
              </div>
            </div>
          </form>
          <!-- Form Body Box --> 
          
        </div>
        <!-- Main form Body End --> 
        
      </div>
      <!-- This is main Form Area  End --> 
      
    </div>
  </div>
</div>
  <script type="text/javascript">
    $(function(){
    var dtToday = new Date();
 
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
     day = '0' + day.toString();
    var maxDate = year + '-' + month + '-' + day;
    $('#inputdate').attr('min', maxDate);
});
 </script>
<?php
if ( isset( $_POST[ 'submit' ] ) ) {
  include '../connect.php';

 $date =mysqli_real_escape_string($connect, $_POST[ 'date' ]);
 $Seat =mysqli_real_escape_string($connect, $_POST[ 'Seat' ]);
 $price=mysqli_real_escape_string($connect, $_POST[ 'price' ]);
 if(strlen( $Seat ) == 0 ){
  echo '<script>alert("Please select a Seat!");</script>';
 }else{
  
    $_SESSION[ 'date' ]=$date;
     $_SESSION[ 'Stat_time' ]=$Stime;
     $_SESSION[ 'Departure_from' ]=$Spoint;
     $_SESSION[ 'Final_Destination' ]=$Destination;
     $_SESSION[ 'Bnumber' ] =$Bus_number;
     $_SESSION[ 'Booking' ] = '1';
?><script>window.location.href='Payment.php?Seatdata=<?php echo $Seat;?>&price=<?php echo $price;?>';</script><?php
   }    

 }
 
include('user-footer.php');
}else{
 header( "location:user-bus-schedules.php" );
}

?>
