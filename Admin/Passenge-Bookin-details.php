<?php include('Admin-nav.php');
//sql Query to get data
include '../connect.php';?>

<!--Body section-->
 
	<div id="page-wrap">

	<h1>Passenger resevation details</h1>
	
	<p>All Passenger's Resevation Informations Mentioned below</p>
		
	
   <?php 
     //sql Query to get data
     $sql="SELECT * FROM ticket";
      $res=mysqli_query($connect,$sql);
     //count Rows
     $count=mysqli_num_rows($res);
      
      
      $sn=1;//creat variable and assign the valu
     if($count>0)
     {
      ?>
  <table>
		        <tr>
            <th>Ticket_No</th>
            <th>Passenger Id</th>
            <th>Date</th>
            <th>Departure Time</th>
             <th>Schedul id</th>
            <th>Route</th>
            <th>Seat id</th>
            <th>Bus_number</th>
          </tr>
  
      <?php
       while($row=mysqli_fetch_assoc($res))
       {
        
          $P_Id=$row['Passenger_Id'];
          $Schedulid=$row['Schedul_id'];
          $Ticket_no = $row[ 'Tid' ];
          $Issue_Date = $row[ 'Issue_Date' ];
          $BusNo = $row[ 'Bus_number' ];
          $Route = $row[ 'Route' ];
          $Seat_No = $row[ 'Seat_id' ];
         $De_Time=$row['Departure_Time'];
        
        ?>
          <tr>
           <td><?php echo $Ticket_no;?></td>
           <td><?php echo $P_Id;?></td>
            <td><?php echo $Issue_Date;?></td>
             <td><?php echo $De_Time;?></td>
           <td><?php echo $Schedulid; ?></td>
           <td><?php echo $Route;?></td>
            <td><?php echo $Seat_No;?></td>
            <td><?php echo $BusNo;?></td>
      
        <?php 
       }
      
    }else{
       echo "<tr> <td colspan='7' class 'error'>Ticket was expired or still user's haven't reserved seats yet..</td></tr>";
       }
     ?>
    
   </table>
  </div>
<!-- Table section ends  -->


<?php include('Admin-footer.php');?>