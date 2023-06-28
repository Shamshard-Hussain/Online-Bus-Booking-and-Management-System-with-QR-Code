<?php
include( 'Admin-nav.php' );
include '../connect.php';
?>




<?php


//sql Query to get data
$sql = "SELECT * FROM feedback";
$res = mysqli_query( $connect, $sql );
//count Rows
$count = mysqli_num_rows( $res );

if ( $count > 0 ) {
 ?>
<section class="Feedback">
  <div class="full-boxer">

<?Php
  while ( $row = mysqli_fetch_assoc( $res ) ) {

    $FId = $row[ 'FId' ];
    $Passenger_Name = $row[ 'Passenger_Name' ];
    $Passenger_Email = $row[ 'Passenger_Email' ];
    $Passenger_Phone = $row[ 'Passenger_Phone' ];
    $Inquries = $row[ 'Inquries' ];
    $Date_Time = $row[ 'Date-&-Time' ];
   $Inquries_from=$row['Inquries_from'];

    ?> 
    <div class="comment-box">
      <div class="box-top">
        <div class="Comment-Profile">
          <div class="profile-image"> <img src="../img/Admin-Home/profile-user.png"> </div>
          <div class="Name"> 
           <strong><?php echo $Passenger_Name;?></strong> 
           <span><?php echo $Passenger_Email;?></span> 
           <span><?php echo $Date_Time;?></span></div>
        </div>
      </div>
      <div class="comment">
        <p> <?php echo $Inquries;?></p>
       
       <?php if($Inquries_from=='inside'){
       ?>  <a  href="Admin-Feedback.php?email=<?php echo $Passenger_Email; ?>" class="comment-R">Replay</a> 
       <a href="Delete-Feedback.php?Id=<?php echo $FId; ?>" class="comment-D">Remove</a></br><?php
       }else{
        ?><a href="Delete-Feedback.php?Id=<?php echo $FId; ?>" class="comment-D">Remove</a></br> <?php
       }?>
       
      </div>
    </div>
   
 
<?php
}
 ?>
 </div>
</section>

<?php
 
 
} else {
    ?>
<section class="Feedback">
  <div class="full-boxer">
    <div class="comment-box">
      <div class="box-top">
        <div class="Comment-Profile">
          <div class="profile-image"> <img src="../img/Admin-Home/profile-user.png"> </div>
          <div class="Name"> <strong>Unkonown</strong> <span>@No_body</span> </div>
        </div>
      </div>
      <div class="comment">
        <p> No comments, feedback and inquires avalable right now. </p>
      </div>
    </div>
  </div>
</section>
<?php
}
?>



<?php
include( 'Admin-footer.php' );
?>