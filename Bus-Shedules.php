<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Beyaztop</title>
 <link rel="stylesheet" type="text/css" href="css/authenticate.css">

</head>
<body>
 <header>
		<a href="User-Home-page.php" class="logo"><img src="img/bg-img/Beyaztop-logo.png" alt=" Logo" width="130px" height="85px"></a>

		<ul class="navbar">
			<li ><a href="Home.php">Home</a></li>
     <li><a href="Bus-Shedules.php">Schedules</a></li>
    <li><a href="About.php">About</a></li>
    <li><a href="F&Q.php">F&Q</a></li>
		</ul>

		<div class="main">
			<div class="loginbtn"><button onClick="location.href='Login.php'">Sign In</button>
   <button onClick="location.href='Register.php'">Sign Up</button></div>
			<div  id="menu-icon"><img src="img/Icon/icons8-chevron-down-30.png" /></div>
		</div>
	</header>


	<!--js link--->
	<script type="text/javascript" src="js/Nav bar.js"></script>
 
<main>
 
 <br><br><br><br><br><br><br>
 <div id="table-page-wrap">
  <h1>Bus schedule</h1>
  <p>Find highway bus timetables from here. You can select the desired destination and make resrvations.</p>
</div>
  
  <div class="userTable"> 
    <!-- Table section starts  -->
   
    <div class="header_fixed">
      <table>
        <thead>
          <?php
         
         date_default_timezone_set('Asia/Colombo');
         $cur_time= date("H:i:s");
         
         include 'connect.php';
          //sql Query to get data
          $sql = "SELECT * FROM bus_shedules where Status='A' ";
          $res = mysqli_query( $connect, $sql );
          //count Rows
          $count = mysqli_num_rows( $res );

          if ( $count > 0 ) {
            ?>
          <tr>
            <th>Bus Name</th>
            <th>Bus Number</th>
            <th>Departure from</th>
            <th>Departure Time</th>
            <th>Final Destination</th>
            <th>Arrival Time</th>
            <th>Available Seat</th>
            <th>Options</th>
          </tr>
        </thead>
        <?php
        while ( $row = mysqli_fetch_assoc( $res ) ) {
          $id = $row[ 'Shedules_id' ];
          $Bname = $row[ 'Bus_name' ];
          $Bnumber = $row[ 'Bus_number' ];
          $Stime = $row[ 'Stat_time' ];
          $Etime = $row[ 'End_time' ];
          $Spoint = $row[ 'Starting_point' ];
          $Destination = $row[ 'Final_destination' ];
          $Scount = $row[ 'Seats_Count' ];
          $Status = $row[ 'Status' ];
         
         if($cur_time <=$Stime){
          
          ?>
        <tbody>
          <tr>
            <td><?php echo $Bname;?></td>
            <td><?php echo $Bnumber;?></td>
            <td><?php echo $Spoint;?></td>
            <td><?php echo $Stime;?></td>
            <td><?php echo $Destination;?></td>
            <td><?php echo $Etime;?></td>
            <?php


            $sql_Seat_Status = mysqli_query( $connect, 'SELECT COUNT(*) as seat_Count from seat where Shedules_id="' . $id . '" AND Status="A";' );
            $result = mysqli_fetch_assoc( $sql_Seat_Status );
            $seat_Count = $result[ 'seat_Count' ];


            ?>
            <td><?php echo $seat_Count;?></td>
            <?php
           if($seat_Count!=='0'){
          ?>
           <td><button>
              <a class="btn-table" href="User/user-bus-schedules.php">Book a seat</a>
              </button></td>
           <?php
         }else{
          ?>
           <td>Seat unavailable</td>
           <?php
         }
            ?>
            
          </tr>
        </tbody>
        <?php

         }else{
         // echo '<td>No buses at the moment.</td>';
         }
 
        }

        } else {
          echo "<tr> <td colspan='7' class 'error'>Bus Details not add yet.</td></tr>";
        }

        ?>
      </table>
    </div>
  </div>
  <!-- Table section ends  --> 
  
<!-- footer section starts  -->
<footer class="footer">
  <div class="container1">
    <div class="row">
      <div class="footer-col">
        <h4>company</h4>
        <ul>
          <li><a href="About.php">about us</a></li>
          <li><a href="https://www.sltb.lk/service.html">our services</a></li>
         
        </ul>
      </div>
      <div class="footer-col">
        <h4>get help</h4>
        <ul>
          <li><a href="F&Q.php">FAQ</a></li>
          
        </ul>
      </div>
      <div class="footer-col">
        <h4>Contact Us</h4>
        <ul>
          <li><a href="#">Sri Lanka Transport Board,</a></li>
          <li><a href="#">Head Office, No.200,</a></li>
          <li><a href="#">Kirula Road, Colombo 5,</a></li>
          <li><a href="#">Sri Lanka.</a></li>
          <li><a href="#">+94 112 581 120</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>Additional Links</h4>
        <ul>
          <li><a href="https://www.sltb.lk/vacancies.html">Vacancy</a></li>
          <li><a href="https://www.sltb.lk/Bus_fare.html">Inter bus fare</a></li>
          <li><a href="https://www.sltb.lk/network.html">Our Networks</a></li>
        </ul>
      </div>
    </div>
  </div>
  </div>
</footer>
<!-- footer section ends -->
</main>
</body>
</html>