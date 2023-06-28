<?php

include( 'Admin-nav.php' );
include '../connect.php';

//get the id of admin to be deleteed
//check id and LNumber set or not
if ( isset( $_GET[ 'id' ] )AND isset($_GET['Seat_data'])) {
  $id = $_GET[ 'id' ];
$Lumber=$_GET[ 'Seat_data' ];
?>
<div class="dialog">
  <h1 class="heading"></br>
    </br>
  </h1>
  <div class="box-dialog">
    <div class="box"><img src="../img/notifications/danger-warning-sign-caution-alert-attention-error-png-icon-689109.png" alt=""></br>
      </br>
      <h3>Are you sure you want to remove this bus detailes completely?</h3>
      </br>
      <p>Deletion of details will affect to bus schedules and reservations!!</p>
      <p>Please confirm!</p>
      <a  href="Delete-Bus.php?id=<?php echo $id; ?>& Seat_data=<?php echo $Lumber; ?>" class="btn">Yes</a>  <a href="Admin-Bus-Details.php" class="btn">No</a></br>
      </br>
    </div>
  </div>
</div>

<?php include('Admin-footer.php');
}else{
  header( "location:Admin-Bus-Details.php" );
}

