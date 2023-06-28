
<?php include('user-header.php');

if ( $_SESSION[ 'Booking' ] == '' ) {
  header( "location:user-bus-schedules.php" );
}

if ( isset( $_GET[ 'Seatdata' ] ) AND isset( $_GET[ 'price' ] ) ) {
 $price= $_GET[ 'price' ];
 $Seatdata= $_GET[ 'Seatdata' ];

}
?>

<div class="Payment">
  <form  action="#" method="post" enctype="multipart/form-data" >
  <div class="prow">
    <div class="col-xs-5">
     
      <div id="cards">
        <img src="../img/payment/Visa-icon.png">
      </div><!--#cards end-->
     
      <div class="form-check">
  <label id="lbl" class="form-check-label" for='card'>
    <input id="card" class="form-check-input" type="checkbox" value="x" name="type" onClick="onlyOne(this)" checked>
    Pay Rs.<?php echo $price;?>.00/= 
  </label>
</div>
     
    </div><!--col-xs-5 end-->
   
    <div class="col-xs-5">
      <div id="cards">
        <img src="../img/payment/Master-Card-icon.png">
      </div><!--#cards end-->
      <div class="form-check">
  <label id="lbl" class="form-check-label" for='paypal'>
    <input id="paypal" class="form-check-input" type="checkbox" value="y" name="type" onClick="onlyOne(this)"  >
     Pay Rs.<?php echo $price;?>.00/= 
  </label>
</div>
    </div><!--col-xs-5 end-->
  </div><!--row end-->
 

  <div class="prow">
    <div class="col-xs-5">
      <i class="fa fa fa-user"></i>
      <label id="lbl" for="cardholder">Cardholder's Name</label>
      <input type="text" id="cardholder" placeholder="Enter Cardholder's Name" name="Cname" required>
    </div><!--col-xs-5-->
    <div class="col-xs-5">
      <i class="fa fa-credit-card-alt"></i>
      <label id="lbl" for="cardnumber">Card Number</label>
      <input type="text" placeholder="xxxx-xxxx-xxxx-xxxx" id="cardNumber" name="Cnumber" maxlength="17" pattern=".{17,}" title="Enter valid card number" required>
    </div><!--col-xs-5-->
  </div><!--row end-->
 
  <div class="prow prow-three">
    <div class="col-xs-2">
      <i class="fa fa-calendar"></i>
      <label id="lbl" for="date">Expiry Date</label>
     <input type="text" id="cardExpiry"  placeholder="MM/YY"/ maxlength="5" pattern=".{5,}" title="Enter valid Exp date" name="expdate" required>
    </div><!--col-xs-3-->
    <div class="col-xs-2">
      <i class="fa fa-lock"></i>
      <label id="lbl" for="date">CVV / CVC *</label>
      <input type="text" id="cardCcv" placeholder="security code" maxlength="3" name="SCode" pattern=".{3,}" title="3 digit numbers" required>
    </div><!--col-xs-3-->
    <div class="col-xs-5">
      <span class="small">* CVV or CVC is the card security code, unique three digits number on the back of your card seperate from its number.</span>
    </div><!--col-xs-6 end-->
  </div><!--row end-->
 
  <Payment_footer>
    <button class="Payment_btn" type="button" onClick="location.href='user-bus-schedules.php';">Back</button>
    <button type="submit" name="submit" class="Payment_btn">Done</buton>
  </Payment_footer>
  </form>
</div>
<!--wrapper end-->
</br></br>

 <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0/dist/cleave.min.js"></script>
    <script src="../js/payment.js"></script>

   <script>
   function onlyOne(checkbox) {
    var checkboxes = document.getElementsByName('type')
    checkboxes.forEach((item) => {
        if (item !== checkbox) item.checked = false
    })
    }
   </script>

<?php 
  /*get session data*/
     $userid=$_SESSION[ 'userid' ];
     $Departure_Time=$_SESSION[ 'Stat_time' ];
     $E_date= $_SESSION[ 'date' ];
     $Spoint=$_SESSION[ 'Departure_from' ];
     $Destination=$_SESSION[ 'Final_Destination' ];
     $Bus_number=$_SESSION[ 'Bnumber' ] ;
     $Shedules_id=$_SESSION[ 'Shedules_id' ];
     

     $bus_Root=$Spoint.' to ' .$Destination;

     include "../qrcode/phpqrcode/qrlib.php"; /*get data from qr library*/
     $PNG_TEMP_DIR = '../qrcode/temp/'; /*qr code save location*/
     $filename = $PNG_TEMP_DIR . 'test.png'; /*image name and format*/


if ( isset( $_POST[ 'submit' ] ) ) {
  include '../connect.php';


 $Cname = mysqli_real_escape_string( $connect, $_POST[ 'Cname' ] );
 $Cnumber = mysqli_real_escape_string( $connect, $_POST[ 'Cnumber' ] );
 $expdate = mysqli_real_escape_string( $connect, $_POST[ 'expdate' ] );
 $SCode = mysqli_real_escape_string( $connect, $_POST[ 'SCode' ] );

 if (  strlen( $Cname ) == 0 || strlen( $Cnumber ) == 0 || strlen( $expdate ) == 0 || strlen( $SCode ) == 0) {

   echo '<script>alert("Fields are empty!");</script>';
  
}  else if ( !preg_match( "/^[A-Za-z]+$/", $Cname ) ) {

  echo '<script>alert("Please enter valid name!");</script>';
} else {

   if(strstr($Seatdata,'Sn1')) {
    mysqli_query($connect,"UPDATE seat Set Status='D' WHERE Name='Sn1' and Shedules_id={$_SESSION['Shedules_id']}");
    
    $Ticket_id=rand(0000000,9999999);
   
      if ( !file_exists( $PNG_TEMP_DIR ) ) /*checking alrady qr code exist*/
        mkdir( $PNG_TEMP_DIR );

      /*Store data to Qr library*/
      $codeString = "Ticket Id - " . $Ticket_id . "\n";
      $codeString .= $_SESSION[ 'Departure_from' ] . " to " . $_SESSION[ 'Final_Destination' ] . "\n";
      $codeString .= "Departure Time - " . $_SESSION[ 'Stat_time' ] . "\n";
      $codeString .= "Bus Number - " . $_SESSION[ 'Bnumber' ] . "\n";
      $codeString .= "Seat Code - Sn1   \n";
      $codeString .= "Issue Date - " . $E_date . "\n";

      $filename = $PNG_TEMP_DIR . 'test' . md5( $codeString ) . '.png'; /*encrypting name and save image*/
      QRcode::png( $codeString, $filename );
      $Qr_code = 'test' . md5( $codeString ) . '.png';

      /*Search qr code exist in database*/
      $select = mysqli_query( $connect, "SELECT * FROM ticket WHERE Qr_code ='$Qr_code'" );
      if ( !mysqli_num_rows( $select ) ) {

        mysqli_query( $connect, "Insert into ticket 
          (Tid,Passenger_Id, Issue_Date,Departure_Time, Route, Seat_id, Schedul_id, Bus_number, Qr_code) values
          ('$Ticket_id',$userid , '$E_date' ,'$Departure_Time','$bus_Root','Sn1', $Shedules_id,'$Bus_number' ,'$Qr_code')" );
      }
    }
  
   if(strstr($Seatdata,'Sn2')) {
    
    mysqli_query($connect,"UPDATE seat Set Status='D' WHERE Name='Sn2' and Shedules_id={$_SESSION['Shedules_id']}");
    
    $Ticket_id=rand(0000000,9999999);
   
      
      if ( !file_exists( $PNG_TEMP_DIR ) ) /*checking alrady qr code exist*/
        mkdir( $PNG_TEMP_DIR );

      /*Store data to Qr library*/
      $codeString = "Ticket Id - " . $Ticket_id . "\n";
      $codeString .= $_SESSION[ 'Departure_from' ] . " to " . $_SESSION[ 'Final_Destination' ] . "\n";
      $codeString .= "Departure Time - " . $_SESSION[ 'Stat_time' ] . "\n";
      $codeString .= "Bus Number - " . $_SESSION[ 'Bnumber' ] . "\n";
      $codeString .= "Seat Code - Sn2   \n";
      $codeString .= "Issue Date - " . $E_date . "\n";


      $filename = $PNG_TEMP_DIR . 'test' . md5( $codeString ) . '.png'; /*encrypting name and save image*/
      QRcode::png( $codeString, $filename );
      $Qr_code = 'test' . md5( $codeString ) . '.png';

      /*Search qr code exist in database*/
      $select = mysqli_query( $connect, "SELECT * FROM ticket WHERE Qr_code ='$Qr_code'" );
      if ( !mysqli_num_rows( $select ) ) {

        mysqli_query( $connect, "Insert into ticket 
          (Tid,Passenger_Id, Issue_Date,Departure_Time, Route, Seat_id, Schedul_id, Bus_number, Qr_code) values
          ('$Ticket_id',$userid , '$E_date' ,'$Departure_Time','$bus_Root','Sn2', $Shedules_id,'$Bus_number' ,'$Qr_code')" );

       }
    }
  
  if(strstr($Seatdata,'Sn3')) {
    mysqli_query($connect,"UPDATE seat Set Status='D' WHERE Name='Sn3' and Shedules_id={$_SESSION['Shedules_id']}");
    
    $Ticket_id=rand(0000000,9999999);
   
      
      if ( !file_exists( $PNG_TEMP_DIR ) ) /*checking alrady qr code exist*/
        mkdir( $PNG_TEMP_DIR );

      /*Store data to Qr library*/
      $codeString = "Ticket Id - " . $Ticket_id . "\n";
      $codeString .= $_SESSION[ 'Departure_from' ] . " to " . $_SESSION[ 'Final_Destination' ] . "\n";
      $codeString .= "Departure Time - " . $_SESSION[ 'Stat_time' ] . "\n";
      $codeString .= "Bus Number - " . $_SESSION[ 'Bnumber' ] . "\n";
      $codeString .= "Seat Code - Sn3   \n";
      $codeString .= "Issue Date - " . $E_date . "\n";


      $filename = $PNG_TEMP_DIR . 'test' . md5( $codeString ) . '.png'; /*encrypting name and save image*/
      QRcode::png( $codeString, $filename );
      $Qr_code = 'test' . md5( $codeString ) . '.png';

      /*Search qr code exist in database*/
      $select = mysqli_query( $connect, "SELECT * FROM ticket WHERE Qr_code ='$Qr_code'" );
      if ( !mysqli_num_rows( $select ) ) {

        mysqli_query( $connect, "Insert into ticket 
          (Tid,Passenger_Id, Issue_Date,Departure_Time, Route, Seat_id, Schedul_id, Bus_number, Qr_code) values
          ('$Ticket_id',$userid , '$E_date' ,'$Departure_Time','$bus_Root','Sn3', $Shedules_id,'$Bus_number' ,'$Qr_code')" );

        }
    }
  
  if(strstr($Seatdata,'Sn4')) {
    mysqli_query($connect,"UPDATE seat Set Status='D' WHERE Name='Sn4' and Shedules_id={$_SESSION['Shedules_id']}");
    
    $Ticket_id=rand(0000000,9999999);
   
      
      if ( !file_exists( $PNG_TEMP_DIR ) ) /*checking alrady qr code exist*/
        mkdir( $PNG_TEMP_DIR );

      /*Store data to Qr library*/
      $codeString = "Ticket Id - " . $Ticket_id . "\n";
      $codeString .= $_SESSION[ 'Departure_from' ] . " to " . $_SESSION[ 'Final_Destination' ] . "\n";
      $codeString .= "Departure Time - " . $_SESSION[ 'Stat_time' ] . "\n";
      $codeString .= "Bus Number - " . $_SESSION[ 'Bnumber' ] . "\n";
      $codeString .= "Seat Code - Sn4  \n";
      $codeString .= "Issue Date - " . $E_date . "\n";


      $filename = $PNG_TEMP_DIR . 'test' . md5( $codeString ) . '.png'; /*encrypting name and save image*/
      QRcode::png( $codeString, $filename );
      $Qr_code = 'test' . md5( $codeString ) . '.png';

      /*Search qr code exist in database*/
      $select = mysqli_query( $connect, "SELECT * FROM ticket WHERE Qr_code ='$Qr_code'" );
      if ( !mysqli_num_rows( $select ) ) {

        mysqli_query( $connect, "Insert into ticket 
          (Tid,Passenger_Id, Issue_Date,Departure_Time, Route, Seat_id, Schedul_id, Bus_number, Qr_code) values
          ('$Ticket_id',$userid , '$E_date' ,'$Departure_Time','$bus_Root','Sn4', $Shedules_id,'$Bus_number' ,'$Qr_code')" );

        }
    }
  
  if(strstr($Seatdata,'Sn5')) {
    mysqli_query($connect,"UPDATE seat Set Status='D' WHERE Name='Sn5' and Shedules_id={$_SESSION['Shedules_id']}");
    
    $Ticket_id=rand(0000000,9999999);
   
      
      if ( !file_exists( $PNG_TEMP_DIR ) ) /*checking alrady qr code exist*/
        mkdir( $PNG_TEMP_DIR );

      /*Store data to Qr library*/
      $codeString = "Ticket Id - " . $Ticket_id . "\n";
      $codeString .= $_SESSION[ 'Departure_from' ] . " to " . $_SESSION[ 'Final_Destination' ] . "\n";
      $codeString .= "Departure Time - " . $_SESSION[ 'Stat_time' ] . "\n";
      $codeString .= "Bus Number - " . $_SESSION[ 'Bnumber' ] . "\n";
      $codeString .= "Seat Code - Sn5   \n";
      $codeString .= "Issue Date - " . $E_date . "\n";


      $filename = $PNG_TEMP_DIR . 'test' . md5( $codeString ) . '.png'; /*encrypting name and save image*/
      QRcode::png( $codeString, $filename );
      $Qr_code = 'test' . md5( $codeString ) . '.png';

      /*Search qr code exist in database*/
      $select = mysqli_query( $connect, "SELECT * FROM ticket WHERE Qr_code ='$Qr_code'" );
      if ( !mysqli_num_rows( $select ) ) {

        mysqli_query( $connect, "Insert into ticket 
          (Tid,Passenger_Id, Issue_Date,Departure_Time, Route, Seat_id, Schedul_id, Bus_number, Qr_code) values
          ('$Ticket_id',$userid , '$E_date' ,'$Departure_Time','$bus_Root','Sn5', $Shedules_id,'$Bus_number' ,'$Qr_code')" );
}
    }
  
  if(strstr($Seatdata,'Sn6')) {
    mysqli_query($connect,"UPDATE seat Set Status='D' WHERE Name='Sn6' and Shedules_id={$_SESSION['Shedules_id']}");
    
    $Ticket_id=rand(0000000,9999999);
   
      
      if ( !file_exists( $PNG_TEMP_DIR ) ) /*checking alrady qr code exist*/
        mkdir( $PNG_TEMP_DIR );

      /*Store data to Qr library*/
      $codeString = "Ticket Id - " . $Ticket_id . "\n";
      $codeString .= $_SESSION[ 'Departure_from' ] . " to " . $_SESSION[ 'Final_Destination' ] . "\n";
      $codeString .= "Departure Time - " . $_SESSION[ 'Stat_time' ] . "\n";
      $codeString .= "Bus Number - " . $_SESSION[ 'Bnumber' ] . "\n";
      $codeString .= "Seat Code - Sn6   \n";
      $codeString .= "Issue Date - " . $E_date . "\n";


      $filename = $PNG_TEMP_DIR . 'test' . md5( $codeString ) . '.png'; /*encrypting name and save image*/
      QRcode::png( $codeString, $filename );
      $Qr_code = 'test' . md5( $codeString ) . '.png';

      /*Search qr code exist in database*/
      $select = mysqli_query( $connect, "SELECT * FROM ticket WHERE Qr_code ='$Qr_code'" );
      if ( !mysqli_num_rows( $select ) ) {

        mysqli_query( $connect, "Insert into ticket 
          (Tid,Passenger_Id, Issue_Date,Departure_Time, Route, Seat_id, Schedul_id, Bus_number, Qr_code) values
          ('$Ticket_id',$userid , '$E_date' ,'$Departure_Time','$bus_Root','Sn6', $Shedules_id,'$Bus_number' ,'$Qr_code')" );

        }
    }
  
  if(strstr($Seatdata,'Sn7')) {
    mysqli_query($connect,"UPDATE seat Set Status='D' WHERE Name='Sn7' and Shedules_id={$_SESSION['Shedules_id']}");
    
    $Ticket_id=rand(0000000,9999999);
   
      
      if ( !file_exists( $PNG_TEMP_DIR ) ) /*checking alrady qr code exist*/
        mkdir( $PNG_TEMP_DIR );

      /*Store data to Qr library*/
      $codeString = "Ticket Id - " . $Ticket_id . "\n";
      $codeString .= $_SESSION[ 'Departure_from' ] . " to " . $_SESSION[ 'Final_Destination' ] . "\n";
      $codeString .= "Departure Time - " . $_SESSION[ 'Stat_time' ] . "\n";
      $codeString .= "Bus Number - " . $_SESSION[ 'Bnumber' ] . "\n";
      $codeString .= "Seat Code - Sn7  \n";
      $codeString .= "Issue Date - " . $E_date . "\n";


      $filename = $PNG_TEMP_DIR . 'test' . md5( $codeString ) . '.png'; /*encrypting name and save image*/
      QRcode::png( $codeString, $filename );
      $Qr_code = 'test' . md5( $codeString ) . '.png';

      /*Search qr code exist in database*/
      $select = mysqli_query( $connect, "SELECT * FROM ticket WHERE Qr_code ='$Qr_code'" );
      if ( !mysqli_num_rows( $select ) ) {

        mysqli_query( $connect, "Insert into ticket 
          (Tid,Passenger_Id, Issue_Date,Departure_Time, Route, Seat_id, Schedul_id, Bus_number, Qr_code) values
          ('$Ticket_id',$userid , '$E_date' ,'$Departure_Time','$bus_Root','Sn7', $Shedules_id,'$Bus_number' ,'$Qr_code')" );
       }
    }
  
  if(strstr($Seatdata,'Sn8')) {
    mysqli_query($connect,"UPDATE seat Set Status='D' WHERE Name='Sn8' and Shedules_id={$_SESSION['Shedules_id']}");
    
    $Ticket_id=rand(0000000,9999999);
   
      
      if ( !file_exists( $PNG_TEMP_DIR ) ) /*checking alrady qr code exist*/
        mkdir( $PNG_TEMP_DIR );

      /*Store data to Qr library*/
      $codeString = "Ticket Id - " . $Ticket_id . "\n";
      $codeString .= $_SESSION[ 'Departure_from' ] . " to " . $_SESSION[ 'Final_Destination' ] . "\n";
      $codeString .= "Departure Time - " . $_SESSION[ 'Stat_time' ] . "\n";
      $codeString .= "Bus Number - " . $_SESSION[ 'Bnumber' ] . "\n";
      $codeString .= "Seat Code - Sn8   \n";
      $codeString .= "Issue Date - " . $E_date . "\n";


      $filename = $PNG_TEMP_DIR . 'test' . md5( $codeString ) . '.png'; /*encrypting name and save image*/
      QRcode::png( $codeString, $filename );
      $Qr_code = 'test' . md5( $codeString ) . '.png';

      /*Search qr code exist in database*/
      $select = mysqli_query( $connect, "SELECT * FROM ticket WHERE Qr_code ='$Qr_code'" );
      if ( !mysqli_num_rows( $select ) ) {

        mysqli_query( $connect, "Insert into ticket 
          (Tid,Passenger_Id, Issue_Date,Departure_Time, Route, Seat_id, Schedul_id, Bus_number, Qr_code) values
          ('$Ticket_id',$userid , '$E_date' ,'$Departure_Time','$bus_Root','Sn8', $Shedules_id,'$Bus_number' ,'$Qr_code')" );

        }
    }
  
  if(strstr($Seatdata,'Sn9')) {
    mysqli_query($connect,"UPDATE seat Set Status='D' WHERE Name='Sn9' and Shedules_id={$_SESSION['Shedules_id']}");
    
    $Ticket_id=rand(0000000,9999999);
   
      
      if ( !file_exists( $PNG_TEMP_DIR ) ) /*checking alrady qr code exist*/
        mkdir( $PNG_TEMP_DIR );

      /*Store data to Qr library*/
      $codeString = "Ticket Id - " . $Ticket_id . "\n";
      $codeString .= $_SESSION[ 'Departure_from' ] . " to " . $_SESSION[ 'Final_Destination' ] . "\n";
      $codeString .= "Departure Time - " . $_SESSION[ 'Stat_time' ] . "\n";
      $codeString .= "Bus Number - " . $_SESSION[ 'Bnumber' ] . "\n";
      $codeString .= "Seat Code - Sn9   \n";
      $codeString .= "Issue Date - " . $E_date . "\n";


      $filename = $PNG_TEMP_DIR . 'test' . md5( $codeString ) . '.png'; /*encrypting name and save image*/
      QRcode::png( $codeString, $filename );
      $Qr_code = 'test' . md5( $codeString ) . '.png';

      /*Search qr code exist in database*/
      $select = mysqli_query( $connect, "SELECT * FROM ticket WHERE Qr_code ='$Qr_code'" );
      if ( !mysqli_num_rows( $select ) ) {

        mysqli_query( $connect, "Insert into ticket 
          (Tid,Passenger_Id, Issue_Date,Departure_Time, Route, Seat_id, Schedul_id, Bus_number, Qr_code) values
          ('$Ticket_id',$userid , '$E_date' ,'$Departure_Time','$bus_Root','Sn9', $Shedules_id,'$Bus_number' ,'$Qr_code')" );

        }
    }
  
  if(strstr($Seatdata,'Sn10')) {
    mysqli_query($connect,"UPDATE seat Set Status='D' WHERE Name='Sn10' and Shedules_id={$_SESSION['Shedules_id']}");
    
    $Ticket_id=rand(0000000,9999999);
   
      
      if ( !file_exists( $PNG_TEMP_DIR ) ) /*checking alrady qr code exist*/
        mkdir( $PNG_TEMP_DIR );

      /*Store data to Qr library*/
      $codeString = "Ticket Id - " . $Ticket_id . "\n";
      $codeString .= $_SESSION[ 'Departure_from' ] . " to " . $_SESSION[ 'Final_Destination' ] . "\n";
      $codeString .= "Departure Time - " . $_SESSION[ 'Stat_time' ] . "\n";
      $codeString .= "Bus Number - " . $_SESSION[ 'Bnumber' ] . "\n";
      $codeString .= "Seat Code - Sn10   \n";
      $codeString .= "Issue Date - " . $E_date . "\n";


      $filename = $PNG_TEMP_DIR . 'test' . md5( $codeString ) . '.png'; /*encrypting name and save image*/
      QRcode::png( $codeString, $filename );
      $Qr_code = 'test' . md5( $codeString ) . '.png';

      /*Search qr code exist in database*/
      $select = mysqli_query( $connect, "SELECT * FROM ticket WHERE Qr_code ='$Qr_code'" );
      if ( !mysqli_num_rows( $select ) ) {

        mysqli_query( $connect, "Insert into ticket 
          (Tid,Passenger_Id, Issue_Date,Departure_Time, Route, Seat_id, Schedul_id, Bus_number, Qr_code) values
          ('$Ticket_id',$userid , '$E_date' ,'$Departure_Time','$bus_Root','Sn10', $Shedules_id,'$Bus_number' ,'$Qr_code')" );

        }
    }
  
  if(strstr($Seatdata,'Sn11')) {
    mysqli_query($connect,"UPDATE seat Set Status='D' WHERE Name='Sn11' and Shedules_id={$_SESSION['Shedules_id']}");
    
    $Ticket_id=rand(0000000,9999999);
   
      
      if ( !file_exists( $PNG_TEMP_DIR ) ) /*checking alrady qr code exist*/
        mkdir( $PNG_TEMP_DIR );

      /*Store data to Qr library*/
      $codeString = "Ticket Id - " . $Ticket_id . "\n";
      $codeString .= $_SESSION[ 'Departure_from' ] . " to " . $_SESSION[ 'Final_Destination' ] . "\n";
      $codeString .= "Departure Time - " . $_SESSION[ 'Stat_time' ] . "\n";
      $codeString .= "Bus Number - " . $_SESSION[ 'Bnumber' ] . "\n";
      $codeString .= "Seat Code - Sn11   \n";
      $codeString .= "Issue Date - " . $E_date . "\n";


      $filename = $PNG_TEMP_DIR . 'test' . md5( $codeString ) . '.png'; /*encrypting name and save image*/
      QRcode::png( $codeString, $filename );
      $Qr_code = 'test' . md5( $codeString ) . '.png';

      /*Search qr code exist in database*/
      $select = mysqli_query( $connect, "SELECT * FROM ticket WHERE Qr_code ='$Qr_code'" );
      if ( !mysqli_num_rows( $select ) ) {

        mysqli_query( $connect, "Insert into ticket 
          (Tid,Passenger_Id, Issue_Date,Departure_Time, Route, Seat_id, Schedul_id, Bus_number, Qr_code) values
          ('$Ticket_id',$userid , '$E_date' ,'$Departure_Time','$bus_Root','Sn11', $Shedules_id,'$Bus_number' ,'$Qr_code')" );
        }
    }
  
  if(strstr($Seatdata,'Sn12')) {
    mysqli_query($connect,"UPDATE seat Set Status='D' WHERE Name='Sn12' and Shedules_id={$_SESSION['Shedules_id']}");
    
    $Ticket_id=rand(0000000,9999999);
   
      
      if ( !file_exists( $PNG_TEMP_DIR ) ) /*checking alrady qr code exist*/
        mkdir( $PNG_TEMP_DIR );

      /*Store data to Qr library*/
      $codeString = "Ticket Id - " . $Ticket_id . "\n";
      $codeString .= $_SESSION[ 'Departure_from' ] . " to " . $_SESSION[ 'Final_Destination' ] . "\n";
      $codeString .= "Departure Time - " . $_SESSION[ 'Stat_time' ] . "\n";
      $codeString .= "Bus Number - " . $_SESSION[ 'Bnumber' ] . "\n";
      $codeString .= "Seat Code - Sn12   \n";
      $codeString .= "Issue Date - " . $E_date . "\n";


      $filename = $PNG_TEMP_DIR . 'test' . md5( $codeString ) . '.png'; /*encrypting name and save image*/
      QRcode::png( $codeString, $filename );
      $Qr_code = 'test' . md5( $codeString ) . '.png';

      /*Search qr code exist in database*/
      $select = mysqli_query( $connect, "SELECT * FROM ticket WHERE Qr_code ='$Qr_code'" );
      if ( !mysqli_num_rows( $select ) ) {

        mysqli_query( $connect, "Insert into ticket 
          (Tid,Passenger_Id, Issue_Date,Departure_Time, Route, Seat_id, Schedul_id, Bus_number, Qr_code) values
          ('$Ticket_id',$userid , '$E_date' ,'$Departure_Time','$bus_Root','Sn12', $Shedules_id,'$Bus_number' ,'$Qr_code')" );

        }
    }
  
  if(strstr($Seatdata,'Sn13')) {
    mysqli_query($connect,"UPDATE seat Set Status='D' WHERE Name='Sn13' and Shedules_id={$_SESSION['Shedules_id']}");
    
    $Ticket_id=rand(0000000,9999999);
   
      
      if ( !file_exists( $PNG_TEMP_DIR ) ) /*checking alrady qr code exist*/
        mkdir( $PNG_TEMP_DIR );

      /*Store data to Qr library*/
      $codeString = "Ticket Id - " . $Ticket_id . "\n";
      $codeString .= $_SESSION[ 'Departure_from' ] . " to " . $_SESSION[ 'Final_Destination' ] . "\n";
      $codeString .= "Departure Time - " . $_SESSION[ 'Stat_time' ] . "\n";
      $codeString .= "Bus Number - " . $_SESSION[ 'Bnumber' ] . "\n";
      $codeString .= "Seat Code - Sn13   \n";
      $codeString .= "Issue Date - " . $E_date . "\n";


      $filename = $PNG_TEMP_DIR . 'test' . md5( $codeString ) . '.png'; /*encrypting name and save image*/
      QRcode::png( $codeString, $filename );
      $Qr_code = 'test' . md5( $codeString ) . '.png';

      /*Search qr code exist in database*/
      $select = mysqli_query( $connect, "SELECT * FROM ticket WHERE Qr_code ='$Qr_code'" );
      if ( !mysqli_num_rows( $select ) ) {

        mysqli_query( $connect, "Insert into ticket 
          (Tid,Passenger_Id, Issue_Date,Departure_Time, Route, Seat_id, Schedul_id, Bus_number, Qr_code) values
          ('$Ticket_id',$userid , '$E_date' ,'$Departure_Time','$bus_Root','Sn13', $Shedules_id,'$Bus_number' ,'$Qr_code')" );

      }
    }
  
  if(strstr($Seatdata,'Sn14')) {
    mysqli_query($connect,"UPDATE seat Set Status='D' WHERE Name='Sn14' and Shedules_id={$_SESSION['Shedules_id']}");
    
    $Ticket_id=rand(0000000,9999999);
   
      
      if ( !file_exists( $PNG_TEMP_DIR ) ) /*checking alrady qr code exist*/
        mkdir( $PNG_TEMP_DIR );

      /*Store data to Qr library*/
      $codeString = "Ticket Id - " . $Ticket_id . "\n";
      $codeString .= $_SESSION[ 'Departure_from' ] . " to " . $_SESSION[ 'Final_Destination' ] . "\n";
      $codeString .= "Departure Time - " . $_SESSION[ 'Stat_time' ] . "\n";
      $codeString .= "Bus Number - " . $_SESSION[ 'Bnumber' ] . "\n";
      $codeString .= "Seat Code - Sn14   \n";
      $codeString .= "Issue Date - " . $E_date . "\n";


      $filename = $PNG_TEMP_DIR . 'test' . md5( $codeString ) . '.png'; /*encrypting name and save image*/
      QRcode::png( $codeString, $filename );
      $Qr_code = 'test' . md5( $codeString ) . '.png';

      /*Search qr code exist in database*/
      $select = mysqli_query( $connect, "SELECT * FROM ticket WHERE Qr_code ='$Qr_code'" );
      if ( !mysqli_num_rows( $select ) ) {

        mysqli_query( $connect, "Insert into ticket 
          (Tid,Passenger_Id, Issue_Date,Departure_Time, Route, Seat_id, Schedul_id, Bus_number, Qr_code) values
          ('$Ticket_id',$userid , '$E_date' ,'$Departure_Time','$bus_Root','Sn14', $Shedules_id,'$Bus_number' ,'$Qr_code')" );

        }
    }
  
  if(strstr($Seatdata,'Sn15')) {
    mysqli_query($connect,"UPDATE seat Set Status='D' WHERE Name='Sn15' and Shedules_id={$_SESSION['Shedules_id']}");
    
    $Ticket_id=rand(0000000,9999999);
   
      
      if ( !file_exists( $PNG_TEMP_DIR ) ) /*checking alrady qr code exist*/
        mkdir( $PNG_TEMP_DIR );

      /*Store data to Qr library*/
      $codeString = "Ticket Id - " . $Ticket_id . "\n";
      $codeString .= $_SESSION[ 'Departure_from' ] . " to " . $_SESSION[ 'Final_Destination' ] . "\n";
      $codeString .= "Departure Time - " . $_SESSION[ 'Stat_time' ] . "\n";
      $codeString .= "Bus Number - " . $_SESSION[ 'Bnumber' ] . "\n";
      $codeString .= "Seat Code - Sn15   \n";
      $codeString .= "Issue Date - " . $E_date . "\n";


      $filename = $PNG_TEMP_DIR . 'test' . md5( $codeString ) . '.png'; /*encrypting name and save image*/
      QRcode::png( $codeString, $filename );
      $Qr_code = 'test' . md5( $codeString ) . '.png';

      /*Search qr code exist in database*/
      $select = mysqli_query( $connect, "SELECT * FROM ticket WHERE Qr_code ='$Qr_code'" );
      if ( !mysqli_num_rows( $select ) ) {

        mysqli_query( $connect, "Insert into ticket 
          (Tid,Passenger_Id, Issue_Date,Departure_Time, Route, Seat_id, Schedul_id, Bus_number, Qr_code) values
          ('$Ticket_id',$userid , '$E_date' ,'$Departure_Time','$bus_Root','Sn15', $Shedules_id,'$Bus_number' ,'$Qr_code')" );

        }
    }
  
  if(strstr($Seatdata,'Sn16')) {
    mysqli_query($connect,"UPDATE seat Set Status='D' WHERE Name='Sn16' and Shedules_id={$_SESSION['Shedules_id']}");
    
    $Ticket_id=rand(0000000,9999999);
   
      
      if ( !file_exists( $PNG_TEMP_DIR ) ) /*checking alrady qr code exist*/
        mkdir( $PNG_TEMP_DIR );

      /*Store data to Qr library*/
      $codeString = "Ticket Id - " . $Ticket_id . "\n";
      $codeString .= $_SESSION[ 'Departure_from' ] . " to " . $_SESSION[ 'Final_Destination' ] . "\n";
      $codeString .= "Departure Time - " . $_SESSION[ 'Stat_time' ] . "\n";
      $codeString .= "Bus Number - " . $_SESSION[ 'Bnumber' ] . "\n";
      $codeString .= "Seat Code - Sn16   \n";
      $codeString .= "Issue Date - " . $E_date . "\n";


      $filename = $PNG_TEMP_DIR . 'test' . md5( $codeString ) . '.png'; /*encrypting name and save image*/
      QRcode::png( $codeString, $filename );
      $Qr_code = 'test' . md5( $codeString ) . '.png';

      /*Search qr code exist in database*/
      $select = mysqli_query( $connect, "SELECT * FROM ticket WHERE Qr_code ='$Qr_code'" );
      if ( !mysqli_num_rows( $select ) ) {

        mysqli_query( $connect, "Insert into ticket 
          (Tid,Passenger_Id, Issue_Date,Departure_Time, Route, Seat_id, Schedul_id, Bus_number, Qr_code) values
          ('$Ticket_id',$userid , '$E_date' ,'$Departure_Time','$bus_Root','Sn16', $Shedules_id,'$Bus_number' ,'$Qr_code')" );
       }
    }
  
  if(strstr($Seatdata,'Sn17')) {
    mysqli_query($connect,"UPDATE seat Set Status='D' WHERE Name='Sn17' and Shedules_id={$_SESSION['Shedules_id']}");
    
    $Ticket_id=rand(0000000,9999999);
   
      
      if ( !file_exists( $PNG_TEMP_DIR ) ) /*checking alrady qr code exist*/
        mkdir( $PNG_TEMP_DIR );

      /*Store data to Qr library*/
      $codeString = "Ticket Id - " . $Ticket_id . "\n";
      $codeString .= $_SESSION[ 'Departure_from' ] . " to " . $_SESSION[ 'Final_Destination' ] . "\n";
      $codeString .= "Departure Time - " . $_SESSION[ 'Stat_time' ] . "\n";
      $codeString .= "Bus Number - " . $_SESSION[ 'Bnumber' ] . "\n";
      $codeString .= "Seat Code - Sn17   \n";
      $codeString .= "Issue Date - " . $E_date . "\n";


      $filename = $PNG_TEMP_DIR . 'test' . md5( $codeString ) . '.png'; /*encrypting name and save image*/
      QRcode::png( $codeString, $filename );
      $Qr_code = 'test' . md5( $codeString ) . '.png';

      /*Search qr code exist in database*/
      $select = mysqli_query( $connect, "SELECT * FROM ticket WHERE Qr_code ='$Qr_code'" );
      if ( !mysqli_num_rows( $select ) ) {

        mysqli_query( $connect, "Insert into ticket 
          (Tid,Passenger_Id, Issue_Date,Departure_Time, Route, Seat_id, Schedul_id, Bus_number, Qr_code) values
          ('$Ticket_id',$userid , '$E_date' ,'$Departure_Time','$bus_Root','Sn17', $Shedules_id,'$Bus_number' ,'$Qr_code')" );

        }
    }
  
  if(strstr($Seatdata,'Sn18')) {
    mysqli_query($connect,"UPDATE seat Set Status='D' WHERE Name='Sn18' and Shedules_id={$_SESSION['Shedules_id']}");
    
    $Ticket_id=rand(0000000,9999999);
   
      
      if ( !file_exists( $PNG_TEMP_DIR ) ) /*checking alrady qr code exist*/
        mkdir( $PNG_TEMP_DIR );

      /*Store data to Qr library*/
      $codeString = "Ticket Id - " . $Ticket_id . "\n";
      $codeString .= $_SESSION[ 'Departure_from' ] . " to " . $_SESSION[ 'Final_Destination' ] . "\n";
      $codeString .= "Departure Time - " . $_SESSION[ 'Stat_time' ] . "\n";
      $codeString .= "Bus Number - " . $_SESSION[ 'Bnumber' ] . "\n";
      $codeString .= "Seat Code - Sn18   \n";
      $codeString .= "Issue Date - " . $E_date . "\n";


      $filename = $PNG_TEMP_DIR . 'test' . md5( $codeString ) . '.png'; /*encrypting name and save image*/
      QRcode::png( $codeString, $filename );
      $Qr_code = 'test' . md5( $codeString ) . '.png';

      /*Search qr code exist in database*/
      $select = mysqli_query( $connect, "SELECT * FROM ticket WHERE Qr_code ='$Qr_code'" );
      if ( !mysqli_num_rows( $select ) ) {

        mysqli_query( $connect, "Insert into ticket 
          (Tid,Passenger_Id, Issue_Date,Departure_Time, Route, Seat_id, Schedul_id, Bus_number, Qr_code) values
          ('$Ticket_id',$userid , '$E_date' ,'$Departure_Time','$bus_Root','Sn18', $Shedules_id,'$Bus_number' ,'$Qr_code')" );

        }
    }
  
  if(strstr($Seatdata,'Sn19')) {
    mysqli_query($connect,"UPDATE seat Set Status='D' WHERE Name='Sn19' and Shedules_id={$_SESSION['Shedules_id']}");
    
    $Ticket_id=rand(0000000,9999999);
   
      
      if ( !file_exists( $PNG_TEMP_DIR ) ) /*checking alrady qr code exist*/
        mkdir( $PNG_TEMP_DIR );

      /*Store data to Qr library*/
      $codeString = "Ticket Id - " . $Ticket_id . "\n";
      $codeString .= $_SESSION[ 'Departure_from' ] . " to " . $_SESSION[ 'Final_Destination' ] . "\n";
      $codeString .= "Departure Time - " . $_SESSION[ 'Stat_time' ] . "\n";
      $codeString .= "Bus Number - " . $_SESSION[ 'Bnumber' ] . "\n";
      $codeString .= "Seat Code - Sn19   \n";
      $codeString .= "Issue Date - " . $E_date . "\n";


      $filename = $PNG_TEMP_DIR . 'test' . md5( $codeString ) . '.png'; /*encrypting name and save image*/
      QRcode::png( $codeString, $filename );
      $Qr_code = 'test' . md5( $codeString ) . '.png';

      /*Search qr code exist in database*/
      $select = mysqli_query( $connect, "SELECT * FROM ticket WHERE Qr_code ='$Qr_code'" );
      if ( !mysqli_num_rows( $select ) ) {

        mysqli_query( $connect, "Insert into ticket 
          (Tid,Passenger_Id, Issue_Date,Departure_Time, Route, Seat_id, Schedul_id, Bus_number, Qr_code) values
          ('$Ticket_id',$userid , '$E_date' ,'$Departure_Time','$bus_Root','Sn19', $Shedules_id,'$Bus_number' ,'$Qr_code')" );

        }
    }
  
  if(strstr($Seatdata,'Sn20')) {
    mysqli_query($connect,"UPDATE seat Set Status='D' WHERE Name='Sn20' and Shedules_id={$_SESSION['Shedules_id']}");
    
    $Ticket_id=rand(0000000,9999999);
   
      
      if ( !file_exists( $PNG_TEMP_DIR ) ) /*checking alrady qr code exist*/
        mkdir( $PNG_TEMP_DIR );

      /*Store data to Qr library*/
      $codeString = "Ticket Id - " . $Ticket_id . "\n";
      $codeString .= $_SESSION[ 'Departure_from' ] . " to " . $_SESSION[ 'Final_Destination' ] . "\n";
      $codeString .= "Departure Time - " . $_SESSION[ 'Stat_time' ] . "\n";
      $codeString .= "Bus Number - " . $_SESSION[ 'Bnumber' ] . "\n";
      $codeString .= "Seat Code - Sn20   \n";
      $codeString .= "Issue Date - " . $E_date . "\n";


      $filename = $PNG_TEMP_DIR . 'test' . md5( $codeString ) . '.png'; /*encrypting name and save image*/
      QRcode::png( $codeString, $filename );
      $Qr_code = 'test' . md5( $codeString ) . '.png';

      /*Search qr code exist in database*/
      $select = mysqli_query( $connect, "SELECT * FROM ticket WHERE Qr_code ='$Qr_code'" );
      if ( !mysqli_num_rows( $select ) ) {

        mysqli_query( $connect, "Insert into ticket 
          (Tid,Passenger_Id, Issue_Date,Departure_Time, Route, Seat_id, Schedul_id, Bus_number, Qr_code) values
          ('$Ticket_id',$userid , '$E_date' ,'$Departure_Time','$bus_Root','Sn20', $Shedules_id,'$Bus_number' ,'$Qr_code')" );

        }
    }
  
  if(strstr($Seatdata,'Sn21')) {
    mysqli_query($connect,"UPDATE seat Set Status='D' WHERE Name='Sn21' and Shedules_id={$_SESSION['Shedules_id']}");
    
    $Ticket_id=rand(0000000,9999999);
   
      
      if ( !file_exists( $PNG_TEMP_DIR ) ) /*checking alrady qr code exist*/
        mkdir( $PNG_TEMP_DIR );

      /*Store data to Qr library*/
      $codeString = "Ticket Id - " . $Ticket_id . "\n";
      $codeString .= $_SESSION[ 'Departure_from' ] . " to " . $_SESSION[ 'Final_Destination' ] . "\n";
      $codeString .= "Departure Time - " . $_SESSION[ 'Stat_time' ] . "\n";
      $codeString .= "Bus Number - " . $_SESSION[ 'Bnumber' ] . "\n";
      $codeString .= "Seat Code - Sn21   \n";
      $codeString .= "Issue Date - " . $E_date . "\n";


      $filename = $PNG_TEMP_DIR . 'test' . md5( $codeString ) . '.png'; /*encrypting name and save image*/
      QRcode::png( $codeString, $filename );
      $Qr_code = 'test' . md5( $codeString ) . '.png';

      /*Search qr code exist in database*/
      $select = mysqli_query( $connect, "SELECT * FROM ticket WHERE Qr_code ='$Qr_code'" );
      if ( !mysqli_num_rows( $select ) ) {

        mysqli_query( $connect, "Insert into ticket 
          (Tid,Passenger_Id, Issue_Date,Departure_Time, Route, Seat_id, Schedul_id, Bus_number, Qr_code) values
          ('$Ticket_id',$userid , '$E_date' ,'$Departure_Time','$bus_Root','Sn21', $Shedules_id,'$Bus_number' ,'$Qr_code')" );

        }
    }
  
  if(strstr($Seatdata,'Sn22')) {
    mysqli_query($connect,"UPDATE seat Set Status='D' WHERE Name='Sn22' and Shedules_id={$_SESSION['Shedules_id']}");
    
    $Ticket_id=rand(0000000,9999999);
   
      
      if ( !file_exists( $PNG_TEMP_DIR ) ) /*checking alrady qr code exist*/
        mkdir( $PNG_TEMP_DIR );

      /*Store data to Qr library*/
      $codeString = "Ticket Id - " . $Ticket_id . "\n";
      $codeString .= $_SESSION[ 'Departure_from' ] . " to " . $_SESSION[ 'Final_Destination' ] . "\n";
      $codeString .= "Departure Time - " . $_SESSION[ 'Stat_time' ] . "\n";
      $codeString .= "Bus Number - " . $_SESSION[ 'Bnumber' ] . "\n";
      $codeString .= "Seat Code - Sn22   \n";
      $codeString .= "Issue Date - " . $E_date . "\n";


      $filename = $PNG_TEMP_DIR . 'test' . md5( $codeString ) . '.png'; /*encrypting name and save image*/
      QRcode::png( $codeString, $filename );
      $Qr_code = 'test' . md5( $codeString ) . '.png';

      /*Search qr code exist in database*/
      $select = mysqli_query( $connect, "SELECT * FROM ticket WHERE Qr_code ='$Qr_code'" );
      if ( !mysqli_num_rows( $select ) ) {

        mysqli_query( $connect, "Insert into ticket 
          (Tid,Passenger_Id, Issue_Date,Departure_Time, Route, Seat_id, Schedul_id, Bus_number, Qr_code) values
          ('$Ticket_id',$userid , '$E_date' ,'$Departure_Time','$bus_Root','Sn22', $Shedules_id,'$Bus_number' ,'$Qr_code')" );

       }
    }
  
  if(strstr($Seatdata,'Sn23')) {
    mysqli_query($connect,"UPDATE seat Set Status='D' WHERE Name='Sn23' and Shedules_id={$_SESSION['Shedules_id']}");
    
    $Ticket_id=rand(0000000,9999999);
   
      
      if ( !file_exists( $PNG_TEMP_DIR ) ) /*checking alrady qr code exist*/
        mkdir( $PNG_TEMP_DIR );

      /*Store data to Qr library*/
      $codeString = "Ticket Id - " . $Ticket_id . "\n";
      $codeString .= $_SESSION[ 'Departure_from' ] . " to " . $_SESSION[ 'Final_Destination' ] . "\n";
      $codeString .= "Departure Time - " . $_SESSION[ 'Stat_time' ] . "\n";
      $codeString .= "Bus Number - " . $_SESSION[ 'Bnumber' ] . "\n";
      $codeString .= "Seat Code - Sn23   \n";
      $codeString .= "Issue Date - " . $E_date . "\n";


      $filename = $PNG_TEMP_DIR . 'test' . md5( $codeString ) . '.png'; /*encrypting name and save image*/
      QRcode::png( $codeString, $filename );
      $Qr_code = 'test' . md5( $codeString ) . '.png';

      /*Search qr code exist in database*/
      $select = mysqli_query( $connect, "SELECT * FROM ticket WHERE Qr_code ='$Qr_code'" );
      if ( !mysqli_num_rows( $select ) ) {

        mysqli_query( $connect, "Insert into ticket 
          (Tid,Passenger_Id, Issue_Date,Departure_Time, Route, Seat_id, Schedul_id, Bus_number, Qr_code) values
          ('$Ticket_id',$userid , '$E_date' ,'$Departure_Time','$bus_Root','Sn23', $Shedules_id,'$Bus_number' ,'$Qr_code')" );

        }
    }
  
  if(strstr($Seatdata,'Sn24')) {
    mysqli_query($connect,"UPDATE seat Set Status='D' WHERE Name='Sn24' and Shedules_id={$_SESSION['Shedules_id']}");
    
    $Ticket_id=rand(0000000,9999999);
   
      
      if ( !file_exists( $PNG_TEMP_DIR ) ) /*checking alrady qr code exist*/
        mkdir( $PNG_TEMP_DIR );

      /*Store data to Qr library*/
      $codeString = "Ticket Id - " . $Ticket_id . "\n";
      $codeString .= $_SESSION[ 'Departure_from' ] . " to " . $_SESSION[ 'Final_Destination' ] . "\n";
      $codeString .= "Departure Time - " . $_SESSION[ 'Stat_time' ] . "\n";
      $codeString .= "Bus Number - " . $_SESSION[ 'Bnumber' ] . "\n";
      $codeString .= "Seat Code - Sn24   \n";
      $codeString .= "Issue Date - " . $E_date . "\n";


      $filename = $PNG_TEMP_DIR . 'test' . md5( $codeString ) . '.png'; /*encrypting name and save image*/
      QRcode::png( $codeString, $filename );
      $Qr_code = 'test' . md5( $codeString ) . '.png';

      /*Search qr code exist in database*/
      $select = mysqli_query( $connect, "SELECT * FROM ticket WHERE Qr_code ='$Qr_code'" );
      if ( !mysqli_num_rows( $select ) ) {

        mysqli_query( $connect, "Insert into ticket 
          (Tid,Passenger_Id, Issue_Date,Departure_Time, Route, Seat_id, Schedul_id, Bus_number, Qr_code) values
          ('$Ticket_id',$userid , '$E_date' ,'$Departure_Time','$bus_Root','Sn24', $Shedules_id,'$Bus_number' ,'$Qr_code')" );

        }
    }
  
  if(strstr($Seatdata,'Sn25')) {
    mysqli_query($connect,"UPDATE seat Set Status='D' WHERE Name='Sn25' and Shedules_id={$_SESSION['Shedules_id']}");
    
    $Ticket_id=rand(0000000,9999999);
   
      
      if ( !file_exists( $PNG_TEMP_DIR ) ) /*checking alrady qr code exist*/
        mkdir( $PNG_TEMP_DIR );

      /*Store data to Qr library*/
      $codeString = "Ticket Id - " . $Ticket_id . "\n";
      $codeString .= $_SESSION[ 'Departure_from' ] . " to " . $_SESSION[ 'Final_Destination' ] . "\n";
      $codeString .= "Departure Time - " . $_SESSION[ 'Stat_time' ] . "\n";
      $codeString .= "Bus Number - " . $_SESSION[ 'Bnumber' ] . "\n";
      $codeString .= "Seat Code - Sn25   \n";
      $codeString .= "Issue Date - " . $E_date . "\n";


      $filename = $PNG_TEMP_DIR . 'test' . md5( $codeString ) . '.png'; /*encrypting name and save image*/
      QRcode::png( $codeString, $filename );
      $Qr_code = 'test' . md5( $codeString ) . '.png';

      /*Search qr code exist in database*/
      $select = mysqli_query( $connect, "SELECT * FROM ticket WHERE Qr_code ='$Qr_code'" );
      if ( !mysqli_num_rows( $select ) ) {

        mysqli_query( $connect, "Insert into ticket 
          (Tid,Passenger_Id, Issue_Date,Departure_Time, Route, Seat_id, Schedul_id, Bus_number, Qr_code) values
          ('$Ticket_id',$userid , '$E_date' ,'$Departure_Time','$bus_Root','Sn25', $Shedules_id,'$Bus_number' ,'$Qr_code')" );

        }
    }
  
  if(strstr($Seatdata,'Sn26')) {
    mysqli_query($connect,"UPDATE seat Set Status='D' WHERE Name='Sn26' and Shedules_id={$_SESSION['Shedules_id']}");
    
    $Ticket_id=rand(0000000,9999999);
   
      
      if ( !file_exists( $PNG_TEMP_DIR ) ) /*checking alrady qr code exist*/
        mkdir( $PNG_TEMP_DIR );

      /*Store data to Qr library*/
      $codeString = "Ticket Id - " . $Ticket_id . "\n";
      $codeString .= $_SESSION[ 'Departure_from' ] . " to " . $_SESSION[ 'Final_Destination' ] . "\n";
      $codeString .= "Departure Time - " . $_SESSION[ 'Stat_time' ] . "\n";
      $codeString .= "Bus Number - " . $_SESSION[ 'Bnumber' ] . "\n";
      $codeString .= "Seat Code - Sn26   \n";
      $codeString .= "Issue Date - " . $E_date . "\n";


      $filename = $PNG_TEMP_DIR . 'test' . md5( $codeString ) . '.png'; /*encrypting name and save image*/
      QRcode::png( $codeString, $filename );
      $Qr_code = 'test' . md5( $codeString ) . '.png';

      /*Search qr code exist in database*/
      $select = mysqli_query( $connect, "SELECT * FROM ticket WHERE Qr_code ='$Qr_code'" );
      if ( !mysqli_num_rows( $select ) ) {

        mysqli_query( $connect, "Insert into ticket 
          (Tid,Passenger_Id, Issue_Date,Departure_Time, Route, Seat_id, Schedul_id, Bus_number, Qr_code) values
          ('$Ticket_id',$userid , '$E_date' ,'$Departure_Time','$bus_Root','Sn26', $Shedules_id,'$Bus_number' ,'$Qr_code')" );

        }
    }
  
  if(strstr($Seatdata,'Sn27')) {
    mysqli_query($connect,"UPDATE seat Set Status='D' WHERE Name='Sn27' and Shedules_id={$_SESSION['Shedules_id']}");
    
    $Ticket_id=rand(0000000,9999999);
   
      
      if ( !file_exists( $PNG_TEMP_DIR ) ) /*checking alrady qr code exist*/
        mkdir( $PNG_TEMP_DIR );

      /*Store data to Qr library*/
      $codeString = "Ticket Id - " . $Ticket_id . "\n";
      $codeString .= $_SESSION[ 'Departure_from' ] . " to " . $_SESSION[ 'Final_Destination' ] . "\n";
      $codeString .= "Departure Time - " . $_SESSION[ 'Stat_time' ] . "\n";
      $codeString .= "Bus Number - " . $_SESSION[ 'Bnumber' ] . "\n";
      $codeString .= "Seat Code - Sn27   \n";
      $codeString .= "Issue Date - " . $E_date . "\n";


      $filename = $PNG_TEMP_DIR . 'test' . md5( $codeString ) . '.png'; /*encrypting name and save image*/
      QRcode::png( $codeString, $filename );
      $Qr_code = 'test' . md5( $codeString ) . '.png';

      /*Search qr code exist in database*/
      $select = mysqli_query( $connect, "SELECT * FROM ticket WHERE Qr_code ='$Qr_code'" );
      if ( !mysqli_num_rows( $select ) ) {

        mysqli_query( $connect, "Insert into ticket 
          (Tid,Passenger_Id, Issue_Date,Departure_Time, Route, Seat_id, Schedul_id, Bus_number, Qr_code) values
          ('$Ticket_id',$userid , '$E_date' ,'$Departure_Time','$bus_Root','Sn27', $Shedules_id,'$Bus_number' ,'$Qr_code')" );

        }
    }
  
  if(strstr($Seatdata,'Sn28')) {
    mysqli_query($connect,"UPDATE seat Set Status='D' WHERE Name='Sn28' and Shedules_id={$_SESSION['Shedules_id']}");
    
    $Ticket_id=rand(0000000,9999999);
   
      
      if ( !file_exists( $PNG_TEMP_DIR ) ) /*checking alrady qr code exist*/
        mkdir( $PNG_TEMP_DIR );

      /*Store data to Qr library*/
      $codeString = "Ticket Id - " . $Ticket_id . "\n";
      $codeString .= $_SESSION[ 'Departure_from' ] . " to " . $_SESSION[ 'Final_Destination' ] . "\n";
      $codeString .= "Departure Time - " . $_SESSION[ 'Stat_time' ] . "\n";
      $codeString .= "Bus Number - " . $_SESSION[ 'Bnumber' ] . "\n";
      $codeString .= "Seat Code - Sn28   \n";
      $codeString .= "Issue Date - " . $E_date . "\n";


      $filename = $PNG_TEMP_DIR . 'test' . md5( $codeString ) . '.png'; /*encrypting name and save image*/
      QRcode::png( $codeString, $filename );
      $Qr_code = 'test' . md5( $codeString ) . '.png';

      /*Search qr code exist in database*/
      $select = mysqli_query( $connect, "SELECT * FROM ticket WHERE Qr_code ='$Qr_code'" );
      if ( !mysqli_num_rows( $select ) ) {

        mysqli_query( $connect, "Insert into ticket 
          (Tid,Passenger_Id, Issue_Date,Departure_Time, Route, Seat_id, Schedul_id, Bus_number, Qr_code) values
          ('$Ticket_id',$userid , '$E_date' ,'$Departure_Time','$bus_Root','Sn28', $Shedules_id,'$Bus_number' ,'$Qr_code')" );

        }
    }
  
  if(strstr($Seatdata,'Sn29')) {
    mysqli_query($connect,"UPDATE seat Set Status='D' WHERE Name='Sn29' and Shedules_id={$_SESSION['Shedules_id']}");
    
    $Ticket_id=rand(0000000,9999999);
   
      
      if ( !file_exists( $PNG_TEMP_DIR ) ) /*checking alrady qr code exist*/
        mkdir( $PNG_TEMP_DIR );

      /*Store data to Qr library*/
      $codeString = "Ticket Id - " . $Ticket_id . "\n";
      $codeString .= $_SESSION[ 'Departure_from' ] . " to " . $_SESSION[ 'Final_Destination' ] . "\n";
      $codeString .= "Departure Time - " . $_SESSION[ 'Stat_time' ] . "\n";
      $codeString .= "Bus Number - " . $_SESSION[ 'Bnumber' ] . "\n";
      $codeString .= "Seat Code - Sn29   \n";
      $codeString .= "Issue Date - " . $E_date . "\n";


      $filename = $PNG_TEMP_DIR . 'test' . md5( $codeString ) . '.png'; /*encrypting name and save image*/
      QRcode::png( $codeString, $filename );
      $Qr_code = 'test' . md5( $codeString ) . '.png';

      /*Search qr code exist in database*/
      $select = mysqli_query( $connect, "SELECT * FROM ticket WHERE Qr_code ='$Qr_code'" );
      if ( !mysqli_num_rows( $select ) ) {

        mysqli_query( $connect, "Insert into ticket 
          (Tid,Passenger_Id, Issue_Date,Departure_Time, Route, Seat_id, Schedul_id, Bus_number, Qr_code) values
          ('$Ticket_id',$userid , '$E_date' ,'$Departure_Time','$bus_Root','Sn29', $Shedules_id,'$Bus_number' ,'$Qr_code')" );

        }
    }
  
  if(strstr($Seatdata,'Sn30')) {
    mysqli_query($connect,"UPDATE seat Set Status='D' WHERE Name='Sn30' and Shedules_id={$_SESSION['Shedules_id']}");
    
    $Ticket_id=rand(0000000,9999999);
   
      
      if ( !file_exists( $PNG_TEMP_DIR ) ) /*checking alrady qr code exist*/
        mkdir( $PNG_TEMP_DIR );

      /*Store data to Qr library*/
      $codeString = "Ticket Id - " . $Ticket_id . "\n";
      $codeString .= $_SESSION[ 'Departure_from' ] . " to " . $_SESSION[ 'Final_Destination' ] . "\n";
      $codeString .= "Departure Time - " . $_SESSION[ 'Stat_time' ] . "\n";
      $codeString .= "Bus Number - " . $_SESSION[ 'Bnumber' ] . "\n";
      $codeString .= "Seat Code - Sn30   \n";
      $codeString .= "Issue Date - " . $E_date . "\n";


      $filename = $PNG_TEMP_DIR . 'test' . md5( $codeString ) . '.png'; /*encrypting name and save image*/
      QRcode::png( $codeString, $filename );
      $Qr_code = 'test' . md5( $codeString ) . '.png';

      /*Search qr code exist in database*/
      $select = mysqli_query( $connect, "SELECT * FROM ticket WHERE Qr_code ='$Qr_code'" );
      if ( !mysqli_num_rows( $select ) ) {

        mysqli_query( $connect, "Insert into ticket 
          (Tid,Passenger_Id, Issue_Date,Departure_Time, Route, Seat_id, Schedul_id, Bus_number, Qr_code) values
          ('$Ticket_id',$userid , '$E_date' ,'$Departure_Time','$bus_Root','Sn30', $Shedules_id,'$Bus_number' ,'$Qr_code')" );

        }
    }
  
  if(strstr($Seatdata,'Sn31')) {
    mysqli_query($connect,"UPDATE seat Set Status='D' WHERE Name='Sn31' and Shedules_id={$_SESSION['Shedules_id']}");
    
    $Ticket_id=rand(0000000,9999999);
   
      
      if ( !file_exists( $PNG_TEMP_DIR ) ) /*checking alrady qr code exist*/
        mkdir( $PNG_TEMP_DIR );

      /*Store data to Qr library*/
      $codeString = "Ticket Id - " . $Ticket_id . "\n";
      $codeString .= $_SESSION[ 'Departure_from' ] . " to " . $_SESSION[ 'Final_Destination' ] . "\n";
      $codeString .= "Departure Time - " . $_SESSION[ 'Stat_time' ] . "\n";
      $codeString .= "Bus Number - " . $_SESSION[ 'Bnumber' ] . "\n";
      $codeString .= "Seat Code - Sn31   \n";
      $codeString .= "Issue Date - " . $E_date . "\n";


      $filename = $PNG_TEMP_DIR . 'test' . md5( $codeString ) . '.png'; /*encrypting name and save image*/
      QRcode::png( $codeString, $filename );
      $Qr_code = 'test' . md5( $codeString ) . '.png';

      /*Search qr code exist in database*/
      $select = mysqli_query( $connect, "SELECT * FROM ticket WHERE Qr_code ='$Qr_code'" );
      if ( !mysqli_num_rows( $select ) ) {

        mysqli_query( $connect, "Insert into ticket 
          (Tid,Passenger_Id, Issue_Date,Departure_Time, Route, Seat_id, Schedul_id, Bus_number, Qr_code) values
          ('$Ticket_id',$userid , '$E_date' ,'$Departure_Time','$bus_Root','Sn31', $Shedules_id,'$Bus_number' ,'$Qr_code')" );

        }
    }
  
  if(strstr($Seatdata,'Sn32')) {
    mysqli_query($connect,"UPDATE seat Set Status='D' WHERE Name='Sn32' and Shedules_id={$_SESSION['Shedules_id']}");
    
    $Ticket_id=rand(0000000,9999999);
   
      
      if ( !file_exists( $PNG_TEMP_DIR ) ) /*checking alrady qr code exist*/
        mkdir( $PNG_TEMP_DIR );

      /*Store data to Qr library*/
      $codeString = "Ticket Id - " . $Ticket_id . "\n";
      $codeString .= $_SESSION[ 'Departure_from' ] . " to " . $_SESSION[ 'Final_Destination' ] . "\n";
      $codeString .= "Departure Time - " . $_SESSION[ 'Stat_time' ] . "\n";
      $codeString .= "Bus Number - " . $_SESSION[ 'Bnumber' ] . "\n";
      $codeString .= "Seat Code - Sn32   \n";
      $codeString .= "Issue Date - " . $E_date . "\n";


      $filename = $PNG_TEMP_DIR . 'test' . md5( $codeString ) . '.png'; /*encrypting name and save image*/
      QRcode::png( $codeString, $filename );
      $Qr_code = 'test' . md5( $codeString ) . '.png';

      /*Search qr code exist in database*/
      $select = mysqli_query( $connect, "SELECT * FROM ticket WHERE Qr_code ='$Qr_code'" );
      if ( !mysqli_num_rows( $select ) ) {

        mysqli_query( $connect, "Insert into ticket 
          (Tid,Passenger_Id, Issue_Date,Departure_Time, Route, Seat_id, Schedul_id, Bus_number, Qr_code) values
          ('$Ticket_id',$userid , '$E_date' ,'$Departure_Time','$bus_Root','Sn32', $Shedules_id,'$Bus_number' ,'$Qr_code')" );

       }
    }
  
  if(strstr($Seatdata,'Sn33')) {
    mysqli_query($connect,"UPDATE seat Set Status='D' WHERE Name='Sn33' and Shedules_id={$_SESSION['Shedules_id']}");
    
    $Ticket_id=rand(0000000,9999999);
   
      
      if ( !file_exists( $PNG_TEMP_DIR ) ) /*checking alrady qr code exist*/
        mkdir( $PNG_TEMP_DIR );

      /*Store data to Qr library*/
      $codeString = "Ticket Id - " . $Ticket_id . "\n";
      $codeString .= $_SESSION[ 'Departure_from' ] . " to " . $_SESSION[ 'Final_Destination' ] . "\n";
      $codeString .= "Departure Time - " . $_SESSION[ 'Stat_time' ] . "\n";
      $codeString .= "Bus Number - " . $_SESSION[ 'Bnumber' ] . "\n";
      $codeString .= "Seat Code - Sn33   \n";
      $codeString .= "Issue Date - " . $E_date . "\n";


      $filename = $PNG_TEMP_DIR . 'test' . md5( $codeString ) . '.png'; /*encrypting name and save image*/
      QRcode::png( $codeString, $filename );
      $Qr_code = 'test' . md5( $codeString ) . '.png';

      /*Search qr code exist in database*/
      $select = mysqli_query( $connect, "SELECT * FROM ticket WHERE Qr_code ='$Qr_code'" );
      if ( !mysqli_num_rows( $select ) ) {

        mysqli_query( $connect, "Insert into ticket 
          (Tid,Passenger_Id, Issue_Date,Departure_Time, Route, Seat_id, Schedul_id, Bus_number, Qr_code) values
          ('$Ticket_id',$userid , '$E_date' ,'$Departure_Time','$bus_Root','Sn33', $Shedules_id,'$Bus_number' ,'$Qr_code')" );

        }
    }
  
  if(strstr($Seatdata,'Sn34')) {
    mysqli_query($connect,"UPDATE seat Set Status='D' WHERE Name='Sn34' and Shedules_id={$_SESSION['Shedules_id']}");
    
    $Ticket_id=rand(0000000,9999999);
   
      
      if ( !file_exists( $PNG_TEMP_DIR ) ) /*checking alrady qr code exist*/
        mkdir( $PNG_TEMP_DIR );

      /*Store data to Qr library*/
      $codeString = "Ticket Id - " . $Ticket_id . "\n";
      $codeString .= $_SESSION[ 'Departure_from' ] . " to " . $_SESSION[ 'Final_Destination' ] . "\n";
      $codeString .= "Departure Time - " . $_SESSION[ 'Stat_time' ] . "\n";
      $codeString .= "Bus Number - " . $_SESSION[ 'Bnumber' ] . "\n";
      $codeString .= "Seat Code - Sn34   \n";
      $codeString .= "Issue Date - " . $E_date . "\n";


      $filename = $PNG_TEMP_DIR . 'test' . md5( $codeString ) . '.png'; /*encrypting name and save image*/
      QRcode::png( $codeString, $filename );
      $Qr_code = 'test' . md5( $codeString ) . '.png';

      /*Search qr code exist in database*/
      $select = mysqli_query( $connect, "SELECT * FROM ticket WHERE Qr_code ='$Qr_code'" );
      if ( !mysqli_num_rows( $select ) ) {

        mysqli_query( $connect, "Insert into ticket 
          (Tid,Passenger_Id, Issue_Date,Departure_Time, Route, Seat_id, Schedul_id, Bus_number, Qr_code) values
          ('$Ticket_id',$userid , '$E_date' ,'$Departure_Time','$bus_Root','Sn34', $Shedules_id,'$Bus_number' ,'$Qr_code')" );

        }
    }
  
  if(strstr($Seatdata,'Sn35')) {
    mysqli_query($connect,"UPDATE seat Set Status='D' WHERE Name='Sn35' and Shedules_id={$_SESSION['Shedules_id']}");
    
    $Ticket_id=rand(0000000,9999999);
   
      
      if ( !file_exists( $PNG_TEMP_DIR ) ) /*checking alrady qr code exist*/
        mkdir( $PNG_TEMP_DIR );

      /*Store data to Qr library*/
      $codeString = "Ticket Id - " . $Ticket_id . "\n";
      $codeString .= $_SESSION[ 'Departure_from' ] . " to " . $_SESSION[ 'Final_Destination' ] . "\n";
      $codeString .= "Departure Time - " . $_SESSION[ 'Stat_time' ] . "\n";
      $codeString .= "Bus Number - " . $_SESSION[ 'Bnumber' ] . "\n";
      $codeString .= "Seat Code - Sn35   \n";
      $codeString .= "Issue Date - " . $E_date . "\n";


      $filename = $PNG_TEMP_DIR . 'test' . md5( $codeString ) . '.png'; /*encrypting name and save image*/
      QRcode::png( $codeString, $filename );
      $Qr_code = 'test' . md5( $codeString ) . '.png';

      /*Search qr code exist in database*/
      $select = mysqli_query( $connect, "SELECT * FROM ticket WHERE Qr_code ='$Qr_code'" );
      if ( !mysqli_num_rows( $select ) ) {

        mysqli_query( $connect, "Insert into ticket 
          (Tid,Passenger_Id, Issue_Date,Departure_Time, Route, Seat_id, Schedul_id, Bus_number, Qr_code) values
          ('$Ticket_id',$userid , '$E_date' ,'$Departure_Time','$bus_Root','Sn35', $Shedules_id,'$Bus_number' ,'$Qr_code')" );

        }
    }
  
  if(strstr($Seatdata,'Sn36')) {
    mysqli_query($connect,"UPDATE seat Set Status='D' WHERE Name='Sn36' and Shedules_id={$_SESSION['Shedules_id']}");
    
    $Ticket_id=rand(0000000,9999999);
   
      
      if ( !file_exists( $PNG_TEMP_DIR ) ) /*checking alrady qr code exist*/
        mkdir( $PNG_TEMP_DIR );

      /*Store data to Qr library*/
      $codeString = "Ticket Id - " . $Ticket_id . "\n";
      $codeString .= $_SESSION[ 'Departure_from' ] . " to " . $_SESSION[ 'Final_Destination' ] . "\n";
      $codeString .= "Departure Time - " . $_SESSION[ 'Stat_time' ] . "\n";
      $codeString .= "Bus Number - " . $_SESSION[ 'Bnumber' ] . "\n";
      $codeString .= "Seat Code - Sn36   \n";
      $codeString .= "Issue Date - " . $E_date . "\n";


      $filename = $PNG_TEMP_DIR . 'test' . md5( $codeString ) . '.png'; /*encrypting name and save image*/
      QRcode::png( $codeString, $filename );
      $Qr_code = 'test' . md5( $codeString ) . '.png';

      /*Search qr code exist in database*/
      $select = mysqli_query( $connect, "SELECT * FROM ticket WHERE Qr_code ='$Qr_code'" );
      if ( !mysqli_num_rows( $select ) ) {

        mysqli_query( $connect, "Insert into ticket 
          (Tid,Passenger_Id, Issue_Date,Departure_Time, Route, Seat_id, Schedul_id, Bus_number, Qr_code) values
          ('$Ticket_id',$userid , '$E_date' ,'$Departure_Time','$bus_Root','Sn36', $Shedules_id,'$Bus_number' ,'$Qr_code')" );

        }
    }
  
  if(strstr($Seatdata,'Sn37')) {
    mysqli_query($connect,"UPDATE seat Set Status='D' WHERE Name='Sn37' and Shedules_id={$_SESSION['Shedules_id']}");
    
    $Ticket_id=rand(0000000,9999999);
   
      
      if ( !file_exists( $PNG_TEMP_DIR ) ) /*checking alrady qr code exist*/
        mkdir( $PNG_TEMP_DIR );

      /*Store data to Qr library*/
      $codeString = "Ticket Id - " . $Ticket_id . "\n";
      $codeString .= $_SESSION[ 'Departure_from' ] . " to " . $_SESSION[ 'Final_Destination' ] . "\n";
      $codeString .= "Departure Time - " . $_SESSION[ 'Stat_time' ] . "\n";
      $codeString .= "Bus Number - " . $_SESSION[ 'Bnumber' ] . "\n";
      $codeString .= "Seat Code - Sn37   \n";
      $codeString .= "Issue Date - " . $E_date . "\n";


      $filename = $PNG_TEMP_DIR . 'test' . md5( $codeString ) . '.png'; /*encrypting name and save image*/
      QRcode::png( $codeString, $filename );
      $Qr_code = 'test' . md5( $codeString ) . '.png';

      /*Search qr code exist in database*/
      $select = mysqli_query( $connect, "SELECT * FROM ticket WHERE Qr_code ='$Qr_code'" );
      if ( !mysqli_num_rows( $select ) ) {

        mysqli_query( $connect, "Insert into ticket 
          (Tid,Passenger_Id, Issue_Date,Departure_Time, Route, Seat_id, Schedul_id, Bus_number, Qr_code) values
          ('$Ticket_id',$userid , '$E_date' ,'$Departure_Time','$bus_Root','Sn37', $Shedules_id,'$Bus_number' ,'$Qr_code')" );

        }
    }
  
  if(strstr($Seatdata,'Sn38')) {
    mysqli_query($connect,"UPDATE seat Set Status='D' WHERE Name='Sn38' and Shedules_id={$_SESSION['Shedules_id']}");
    
    $Ticket_id=rand(0000000,9999999);
   
      
      if ( !file_exists( $PNG_TEMP_DIR ) ) /*checking alrady qr code exist*/
        mkdir( $PNG_TEMP_DIR );

      /*Store data to Qr library*/
      $codeString = "Ticket Id - " . $Ticket_id . "\n";
      $codeString .= $_SESSION[ 'Departure_from' ] . " to " . $_SESSION[ 'Final_Destination' ] . "\n";
      $codeString .= "Departure Time - " . $_SESSION[ 'Stat_time' ] . "\n";
      $codeString .= "Bus Number - " . $_SESSION[ 'Bnumber' ] . "\n";
      $codeString .= "Seat Code - Sn38   \n";
      $codeString .= "Issue Date - " . $E_date . "\n";


      $filename = $PNG_TEMP_DIR . 'test' . md5( $codeString ) . '.png'; /*encrypting name and save image*/
      QRcode::png( $codeString, $filename );
      $Qr_code = 'test' . md5( $codeString ) . '.png';

      /*Search qr code exist in database*/
      $select = mysqli_query( $connect, "SELECT * FROM ticket WHERE Qr_code ='$Qr_code'" );
      if ( !mysqli_num_rows( $select ) ) {

        mysqli_query( $connect, "Insert into ticket 
          (Tid,Passenger_Id, Issue_Date,Departure_Time, Route, Seat_id, Schedul_id, Bus_number, Qr_code) values
          ('$Ticket_id',$userid , '$E_date' ,'$Departure_Time','$bus_Root','Sn38', $Shedules_id,'$Bus_number' ,'$Qr_code')" );

        }
    }
  
  if(strstr($Seatdata,'Sn39')) {
    mysqli_query($connect,"UPDATE seat Set Status='D' WHERE Name='Sn39' and Shedules_id={$_SESSION['Shedules_id']}");
    
    $Ticket_id=rand(0000000,9999999);
   
      
      if ( !file_exists( $PNG_TEMP_DIR ) ) /*checking alrady qr code exist*/
        mkdir( $PNG_TEMP_DIR );

      /*Store data to Qr library*/
      $codeString = "Ticket Id - " . $Ticket_id . "\n";
      $codeString .= $_SESSION[ 'Departure_from' ] . " to " . $_SESSION[ 'Final_Destination' ] . "\n";
      $codeString .= "Departure Time - " . $_SESSION[ 'Stat_time' ] . "\n";
      $codeString .= "Bus Number - " . $_SESSION[ 'Bnumber' ] . "\n";
      $codeString .= "Seat Code - Sn39   \n";
      $codeString .= "Issue Date - " . $E_date . "\n";


      $filename = $PNG_TEMP_DIR . 'test' . md5( $codeString ) . '.png'; /*encrypting name and save image*/
      QRcode::png( $codeString, $filename );
      $Qr_code = 'test' . md5( $codeString ) . '.png';

      /*Search qr code exist in database*/
      $select = mysqli_query( $connect, "SELECT * FROM ticket WHERE Qr_code ='$Qr_code'" );
      if ( !mysqli_num_rows( $select ) ) {

        mysqli_query( $connect, "Insert into ticket 
          (Tid,Passenger_Id, Issue_Date,Departure_Time, Route, Seat_id, Schedul_id, Bus_number, Qr_code) values
          ('$Ticket_id',$userid , '$E_date' ,'$Departure_Time','$bus_Root','Sn39', $Shedules_id,'$Bus_number' ,'$Qr_code')" );

        }
    }
  
  if(strstr($Seatdata,'Sn40')) {
    mysqli_query($connect,"UPDATE seat Set Status='D' WHERE Name='Sn40' and Shedules_id={$_SESSION['Shedules_id']}");
    
    $Ticket_id=rand(0000000,9999999);
   
      
      if ( !file_exists( $PNG_TEMP_DIR ) ) /*checking alrady qr code exist*/
        mkdir( $PNG_TEMP_DIR );

      /*Store data to Qr library*/
      $codeString = "Ticket Id - " . $Ticket_id . "\n";
      $codeString .= $_SESSION[ 'Departure_from' ] . " to " . $_SESSION[ 'Final_Destination' ] . "\n";
      $codeString .= "Departure Time - " . $_SESSION[ 'Stat_time' ] . "\n";
      $codeString .= "Bus Number - " . $_SESSION[ 'Bnumber' ] . "\n";
      $codeString .= "Seat Code - Sn40   \n";
      $codeString .= "Issue Date - " . $E_date . "\n";


      $filename = $PNG_TEMP_DIR . 'test' . md5( $codeString ) . '.png'; /*encrypting name and save image*/
      QRcode::png( $codeString, $filename );
      $Qr_code = 'test' . md5( $codeString ) . '.png';

      /*Search qr code exist in database*/
      $select = mysqli_query( $connect, "SELECT * FROM ticket WHERE Qr_code ='$Qr_code'" );
      if ( !mysqli_num_rows( $select ) ) {

        mysqli_query( $connect, "Insert into ticket 
          (Tid,Passenger_Id, Issue_Date,Departure_Time, Route, Seat_id, Schedul_id, Bus_number, Qr_code) values
          ('$Ticket_id',$userid , '$E_date' ,'$Departure_Time','$bus_Root','Sn40', $Shedules_id,'$Bus_number' ,'$Qr_code')" );

        }
    }
  
  if(strstr($Seatdata,'Sn41')) {
    mysqli_query($connect,"UPDATE seat Set Status='D' WHERE Name='Sn41' and Shedules_id={$_SESSION['Shedules_id']}");
    
    $Ticket_id=rand(0000000,9999999);
   
      
      if ( !file_exists( $PNG_TEMP_DIR ) ) /*checking alrady qr code exist*/
        mkdir( $PNG_TEMP_DIR );

      /*Store data to Qr library*/
      $codeString = "Ticket Id - " . $Ticket_id . "\n";
      $codeString .= $_SESSION[ 'Departure_from' ] . " to " . $_SESSION[ 'Final_Destination' ] . "\n";
      $codeString .= "Departure Time - " . $_SESSION[ 'Stat_time' ] . "\n";
      $codeString .= "Bus Number - " . $_SESSION[ 'Bnumber' ] . "\n";
      $codeString .= "Seat Code - Sn41   \n";
      $codeString .= "Issue Date - " . $E_date . "\n";


      $filename = $PNG_TEMP_DIR . 'test' . md5( $codeString ) . '.png'; /*encrypting name and save image*/
      QRcode::png( $codeString, $filename );
      $Qr_code = 'test' . md5( $codeString ) . '.png';

      /*Search qr code exist in database*/
      $select = mysqli_query( $connect, "SELECT * FROM ticket WHERE Qr_code ='$Qr_code'" );
      if ( !mysqli_num_rows( $select ) ) {

        mysqli_query( $connect, "Insert into ticket 
          (Tid,Passenger_Id, Issue_Date,Departure_Time, Route, Seat_id, Schedul_id, Bus_number, Qr_code) values
          ('$Ticket_id',$userid , '$E_date' ,'$Departure_Time','$bus_Root','Sn41', $Shedules_id,'$Bus_number' ,'$Qr_code')" );

        }
    }
  
  if(strstr($Seatdata,'Sn42')) {
    mysqli_query($connect,"UPDATE seat Set Status='D' WHERE Name='Sn42' and Shedules_id={$_SESSION['Shedules_id']}");
    
    $Ticket_id=rand(0000000,9999999);
   
      
      if ( !file_exists( $PNG_TEMP_DIR ) ) /*checking alrady qr code exist*/
        mkdir( $PNG_TEMP_DIR );

      /*Store data to Qr library*/
      $codeString = "Ticket Id - " . $Ticket_id . "\n";
      $codeString .= $_SESSION[ 'Departure_from' ] . " to " . $_SESSION[ 'Final_Destination' ] . "\n";
      $codeString .= "Departure Time - " . $_SESSION[ 'Stat_time' ] . "\n";
      $codeString .= "Bus Number - " . $_SESSION[ 'Bnumber' ] . "\n";
      $codeString .= "Seat Code - Sn42   \n";
      $codeString .= "Issue Date - " . $E_date . "\n";


      $filename = $PNG_TEMP_DIR . 'test' . md5( $codeString ) . '.png'; /*encrypting name and save image*/
      QRcode::png( $codeString, $filename );
      $Qr_code = 'test' . md5( $codeString ) . '.png';

      /*Search qr code exist in database*/
      $select = mysqli_query( $connect, "SELECT * FROM ticket WHERE Qr_code ='$Qr_code'" );
      if ( !mysqli_num_rows( $select ) ) {

        mysqli_query( $connect, "Insert into ticket 
          (Tid,Passenger_Id, Issue_Date,Departure_Time, Route, Seat_id, Schedul_id, Bus_number, Qr_code) values
          ('$Ticket_id',$userid , '$E_date' ,'$Departure_Time','$bus_Root','Sn42', $Shedules_id,'$Bus_number' ,'$Qr_code')" );

        }
    }
  
  if(strstr($Seatdata,'Sn43')) {
    mysqli_query($connect,"UPDATE seat Set Status='D' WHERE Name='Sn43' and Shedules_id={$_SESSION['Shedules_id']}");
    
    $Ticket_id=rand(0000000,9999999);
   
      
      if ( !file_exists( $PNG_TEMP_DIR ) ) /*checking alrady qr code exist*/
        mkdir( $PNG_TEMP_DIR );

      /*Store data to Qr library*/
      $codeString = "Ticket Id - " . $Ticket_id . "\n";
      $codeString .= $_SESSION[ 'Departure_from' ] . " to " . $_SESSION[ 'Final_Destination' ] . "\n";
      $codeString .= "Departure Time - " . $_SESSION[ 'Stat_time' ] . "\n";
      $codeString .= "Bus Number - " . $_SESSION[ 'Bnumber' ] . "\n";
      $codeString .= "Seat Code - Sn43   \n";
      $codeString .= "Issue Date - " . $E_date . "\n";


      $filename = $PNG_TEMP_DIR . 'test' . md5( $codeString ) . '.png'; /*encrypting name and save image*/
      QRcode::png( $codeString, $filename );
      $Qr_code = 'test' . md5( $codeString ) . '.png';

      /*Search qr code exist in database*/
      $select = mysqli_query( $connect, "SELECT * FROM ticket WHERE Qr_code ='$Qr_code'" );
      if ( !mysqli_num_rows( $select ) ) {

        mysqli_query( $connect, "Insert into ticket 
          (Tid,Passenger_Id, Issue_Date,Departure_Time, Route, Seat_id, Schedul_id, Bus_number, Qr_code) values
          ('$Ticket_id',$userid , '$E_date' ,'$Departure_Time','$bus_Root','Sn43', $Shedules_id,'$Bus_number' ,'$Qr_code')" );

        }
    }
  
  if(strstr($Seatdata,'Sn44')) {
    mysqli_query($connect,"UPDATE seat Set Status='D' WHERE Name='Sn44' and Shedules_id={$_SESSION['Shedules_id']}");
    
    $Ticket_id=rand(0000000,9999999);
   
      
      if ( !file_exists( $PNG_TEMP_DIR ) ) /*checking alrady qr code exist*/
        mkdir( $PNG_TEMP_DIR );

      /*Store data to Qr library*/
      $codeString = "Ticket Id - " . $Ticket_id . "\n";
      $codeString .= $_SESSION[ 'Departure_from' ] . " to " . $_SESSION[ 'Final_Destination' ] . "\n";
      $codeString .= "Departure Time - " . $_SESSION[ 'Stat_time' ] . "\n";
      $codeString .= "Bus Number - " . $_SESSION[ 'Bnumber' ] . "\n";
      $codeString .= "Seat Code - Sn44   \n";
      $codeString .= "Issue Date - " . $E_date . "\n";


      $filename = $PNG_TEMP_DIR . 'test' . md5( $codeString ) . '.png'; /*encrypting name and save image*/
      QRcode::png( $codeString, $filename );
      $Qr_code = 'test' . md5( $codeString ) . '.png';

      /*Search qr code exist in database*/
      $select = mysqli_query( $connect, "SELECT * FROM ticket WHERE Qr_code ='$Qr_code'" );
      if ( !mysqli_num_rows( $select ) ) {

        mysqli_query( $connect, "Insert into ticket 
          (Tid,Passenger_Id, Issue_Date,Departure_Time, Route, Seat_id, Schedul_id, Bus_number, Qr_code) values
          ('$Ticket_id',$userid , '$E_date' ,'$Departure_Time','$bus_Root','Sn44', $Shedules_id,'$Bus_number' ,'$Qr_code')" );

        }
    }
  
  /*Send notification to user */
   mysqli_query( $connect, "Insert into notifications(UserID,Notifications,Type,status) 
           values ($userid , 'You have successfuly purchased bus ticket for $bus_Root at $Departure_Time','Purchase Confirmation' ,'unread')" );
 
  unset($_SESSION[ 'Booking' ]);
  ?><script>alert("Reservation Successful");window.location.href='User-Bookin-details.php';</script><?php
}
}
?>



<?php 
include('user-footer.php');?>
