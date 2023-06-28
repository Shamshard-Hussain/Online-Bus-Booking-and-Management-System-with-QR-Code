

<?php

include( 'Admin-nav.php' );
include '../connect.php';

//get the id of admin to be deleteed
//check id set or not
if ( isset( $_GET[ 'Id' ] )) {
  $id = $_GET[ 'Id' ];



 
 
  $sql = "DELETE FROM feedback WHERE FId=$id";
  $res = mysqli_query( $connect, $sql );
  if ( $res == true ) {

    ?>
        <script>
         alert("Data deleted successfully");
       </script>
    <?php
header( 'location:Admin-Vew-Feedback.php' );
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
      <a href="Admin-Vew-Feedback.php" class="btn">Go Back</a></br>
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