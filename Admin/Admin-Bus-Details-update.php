<?php
include( 'Admin-nav.php' );


include '../connect.php';


//check id and LNumber set or not
if ( isset( $_GET[ 'id' ] )& isset( $_GET[ 'busNumbr' ] ))   {
  $id = $_GET[ 'id' ];
 $busNumbr = $_GET[ 'busNumbr' ];
 
  $sql2 = "SELECT * FROM bus_details WHERE Bus_id=$id";
  $res2 = mysqli_query( $connect, $sql2 );

  $row = mysqli_fetch_assoc( $res2 );

    $id = $row[ 'Bus_id' ];
    $fname = $row[ 'Owner_First_name' ];
    $lname = $row[ 'Owner_Last_name' ];
    $Phone = $row[ 'Phone_Number' ];
    $Lumber = $row[ 'licences_Number' ];
    $NicNumber = $row[ 'Nic_number' ];
    $BPnumber = $row[ 'Permit_Number' ];
    $Snumber = $row[ 'Seats_Count' ];
 
   //sql Query to get data
     $sql="SELECT * FROM bus_details";
      $res=mysqli_query($connect,$sql);
     //count Rows
     $count=mysqli_num_rows($res);
     if($count>0)
     {
      while($row=mysqli_fetch_assoc($res))
      {$licences_Number = $row[ 'licences_Number' ];}
     }
 ?>

<!--Body section-->
<div class="page">
  <div class="ProfileContainer">
    <div class="title">Update bus informations</div>
    <div class="content">
      <form action="" method="post" enctype="multipart/form-data">
        <div class="user-details">
         <div class="input-box"> <span class="details">Bus Owner First Name</span>
          <input type="text" name="fname"value="<?php echo $fname;?>"  placeholder="Enter first name" required>
          </div>
         <div class="input-box"> <span class="details">Bus Owner last Name</span>
            <input type="text" name="lname" value="<?php echo $lname;?>"  placeholder="Enter last name" required>
          </div>
          <div class="input-box"> <span class="details">Owner Nic Number</span>
            <input type="text" name="nicnumber" value="<?php echo $NicNumber;?>" placeholder="Enter Nic-Number" required>
          </div>
         
         <div class="input-box"> <span class="details">Owner Contact Number</span>
            <input type="text" name="Cnumber" value="<?php echo $Phone;?>" id="tp" maxlength="9" pattern="[+ 0-9]{9}" title="Please Enter 10 digit number" placeholder="Enter Contact Number" required>
          </div>  
        
          <div class="input-box"> <span class="details">Bus licences Number</span>
            <input type="text" name="Lnumber" id="licence_number" value="<?php echo $Lumber;?>" placeholder="Enter licences Number"  required>
          </div>
          <div class="input-box"> <span class="details">Bus Permit Number</span>
            <input type="number" name="BPNumber" value="<?php echo $BPnumber;?>" placeholder="Enter Permit Number" min="0" required>
          </div>
          
        </div>
        <div class="button">
          <input type="submit" name="submit" value="Update">
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
  $Pnumber = mysqli_real_escape_string( $connect, $_POST[ 'Cnumber' ] );
  $Lumber = mysqli_real_escape_string( $connect, $_POST[ 'Lnumber' ] );
  $BPNumber = mysqli_real_escape_string( $connect, $_POST[ 'BPNumber' ] );


  if ( strlen( $fname ) == 0 || strlen( $lname ) == 0 || strlen( $Lumber ) == 0 || strlen( $Pnumber ) == 0 || strlen( $BPnumber ) == 0 || strlen( $Nicnumber ) == 0 || strlen( $Snumber ) == 0 ) {

    ?>
    <script>
         alert("Fields are empty");
        </script>
<?php
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
}else if($busNumbr !=$Lumber){
   
   if($licences_Number =$Lumber){
    ?><script>alert("This bus is alredy registerd!");</script><?php
   }
   
  } else {
 

//echo $id;
  $sql_bus_info = "Update bus_details set
     Owner_First_name = '$fname' ,
     Owner_Last_name = '$lname' ,
     Nic_number= '$Nicnumber' ,
     Phone_Number = $Pnumber, 
     licences_Number= '$Lumber',
     Permit_Number = $BPNumber, 
     Seats_Count = $Snumber
     where Bus_id=$id
    ";


  if ( mysqli_query( $connect, $sql_bus_info ) == true ) {
    echo "<script> alert('Update Successful!');window.location.href='Admin-Bus-Details.php';</script>";
  } else {
    ?>
              <script>
                alert("Update Faild!");
              </script>
<?php
}

}

}

include( 'Admin-footer.php' );


} else {
  ?><script>alert("Update Faild,Form is not submited");</script><?php 
   header( "location:Admin-Bus-Details.php" );
} 

?>





