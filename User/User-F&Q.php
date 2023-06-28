<?php
include '../connect.php' ;
 include('user-header.php');?>

	
<div class="contact-box">
  <div class="fQ_content">
    <h1>CONTACT US</h1>
    <p>Connect with us by sending your views.</p>
  </div>
 <form action="" method="post" enctype="multipart/form-data">
  <div class="fQ_form">

    <div class="top-fQ_form">
      <div class="inner-fQ_form">
        <div class="label">name</div>
        <input type="text"  name="name" value="<?php echo $_SESSION['fname'] ?>" pattern="[a-z]{1,15}" title="Please enter valid name" required >
      </div>
      <div class="inner-fQ_form">
        <div class="label">email</div>
        <input type="email"  name="email" value="<?php echo $_SESSION['email'] ?>" pattern="[a-zA-Z0-9!#$%&amp;'*+\/=?^_`{|}~.-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*" title="Please enter valid email" required >
      </div>
      
    </div>

    <div class="middle-fQ_form">
      <div class="inner-fQ_form">
        <div class="label">subject</div>
        <input type="text" placeholder="Subject" required>
      </div>
    </div>

    <div class="bottom-fQ_form">
      <div class="inner-fQ_form">
        <div class="label">message</div>
        <textarea placeholder="Your message" name="feedback" required></textarea>
      </div>
    </div>

    <div >
    <input class="fQ_btn" type="submit" name="submit"  value="Send">
   </div>
</form>
  </div>
</div>

<!-- ends  -->



      <?php
if ( isset( $_POST[ 'submit' ] ) ) {

  $name = mysqli_real_escape_string( $connect, $_POST[ 'name' ] );
  $email = mysqli_real_escape_string( $connect, $_POST[ 'email' ] );
  $Pnumber = mysqli_real_escape_string( $connect, $_POST[ 'Pnumber' ] );
  $feedback = mysqli_real_escape_string( $connect, $_POST[ 'feedback' ] );

  if ( strlen( $name ) == 0 || strlen( $email ) == 0 || strlen( $feedback ) == 0 ) {
?><script>alert("Fields are empty");</script><?php
} else if ( !preg_match( "/^[A-Za-z]+$/", $name ) ) {
?><script>alert("Please enter valid name");</script><?php
} else if ( !preg_match( "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/", $email ) ) {
?><script>alert("Please enter valid email");</script><?php
} else {

  /*--send Feedback--*/
   $sql_userdatabase = "Insert into feedback(Passenger_Name,Passenger_Email,Passenger_Phone,Inquries,Inquries_from) 
          values ('$name','$email' , '$Pnumber' ,'$feedback','inside')";

  if ( mysqli_query( $connect, $sql_userdatabase ) == true ) {
    echo "<script> alert('Message send');window.location.href='User-F&Q.php';</script>";
  } else {
    ?><script>alert("Faild to send Message");</script>
<?php
}
}
}
?>


<?php include('user-footer.php');?>