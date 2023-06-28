<?php include('Admin-nav.php');
  include '../connect.php';

?>
<!--Body section-->
<div class="page">
  <div class="ProfileContainer">
    <div class="title">Add new bus informations</div>
    <div class="content">
      <form action="" method="post" enctype="multipart/form-data">
        <div class="user-details">
          <div class="input-box"> <span class="details">Bus Owner First Name</span>
            <input type="text" name="fname" placeholder="Enter first name"  required>
          </div>
         <div class="input-box"> <span class="details">Bus Owner last Name</span>
            <input type="text" name="lname" placeholder="Enter last name"  required>
          </div>
          <div class="input-box"> <span class="details">Owner Nic Number</span>
            <input type="text" name="nicnumber" placeholder="Enter Nic-Number" maxlength="12" pattern=".{9,12}" title="Enter valid nic number" required>
          </div>
          <div class="input-box"> <span class="details">Owner Contact Number</span>
            <input type="text" name="Pnumber" placeholder="Enter Contact Number"  maxlength="9" pattern="[+ 0-9]{9}" title="Please Enter 10 digit number" required>
          </div>
          <div class="input-box"> <span class="details">Bus licences Number</span>
            <input type="text" name="Lumber" id="licence_number" placeholder="Enter licences Number" maxlength="7" 
               pattern=".{7,}" title="Seven or more characters"    required>
          </div>
          <div class="input-box"> <span class="details">Bus Permit Number</span>
            <input type="number" name="BPnumber" placeholder="Enter Permit Number" min="0" required>
          </div>
          <div class="input-box"> <span class="details">Seats Count</span>
            <input type="number" name="Svalue" placeholder="Enter Seat Count" min="40" max="44" required>
          </div>
        </div>
        <div class="button">
          <input type="submit" name="submit" value="Add">
        </div>
      </form>
    </div>
  </div>
</div>
 <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0/dist/cleave.min.js"></script>
    <script>
var cleave = new Cleave('#licence_number', {
    delimiters: ['-'],
    blocks: [2, 4],
    uppercase: true
});

</script>
<?php
if ( isset( $_POST[ 'submit' ] ) ) {
  $fname = mysqli_real_escape_string( $connect, $_POST[ 'fname' ] );
  $lname = mysqli_real_escape_string( $connect, $_POST[ 'lname' ] );
  $Nicnumber = mysqli_real_escape_string( $connect, $_POST[ 'nicnumber' ] );
  $Pnumber = mysqli_real_escape_string( $connect, $_POST[ 'Pnumber' ] );
  $Lumber = mysqli_real_escape_string( $connect, $_POST[ 'Lumber' ] );
  $BPnumber = mysqli_real_escape_string( $connect, $_POST[ 'BPnumber' ] );
  $Snumber = mysqli_real_escape_string( $connect, $_POST[ 'Svalue' ] );


  if ( strlen( $fname ) == 0 || strlen( $lname ) == 0 || strlen( $Lumber ) == 0 || strlen( $Pnumber ) == 0 || strlen( $BPnumber ) == 0 || strlen( $Nicnumber ) == 0 || strlen( $Snumber ) == 0 ) {

    ?>
<script>alert("Fields are empty!");</script><?php
} else if ( !preg_match( "/^[A-Za-z]+$/", $fname ) ) {
?><script>alert("Please enter valid owner name!");</script><?php
} else if ( !preg_match( "/^[A-Za-z]+$/", $lname ) ) {
?><script>alert("Please enter valid owner name!");</script><?php
} else  if ( !preg_match( '/^([0-9]{9}[x|X|v|V]|[0-9]{12})$/', $Nicnumber ) ) {
?><script>alert("Please Enter valid nic number!");</script><?php
}else if ( !preg_match( "/^[0-9]*$/", $Pnumber ) ) {
?><script>alert("Please enter valid contact Number!");</script><?php
} else if ( !preg_match( "/^[0-9]*$/", $Snumber ) ) {
?><script>alert("Please enter valid seat Count!");</script><?php
}else {
   
   
   $select = mysqli_query($connect, "SELECT * FROM bus_details WHERE licences_Number = '$Lumber' ");
   if(mysqli_num_rows($select)) {
   ?><script>alert("This bus is alredy registerd!");</script><?php
   }else{
      /*--inser Bus deta--*/
  $sql_userdatabase = "insert into bus_details(Owner_First_name,Owner_Last_name ,Nic_number ,Phone_Number, licences_Number, Permit_Number,Seats_Count) 
          values ('$fname','$lname' , '$Nicnumber' ,$Pnumber, '$Lumber','$BPnumber', $Snumber)";


  if ( mysqli_query( $connect, $sql_userdatabase ) == true ) {
    echo "<script> alert('Bus Registerion Successful');window.location.href='Admin-Add-New-Bus.php';</script>";
  } else {
    ?><script>alert("Bus Registerion Faild"); </script><?php
  }
   }

}

}

?>
<?php include('Admin-footer.php');?>