<?php include('user-header.php');?>

 <!-- profile section starts  -->
<div class="Red_button" >
  <button type="button" class="logout-button" >
  <span class="logout-button__text">
   <a onclick="if (confirm('Log Out?')){return true;}
                else{event.stopPropagation(); event.preventDefault();};" 
      href="logout.php">Log-Out</span> <span class="logout-button__icon">
   
  <ion-icon><img  src="../img/Icon/icons8-logout-30.png"></ion-icon></a>
  </span>
 </button>
</div>


<div class="profile_body">
<section class="profile_container">
      <h3>User Profile</h3>
      <form action="#" class="profile_form" method="post">
       
       <div class="column">
          <div class="profile_input-box">
            <label>First name</label>
            <input type="text" name="fname" value="<?php echo $_SESSION['fname']; ?>" placeholder="Enter First Name" pattern="[a-z]{1,15}" title="Please enter valid name" required />
          </div>
          <div class="profile_input-box">
            <label>Last Name</label>
            <input type="text" value="<?php echo $_SESSION['lname'];?>" name="lname" placeholder="Enter Last Name" pattern="[a-z]{1,15}" title="Please enter valid name" required />
          </div>
        </div>
       
        <div class="profile_input-box">
          <label>Email Address</label>
          <input type="text" value=" <?php echo $_SESSION['email'] ?>" name="email"  placeholder="Enter Email Address" readonly />
        </div>

        <div class="profile_input-box">
          <label>Phone Number</label>
          <input type="text" value="<?php echo $_SESSION['phone'] ?>" placeholder="Enter Phone Number" name="phone" maxlength="9" pattern="[+ 0-9]{9}" title="Please Enter 9 digit number without 0" required />
        </div>

        <div class="column">
          <div class="profile_input-box">
            <label>New Password</label>
            <input type="password" name="password" placeholder="Enter New Password" pattern=".{7,}" title="Seven or more characters" required />
          </div>
          <div class="profile_input-box">
            <label>Confirm Password</label>
            <input type="password" name="cpassword" placeholder="Confirm Password" pattern=".{7,}" title="Seven or more characters" required />
          </div>
        </div>

        <button type="submit" name="submit">Update</button>
      </form>
    </section>

</div>
 <!-- profile section ends --> 
 
<?php
if ( isset( $_POST[ 'submit' ] ) ) {
$fname =mysqli_real_escape_string($connect, $_POST[ 'fname' ]);
$lname =mysqli_real_escape_string($connect, $_POST[ 'lname' ]);
$Phone = mysqli_real_escape_string($connect,$_POST[ 'phone' ]);
$password = mysqli_real_escape_string($connect, md5($_POST['password']) );
$Cpassword = mysqli_real_escape_string($connect,md5($_POST['cpassword']));
 
if ( strlen( $fname ) == 0 || strlen( $lname ) == 0|| strlen( $Phone ) == 0 || strlen( $password ) == 0 || strlen( $Cpassword ) == 0 ) {

echo '<script>alert("Fields are empty!");</script>';
} else if ( !preg_match( "/^[A-Za-z]+$/", $fname ) ) {
echo '<script>alert("Please enter valid name!");</script>';
} else if ( !preg_match( "/^[A-Za-z]+$/", $lname ) ) {
echo '<script>lert("Please enter valid name!");</script>';
} else if ( !preg_match( "/^[0-9]*$/", $Phone ) ) {
echo '<script>alert("Please enter valid phone number!");</script>';
} else if ( strlen( $password ) < 6 ) {
echo '<script>alert("Password is too short!");</script>';
} else if ( $password !== $Cpassword ) {
echo '<script>alert("Password is not matching!");</script>';
} else if ( $password === $Cpassword ) {
    $sql_profile_info = "Update passenger set
     First_Name = '$fname' ,
     Last_Name = '$lname' ,
     Phone= '$Phone' ,
     password = '$password'
     where UserID='{$_SESSION[ 'userid' ]}'
    ";
  if ( mysqli_query( $connect, $sql_profile_info ) == true ) {
    $_SESSION[ 'fname' ] = $fname;
    $_SESSION[ 'lname' ] = $lname;
    $_SESSION[ 'phone' ] = $Phone;
   echo "<script> alert('Update Successful');window.location.href='user-profile.php';</script>";
  } else {
   echo '<script>alert("Update Faild!");</script>';
  }
  }else { echo '<script>alert("Update Faild!");</script>'; }
}
 
 

include('user-footer.php');