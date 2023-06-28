<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<?php include('user-header.php');?>

<main>
 
     <!-- Main body section starts  -->
<div class="home_container">


    <div class="bus_content">

      <div class="info">
        <h2>Get your ticket online,<br>
      easy and safely.</h2>
       <!-- <p>beyaztop.</p>-->
      </div>
     <form method="post" action="#" >
     <div class="booking_info">
        <div class="opt"> <span class="active">Find root</span> 
          <!--  <span>Homes</span>--> 
        </div>
        <div class="booking_details">
          <div class="item">
            <select name="spoint">
              <option value="0" hidden>Pickup Point</option>
              <option value="Matara">Matara</option>
              <option value="Makubura">Makubura</option>
            </select>
          </div>
          <div class="item">
            <select name="epoint">
              <option value="0" hidden>Departure Point</option>
              <option value="Makubura">Makubura</option>
              <option value="Matara">Matara</option>
            </select>
          </div>
          <div class="item">
             <input type="date" id="inputdate" name="date" required>
          </div>
          <div class="item">
            <div ><button type="submit"  name="submit" class="cta active">Search</button></div>
          </div>
        </div>
      </div>
     </form>
    </div>
  </div>
 </main>



<?php
if ( isset( $_POST[ 'submit' ] ) ) {
  include '../connect.php';

 $date = mysqli_real_escape_string( $connect, $_POST[ 'date' ] );
 
 

 if($_POST[ 'spoint' ]=='0'){
  echo '<script>alert("Please select pickup point");</script>';
 }
 else if( $_POST[ 'epoint' ]=='0' ){
  echo '<script>alert("Please select departure point");</script>';
 }
 else if(strlen( $date ) == 0 ){
  echo '<script>alert("Please select date");</script>';
 }
 else if($_POST[ 'epoint' ]==$_POST[ 'spoint' ]){
  echo '<script>alert("Departure point and pickup point are same");</script>';
 }
 else{
  
     $Spoint = mysqli_real_escape_string( $connect, $_POST[ 'spoint' ] );
     $Epoint = mysqli_real_escape_string( $connect, $_POST[ 'epoint' ] );
     
  header( "location:User-Schedule-search.php?spoint=$Spoint&epoint=$epoint" );
  
   }    

}else{
// header( "location:User-Home-page.php" );
}

?>


 <script type="text/javascript">
    $(function(){
    var dtToday = new Date();
 
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
     day = '0' + day.toString();
    var maxDate = year + '-' + month + '-' + day;
    $('#inputdate').attr('min', maxDate);
});
 </script>
<?php include('user-footer.php');?>
 