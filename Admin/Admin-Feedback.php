<?php
include( 'Admin-nav.php' );
include '../connect.php';
if ( isset( $_GET[ 'email' ] )) {
  $Passenger_Email = $_GET[ 'email' ];
 
 $sql = "SELECT * FROM passenger where Email='$Passenger_Email'";
          $res = mysqli_query( $connect, $sql );
          //count Rows
          $count = mysqli_num_rows( $res );
          if ( $count > 0 ) {
            while ( $row = mysqli_fetch_assoc( $res ) ) {
            $passenger_ID=$row['UserID'];
         
            }
           
          }
}
?>

<div class="contact-box">
  <div class="fQ_content">
    <h1>Replay to passenger Reviews.</h1>
    <p></p>
  </div>
<form action="" method="post" enctype="multipart/form-data">
  <div class="fQ_form">

    <div class="top-fQ_form">
      
      <div class="inner-fQ_form">
        <div class="label">passenger email</div>
        	<input type="email" name="New_email" value="<?php echo $Passenger_Email; ?>"  readonly >
      </div>
     
      
    </div>

    <div class="middle-fQ_form">
      <div class="inner-fQ_form">
        <div class="label">subject</div>
        <input type="text"  name="Subject" value="" placeholder="Subject" required>
      </div>
    </div>

    <div class="bottom-fQ_form">
      <div class="inner-fQ_form">
        <div class="label">message</div>
        <textarea placeholder="Compose email" name="Message" required></textarea>
      </div>
    </div>

    <div >
     <input class="fQ_btn" type="submit" name="submit"  value="Send">
     
     </div>

  </div>
 </form>
</div>

<!-- ends  -->

      <?php
if ( isset( $_POST[ 'submit' ] ) ) {

  $New_email = mysqli_real_escape_string( $connect, $_POST[ 'New_email' ] );
  $Subject = mysqli_real_escape_string( $connect, $_POST[ 'Subject' ] );
  $feedback = mysqli_real_escape_string( $connect, $_POST[ 'Message' ] );

  if ( strlen( $New_email ) == 0 ||strlen( $feedback ) == 0 ||strlen( $Subject ) == 0) {

    ?>
<script>
         alert("Fields are empty!");
        </script>
<?php
}else if ( !preg_match( "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/", $New_email ) ) {

  ?>
<script>
         alert("Please enter valid email!");
       </script>
<?php
}  else {

$sql_Admin = "Insert into notifications(UserID,Notifications,Type,status) 
           values ('$passenger_ID' , '$feedback','$Subject' ,'unread')";

           if ( mysqli_query( $connect, $sql_Admin ) == true ) {
            ?><script>alert("Message sent!");</script><?php
           }else{
             ?><script>alert("Faild to send Message!");</script><?php
           }
   
  }
}

?>




<?php
include( 'Admin-footer.php' );
?>