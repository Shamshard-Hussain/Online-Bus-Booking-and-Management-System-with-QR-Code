<?php

include( 'Admin-nav.php' );
include '../connect.php';

//get the id of admin to be deleteed
//check id set or not
if ( isset( $_GET[ 'id' ] )AND isset($_GET['Seat_data'])) {
  $id = $_GET[ 'id' ];
  $Lumber=$_GET[ 'Seat_data' ];


 $sql_Seat='DELETE FROM seat WHERE Bus_number = "' . $Lumber . '" '; 
    $res2=mysqli_query($connect,$sql_Seat);
 
  $sql = "DELETE FROM bus_details WHERE Bus_id=$id";
  $res = mysqli_query( $connect, $sql );
  if ( $res == true & $res2==true) {

    ?>
        <script>
         alert("Data deleted successfully");
       </script>
    <?php
header( 'location:Admin-Bus-Details.php' );
}
else {

  ?>
<div class="dialog">
  <h1 class="heading"></br>
    </br>
  </h1>
  <div class="box-dialog">
    <div class="box"><img src="../img/notifications/alert-danger-error-exclamation-mark-red-icon-227724.png" alt=""></br>
      </br>
      <h3>Failed to Delete Data</h3>
      </br>
      <a href="Admin-Bus-Details.php" class="btn">Go Back</a></br>
      </br>
    </div>
  </div>
</div>
<?php

}
}
else {
  ?>
<div class="dialog">
  <h1 class="heading"></br>
    </br>
  </h1>
  <div class="box-dialog">
    <div class="box"><img src="../img/notifications/alert-danger-error-exclamation-mark-red-icon-227724.png" alt=""></br>
      </br>
      <h3>Failed to Delete Data</h3>
      </br>
      <a href="Admin-Bus-Details.php" class="btn">Go Back</a></br>
      </br>
    </div>
  </div>
</div>
<?php
}
?>

<?php include('Admin-footer.php');?>